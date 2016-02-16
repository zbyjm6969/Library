<?php

define('ROOT_DIR', str_replace(DIRECTORY_SEPARATOR, '/', dirname(__FILE__)));


include('RedisService.php');

$redis_handle = RedisService::getInstance();
$array = array(
	'name'=>'name1',
	'name2'=>'name2'
);
$redis_handle->setValue($array);