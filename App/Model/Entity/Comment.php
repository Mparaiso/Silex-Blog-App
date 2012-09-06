<?php

namespace App\Model\Entity;

class Comment{

	protected $name;
	protected $email;
	protected $comment;
	protected $created_at;

	function __get($name){
		if(property_exists(self, $name)):
			return $this->$name;
		endif;
	}

	function __set($name,$value){
		if(property_exists(self, $name)):
			$this->$name = $value;
			return $this->$name;
		endif;
	}
}