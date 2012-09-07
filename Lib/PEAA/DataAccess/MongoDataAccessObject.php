<?php

require_once 'IDataAccessObject.php';

namespace PEAA\DataAccess;

use Mongo;
use MongoId;

class MongoDataAccessObject implements IDataAccessObject{
	function __construct(\Mongo $connexion,$databaseName,$collection){
		$this->database = $connexion->selectDB($databaseName);
		$this->collection  = $this->database->selectCollection($collection);
	}

	function find(array $params){
		return $this->collection->findone($params);
	}

	/**
	* seek array['id'] , make it into array['_id'] as MongoId and unset array['id'].
	* @return array
	*/
	function makeMongoId($params){
		$_params = $params ;
		if($_params['id']==null):
			$_params['_id']=new MongoId($_params['id']);
			unset($_params['id']);
		endif;
		return $_params;
	}

	function update(array $params,array $object){
		$this->collection->update($params,array('$set'=>$array),array('safe'=>true));
		return $this->findOne($params);
	}

	function delete(array $params){
		return $this->collection->remove($params);

	}

	function insert($object){
		$this->collection->insert($object);
		return $object['_id'];
	}
}