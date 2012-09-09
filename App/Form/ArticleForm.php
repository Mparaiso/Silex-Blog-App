<?php
namespace App\Form{

	use Symfony\Component\Form\AbstractType;
	use Symfony\Component\Form\FormBuilderInterface;

	class ArticleForm extends AbstractType{

		protected $defaultClass = "span6";

		public function buildForm(FormBuilderInterface $builder,array $options)
		{
			$builder->add("title", "text", array("required" => true, "attr" => array("class" => $this->defaultClass, "placeholder" => "The title")));
            $builder->add("content", "textarea", array("required" => true, "attr" => array("placeholder" => "the content", "rows" => 8, "class" => $this->defaultClass)));
            $builder->add("tags", "text", array("attr" => array("class" => $this->defaultClass, "placeholder" => "ms, apple ,samsung, nokia")));
            $builder->add("featured","checkbox",array("value"=>true,"label"=>""));
		}

		public function getName(){
			return "article";
		}
	}

}