<?php
function __autoload($class){
	$path = 'class/';
	require_once $path.$class.'.class.php';
}