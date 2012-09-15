<?php

# EN : define main routes 

$loader = require dirname(__DIR__)."/vendor/autoload.php";

$loader->add("App",dirname(__DIR__));

$app = require "config.php";

$app->mount("/", new App\Controller\IndexController());
$app->mount("/article", new App\Controller\ArticleController($app['article_manager'],$app['user_manager']));
$app->mount("/comment", new App\Controller\CommentController());
$app->mount('/user', new App\Controller\UserController());
$app->mount('/admin/user', new App\Controller\Admin\UserAdminController());
$app->mount('/admin/article',new App\Controller\Admin\ArticleAdminController());

return $app;