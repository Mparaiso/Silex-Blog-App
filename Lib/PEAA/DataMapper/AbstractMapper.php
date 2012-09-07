<?php

namespace PEAA\DataMapper;

abstract class AbstractMapper{
	protected $dataAccessLayer;

	protected $idFieldName="_id";

	protected $loadedMap = array();

	function __construct(IDataAccessObject $dataAccessLayer){
		$this->dataAccessLayer = $dataAccessLayer;
	}

	protected function abstractFind($id){
		$result = $loadedMap[$id];
		if($result!=null)return $result;
		$resultSet = $this->dataAccessLayer->find(array($idFieldName=>$id));
		return $this->load($resultSet);
	}

	function insert($object){
		return $this->doInsert($object);
	}

	protected function load($resultSet){
		$id = $resultSet[$idFieldName];
		if($this->loadedMap[$id]!=null):
			return $this->loadedMap[$id];
		endif;
		$result = $this->doLoad($id,$resultSet);
		$this->loadedMap[$id] = $result;
		return $result;
	}

	function __get($attr){
		if(property_exists($this,$attr)):
			return $this->$attr;
		endif;
	}
}

