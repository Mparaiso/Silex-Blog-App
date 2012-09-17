<?php

use Silex\Application ;

#@note @php using different namespaces in the same files F

# EN : define main routes 

$loader = require dirname(__DIR__)."/vendor/autoload.php";

$loader->add("App",dirname(__DIR__));

/** 
 * @var $app Application
 */
$app = require "config.php";


$app->mount("/", new App\Controller\IndexController());
$app->mount("/article",new App\Controller\ArticleController($app['article_manager'],$app['user_manager']) );
$app->mount("/comment",new App\Controller\CommentController($app['spam_manager']) );
$app->mount('/user', new App\Controller\UserController($app['spam_manager']) );
$app->mount('/admin/user', new App\Controller\Admin\UserAdminController());
$app->mount('/admin/article',new App\Controller\Admin\ArticleAdminController());
$app->mount('/admin/option',new App\Controller\Admin\OptionAdminController($app['options']));

return $app;
