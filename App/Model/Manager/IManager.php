<?php

namespace App\Model\Manager\IManager{
	interface IManager{
		function getDB();
		function getCollection();
	}
}