	<tr>
		<td align=center>
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
							<img src='image.php?img=v10.png&w=120&h=85' width='120' height='85' onmouseover='src="image.php?img=v10o.png&w=120&h=85"' onmouseout='src="image.php?img=v10.png&w=120&h=85"'></a><br>
							<?php echo $consArray[0]->getPrix($perso->getLevel()); ?> $
						</td>
							<?php
							}else
							{
							echo"
						<td align=center class='verouille' width='33%'>
							<font size=5>VEROUILLE</font><br>
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
							<img src='image.php?img=v50.png&w=120&h=85' width='120' height='85' onmouseover='src="image.php?img=v50o.png&w=120&h=85"' onmouseout='src="image.php?img=v50.png&w=120&h=85"'></a><br>
							<?php echo $consArray[1]->getPrix($perso->getLevel()); ?> $
						</td>
							<?php
							}else
							{
							echo"
						<td align=center class='verouille' width='33%'>
							<font size=5>VEROUILLE</font><br>
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
							<img src='image.php?img=vf.png&w=120&h=85' width='120' height='85' onmouseover='src="image.php?img=vfo.png&w=120&h=85"' onmouseout='src="image.php?img=vf.png&w=120&h=85"'></a><br>
							<?php echo $consArray[2]->getPrix($perso->getLevel()); ?> $
						</td>
							<?php
							}else
							{
							echo"
						<td align=center class='verouille' width='33%'>
							<font size=5>VEROUILLE</font><br>
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
							<img src='image.php?img=n20.png&w=120&h=85' width='120' height='85' onmouseover='src="image.php?img=n20o.png&w=120&h=85"' onmouseout='src="image.php?img=n20.png&w=120&h=85"'></a><br>
							<?php echo $consArray[3]->getPrix($perso->getLevel()); ?> $
						</td>
							<?php
							}else
							{
							echo"
						<td align=center class='verouille' width='33%'>
							<font size=5>VEROUILLE</font><br>
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
							<img src='image.php?img=n70.png&w=120&h=85' width='120' height='85' onmouseover='src="image.php?img=n70o.png&w=120&h=85"' onmouseout='src="image.php?img=n70.png&w=120&h=85"'></a><br>
							<?php echo $consArray[4]->getPrix($perso->getLevel()); ?> $
						</td>
							<?php
							}else
							{
							echo"
						<td align=center class='verouille' width='33%'>
							<font size=5>VEROUILLE</font><br>
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
							<img src='image.php?img=n100.png&w=120&h=85' width='120' height='85' onmouseover='src="image.php?img=n100o.png&w=120&h=85"' onmouseout='src="image.php?img=n100.png&w=120&h=85"'></a><br>
							<?php echo $consArray[5]->getPrix($perso->getLevel()); ?> $
						</td>
							<?php
							}else
							{
							echo"
						<td align=center class='verouille' width='33%'>
							<font size=5>VEROUILLE</font><br>
							NIVEAU REQUIS : </font><font size=4 color='333333'>".$consArray[5]->getLevelRequis()."</font>
						</td>";
							}
							?>
					</tr>
				</table>

		</td>
	</tr>
