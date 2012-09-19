<?php
namespace App\Form{

  use Symfony\Component\Form\AbstractType;
  use Symfony\Component\Form\FormBuilderInterface;

  use App\Form\DataTransformer\MetadataTransformer;


  class MetaData extends AbstractType{

    protected $span4="span4";
    protected $span3="span3";

    public function buildForm(FormBuilderInterface $builder,array $options){
      $builder->add('name','text',array("label"=>' ','attr'=>array("class"=>$this->span3,'placeholder'=>'name')))
      ->add('value','text',array('label'=>' ','attr'=>array("class"=>$this->span4,'placeholder'=>'value')));
    }

    public function getName(){
      return "MetaData";
    }

  }

}