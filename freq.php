<p><h1>Fréquentation du site</h1></p>
<table class="small" width=100%>
<?php
require_once 'autoload.php';
require_once 'cdnHelper.php';
$query='select max(count) as max from (select distinct a.date, count(a.date) as count from (select id_membre, date, count(id_membre)  from activity group by date, id_membre) as a group by a.date) as m';
$req = ConnectionSingleton::connect()->prepare($query);
$req->execute();
$max = $req->fetch(PDO::FETCH_OBJ)->max;

$query = 'select distinct a.date, count(a.date) as count from (select id_membre, date, count(id_membre)  from activity group by date, id_membre) as a group by a.date order by a.date desc';
$req = ConnectionSingleton::connect()->prepare($query);
$req->execute();
$data = $req->fetchAll(PDO::FETCH_OBJ);

foreach ($data as $i):?>
<tr>
	<td width="100px" style="border: 1px black solid"><?php echo date("d/m/Y",strtotime($i->date));?></td>
	<td style="border: 1px black solid"><img src="<?php echo convertToCDNUrl('pic/jblanc.png');?>" width="<?php echo ($i->count/$max*100)?>%" height="10"></td>
	<td width="30px" style="border: 1px black solid"><?php echo $i->count;?></td>
</tr>
<?php endforeach;?>
</table>