<?php
namespace App\Controller\Admin{
  use Silex\ControllerProviderInterface;
  use Silex\Application;
  use Silex\ControllerCollection;
  use App\Model\Manager\OptionManager;
  use App\Model\Manager\IOptionManager;

  use MongoCursor;

  class OptionAdminController implements ControllerProviderInterface{

    protected $optionManager;

    function __construct(IOptionManager $optionManager){
      $this->optionManager = $optionManager;
    }
    /**
     *@return ControllerCollection
     */
    function connect(Application $app){
      /**@var $configController ControllerCollection **/
      $optionController = $app['controllers_factory'];
      $optionController->get('/',array($this,"indexAction"))->bind('admin.option.index');
      /** only admins can access this ressouce **/
      $optionController->before($app['filter.mustbeadmin']);
      return $optionController;
    }

    function indexAction(Application $app){
      /** @var $options MongoCursor cursor **/
      $options = $this->optionManager->getAll();
      return $app['twig']
        ->render('option/index.twig',array('options'=>$options));
    }
  }
}