<div id="lexique">
<?php
require_once 'autoload.php';
$req=ConnectionSingleton::connect()->prepare("select * from lexique order by titre asc;");
$req->execute();
$data=$req->fetchAll(PDO::FETCH_OBJ);

foreach ($data as $i):?>
	<div class="lex-item" id="<?php echo $i->id;?>">
		<p class="color4">&nbsp;</p>
		<p><h2><?php echo $i->titre;?></h2></p>
		<p><?php echo $i->desc;?></p>
	</div>
<?php endforeach;?>
<p class="color4">&nbsp;</p>
</div>