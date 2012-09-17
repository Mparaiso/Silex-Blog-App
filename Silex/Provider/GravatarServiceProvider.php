<?php

namespace Silex\Provider{

  use Silex\Application;
  use Silex\ServiceProviderInterface;

  use Net\Mpmedia\Gravatar\Gravatar;

  class GravatarServiceProvider{

    function register(Application $app){
      $app['gravatar']=$app->share(
        return new Gravatar();
      );
    }

    function boot(Application $app){

    }
  }
}