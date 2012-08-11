<?php
require_once 'ConnectionSingleton.php';

$query = "Delete from log where timestamp < (CURRENT_TIMESTAMP - interval '2' month);";
$req = ConnectionSingleton::connect()->prepare($query);
$req->execute();

$query = "Delete from chat where timestamp < (CURRENT_TIMESTAMP - interval '2' month);";
$req = ConnectionSingleton::connect()->prepare($query);
$req->execute();
