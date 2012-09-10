<?php
namespace App\Form\DataTransformer{

  use Symfony\Component\Form\DataTransformerInterface;
  class TagsToArrayTransformer implements DataTransformerInterface{
   
    /**
     * array to string ( transform the object data into a string displayable an text input )
     */
    function transform($tags){
      #$app = require ROOT.'/App/config.php';
      #$app['monolog']->addInfo("tags : ".print_r($tags,true));
      if(is_array($tags)):
        return implode(",", $tags);
      endif;
        return $tags;
    }
    /**
     * string to Array ( get back the form data )
     */
    function reverseTransform($tags){
      return explode(",", $tags);
    }
  }
}