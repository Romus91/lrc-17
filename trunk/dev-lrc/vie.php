	<tr>
		<td align=center>
				
						
				<table class='small' width='100%' >
					<tr height='120'>
						<?php 
							if ($perso->getLevel() > 4)
							{
							?>
						<td align=center bgcolor='222222' width='33%'>	
							<a href='achatok.php?perso=<?php echo $perso->getId();?>&medipack=10&type=JKREJI8HYJ444YT' >
							<img src='pic/v10.png' width='120' height='85' onmouseover='src="pic/v10o.png"' onmouseout='src="pic/v10.png"'></a><br>
							<?php echo (ceil($perso->getLevel()/4)*200); ?> $
						</td>
							<?php
							}else
							{
							echo"
						<td align=center bgcolor='111111' width='33%'>	
							<font color='333333'>NIVEAU REQUIS : </font><font size=4 color='333333'>5</font>
						</td>";
							}
							?>
							<?php 
							if ($perso->getLevel() > 6)
							{
							?>
						<td align=center bgcolor='222222' width='33%'>	
							<a href='achatok.php?perso=<?php echo $perso->getId();?>&medipack=50&type=JKREJI8HYJ444YT' >
							<img src='pic/v50.png' width='120' height='85' onmouseover='src="pic/v50o.png"' onmouseout='src="pic/v50.png"'></a><br>
							<?php echo (ceil($perso->getLevel()/4)*500); ?> $
						</td>
							<?php
							}else
							{
							echo"
						<td align=center bgcolor='111111' width='33%'>	
							<font color='333333'>NIVEAU REQUIS : </font><font size=4 color='333333'>7</font>
						</td>";
							}
							?>
							<?php 
							if ($perso->getLevel() > 9)
							{
							?>
						<td align=center bgcolor='222222' width='33%'>	
							<a href='achatok.php?perso=<?php echo $perso->getId();?>&medipack=full&type=JKREJI8HYJ444YT' >
							<img src='pic/vf.png' width='120' height='85' onmouseover='src="pic/vfo.png"' onmouseout='src="pic/vf.png"'></a><br>
							<?php echo (ceil($perso->getLevel()/4)*800); ?> $
						</td>
							<?php
							}else
							{
							echo"
						<td align=center bgcolor='111111' width='33%'>	
							<font color='333333'>NIVEAU REQUIS : </font><font size=4 color='333333'>10</font>
						</td>";
							}
							?>
					</tr>
				</table>
				
				<table class='small' width='100%' >
					<tr height='120'>
						<?php 
							if ($perso->getLevel() > 5)
							{
							?>
						<td align=center bgcolor='222222' width='33%'>	
							<a href='achatok.php?perso=<?php echo $perso->getId();?>&nrgpack=20&type=JKREJI8HYJ444YT' >
							<img src='pic/n20.png' width='120' height='85' onmouseover='src="pic/n20o.png"' onmouseout='src="pic/n20.png"'></a><br>
							<?php echo (ceil($perso->getLevel()/4)*300); ?> $
						</td>
							<?php
							}else
							{
							echo"
						<td align=center bgcolor='111111' width='33%'>	
							<font color='333333'>NIVEAU REQUIS : </font><font size=4 color='333333'>6</font>
						</td>";
							}
							?>
							<?php 
							if ($perso->getLevel() > 7)
							{
							?>
						<td align=center bgcolor='222222' width='33%'>	
							<a href='achatok.php?perso=<?php echo $perso->getId();?>&nrgpack=70&type=JKREJI8HYJ444YT' >
							<img src='pic/n70.png' width='120' height='85' onmouseover='src="pic/n70o.png"' onmouseout='src="pic/n70.png"'></a><br>
							<?php echo (ceil($perso->getLevel()/4)*700); ?> $
						</td>
							<?php
							}else
							{
							echo"
						<td align=center bgcolor='111111' width='33%'>	
							<font color='333333'>NIVEAU REQUIS : </font><font size=4 color='333333'>8</font>
						</td>";
							}
							?>
							<?php 
							if ($perso->getLevel() > 9)
							{
							?>
						<td align=center bgcolor='222222' width='33%'>	
							<a href='achatok.php?perso=<?php echo $perso->getId();?>&nrgpack=100&type=JKREJI8HYJ444YT' >
							<img src='pic/n100.png' width='120' height='85' onmouseover='src="pic/n100o.png"' onmouseout='src="pic/n100.png"'></a><br>
							<?php echo (ceil($perso->getLevel()/4)*1000); ?> $
						</td>
							<?php
							}else
							{
							echo"
						<td align=center bgcolor='111111' width='33%'>	
							<font color='333333'>NIVEAU REQUIS : </font><font size=4 color='333333'>10</font>
						</td>";
							}
							?>
					</tr>
				</table>
				
		</td>
	</tr>
