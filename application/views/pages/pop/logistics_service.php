<div class="container-fuild" style="float:left;width:100%;background-color:#eee;padding:10px 0% 12px 0%;">
	<div class="container"><?php print_r($slider); ?></div>
</div>
 
<div class="container-fuild content-section" style="padding-top:15px;float:left;width:100%;padding-bottom:15px;">
	<div class="container">
		<div class="col-md-12 bc-nav" >
			<a href="<?php echo base_url(); ?>" title=""><?php echo $this->lang_file->heading_fetch('home');?></a>&nbsp;<i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>&nbsp;
			<a href="<?php echo base_url(); ?>pop-dashboard"><?php echo $this->lang_file->heading_fetch('pop_dashboard');?> </a><i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>&nbsp;
			<?php echo $this->lang_file->heading_fetch('transportation');?></a>

		</div>
		<div class="col-sm-9 content-9 h-space-padd-r">

			<h3 class="p-title"><span><?php echo $this->lang_file->heading_fetch('transportation');?><p class="t-stake-data"><a id="backBtn"><b><?php echo $this->lang_file->heading_fetch('back');?></b>  <img src="<?php echo base_url(); ?>assest/images/pop/back-arrow.png" style="width: 20px;"></a></p></span></h3>
			<div align="center" class="row">
				<p>&nbsp;</p>

				<div class="col-md-2"><a href="<?php echo base_url();?>pop-dashboard/transportation/providers"><img src="<?php echo base_url();?>/assest/images/pop/ser_provider.png" style="width:118px; height: 118px;" /><br />
				<b><?php echo $this->lang_file->heading_fetch('pop_service_information');?></b></a>
				</div>
				<div class="col-md-2"><a href="#"><img src="<?php echo base_url(); ?>/assest/images/pop/rate_card.png" style="width:118px; height: 118px;" /><br />
				<b><?php echo $this->lang_file->heading_fetch('pop_rate');?></b></a>
				</div>
				<div class="col-md-2"><a href="#"><img src="<?php echo base_url(); ?>/assest/images/pop/request.png" style="width:118px; height: 118px;" /><br />
				<b><?php echo $this->lang_file->heading_fetch('pop_servicesrequest');?></b></a>
				</div>		

				<p>&nbsp;</p>
			</div>
		</div>			

		<div class="col-sm-3 content-3 h-space-padd-r-l">
			<div class="focus-section">
				<div class="sidebar-header-title"><span><?php echo $this->lang_file->heading_fetch('enam_coverage'); ?></span></div>
				<div class="home-ind-map">
					<a href="javascript:void(0);"><img src="<?php echo base_url();?>/assest/images/new-theme/map.jpg" usemap="#image-map" class="state_district"></a>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

<script type="text/javascript">
	$('#backBtn').click(function(){
		parent.history.back();
	});
</script>


