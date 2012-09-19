<?php

$loader = require 'vendor/autoload.php';
$loader->add('App', __DIR__);
$loader->add('Lib',__DIR__);
function getApp(){
	return $app = require __DIR__.'/../app/config.php';
}
getApp();
