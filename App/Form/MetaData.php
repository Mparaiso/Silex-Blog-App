<?php
namespace App\Form{

  use Symfony\Component\Form\AbstractType;
  use Symfony\Component\Form\FormBuilderInterface;


  class MetaData extends AbstractType{

    public function buildForm(FormBuilderInterface $builder,array $options){
      $builder->add('name','text',array("label"=>' ','attr'=>array('placeholder'=>'name')))
      ->add('value','text',array('label'=>' ','attr'=>array('placeholder'=>'value')));
    }

    public function getName(){
      return "MetaData";
    }

  }

}