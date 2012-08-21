						<script language=javascript>
								var i=<?php  echo $inv['munp'.$i];?>;
								var tune=<?php  echo $perso->getArgent();?>;
								var p=0;
								function plusOne(mun,munmax)
								{

										if ((i < munmax) && (calcul(i+1,mun) >= 0))
										{
											i++;
											p=i-mun;
											document.getElementById('action').innerHTML="<font color='FFFF00'>"+i+"</font> | <?php  echo $arm['munmax'];?>";
											//document.getElementById('plus').innerHTML="<font color='00FF00'>+ "+p+"</font>";
										}
										result(i,mun);

								}
								function plusTen(mun,munmax)
								{
										if (calcul(munmax,mun) >=0)
										{
											i=munmax;
											document.getElementById('action').innerHTML="<font color='FFFF00'>"+i+"</font> | <?php  echo $arm['munmax'];?>";
										}else
										{
											i=mun+(Math.floor(calcul(i,mun)/<?php echo $prix;?>));
											document.getElementById('action').innerHTML="<font color='FFFF00'>"+i+"</font> | <?php  echo $arm['munmax'];?>";
										}
										p=i-mun;
										//document.getElementById('plus').innerHTML="<font color='00FF00'>+ "+p+"</font>";
										result(i,mun);
								}
								function minOne(mun)
								{
											if (i > mun)
											{
												i--;
												if (i == mun)
												{
													document.getElementById('action').innerHTML=i+" | <?php  echo $arm['munmax'];?>";
												}else
												{
													document.getElementById('action').innerHTML="<font color='FFFF00'>"+i+"</font> | <?php  echo $arm['munmax'];?>";
												}
											}
											p=i-mun;
										//	document.getElementById('plus').innerHTML="<font color='00FF00'>+ "+p+"</font>";
											result(i,mun);

								}
								function minTen(mun)
								{
										i=mun;
										document.getElementById('action').innerHTML=i+" | <?php  echo $arm['munmax'];?>";
										p=0;
									//	document.getElementById('plus').innerHTML="<font color='00FF00'>+ "+p+"</font>";
										result(i,mun);
								}




								function result(i,mun)
								{
									calcul(i,mun);
									//
									//return argent;
									if (i == mun)
									{
										document.getElementById('prix').innerHTML="<font size=5>"+argent+"</font> <font color=1EB117 size=5>$</font>";
									}
									else
									{
										neg=tune-argent;
										document.getElementById('prix').innerHTML="<font color='FF0000' size=5>- "+neg+"</font> <font size=5>|</font> <font color='FFFF00' size=5>"+argent+"</font> <font color=1EB117 size=5>$</font>";
									}
								}

								function calcul(i,mun)
								{
									argent=(tune-(<?php echo $prix;?>*((i)- mun)));
									return argent;
								}

								function go(i,mun)
								{
									//calcul(i,ip,mun,munp);
									argent=calcul(i,mun);
									window.location.replace("achatmunpiege.php?perso=<?php echo $perso->getId();?>&argent="+argent+"&mun="+(i-mun)+"&munpiege=<?php echo $i;?>&piege=<?php echo $piege;?>&type=G4F5DG4656DG4&nom=<?php echo $perso->getNom();?>");
								}


							</script>
							<noscript>Tu es nul !</noscript>

					<tr valign=top >
						<td colspan=3 bgcolor='333333' align=center>
								<table class='small' width='100%'>
									<tr>
										<td align=center><font size=3>RECHARGER</font></td>
									</tr>
								</table>
								<table class='button'>
									<tr>
										<td class='small' width='300'>
											<table class='small' >
												<tr>
													<td>
														<img src='pic/mmo.png' name='img1' onClick="minTen(<?php  echo $inv['munp'.$i];?>)"  onMouseOver="img1.src='pic/mmi.png'"   onMouseOut="img1.src='pic/mmo.png'">
													</td>
													<td>
														<img src='pic/mo.png' name='img2' onClick="minOne(<?php  echo $inv['munp'.$i];?>)"  onMouseOver="img2.src='pic/mi.png'"   onMouseOut="img2.src='pic/mo.png'">
													</td>
													<td align=center width='100%'>
															<!--<div id='plus'><font color="00FF00">+ 0</font></div>-->	<div id='action'><?php  echo $inv['munp'.$i];?> | <?php  echo $arm['munmax'];?></div>
													</td>
													<td align=right>
														<img src='pic/po.png' name='img3' onClick="plusOne(<?php  echo $inv['munp'.$i];?>,<?php  echo $arm['munmax'];?>)"  onMouseOver="img3.src='pic/pi.png'"   onMouseOut="img3.src='pic/po.png'" >
													</td>
													<td align=right>
														<img src='pic/ppo.png' name='img4' onClick="plusTen(<?php  echo $inv['munp'.$i];?>,<?php  echo $arm['munmax'];?>)"   onMouseOver="img4.src='pic/ppi.png'"   onMouseOut="img4.src='pic/ppo.png'">
													</td>
												</tr>
											</table>
										</td>
								</table>
								<table>
									<tr>
										<td>PRIX PAR ITEM [<?php echo $prix;?>$]</td>
									</tr>
								</table>
								<table width=100%>
									<tr>
										<td>
											<table class='button'  >
												<tr>
													<td align=center id='button'>
														<a onclick='go(i,<?php  echo $inv['munp'.$i];?>),opener.location.reload()' onmouseover="this.style.cursor='pointer'" >OK</a>
													</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
							</td>
						</tr>