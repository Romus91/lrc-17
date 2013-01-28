<?php
require_once 'autoload.php';

$id=(int)htmlentities($_GET['id']);
$p=(int)htmlentities($_GET['perso']);

$persoCont = new PersoController();
$perso = $persoCont->fetchPerso($p);

$armes = $perso->getInvArme();

$i=0;
for(;$i<count($armes) && $armes[$i]->getId()!=$id;$i++);

$arm = $armes[$i];

echo json_encode(array('arme'=>$arm->getNom(),'prix'=>($arm->getPrix()/2)));
?>