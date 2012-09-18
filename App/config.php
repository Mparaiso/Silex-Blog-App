<?php
#error_reporting(E_ALL);
define('ROOT',dirname(__DIR__));

$loader = require ROOT."/vendor/autoload.php";

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

use Net\Mpmedia\SilexExtension\Provider\GravatarServiceProvider;

# bootstrap
/**@var $app Silex\Application application **/
$app = new Silex\Application();

#debug
$app['debug'] = true;

# autoloader
$app['autoloader'] = $app->share(function()use($loader){return $loader;});
# paramètrer l'autoloader.
$app['autoloader']->add("App",ROOT);
$app['autoloader']->add("Net",ROOT.'/Lib');
# providers
# twig
$app->register(new Silex\Provider\TwigServiceProvider(), array(
  "twig.path" => ROOT . "/App/view",
  'twig.options' => array('cache' => ROOT.'/cache', 'strict_variables' => true)
  )
);
# form
$app->register(new Silex\Provider\FormServiceProvider());
# session
$app->register(new Silex\Provider\SessionServiceProvider(),array(
  'session.storage.handler'=>$app->share(
    function(Application $app){
        // EN : overloading defaut session storage handler  
        // FR : surcharge du session.storage.handler
      return $app['session_manager'];
    }
    )
  ));
# trans
$app->register(new Silex\Provider\TranslationServiceProvider(), array("locale_fallback" => "en"));
# url generator
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
# validation
$app->register(new Silex\Provider\ValidatorServiceProvider());
# monolog
$app->register(new Silex\Provider\MonologServiceProvider(), 
  array(
    'monolog.logfile' => ROOT . '/../log/development.log', 
    'monolog.name' => 'mongoblog',
    'monolog.handler'=> $app->share(
      function(Application $app){
        return new Monolog\Handler\MongoDBHandler($app['mongo'],$app['config.database'],"log");
      }
    ),
  )
);
/** Security
 * EN : note : all the app must be behind the firewall
 * the firewall must allow anonymous users 
 * then you need to define credentials for some parts of the app behind the firewall
 * with the security.access_rules container
 */
$app->register(new Silex\Provider\SecurityServiceProvider(),array(
  'security.firewalls'=>array(
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
        "failure_path" => "/user/login",
        ),
      'logout' => array(
        'logout_path' => "/admin/user/logout",
        "target" => '/',
        "invalidate_session" => true,
        "delete_cookies" => array(
          "mongoblog.local" => array("domain" => "mongoblog.local", "path" => "/")
          )
        ),
      'users' => function(Application $app) {
        return $app['user_manager'];
      }
      )
    ),
  'security.access_rules' => array(
    array('^/admin', 'ROLE_USER'),
    array('^/admin/option','ROLE_ADMIN'),
    ),
  'security.role_hierarchy'=> array(
    'ROLE_ADMIN' => array('ROLE_EDITOR'),
    "ROLE_EDITOR" => array('ROLE_WRITER'),
    "ROLE_WRITER" => array('ROLE_USER'),
    "ROLE_USER" => array("ROLE_SUSCRIBER"),
    ),
  )
);
# cache
$app->register(new Silex\Provider\HttpCacheServiceProvider(),array('http_cache.cache_dir'=>ROOT.'/cache'));
// Gravatar
$app->register(new GravatarServiceProvider());
# CUSTOM SERVICES
$app['configuration_script_path'] = ROOT . '/config/configuration.php';
$app['configuration_file'] = ROOT . "/config/configuration.yaml";
$app['config.server'] = getenv('MONGODB_SERVER')?getenv('MONGODB_SERVER'):"localhost";
$app['config.database'] = getenv("MONGODB_DATABASE")?getenv("MONGODB_DATABASE"):"mongoblog";
$app['config.site_title'] = "Mongo Blog";
$app['config.default_user_role'] = "ROLE_WRITER";
$app["mongo"] = $app->share(
  function($app) {
    return new Mongo($app['config.server']);
  }
  );
# session manager
$app['session_manager'] = $app->share(function($app) {
  $sessionManager = new SessionManager($app['mongo'], $app['config.database']);
  return $sessionManager;
}
);
# user manager
$app['user_manager'] = $app->share(
  function($app) {
    return new \App\Model\Manager\UserManager($app['mongo'], $app['config.database'],$app);

  }
  );
$app['user_provider']=$app->share(
  function($app){
    return new App\Model\Provider\UserProvider($app['user_manager']);
  }
  );
# article manager
$app['article_manager'] = $app->share(
  function($app) {
    return new \App\Model\Manager\ArticleManager($app['mongo'], $app['config.database']);
  }
  );
# comment manager
$app['comment_manager'] = $app->share(
  function(Silex\Application $app) {
    return new \App\Model\Manager\CommentManager($app["mongo"], $app["config.database"]);
  }
  );


$app['spam_manager']=$app->share(
  function(Silex\Application $app){
    return new \App\Model\Manager\SpamManager($app['mongo'],$app['config.database'],$__SERVER["HTTP_HOST"],getenv("AKISMET_APIKEY"));
  }
  );

/** @var $app['option_manager'] App\Model\Manager\OptionManager **/
$app['options']=$app->share( 
  function(Application $app){
    return new \App\Model\Manager\OptionManager($app['mongo'],$app['config.database']);
  }
  );
# FILTERS
# EN : check if the user owns the resource.
# FR : vérifie si l'utilisateur est propriétaire de la resource.
$app['filter.mustbeowner'] = $app->protect(
  function(Request $request)use($app) {
    $user = $app['user_manager']->getUSer();
    $resource_id = $request->get('id');
    if ($app['article_manager']->belongsTo($resource_id, $user['_id']) == false):
      $app['session']->setFlash("error", "You cant edit this resource!");
    return $app->redirect($app['url_generator']->generate('index.index'));
    endif;
  }
  );

$app['filter.mustbeadmin']=$app->protect(

  function(Request $request)use($app){
    if(false===$app['security']->isGranted('ROLE_ADMIN')):
      $user = $app['user_manager']->getUser();
    $app['session']->setFlash('error','You cant access this resouce!');
    $app['monolog']->addWarning('unauthorized access from user '.$user->username.' to '.$request->getRequestURI());
    return $app->redirect($app['url_generator']->generate('index.index'));
    endif;
  }
  );

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



$app['silexblog.url']=function(){
  return $app['url_generator']->generate('index.index');
};
/** init monolog **/
$app->before(
  function(Request $request)use($app){
    if($request->getClientIp()!="127.0.0.1"):
      $app['monolog']->addInfo(json_encode(array("ip"=>$app['request']->getClientIp())));
    endif;
  }
  );
/** allowed tags for content rendering in the view **/
$app['silexblog.config.allowedTags']='<a>,<b>,<u>,<small>,<strong>,<li>,<ol>,<ul>,<img>,<h3>,<h4>,<h5>,<h6>,<p>';
return $app;
