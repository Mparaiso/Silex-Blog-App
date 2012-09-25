<?php
namespace App\Model\Manager{

  use Mongo;

  class SpamManagerTest extends \PHPUnit_Framework_TestCase{


    protected $app;

    protected $spamManager;
        
    
    public function setUp(){
      $this->app = ROOT.'/App/config.php';
      $this->spamManager = new SpamManager(new Mongo("localhost"),"test","media.alwaysdata.net/silexblog",getenv("AKISMET_APIKEY"));
    }

    function testIpIsSpam(){
      $this->assertTrue($this->spamManager->ipIsSpammer("113.91.127.32"));
    }

    function tearDown()
    {
    }
  }
}