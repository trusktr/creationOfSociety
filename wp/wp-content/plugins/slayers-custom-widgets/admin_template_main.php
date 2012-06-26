
<h2>Custom widgets</h2>
<table class="form-table">
	<tr>
		<th scope="row" style="width:200px;">
			<h3>Widgets</h3>
			<div style="font-weight:normal;margin-bottom:20px;">Select a widget from the list that you want to customize.</div>
			
			<h4>Legend</h4>
			<div style="font-weight:normal;margin-top:10px;">
				Blue text - normal widget <br/>
				Red  text - customized widget
			</div>
			
			<br/><br/>
			
			<a class="button" onclick="if(!confirm('Are you sure you want to reset all widgets?')) return false;" href="<?php echo $this->info['admin_url'] ?>&amp;reset_widgets">Reset all widgets</a>
		</th>
		<td>
			<?php
				
				global $wp_registered_sidebars, $wp_registered_widgets, $wp_registered_widget_controls;
				
				$sidebars = wp_get_sidebars_widgets();
				
				if(!$sidebars)
					echo '<div class="slayer_list">No widgets registered. Please setup at least one widget via wordpress <a href="widgets.php">widgets control panel</a>(found under the Design tab)</div>';
				else
					{
					echo '<ul class="slayer_list">';
					
						foreach($sidebars as $sidebar_id => $widgets){
							
							echo '<li class="widget-list-control-item">';
							
								echo '<h4 class="widget-title ', !empty($wp_registered_sidebars[$sidebar_id]['name']) ? false : 'not_registered' ,'">',!empty($wp_registered_sidebars[$sidebar_id]['name']) ? $wp_registered_sidebars[$sidebar_id]['name'] : 'Not registered','</h4>';
								
								echo '<ul>';
									
									$texts = get_option('widget_text');
									foreach($widgets as $widget_id){
										
										$has_limit = false;
										if(!empty($this->widgets[$widget_id]))
											foreach($this->widgets[$widget_id] as $group => $data )
												if(!empty($data))
													if($group != 'opts'){
														$has_limit = true;
														break;
														}
													else
														foreach($data as $opt)
															if(!empty($opt)){
																$has_limit = true;
																break;
																}
										
										echo '<li><a style="', $has_limit ? 'color:red;' : false ,'" href="',$this->info['admin_url'],'&amp;act=edit&amp;id=',$wp_registered_widgets[$widget_id]['id'],'">';
											
											if($wp_registered_widgets[$widget_id]['callback'] == 'wp_widget_text' && !empty($wp_registered_widgets[$widget_id]['params'][0]['number']) && !empty($texts[$wp_registered_widgets[$widget_id]['params'][0]['number']])){
												echo 'Text widget: ', !empty($texts[$wp_registered_widgets[$widget_id]['params'][0]['number']]['title']) ? $texts[$wp_registered_widgets[$widget_id]['params'][0]['number']]['title'] : htmlentities(array_shift(explode("\r\n", wordwrap($texts[$wp_registered_widgets[$widget_id]['params'][0]['number']]['text'], 15, " ...\r\n", true))));
												
												}
											else
												echo !empty($wp_registered_widgets[$widget_id]['name']) ? $wp_registered_widgets[$widget_id]['name'] : $wp_registered_widgets[$widget_id]['id'];
										
										echo '</a></li>';
									
										}
								echo '</ul>';
								
							echo '</li>';
							
							
							}
						
					echo '</ul>';
					}
			?>
			
		</td>
	</tr>
</table>
