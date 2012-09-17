<?php
#@note @php using different namespaces in the same files F
namespace{

# EN : define main routes 

  $loader = require dirname(__DIR__)."/vendor/autoload.php";

  $loader->add("App",dirname(__DIR__));

  $app = require "config.php";
}

namespace App\Controller{

  $app->mount("/", new IndexController());
  $app->mount("/article",new ArticleController($app['article_manager'],$app['user_manager']));
  $app->mount("/comment",new CommentController());
  $app->mount('/user', new UserController());
  $app->mount('/admin/user', new Admin\UserAdminController());
  $app->mount('/admin/article',new Admin\ArticleAdminController());
  $app->mount('/admin/option',new Admin\OptionAdminController());

  return $app;
}