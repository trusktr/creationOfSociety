jQuery(document).ready(function(){
	
	jQuery('.rbet_tip').each(function(){
				
				this.parentNode.rbet_tip = this;
				
				jQuery(this).hide();
				
				this.parentNode.onmouseover = function(){
							
						jQuery(this.rbet_tip).show();
						
					};
				this.parentNode.onmouseout = function(){
						
						jQuery(this.rbet_tip).hide();
						
						
					};
				
			}
		);
	
	jQuery('.check-column-controller').each(function(){
			
			jQuery('tr',this.parentNode.parentNode.parentNode.tBodies[0]).each(function(){
					this.style.cursor = 'pointer';
					this.onclick = function(ev) {
						ev = ev || window.event;
						var target = ev.target || ev.srcElement;
						if( !target.type || target.type != 'checkbox' )
							this.firstChild.firstChild.checked = !this.firstChild.firstChild.checked;
						}
					}
				);
			
			this.firstChild.onclick = function(){
				var q = this.checked;
				jQuery('.check-column',this.parentNode.parentNode.parentNode.parentNode.tBodies[0]).each(function(){
						this.firstChild.checked = q;
						}
					);
				}
			}
		);
		
	jQuery('.check-column-controller_ext').each(function(){
			
			
			jQuery('tr',jQuery('.widefat', this.parentNode.parentNode.parentNode.parentNode)[1]).each(function(){
					this.style.cursor = 'pointer';
					this.onclick = function(ev) {
						ev = ev || window.event;
						var target = ev.target || ev.srcElement;
						if( !target.type || target.type != 'checkbox' )
							this.firstChild.firstChild.checked = !this.firstChild.firstChild.checked;
						}
					}
				);
			
			this.firstChild.onclick = function(){
				var q = this.checked;
				jQuery('.check-column', jQuery('.widefat', this.parentNode.parentNode.parentNode.parentNode.parentNode)[1]).each(function(){
						this.firstChild.checked = q;
						}
					);
				}
			}
		);
		
	
	}
);