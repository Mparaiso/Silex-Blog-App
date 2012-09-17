<?php
namespace App\Model\Manager{
  use App\Model\Entity\Option;
  class OptionManager extends BaseManager implements IOptionManager {
    /** @var string **/
    protected $collection="option";

    /**
     * return \MongoCursor
     */
    function getAll(){
      return $this->getCollection()
        ->find();
    }

    function getByName($name)
    {
      return $this->getCollection()
        ->findone(array("option_name"=>$name));
    }

    function get($name){
      $option=$this->getByName($name);
      if(!empty($option)){
        return $option['option_value'];
      }
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