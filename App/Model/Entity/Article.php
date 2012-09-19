<?php

namespace App\Model\Entity;

class Article extends Base {

  const STATUS_PUBLISHED=0;
  const STATUS_UNPUBLISHED=1;
  const STATUS_DRAFT=2;
  
  protected $_id;
  protected $_rev;
  protected $title;
  protected $content;
  protected $slug;
  protected $tags;
  protected $category_ids = array();
  protected $user_id;
  protected $type = "article";
  protected $update_count = 0;
  protected $featured;
  protected $metadatas=array();
  /**
   *@var string $status can be published unpublished
   */
  protected $status;
  /**
  * States if the article appears on the homepage
  */
  function getType(){
    return "article";
  }

  function setMeta($name,$value){
    $index = $this->getMetaIndex($meta);
    if($index>=0){
      $this->metadatas[$index]['name']=$name;
      $this->metadatas[$idnex]['value']=$value;
    }else{
      array_push($this->metadatas, array('name'=>$name,'value'=>$value));
    }
  }

  function getMetaIndex($meta){
    for($i=0;$i<count($this->metadatas);$i++){
      if($this->metadatas[$i]['name']===$meta){
        return $i;
      }
    }
    return -1;
  }

  function getMeta($name){
    $index = $this->getMetaIndex($name);
    if($index>=0){
      return $this->metadatas[$index]['value'];
    }
  }

  function setTags(array $value){
    $this->tags = $value;
  }

}