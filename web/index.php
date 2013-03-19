<?php
$app = require_once dirname(__DIR__)."/App/config.php";
$app['http_cache']->run();
