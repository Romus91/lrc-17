					<?php 
						$inv=mysql_fetch_array(mysql_query("SELECT * FROM inventaire WHERE id_perso = ".$perso->getId().""));
						$piege=mysql_fetch_array(mysql_query("SELECT * FROM pieges WHERE image = '".$inv['pie'.$i]."'"));
					?>
					<tr height='140' valign=top>
						<td colspan=3 bgcolor='333333'>
								<table class='small' width='490' height='30'>
									<tr>
										<td align=center><font size=3>AMELIORATIONS</font></td>
									</tr>
								</table>
								<table class='button' width='490'  >
									<tr>
										<td class='color3'>DEGATS</td><td class='small' width=50 align=right><font color="00ff00">+0</font></td>
									</tr>
									<tr>
										<td class='color4'>PRECISION</td><td class='small' width=50 align=right><font color="00ff00" >+0</font></td>
									</tr>
									<tr>
										<td class='color3'>CAPACITE CHARGEUR</td><td class='small' width=50 align=right><font color="00ff00" >+0</font></td>
									<tr>
										<td class='color4' >&nbsp;</td><td class='small' width=50 align=right><font color="00ff00" >+0</font></td>
									</tr>
								</table>
						</td>
					</tr>
