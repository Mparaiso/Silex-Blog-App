<?php
namespace App\Form{

	use Symfony\Component\Form\AbstractType;
	use Symfony\Component\Form\FormBuilderInterface;

	use Symfony\Component\Validator\Constraints as Assert;


	class Comment extends AbstractType{

		protected $class='span5';

		public function buildForm(FormBuilderInterface $builder, array $options){
			#name
			$builder->add('name',"text",array(
				"constraints"=>array(new Assert\NotBlank(),new Assert\MinLength(3)),
				"attr"=>array('class'=>$this->class ,"placeholder"=>"name")));
			#email
			$builder->add('email',"email",array(
				"constraints"=>array(new Assert\NotBlank(),new Assert\Email()),
				"attr"=>array('class'=>$this->class ,"placeholder"=>"email")));
			#url
			$builder->add('url','url',array(
				'constraints'=>array(new Assert\Url()),
				'required'=>false,'attr'=>array('class'=>$this->class ,'placeholder'=>'url')));
			#content
			$builder->add("content","textarea",array(
				"constraints"=>array(new Assert\NotBlank(),new Assert\MinLength(30)),
				"attr"=>array('class'=>$this->class ,"rows"=>3)));
			$builder->add("article_id","hidden");
		}

		public function getName(){
			return "comment";
		}



	}

}