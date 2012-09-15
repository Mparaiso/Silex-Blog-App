<?php

namespace App\Model\Entity{

  abstract class Base implements \ArrayAccess {

    protected $created_at;
    protected $updated_at;

    function __construct(array $data=array()){
      foreach ($data as $key => $value) {
        $this->__set($key,$value);
      }
    }

    function __get($name) {
      $method = "get".ucwords($name);
      if(method_exists($this,$method)):
        return $this->$method();
      elseif (property_exists($this, $name)):
        return $this->$name;
      endif;
    }

    function __set($name, $value) {
      $method = "set".ucwords($name);
      if(method_exists($this, $method)):
        return $this->$method($value);
      elseif (property_exists($this, $name)):
        $this->$name = $value;
      endif;
    }

    /* Méthodes */
    function offsetExists($offset){
      if(property_exists($this, $offset)):
        return true;
      else:
        return false;
      endif;
    }
    function offsetGet($offset){
      return $this->__get($offset);
    }
    function offsetSet($offset,$value){
      return $this->__set($offset,$value);
    }
    function offsetUnset($offset){
      if(property_exists($this, $offset)):
        unset($this->$offset);
      endif;
    }

    function __toString(){
      ob_start();
      var_dump($this);
      return ob_get_clean();
    }

    /**
     * get properties as an associative array 
     * and trim null value
     * @see http://briancray.com/posts/remove-null-values-php-arrays
     */
    function toArray(){
      $array = @array_filter( get_object_vars($this) ,function($value){
        return $value!=null;
      });
      return $array;
    }

    function serialize(){
      return json_encode($this->toArray());
    }

    function deszerialize($json){
      $datas = json_decode($json);
      $this->__construct($json);
    }
  }
}