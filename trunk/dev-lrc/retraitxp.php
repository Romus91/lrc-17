<?php

require_once 'autoload.php';

$persocont = new PersoController();
$tab = $persocont->fetchAll();

foreach ($tab as $p) {
	$p->addXpAfk();
	echo $p->getNom().' : '.$p->getXp().' / '.$p->getXpWhenAfk().'<br>';
	$persocont->savePerso($p);
}

exec('php unlock.php');