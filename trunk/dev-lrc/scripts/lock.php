<?php
$path ='cite17/';

$p = fopen($path.'lrc.lock', 'w');
fwrite($p, 'm');
fclose($p); ?>