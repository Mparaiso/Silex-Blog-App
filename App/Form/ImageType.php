<?php
namespace App\Form{

  use Symfony\Component\Form\AbstractType;
  use Symfony\Component\Form\FormBuilderInterface;
  use App\Form\DataTransformer\TagsToArrayTransformer;
  use App\Form\DataTransformer\MetadataTransformer;

  class ImageType extends AbstractType{

    /**
     * image source
     */
    protected $src="blop";
        


   function buildForm(FormBuilderInterface $builder,array $options){
   }

   function getDefaultOptions(array $options){
    return array("attr"=>array('src'=>"/img/image.png"));
   }

   function getName(){
     return "image";
   }

   function getParent(){
    return "field";
  }

}

}