<?php
#error_reporting(E_ALL);
const ROOT = __DIR__;

$loader = require dirname(ROOT)."/vendor/autoload.php";

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Model\Manager\SessionManager;

use Symfony\Component\ClassLoader\UniversalClassLoader;

use App\Controller\IndexController;
use App\Controller\ArticleController;
use App\Controller\UserController;
use App\Controller\CommentController;
use App\Controller\Admin\UserAdminController;
use App\Controller\Admin\ArticleAdminController;

# bootstrap
$app = new Silex\Application();

#debug
$app['debug'] = true;

# autoloader
$app['autoloader'] = $app->share(function()use($loader){return $loader;});
# paramètrer l'autoloader.
$app['autoloader']->add("App", dirname(ROOT));
$app['autoloader']->add("Lib", dirname(ROOT));
# providers
# twig
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    "twig.path" => ROOT . "/view",
    'twig.options' => array('cache' => ROOT . '/../cache', 'strict_variables' => true)
        )
);
# form
$app->register(new Silex\Provider\FormServiceProvider());
# session
$app->register(new Silex\Provider\SessionServiceProvider());
# trans
$app->register(new Silex\Provider\TranslationServiceProvider(), array("locale_fallback" => "en"));
# url generator
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
# validation
$app->register(new Silex\Provider\ValidatorServiceProvider());
# monolog
$app->register(new Silex\Provider\MonologServiceProvider(), array('monolog.logfile' => ROOT . '/../log/development.log', 'monolog.name' => 'mongoblog'));
$app['monolog.handler'] = $app->share(function(Application $app){
  return new Monolog\Handler\MongoDBHandler($app['mongo'],$app['config.database'],"log");
});
# security
$app->register(new Silex\Provider\SecurityServiceProvider());
# cache
$app->register(new Silex\Provider\HttpCacheServiceProvider());
$app['cache.path'] = ROOT . '/../cache';
$app['http_cache.cache_dir'] = $app['cache.path'];
# CUSTOM SERVICES
$app['root']="";
$app['configuration_script_path'] = ROOT . '/config/configuration.php';
$app['configuration_file'] = ROOT . "/config/configuration.yaml";
$app['config.server'] = getenv('MONGODB_SERVER')?getenv('MONGODB_SERVER'):"localhost";
$app['config.database'] = getenv("MONGODB_DATABASE")?getenv("MONGODB_DATABASE"):"mongoblog";
$app['config.site_title'] = "Mongo Blog";
$app['config.default_user_role'] = "ROLE_WRITER";
$app["mongo"] = $app->share(function($app) {
          return new Mongo($app['config.server']);
        }
);
# session manager
$app['session_manager'] = $app->share(function($app) {
          $sessionManager = new SessionManager($app['mongo'], $app['config.database']);
          return $sessionManager;
        }
);
# EN : defaut session storage handler overloading 
# FR : surcharge du session.storage.handler
$app['session.storage.handler'] = $app->share(function ($app) {
          return $app['session_manager'];
        }
);
$app["gravatar"] = $app->share(function($app) {
          return new \Lib\Gravatar();
        });
# user manager
$app['user_manager'] = $app->share(function($app) {
          $um = new \App\Model\Manager\UserManager($app['mongo'], $app['config.database'], $app);
          return $um;
        });
# article manager
$app['article_manager'] = $app->share(function($app) {
          return new \App\Model\Manager\ArticleManager($app['mongo'], $app['config.database']);
        });
# comment manager
$app['comment_manager'] = $app->share(function(Silex\Application $app) {
          return new \App\Model\Manager\CommentManager($app["mongo"], $app["config.database"]);
        }
);
# FILTERS
# EN : check if the user owns the resource.
# FR : vérifie si l'utilisateur est propriétaire de la resource.
$app['filter.mustbeowner'] = $app->protect(
        function(Request $request)use($app) {
          $user = $app['user_manager']->getUSer();
          $resource_id = $request->get('id');
          if ($app['article_manager']->belongsTo($resource_id, $user) == false):
            $app['session']->setFlash("error", "You cant edit this resource!");
            return $app->redirect($app['url_generator']->generate('index.index'));
          endif;
        }
);
# routes

if ($app['debug'] == true):
  $app->get('/info', function(Response $response, Request $request, Application $app) {
            phpinfo();
          }
  );
endif;
$app->mount("/", new IndexController());
$app->mount("/article", new ArticleController());
$app->mount("/comment", new CommentController());
$app->mount('/user', new UserController());
$app->mount('/admin/user', new UserAdminController());
$app->mount('/admin/article',new ArticleAdminController());

$app['user_infos'] = $app->share(function(Application $app) {
          $user_infos = array();
          if ($app['security'] != null):
            $user_infos['token'] = $app['security']->getToken();
            if ($user_infos['token'] !== null):
              $user_infos['user'] = json_encode($user_infos['token']->getUser());
            endif;
          endif;
          return (object) $user_infos;
        });
# using symfony reverse proxy
Request::trustProxyData();
# FIREWALLS
$app['security.firewalls'] = function(Application $app) {
          return array(
              'admin' => array(
                  'pattern' => '^/',
                  "anonymous" => array(),
                  'form' => array(
                      'login_path' => "/user/login",
                      'check_path' => "/admin/user/dologin",
                      "default_target_path" => "/admin/user/profile",
                      "always_use_default_target_path" => true,
                      'username_parameter' => 'login[username]',
                      'password_parameter' => 'login[password]',
                      "csrf_parameter" => "login[_token]",
                      #"failure_forward" => false,
                      "failure_path" => "/user/login",
                      #"use_forward" => true,
                  ),
                  'logout' => array(
                      'logout_path' => "/admin/user/logout",
                      "target" => '/',
                      "invalidate_session" => true,
                      "delete_cookies" => array(
                          "mongoblog.local" => array("domain" => "mongoblog.local", "path" => "/")
                      )
                  ),
                  'users' => $app->share(function(Application $app) {
                            return $app['user_manager'];
                          }),
              ),
          );
        };
# EN : role hierarchy
# FR : hierarchie des roles
$app['security.role_hierarchy'] = function() {
          return array(
              'ROLE_ADMIN' => array('ROLE_EDITOR'),
              "ROLE_EDITOR" => array('ROLE_WRITER'),
              "ROLE_WRITER" => array('ROLE_USER'),
              "ROLE_USER" => array("ROLE_SUSCRIBER"),
          );
        };
# EN : define access rules
# FR : définir les règles d'accès aux ressources
$app['security.access_rules'] = function() {
          return array(
              array('^/admin', 'ROLE_USER'),
          );
        };

return $app;
