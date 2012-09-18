<?php
namespace App\Form\DataTransformer{
  use Symfony\Component\Form\DataTransformerInterface;
  class MetadataObjectToMetadataArrayTransformer implements DataTransformerInterface{


    function reverseTransform($metadatas){
      if(is_array($metadatas)){
        foreach($metadatas as $value){
          $result[]=array($value['name']=>$value['value']);
        }
        return $result;
      }
    }
    
    /**
     * @param array
     * @return array
     */
    function transform($metadatas){
      if(is_array($metadatas)){
        foreach($metadatas as $metadata){
          foreach($metadata as $key=>$value){
            $result[]=array('name'=>$key,'value'=>$value);
          }
        }
        return $result;
      }
    }
  }
}