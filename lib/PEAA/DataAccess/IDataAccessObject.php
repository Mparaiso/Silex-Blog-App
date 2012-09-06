<?php

namespace PEAA\DataAccess;

interface IDataAccessObject{
	function find(array $params);
	function update(array $params,array $object);
	function delete(array $params);
	function insert($object);
}