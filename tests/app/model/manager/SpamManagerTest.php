<?php
namespace App\Model\Entity\Manager{


  class SpamManagerTest extends \PHPUnit_Framework_TestCase{
    protected $app;
    
    public function setUp(){
      $this->app = ROOT.'/App/config.php';
      $this->spamManager = $this->app['spam_manager'];
    }

    function testNew(){
      ;
    }

    function tearDown()
    {
      unset(->myBase);
    }
  }
}