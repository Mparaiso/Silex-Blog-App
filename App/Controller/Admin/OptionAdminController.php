<?php
namespace App\Controller\Admin{
  use Silex\ControllerProviderInterface;
  use Silex\Application;
  use Silex\ControllerCollection;
  use App\Model\Manager\OptionManager;
  class OptionAdminController implements ControllerProviderInterface{

    /**
     *@return ControllerCollection
     */
    function connect(Application $app){
      /**@var $configController ControllerCollection **/
      $optionController = $app['controllers_factory'];
      $optionController->get('/',array($this,indexAction))->bind('admin.option.index');
      return $optionController;
    }

    function indexAction(Application $app){
      /**@var $optionManager OptionManager **/
      $optionManager = $app['option_manager'];
      $options = $optionManager->getAll();
      return $app['twig']
        ->render('option/index.twig',array('options'=>$options));
    }
  }
}