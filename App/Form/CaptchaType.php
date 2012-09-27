<?php
namespace App\Form{
  
  use Symfony\Component\Form\FormBuilderInterface;
  
  class CaptchaType extends AbstractType
  {

    public function buildForm(FormBuilderInterface $builder,array $options){
      $builder->add(array("image","image"));
    }
    
    function getDefaultOptions(array $options){
      return array();
    }

    function getName(){
      return "captcha";
    }

    function getParent(array $options){
      return "form";
    }
  }
}