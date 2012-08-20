
			<?php
				$inv=mysql_fetch_array(mysql_query("SELECT * FROM inventaire WHERE id_perso = ".$perso->getId().""));
				$arm=mysql_fetch_array(mysql_query("SELECT * FROM pieges WHERE image = '".$inv['pie'.$i]."'"));
				$value=($arm['prix']/2);
			?>
				<tr valign=top>
						<td colspan=3 bgcolor='333333'>
								<table class='small' width='100%'>
									<tr>
										<td align=center><font size=3>VENDRE <?php echo $arm['nom'];?> ? </font></td>
									</tr>
								</table>
								<table  width='100%'>
									<tr valign=top>
										<td align=center>
											<font size=4 color="00FF00"> + <?php echo $value; ?> $</font>
												<table class='button'  >
													<tr>
														<td align=center id='button'>
															<a href='piegevendreok.php?perso=<?php echo $perso->getId();?>&nom=<?php echo $perso->getNom();?>&i=<?php echo $_GET['i'];?>&value=<?php echo $value;?>' >OK</a>
														</td>
													</tr>
												</table>
										</td>
									</tr>
								</table>