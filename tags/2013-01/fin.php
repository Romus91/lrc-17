													</td>
												</tr>
											</table></div>
											<table class='barremenu' width="100%">
												<tr>
													<td align=center>&nbsp;</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr align="left">
				<td colspan="2"><a href='http://romustech.dyndns.org'>Created by Romus</a><font color="FAC21D"> -- Copyright © LES RESCAPES DE CITE 17 -- Co-developper : Anthares <!-- Mets l'adresse de ta plateforme personnelle ici ;) --></font></td>
			</tr>
		</table>
	</td>
</tr>
</table>
<div style="height:30; background: none"/>
<div id="footer-block-wrapper">
	<div id="footer-block">
		<div id="chat-tray">
			<div id="chat-tray-arrow"></div>
			<div id="chat-tray-title">CHAT</div>
			<div id="chat-tray-badge"><p id="chatUnreadMessage">0</p></div>
		</div>
		<div id="pseudobox">
			<img src='<?php echo convertToCDNUrl('pic/charg.gif');?>' width='100%'>
		</div>
		<form id="chatform">
			<input type="text" name="mess" />
			<input name="pseudo" type="hidden" value="<?php echo $mem->getLogin();?>" />
		</form>
		<div id="chattimestamp" style="display: none;"></div>
	</div>
</div>
</body>
</html>