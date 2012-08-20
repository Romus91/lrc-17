<?php  $act=$_GET['arme'];
	$actp=$_GET['piege'];
								###Attribution des points pour les armes###
								$_SESSION['prix']=$prixballe['prixballes']=mysql_fetch_array(mysql_query("SELECT prixballe FROM armes WHERE image = '".$act."'"));

								###Attribution des points pour les pièges###
								if ($actp == '')$_SESSION['prixp']=0;
								if ($actp == 'piege1')$_SESSION['prixp']=10;
								if ($actp == 'piege2')$_SESSION['prixp']=20;
								if ($actp == 'piege3')$_SESSION['prixp']=5;
								if ($actp == 'piege4')$_SESSION['prixp']=20;
								if ($actp == 'piege5')$_SESSION['prixp']=180;
								if ($actp == 'piege6')$_SESSION['prixp']=120;
								if ($actp == 'piege7')$_SESSION['prixp']=140;
								if ($actp == 'piege8')$_SESSION['prixp']=2;
							?>

						<script language=javascript>
								var i=<?php  echo $_SESSION['mun'];?>;
								var  tune=<?php  echo $_SESSION['tune'];?>;
								var p=0;
								var pp=0;
								function plusOne(mun,munp,munmax)
								{

										if ((i < munmax) && (calcul(i+1,ip,mun,munp) >= 0))
										{
											i++;
											p=i-mun;
											document.getElementById('action').innerHTML="<font color='FFFF00'>"+i+"</font> / <?php  echo $_SESSION['munmax'];?>";
										}
										result(i,ip,mun,munp);
										document.getElementById('plus').innerHTML="<font color='00FF00'>+ "+p+"</font>";
								}
								function plusTen(mun,munp,munmax)
								{
										if (calcul(munmax,ip,mun,munp) >=0)
										{
											i=munmax;
											document.getElementById('action').innerHTML="<font color='FFFF00'>"+i+"</font> / <?php  echo $_SESSION['munmax'];?>";
										}else
										{
											i=mun+(Math.floor(calcul(i,ip,mun,munp)/<?php echo $_SESSION['prix'];?>));
											document.getElementById('action').innerHTML="<font color='FFFF00'>"+i+"</font> / <?php  echo $_SESSION['munmax'];?>";
										}
										p=i-mun;
										document.getElementById('plus').innerHTML="<font color='00FF00'>+ "+p+"</font>";
										result(i,ip,mun,munp);
								}
								function minOne(mun,munp)
								{
											if (i > mun)
											{
												i--;
												if (i == mun)
												{
													document.getElementById('action').innerHTML=i+" / <?php  echo $_SESSION['munmax'];?>";
												}else
												{
													document.getElementById('action').innerHTML="<font color='FFFF00'>"+i+"</font> / <?php  echo $_SESSION['munmax'];?>";
												}
											}
											p=i-mun;
											document.getElementById('plus').innerHTML="<font color='00FF00'>+ "+p+"</font>";
											result(i,ip,mun,munp);

								}
								function minTen(mun,munp)
								{
										i=mun;
										document.getElementById('action').innerHTML=i+" / <?php  echo $_SESSION['munmax'];?>";
										result(i,ip,mun,munp);
										p=0;
										document.getElementById('plus').innerHTML="<font color='00FF00'>+ "+p+"</font>";
								}



								ip=<?php  echo $_SESSION['munp'];?>;
								function plusOnep(mun,munp,munpmax)
								{

										if ((ip < munpmax) && (calcul(i,ip+1,mun,munp) >= 0))
										{
											ip++;
											document.getElementById('actionp').innerHTML="<font color='FFFF00'>"+ip+"</font>"+" / <?php  echo $_SESSION['munpmax'];?>";
										}
										pp=ip-munp;
										document.getElementById('plusp').innerHTML="<font color='00FF00'>+ "+pp+"</font>";
										result(i,ip,mun,munp);
								}
								function plusTenp(mun,munp,munpmax)
								{
										if (calcul(i,munpmax,mun,munp) >=0)
										{
											ip=munpmax;
											document.getElementById('actionp').innerHTML="<font color='FFFF00'>"+ip+"</font>"+" / <?php  echo $_SESSION['munpmax'];?>";
										}else
										{
											ip=munp+(Math.floor(calcul(i,ip,mun,munp)/<?php echo $_SESSION['prixp'];?>));
											document.getElementById('actionp').innerHTML="<font color='FFFF00'>"+ip+"</font>"+" / <?php  echo $_SESSION['munpmax'];?>";
										}
										pp=ip-munp;
										document.getElementById('plusp').innerHTML="<font color='00FF00'>+ "+pp+"</font>";
										result(i,ip,mun,munp);
								}
								function minOnep(mun,munp)
								{
											if (ip > munp)
											{
												ip--;
												if (ip == munp)
												{
													document.getElementById('actionp').innerHTML=ip+" / <?php  echo $_SESSION['munpmax'];?>";
												}else
												{
													document.getElementById('actionp').innerHTML="<font color='FFFF00'>"+ip+"</font>"+" / <?php  echo $_SESSION['munpmax'];?>";
												}
											}
											pp=ip-munp;
										document.getElementById('plusp').innerHTML="<font color='00FF00'>+ "+pp+"</font>";
											result(i,ip,mun,munp);

								}
								function minTenp(mun,munp)
								{
										ip=munp;
										document.getElementById('actionp').innerHTML=ip+" / <?php  echo $_SESSION['munpmax'];?>";
										result(i,ip,mun,munp);
										pp=0;
										document.getElementById('plusp').innerHTML="<font color='00FF00'>+ "+pp+"</font>";
								}


								function result(i,ip,mun,munp)
								{
									calcul(i,ip,mun,munp);
									//
									//return argent;
									if ((ip == munp) && (i == mun))
									{
										document.getElementById('prix').innerHTML="<font size=5>"+argent+"</font> <font color=1EB117 size=5>$</font>";
									}
									else
									{
										neg=tune-argent;
										document.getElementById('prix').innerHTML="<font color='FF0000' size=5>- "+neg+"</font>  <font color='FFFF00' size=5>"+argent+"</font> <font color=1EB117 size=5>$</font>";
									}
								}

								function calcul(i,ip,mun,munp)
								{
									argent=(tune-((<?php echo $_SESSION['prixp'];?>*((ip)-munp))+(<?php echo $_SESSION['prix'];?>*((i)- mun))));
									return argent;
								}

								function go(i,ip,mun,munp)
								{
									//calcul(i,ip,mun,munp);
									argent=calcul(i,ip,mun,munp);
									window.location.replace("index.php?page=achatok&perso=<?php  echo $nom;?>&mun="+i+"&munp="+ip+"&type=FSG258NE547");
								}


							</script>
							<noscript>Tu es nul !</noscript>
	<tr>
		<td>
				<table class='small' width='100%'><!-- On fait un grand formulaire avec toutes les armes, piège, vie que l'on peut achetter -->
					<?php
					if ($act <> 'piedbiche')
					{
					?>
					<tr>
						<td align=center class='color3'>
							Prix : <?php echo $_SESSION['prix'];?>$ / balles
						</td>
						<td align=center class='color4'>
							<table class='small' width='210'>
								<tr>
									<td>

											<img src='image.php?img=mmo.png' name='img1' onClick="minTen(<?php  echo $_SESSION['mun'];?>,<?php  echo $_SESSION['munp'];?>)"  onMouseOver="img1.src='image.php?img=mmi.png'"   onMouseOut="img1.src='image.php?img=mmo.png'">

									</td>
									<td>

											<img src='image.php?img=mo.png' name='img2' onClick="minOne(<?php  echo $_SESSION['mun'];?>,<?php  echo $_SESSION['munp'];?>)"  onMouseOver="img2.src='image.php?img=mi.png'"   onMouseOut="img2.src='image.php?img=mo.png'">

									</td>
									<td align=center width='100%'>
											<div id='plus'><font color="00FF00">+ 0</font></div>
									</td>
									<td align=right>

											<img src='image.php?img=po.png' name='img3' onClick="plusOne(<?php  echo $_SESSION['mun'];?>,<?php  echo $_SESSION['munp'];?>,<?php  echo $_SESSION['munmax'];?>)"  onMouseOver="img3.src='image.php?img=pi.png'"   onMouseOut="img3.src='image.php?img=po.png'" >

									</td>
									<td align=right>

											<img src='image.php?img=ppo.png' name='img4' onClick="plusTen(<?php  echo $_SESSION['mun'];?>,<?php  echo $_SESSION['munp'];?>,<?php  echo $_SESSION['munmax'];?>)"   onMouseOver="img4.src='image.php?img=ppi.png'"   onMouseOut="img4.src='image.php?img=ppo.png'">

									</td>
								</tr>
							</table>
						</td>
						<td align=center class='color3'>
							<table class='hev'>
								<tr>
									<td align=center>
										<img src='<?php  echo $act;?>.png' width='80'>
									</td>
								</tr>
							</table>
							<table class='small' width='105'>
								<tr>
									<td align=center>
											<div id='action'><?php  echo $_SESSION['mun'];?> / <?php  echo $_SESSION['munmax'];?></div>
									</td>
								</tr>
							</table>
						</td>
					</tr>

					<?php
					}else
						echo "
					<tr>
						<td align=center>
							Le pied de biche ne peut pas être rechargé !
						</td>
					</tr>";
					if ($actp)
					{
					?>
					<tr>
						<td td align=center class='color3'>
							Prix : <?php echo $_SESSION['prixp'];?>$ / items
						</td>
						<td td align=center class='color4'>
							<table class='small' width='210'>
								<tr>
									<td>
											<img src='image.php?img=mmo.png' name='img1p' onClick="minTenp(<?php  echo $_SESSION['mun'];?>,<?php  echo $_SESSION['munp'];?>)"  onMouseOver="img1p.src='image.php?img=mmi.png'"   onMouseOut="img1p.src='image.php?img=mmo.png'" >
									</td>
									<td>
											<img src='image.php?img=mo.png' name='img2p' onClick="minOnep(<?php  echo $_SESSION['mun'];?>,<?php  echo $_SESSION['munp'];?>)"  onMouseOver="img2p.src='image.php?img=mi.png'"   onMouseOut="img2p.src='image.php?img=mo.png'">
									</td>
									<td align=center width='100%'>
											<div id='plusp'><font color="00FF00">+ 0</font></div>
									</td>
									<td align=right>
											<img src='image.php?img=po.png' name='img3p' onClick="plusOnep(<?php  echo $_SESSION['mun'];?>,<?php  echo $_SESSION['munp'];?>,<?php  echo $_SESSION['munpmax'];?>)"  onMouseOver="img3p.src='image.php?img=pi.png'"   onMouseOut="img3p.src='image.php?img=po.png'">
									</td>
									<td align=right>
											<img src='image.php?img=ppo.png' name='img4p' onClick="plusTenp(<?php  echo $_SESSION['mun'];?>,<?php  echo $_SESSION['munp'];?>,<?php  echo $_SESSION['munpmax'];?>)"   onMouseOver="img4p.src='image.php?img=ppi.png'"   onMouseOut="img4p.src='image.php?img=ppo.png'">
									</td>
								</tr>
							</table>
						</td>
						<td td align=center class='color3'>
							<table class='hev'>
								<tr>
									<td align=center>
										<img src='<?php  echo $actp;?>.png' width='80'>
									</td>
								</tr>
							</table>
							<table class='small' width='105'>
								<tr>
									<td align=center>
											 <div id='actionp'><?php  echo $_SESSION['munp'];?> / <?php  echo $_SESSION['munpmax'];?></div>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<?php
					}
					?>
				</table>
				<table bgcolor=000000 width='100%'>
					<tr>
						<td colspan=3 align=center><input type= 'submit' value = 'Acheter !' onClick="go(i,ip,<?php  echo $_SESSION['mun'];?>,<?php  echo $_SESSION['munp'];?>)"></td>
					</tr>
				</table>
		</td>
	</tr>