<?php
namespace Net\Mpmedia\Akismet{


  class AkismetTest extends \PHPUnit_Framework_TestCase{

    /**
     * @var Silex\Application
     */
    protected $app;

    /**
     * @var Akismet
     */
    protected $akismet;
    
    public function setUp(){
      $this->app = ROOT."/App/config.php";
      $this->akismet = new Akismet("http://mpmedia.alwaysdata.net/silexblog",getenv("AKISMET_APIKEY"));
    }

    function testIsSpam(){
      $this->akismet->commentUserIp = "113.91.127.32";
      $this->akismet->commentAuthor = "office 2010 download";
      $this->assertTrue(isset($this->akismet));
      $this->assertTrue($this->akismet->isSpam());
    }

    function tearDown()
    {

    }
  }
}