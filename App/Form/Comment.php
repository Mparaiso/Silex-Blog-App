<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


class Comment extends AbstractType{

  protected $class='span5';

	public function buildForm(FormBuilderInterface $builder, array $options){
		$builder->add('name',"text",array("attr"=>array('class'=>$this->class ,"placeholder"=>"name")));
		$builder->add('email',"email",array("attr"=>array('class'=>$this->class ,"placeholder"=>"email")));
    $builder->add('url','url',array('required'=>false,'attr'=>array('class'=>$this->class ,'placeholder'=>'url')));
		$builder->add("content","textarea",array("attr"=>array('class'=>$this->class ,"rows"=>3)));
		$builder->add("article_id","hidden");
	}

	public function getName(){
		return "comment";
	}



}