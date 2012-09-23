<?php
namespace App\Model\Form\Validation{

  /** 
   * simple tests on symfony validation component
   */
  class ValidationTest extends \PHPUnit_Framework_TestCase{
    /**
     * Silex\Application
     */
    protected $app;
    public function setUp(){
      if(defined("ROOT")):
        $this->app = require ROOT.'/App/config.php';
      else:
        throw new Exception("ROOT is not defined", 1);
      endif;
    }

    function testNew(){
      
    }
    
    function tearDown(){
    }
  }

  use Symfony\Component\Validator\Constraints as Assert;

  class Author{
    /**
     * @Assert\NotBlank()
     */
    public $name;
  }
}