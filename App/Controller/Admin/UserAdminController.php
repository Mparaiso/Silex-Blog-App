<?php

namespace App\Controller\Admin;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormError;

/**
 * Gère les utilisateurs de l'application.
 */
class UserAdminController implements ControllerProviderInterface {

  function connect(Application $app) {
    $userAdmin = $app['controllers_factory'];
    $userAdmin->get("/profile", "App\Controller\Admin\UserAdminController::profile")->bind("admin.user.profile");
    $userAdmin->get("/logout", "App\Controller\Admin\UserAdminController::logout")->bind('admin.user.logout');
    return $userAdmin;
  }

  function logout(Application $app) {
    $app['session']->setFlash('success', "You are logged out!");
    $referer = null; #$app['request']->headers->get('referer');
    return $app->redirect($referer != null ? $referer : $app['url_generator']->generate('index.index'));
  }

  function profile(Application $app) {
    $userManager = $app['user_manager'];
    $user = $userManager->getUser();
    return $app['twig']->render('user/profile.twig', array('user' => $user));
  }

  function getDashboard(Application $app){
    return;
  }

}