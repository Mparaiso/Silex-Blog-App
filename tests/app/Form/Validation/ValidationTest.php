<?php
namespace App\Model\Form\Validation{

  /** 
   * simple tests on symfony validation component, to learn how the component works
   * 
   */
  class ValidationTest extends \PHPUnit_Framework_TestCase{

    /**
     * @var Silex\Application
     */
    protected $app;

    public function setUp(){
      if(defined("ROOT")):
        $this->app = require ROOT.'/App/config.php';
      else:
        throw new Exception("ROOT is not defined", 1);
      endif;
    }

    function testValidate(){
      /** @var $author Author **/
      $author = new Author();
      $author->firstName = "Marc";
      $author->lastName = "Prades";
      /** @var $validator Symfony\Component\Validator\Validator **/
      $validator = $this->app['validator'];
      //@note @symfony FR : valider un object @see http://symfony.com/doc/current/book/validation.html
      $errors = $validator->validate($author);
      $this->assertTrue(count($errors)==0);
      $author->lastName="";
      $errors = $validator->validate($author);
      #print_r($errors);
      $this->assertCount(1,$errors);
    }

    function tearDown(){
    }
  }

  use Symfony\Component\Validator\Constraints as Assert;
  use Symfony\Component\Validator\Mapping\ClassMetadata;

  class Author{
    /**
     * @var string
     */
    public $firstName;

    /**
     * @var string
     */
    public $lastName;

    static public function loadValidatorMetadata(ClassMetadata $metadata){
      $metadata->addPropertyConstraint('firstName',new Assert\NotBlank());
      $metadata->addPropertyConstraint('lastName',new Assert\NotBlank());

    }
  }
}