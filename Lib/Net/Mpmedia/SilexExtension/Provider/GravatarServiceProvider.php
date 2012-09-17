<?php

namespace Net\Mpmedia\SilexExtension\Provider{

  use Silex\Application;
  use Silex\ServiceProviderInterface;

  use Net\Mpmedia\Gravatar\Gravatar;

  class GravatarServiceProvider implements ServiceProviderInterface{

    function register(Application $app){
      $app['gravatar']=$app->share(
        function(Application $app){
          return new Gravatar();
        }
      );
    }

    function boot(Application $app){

    }
  }
}