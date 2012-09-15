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
  protected $status;
  protected $metadatas;
  /**
  * States if the article appears on the homepage
  */
  function getType(){
    return "article";
  }

  function setTags(array $value){
    $this->tags = $value;
  }

}