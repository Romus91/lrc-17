<?php
$path ='';

$p = fopen($path.'lrc.lock', 'w');
fwrite($p, 'm');
fclose($p); ?>