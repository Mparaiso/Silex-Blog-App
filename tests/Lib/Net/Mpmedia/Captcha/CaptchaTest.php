<?php
namespace Net\Mpmedia\Captcha{


  class CaptchaTest extends \PHPUnit_Framework_TestCase{

    protected $app;

    protected $captcha;
        
        
    public function setUp(){
      $this->app = ROOT.'/App/config.php';
      $this->captcha = new Captcha(getenv("RECAPTCHA_PUBLIC_KEY"),getenv("RECAPTCHA_PRIVATE_KEY"));
    }

    function testNew(){
    }
  
    function tearDown(){
    }
  }
}