<div id="footer-block-wrapper">
	<div id="footer-block">
		<div id="chat-tray">
			<div id="chat-tray-arrow"></div>
			<div id="chat-tray-title">CHAT</div>
			<div id="chat-tray-badge">
				<p id="chatUnreadMessage">0</p>
			</div>
		</div>
		<div id='chat-content'>
			<div id="pseudobox">
				<img src='<?php echo convertToCDNUrl('pic/charg.gif');?>' width='100%'>
			</div>
			<div id='chat-online'>
				<div id="online-header" class="color1">En ligne</div>
				<div id='online'></div>
				<div id='online-legende' class="color1">
					<span class="role-admin">Admin</span><br /><span class="role-dev">DevTeam</span><br /><span class="role-member">Joueur</span>
				</div>
			</div>
		</div>
		<div id="chatform-wrapper">
			<form id="chatform">
				<input type="text" name="mess" /> <input name="pseudo" type="hidden" value="<?php echo $mem->getLogin();?>" />
			</form>
			<div id="chat-sound"></div>
		</div>
		<div id="chattimestamp" style="display: none;"></div>
	</div>
</div>
