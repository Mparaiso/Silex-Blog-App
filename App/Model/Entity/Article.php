<?php

namespace App\Model\Entity;

class Article extends Base {

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
  /**
  * States if the article appears on the homepage
  */
  function getType(){
    return "article";
  }

  function setTags($value){
    if(value!=null):
      if(is_string($value)):
        $value = explode(",", $value);
      elseif(!is_array($value)):
        throw new Exception("Error $value must be an array", 1);
      endif;
      $this->tags = array_map(function($tag){return trim(strtolower($tag));}, $value);
    endif;
  }

}