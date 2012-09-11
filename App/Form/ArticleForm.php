<?php
namespace App\Form{

	use Symfony\Component\Form\AbstractType;
	use Symfony\Component\Form\FormBuilderInterface;
	use App\Form\DataTransformer\TagsToArrayTransformer;

	class ArticleForm extends AbstractType{

		protected $defaultClass = "span8";

		public function buildForm(FormBuilderInterface $builder,array $options)
		{
			$transformer = new TagsToArrayTransformer();
			$builder->add("title", "text", array("required" => true, "attr" => array("class" => $this->defaultClass, "placeholder" => "The title")));
      $builder->add("content", "textarea", array("required" => true, "attr" => array("placeholder" => "the content", "rows" => 20, "class" => $this->defaultClass)));
      $builder->add(
        #WARNING !
        #@see http://symfony.com/doc/2.0/cookbook/form/data_transformers.html
        $builder->create(
        	"tags", "text", 
          array(
            "attr" => array(
              "class" => $this->defaultClass, 
        		  "placeholder" => "ms, apple ,samsung, nokia"
              )
            )
          )->prependNormTransformer($transformer)
        );
      $builder->add("featured","checkbox",array('required'=>false));
		}

		public function getName(){
			return "article";
		}
	}

}