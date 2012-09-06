<?php

namespace App\Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;

class AdminController implements ControllerProviderInterface {

  protected $admin;

  function connect(Application $app) {
    #@note @silex EN: connect controller class to Silex\Application instance ( ControllerProviderInterface spec)
    $this->admin = $app['controllers_factory'];
    $this->admin->get('/', "App\Controller\AdminController::index")->bind("admin.index");
    #@note @silex use a method of a class as a route callback
    #$this->admin->match('/dologin', function() { return "dologin"; })->bind("admin.dologin");
    return $this->admin;
  }

  function index(Application $app) {
    return $app['twig']->render('admin/index.twig');
  }

}