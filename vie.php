	<tr>
		<td align=center width="100%">
				<?php

					$consoCont = new ConsoController();
					$consArray = $consoCont->fetchAll();

				?>

				<table class='small' width='100%' >
					<tr height='120'>
						<?php
							if ($perso->getLevel() >= $consArray[0]->getLevelRequis())
							{
							?>
						<td align=center bgcolor='222222' width='33%'>
							<a href='achatok.php?perso=<?php echo $perso->getId();?>&pack=<?php echo $consArray[0]->getId();?>&type=JKREJI8HYJ444YT' >
							<img src='<?php echo convertToCDNUrl('pic/v10.png');?>' width='114' height='79' onmouseover='src="<?php echo convertToCDNUrl('pic/v10o.png');?>"' onmouseout='src="<?php echo convertToCDNUrl('pic/v10.png');?>"'></a><br>
							<?php echo $consArray[0]->getPrix($perso->getLevel()); ?> $
						</td>
							<?php
							}else
							{
							echo"
						<td align=center class='verouille' width='33%'>
							<font size=5>VERROUILLE</font><br>
							NIVEAU REQUIS : </font><font size=4 color='333333'>".$consArray[0]->getLevelRequis()."</font>
						</td>";
							}
							?>
							<?php
							if ($perso->getLevel() >= $consArray[1]->getLevelRequis())
							{
							?>
						<td align=center bgcolor='222222' width='33%'>
							<a href='achatok.php?perso=<?php echo $perso->getId();?>&pack=<?php echo $consArray[1]->getId();?>&type=JKREJI8HYJ444YT' >
							<img src='<?php echo convertToCDNUrl('pic/v50.png');?>' width='114' height='79' onmouseover='src="<?php echo convertToCDNUrl('pic/v50o.png');?>"' onmouseout='src="<?php echo convertToCDNUrl('pic/v50.png');?>"'></a><br>
							<?php echo $consArray[1]->getPrix($perso->getLevel()); ?> $
						</td>
							<?php
							}else
							{
							echo"
						<td align=center class='verouille' width='33%'>
							<font size=5>VERROUILLE</font><br>
							NIVEAU REQUIS : </font><font size=4 color='333333'>".$consArray[1]->getLevelRequis()."</font>
						</td>";
							}
							?>
							<?php
							if ($perso->getLevel() >= $consArray[2]->getLevelRequis())
							{
							?>
						<td align=center bgcolor='222222' width='33%'>
							<a href='achatok.php?perso=<?php echo $perso->getId();?>&pack=<?php echo $consArray[2]->getId();?>&type=JKREJI8HYJ444YT' >
							<img src='<?php echo convertToCDNUrl('pic/vf.png');?>' width='114' height='79' onmouseover='src="<?php echo convertToCDNUrl('pic/vfo.png');?>"' onmouseout='src="<?php echo convertToCDNUrl('pic/vf.png');?>"'></a><br>
							<?php echo $consArray[2]->getPrix($perso->getLevel()); ?> $
						</td>
							<?php
							}else
							{
							echo"
						<td align=center class='verouille' width='33%'>
							<font size=5>VERROUILLE</font><br>
							NIVEAU REQUIS : </font><font size=4 color='333333'>".$consArray[2]->getLevelRequis()."</font>
						</td>";
							}
							?>
					</tr>
				</table>

				<table class='small' width='100%' >
					<tr height='120'>
						<?php
							if ($perso->getLevel() >= $consArray[3]->getLevelRequis())
							{
							?>
						<td align=center bgcolor='222222' width='33%'>
							<a href='achatok.php?perso=<?php echo $perso->getId();?>&pack=<?php echo $consArray[3]->getId();?>&type=JKREJI8HYJ444YT' >
							<img src='<?php echo convertToCDNUrl('pic/n20.png');?>' width='114' height='79' onmouseover='src="<?php echo convertToCDNUrl('pic/n20o.png');?>"' onmouseout='src="<?php echo convertToCDNUrl('pic/n20.png');?>"'></a><br>
							<?php echo $consArray[3]->getPrix($perso->getLevel()); ?> $
						</td>
							<?php
							}else
							{
							echo"
						<td align=center class='verouille' width='33%'>
							<font size=5>VERROUILLE</font><br>
							NIVEAU REQUIS : </font><font size=4 color='333333'>".$consArray[3]->getLevelRequis()."</font>
						</td>";
							}
							?>
							<?php
							if ($perso->getLevel() >= $consArray[4]->getLevelRequis())
							{
							?>
						<td align=center bgcolor='222222' width='33%'>
							<a href='achatok.php?perso=<?php echo $perso->getId();?>&pack=<?php echo $consArray[4]->getId();?>&type=JKREJI8HYJ444YT' >
							<img src='<?php echo convertToCDNUrl('pic/n70.png');?>' width='114' height='79' onmouseover='src="<?php echo convertToCDNUrl('pic/n70o.png');?>"' onmouseout='src="<?php echo convertToCDNUrl('pic/n70.png');?>"'></a><br>
							<?php echo $consArray[4]->getPrix($perso->getLevel()); ?> $
						</td>
							<?php
							}else
							{
							echo"
						<td align=center class='verouille' width='33%'>
							<font size=5>VERROUILLE</font><br>
							NIVEAU REQUIS : </font><font size=4 color='333333'>".$consArray[4]->getLevelRequis()."</font>
						</td>";
							}
							?>
							<?php
							if ($perso->getLevel() >= $consArray[5]->getLevelRequis())
							{
							?>
						<td align=center bgcolor='222222' width='33%'>
							<a href='achatok.php?perso=<?php echo $perso->getId();?>&pack=<?php echo $consArray[5]->getId();?>&type=JKREJI8HYJ444YT' >
							<img src='<?php echo convertToCDNUrl('pic/n100.png');?>' width='114' height='79' onmouseover='src="<?php echo convertToCDNUrl('pic/n100o.png');?>"' onmouseout='src="<?php echo convertToCDNUrl('pic/n100.png');?>"'></a><br>
							<?php echo $consArray[5]->getPrix($perso->getLevel()); ?> $
						</td>
							<?php
							}else
							{
							echo"
						<td align=center class='verouille' width='33%'>
							<font size=5>VERROUILLE</font><br>
							NIVEAU REQUIS : </font><font size=4 color='333333'>".$consArray[5]->getLevelRequis()."</font>
						</td>";
							}
							?>
					</tr>
				</table>

		</td>
	</tr>
