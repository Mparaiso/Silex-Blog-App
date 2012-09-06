<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


class Login extends AbstractType{

	public function buildForm(FormBuilderInterface $builder, array $options){
		$builder->add('username',"text",array("attr"=>array("placeholder"=>"username")));
		$builder->add('password',"password");
	}

	public function getName(){
		return "login";
	}



}