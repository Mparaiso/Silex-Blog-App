<?php
namespace App\Model\Manager{
  use App\Model\Entity\Option;
  class OptionManager extends BaseManager{
    /**
     * return \MongoCursor
     */
    protected $_collection="option";
    function getAll(){
      return $this->getCollection()
        ->find();
    }
    function getByName($name)
    {
      return $this->getCollection()
        ->findone(array("option_name"=>$name));
    }

    function getById($id){
      return $this->getCollection()
        ->findone(array("option_id"=>new \MongoId($id)));
    }

    function set(Option $option){
      $this->getCollection()
        ->insert($options->toArray());
    }
  }
}