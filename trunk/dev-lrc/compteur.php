<table>

	<tr>
		<td>
			<object type="application/x-shockwave-flash" height="100" width="200" data="http://www.usflashmap.com/component/cdt_new/cdt2_2.swf">
			<param name="movie" value="http://www.usflashmap.com/component/cdt_new/cdt2_2.swf" />
			<param name="base" value="http://www.usflashmap.com/component/cdt_new/" />
			<param name="flashvars" value="
				  &timer=2&
				  &time_template=2:ss;1:mm;0:hh&
				  &time_color=0xCC0000&
				  &label_color=0x000000&
				  &background_color=0x555555&
				  &flare_view=false&
				  &time_label=d:;h:;m:;s:&
				  &time_zone=Local time&
				  &event_time=year:<?php  echo date('Y');?>;month:<?php  echo date('n');?>;day:
				  <?php 
					if ((date('n') == 1) OR (date('n') == 3) OR (date('n') == 5) OR (date('n') == 7) OR (date('n') == 8) OR (date('n') == 10) OR (date('n') == 12))
					{
						if (date('j') == 31)
							echo 1;
						else
							echo (date('j')+1);
					}else
					{
						if ((date('n') == 2) AND ((date('Y')%4) == 0))
						{
							if (date('j') == 29)
								echo 1;
							else
								echo (date('j') + 1);
						}else
						{
							if (date('n') == 2)
							{
								if (date('j') == 28)
								echo 1;
							else
								echo (date('j') + 1);
							}else
							{
								if (date('j') == 30)
									echo 1;
								else
									echo (date('j')+1);
							}
						}
					}				
				  ?>;hour:0;minute:0;seconds:0&
				  &event_duration=year:0;month:0;day:0;hour:0;minute:0;seconds:0&
				  &event_recursion=hourly&
				  &onpress_url=-&
				  &event_onpress_url=-&
				  &title=PROCHAINE VAGUE&
				  &event_title=&
				  &sound_file=-&
				  &event_sound_file=-&
				  &transparent=false&
			" />
			<param name="quality" value="high" />
			<param name="wmode" value="transparent" />
			<param name="scale" value="noscale" />
			<param name="salign" value="lt" />
			</object>
		</tr>
	</tr>
</table>