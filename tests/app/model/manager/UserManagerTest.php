<?php
#UserManagerTest.php
namespace App\Model\Manager{
  use App\Model\Manager\UserManager;
  
  class UserManagerTest extends \PHPUnit_Framework_TestCase{

    protected $app;
    protected $userManager;
    function setUp()
    {
      $this->app = getApp();
      $this->userManager = new UserManager(new \Mongo('localhost'),"test",$this->app);
    }

    function testNew(){
      $this->assertTrue($this->userManager!=null);
    }

    function teatDown(){

    }
  }
}