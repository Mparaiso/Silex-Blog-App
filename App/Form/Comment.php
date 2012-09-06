<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


class Comment extends AbstractType{

	public function buildForm(FormBuilderInterface $builder, array $options){
		$builder->add('name',"text",array("attr"=>array("placeholder"=>"name")));
		$builder->add('email',"email",array("attr"=>array("placeholder"=>"email")));
		$builder->add("content","textarea",array("attr"=>array("rows"=>3)));
		$builder->add("article_id","hidden");
	}

	public function getName(){
		return "comment";
	}



}