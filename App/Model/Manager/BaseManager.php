<?php
namespace App\Model\Manager;

use \Silex\Application;

class BaseManager{
	/**
	* @var \Mongo
	*/
	protected $connection;

	protected $database;

	/**
	* collection name
	* @string
	*/
	protected $collection;

	/**
	* @var MongoCollection
	*/
	protected $_collection;

	
	function __construct(\Mongo $connection,$database){
		$this->connection = $connection;
		$this->database = $database;
		$this->_collection = $this->getCollection();
	}


  function getDb() {
    $db = $this->connection->selectDB($this->database);
    return $db;
  }

  function getCollection() {
    $db = $this->getDb();
    $collection = $db->selectCollection($this->collection);
    return $collection;
  }
 
}