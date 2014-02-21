<?php
function __autoload($class){
	$path = 'cite17/class/';
	require_once $path.$class.'.class.php';
}