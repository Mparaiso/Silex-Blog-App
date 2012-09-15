<?php
namespace App\Form\DataTransformer{

  use Symfony\Component\Form\DataTransformerInterface;
  class TagsToArrayTransformer implements DataTransformerInterface{
   
    /**
     * array to string ( transform the object data into a string displayable an text input )
     */
    function transform($tags){
      if(is_array($tags)):
        $tagCollection = implode(",", $tags);
      endif;
      return $tagCollection;
    }
    /**
     * string to Array ( get back the form data )
     */
    function reverseTransform($tags){
      $tagCollection = explode(",", $tags);
      $tagCollectionTrimmed = array_map(function($value){ 
        return trim(strtolower($value));
      },$tagCollection);
      return $tagCollectionTrimmed;
    }
  }
}