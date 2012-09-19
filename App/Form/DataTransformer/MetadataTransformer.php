<?php
namespace App\Form\DataTransformer{
  use Symfony\Component\Form\DataTransformerInterface;
  class MetadataTransformer implements DataTransformerInterface{

    function transform($metadatas){
      return $metadatas;
    }

    function reverseTransform($metadatas){
      if(is_array($metadatas)){
        foreach($metadatas as $value){
          $result[$value['name']]=$value['value'];
        }
        return $result;
      }
    }
  }
}