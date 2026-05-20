<header>
<div class="header-section">
	<div class="container-fuild">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-sm-8">
					<div class="india-logo">
						<img class="govt-logo" alt="India" src="<?php echo base_url(); ?>/assest/images/new-theme/g-logo.png" />
						<!--<img class="sfac-logo" alt="SFAC" src="<?php echo base_url(); ?>/assest/images/new-theme/sfac-logo.png" />-->
						<div class="border-line">&nbsp;</div>
						<img class="e-nam-logo" alt="eNam" src="<?php echo base_url(); ?>/assest/images/new-theme/enam-logo.png" />
					</div>
				</div>
				<div class="col-lg-4 col-sm-4">
					<div class="header-right-section">
						<div class="header-right-list h-bottom">
							<div class="pull-left">
								<span><b><?php echo $this->lang_file->heading_fetch('call_us');?></b></span>
								<span><b>1800 270 0224</b></span>
							</div>
							<div class="pull-left lag-box-sec">
							
								<span><?php echo $this->lang_file->heading_fetch('language');?></span>
								<select class="select-lang" id="language_selector">
									<?php if($this->session->userdata('client_language') != ''){ 
										$session_lang = $this->session->userdata('client_language'); 
									} else { $session_lang = ''; }?>
									<?php foreach($languages as $language){ 
										if($session_lang != ''){ ?>
											<?php if($language['l_id'] == $session_lang)
										
											{ ?>

												<option value="<?php echo $language['l_id']; ?>" selected><?php echo $language['l_name']; ?></option>
											<?php } else {?>
											<option value="<?php echo $language['l_id']; ?>"><?php echo $language['l_name']; ?></option>
											<?php } ?>
										<?php } else { ?>
											<option value="<?php echo $language['l_id']; ?>"><?php echo $language['l_name']; ?></option>
										<?php } ?>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="header-right-list" >
                                                        <a href="<?php echo base_url('registration'); ?>" title="Registration">
								<img alt="Registrations" src="<?php echo base_url(); ?>/assest/images/new-theme/registrations.png" />
								<span><b><?php echo $this->lang_file->heading_fetch('registration');?></b></span>
							</a>
						</div>
						<div class="header-right-list">
                                                   <a class="border" href="<?php echo base_url('login'); ?>" title="Login">
								<img alt="Login" src="<?php echo base_url(); ?>/assest/images/new-theme/login-user.png" />
								<span><b><?php echo $this->lang_file->heading_fetch('login');?></b></span>
							</a>
						</div>
						<div class="color-theme">
							<div class="green-theme-btn"><span title="Green Theme" class="green-box">&nbsp;&nbsp;&nbsp;</span></div>						
							<div class="red-theme-btn"><span title="Red Theme" class="red-box">&nbsp;&nbsp;&nbsp;</span></div>
							<div class="blue-theme-btn"><span title="Blue Theme" class="blue-box">&nbsp;&nbsp;&nbsp;</span></div>
							<div class="orange-theme-btn"><span title="Dark Theme" class="orange-box">&nbsp;&nbsp;&nbsp;</span></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</header>
<!-- <script type="text/javascript">
	
	$('#language_selector').on('change', function() {
		 if ($(this).val() == 2) 
		 {
		 	alert("okay");
		   $('.font-A .quick-link-list li a').css("font-size", "10px");
		 }
		});

</script>
 -->
