<?php
namespace App\Form\DataTransformer{

  use Symfony\Component\Form\DataTransformerInterface;
  class TagsToArrayTransformer implements DataTransformerInterface{
   
    /**
     * array to string ( transform the object data into a string displayable an text input )
     */
    function transform($tags){
      if(is_array($tags)):
        return implode(",", $tags);
      endif;
        return $tags;
    }
    /**
     * string to Array ( get back the form data )
     */
    function reverseTransform($tags){
      $tagCollection = explode(",", $tags);
      $tagCollectionTrimmed = array_map(function($value){ return trim($value);},$tagCollection);
      return $tagCollectionTrimmed;
    }
  }
}