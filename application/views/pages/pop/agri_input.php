<style type="text/css">
	#myModalbankdetail a.close{color:#f00;opacity:1;}
	#myModalbankdetail h3{color:#27AE60;}
	@media (max-width:1600px){
		#myModalbankdetail{width: 555px; height: 480px;}
	}
	@media (max-width:1400px){
		#myModalbankdetail{width: 555px; height: 480px;}
	}

	@media (max-width:1200px){
		#myModalbankdetail{width: 555px; height: 480px;}
	}
	@media (max-width:960px){
		#myModalbankdetail{width: 555px; height: 480px;}
	}

	@media (max-width:480px){
		#myModalbankdetail{width: 300px; height: 310px;}
	}


	#modalForNSC a.close{color:#f00;opacity:1;}
	#modalForNSC h3{color:#27AE60;}
	@media (max-width:1600px){
		#modalForNSC{width: 555px; height: 480px;}
	}
	@media (max-width:1400px){
		#modalForNSC{width: 555px; height: 480px;}
	}

	@media (max-width:1200px){
		#modalForNSC{width: 555px; height: 480px;}
	}
	@media (max-width:960px){
		#modalForNSC{width: 555px; height: 480px;}
	}

	@media (max-width:480px){
		#modalForNSC{width: 300px; height: 310px;}
	}
</style>

<div class="container-fuild" style="float:left;width:100%;background-color:#eee;padding:10px 0% 12px 0%;">
	<div class="container"><?php print_r($slider); ?></div>
</div>
 
<div class="container-fuild content-section" style="padding-top:15px;float:left;width:100%;padding-bottom:15px;">
	<div class="container">
		<div class="col-md-12 bc-nav">
			<a href="<?php echo base_url(); ?>" title=""><?php echo $this->lang_file->heading_fetch('home');?></a>&nbsp;<i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>&nbsp;
			<a href="<?php echo base_url(); ?>pop-dashboard"><?php echo $this->lang_file->heading_fetch('pop_dashboard');?> </a><i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>&nbsp;
			<?php echo $this->lang_file->heading_fetch('agri_input');?>
		</div>
		<div class="col-sm-9 content-9 h-space-padd-r">
			<h3 class="p-title"><span><?php echo $this->lang_file->heading_fetch('providers_agri_input');?><p class="t-stake-data"><a id="backBtn"><b><?php echo $this->lang_file->heading_fetch('back');?></b>  <img src="<?php echo base_url(); ?>assest/images/pop/back-arrow.png" style="width: 20px;"></a></p></span></h3>
			<div align="center" class="row">
				<p>&nbsp;</p>
				<div class="col-md-2"><a href="" target=""><img src="<?php echo base_url();?>/assest/images/pop/Star Agribazaar.jpg" style="width:118px; height: 118px;" />
				<b id="star_agri"><?php echo $this->lang_file->heading_fetch('star_agri');?></b></a><img class="imgpop" data-id="star_agri" src="<?php echo base_url();?>assest/images/pop/i_tag.png"/>
				</div>

				<div class="col-md-2" style="padding-top: 28px;">
					<a href="" target=""><img src="<?php echo base_url(); ?>assest/images/pop/FPO Bazaar.png" style="width:100px; height: 70px;" /><br/><br>
				<p id="fpo_p"><b id="fpo">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->lang_file->heading_fetch('fpo');?></b></a><img class="imgpop" data-id="fpo" src="<?php echo base_url();?>assest/images/pop/i_tag.png"/></p>
				</div>

				<div class="col-md-2" style="padding-top: 58px;"><a href="" target=""><img src="<?php echo base_url(); ?>assest/images/pop/NSC_logo-name.jpg" style="width:224px; height: 40px;margin-left: 25px;" /><br/><br>
				<p id="nsc_p" style="white-space: nowrap;"><b id="nsc">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->lang_file->heading_fetch('national_seed');?></b></a><img class="nsclogo" data-id="nsc" src="<?php echo base_url();?>assest/images/pop/i_tag.png"/></p>
				</div>


				<div class="col-md-2" style="padding-top: 28px; margin-left: 91px;">
					<a href="" target=""><img src="<?php echo base_url(); ?>assest/images/pop/tafe1.png" style="width:100px; height: 70px;" /><br/><br>
				<p id="tafe_p"><b id="tafe">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->lang_file->heading_fetch('tafe');?></b></a><img class="imgpop" data-id="tafe" src="<?php echo base_url();?>assest/images/pop/i_tag.png"/></p>
				</div>


				<div class="col-md-2" style="padding-top: 5px;">
					<a href="" target=""><img src="<?php echo base_url(); ?>assest/images/pop/hfn.png" style="width:142px; height: 86px;" /><br/><br>
				<p id="hfn_p"><b id="hfn"><?php echo $this->lang_file->heading_fetch('hfn');?></b></a><img class="imgpop" data-id="hfn" src="<?php echo base_url();?>assest/images/pop/i_tag.png"/></p>
				</div>

				<p>&nbsp;</p>
			</div>

			<div align="center" class="row">
				<p>&nbsp;</p>
				
				<div class="col-md-2" style="padding-top: 28px;"><a href="" target=""><img src="<?php echo base_url(); ?>assest/images/pop/mahindra_hzpc.png" style="width:100px; height: 70px;" /><br/><br>
				<p id="mahindrahzpc"><b><?php echo $this->lang_file->heading_fetch('mahindrahzpc'); ?></b></a><img class="imgpop" data-id="mahindrahzpc" src="<?php echo base_url();?>assest/images/pop/i_tag.png"/></p>
				</div>

				<div class="col-md-2" style="padding-top: 7px;">
					<a href="" target=""><img src="<?php echo base_url(); ?>assest/images/pop/kvss_logo.png" style="width:82px; height: 92px;"/><br/><br>
				<p id="pop_kvss"><b style="white-space: nowrap;padding-left: 38px;"><?php echo $this->lang_file->heading_fetch('pop_kvss'); ?></b></a><img class="imgpop" data-id="pop_kvss" src="<?php echo base_url();?>assest/images/pop/i_tag.png"/></p>
				</div>

				<div class="col-md-2" style="padding-top: 28px;"><a href="" target=""><img src="<?php echo base_url(); ?>assest/images/pop/agro.png" style="width:100px; height: 70px;" /><br/><br>
				<p id="new_pop_agrotech"><b style="white-space: nowrap;padding-left: 29px"><?php echo $this->lang_file->heading_fetch('new_pop_agrotech'); ?></b></a><img class="imgpop" data-id="new_pop_agrotech" src="<?php echo base_url();?>assest/images/pop/i_tag.png"/></p>
				</div>


				<div class="col-md-2" style="padding-top: 49px;"><a href="" target=""><img src="<?php echo base_url(); ?>assest/images/pop/absolute.png" style="width:94px; height: 49px;" /><br/><br>
				<p id="pop_absolute"><b style="white-space: nowrap;padding-left: 27px"><?php echo $this->lang_file->heading_fetch('pop_absolute'); ?></b></a><img class="imgpop" data-id="pop_absolute" src="<?php echo base_url();?>assest/images/pop/i_tag.png"/></p>
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
		<div class="modal fade" id="myModalbankdetail" style="
		    background-color: #fff;
		    margin:auto;
		    left: 0;
		    right: 0;
		    border-radius: 23px;border:2px solid #7b7a7a;">
		  	<div class="modal-header text-center">
		    	<a class="close" data-dismiss="modal">x</a>
		     	<h3><b id="modal_title"></b></h3>
		  	</div>
			<div class="modal-body">
				<p id="modal_details" style="font-size: 16px;"></p>
		  	</div>
		</div>

		<!-- Modal for NSC Info -->
			<div class="modal fade" id="modalForNSC" style="
			    background-color: #fff;
			    margin:auto;
			    left: 0;
			    right: 0;
			    border-radius: 23px;border:2px solid #7b7a7a;">
			  	<div class="modal-header text-center">
			    	<a class="close" data-dismiss="modal">x</a>
			     	<h3><b id="nsc_title"></b></h3>
			  	</div>
				<div class="modal-body">
					<p id="nsc_details" style="font-size: 16px;"></p><br>
					<p style="font-size: 14px;"><b id="nsc_subdetails1"> </b><span><a href="https://www.indiaseeds.com" target="_tblank" id="nsc_subdetails2"></b></a></span></p>
			  	</div>
			</div>
		<!-- Modal for NSC Info -->
	</div>
</div>
</div>

<script type="text/javascript">
	$('#backBtn').click(function(){
		parent.history.back();
	});

	$('.imgpop').click(function(){
		$("#modal_details").html("");
		let id = "desc_" + $(this).data("id");
		let platId = $(this).data("id");
		$('#modal_title').html($('#'+platId).text());
		$.ajax({
			url:"<?php echo base_url();?>/Enam_ctrl/getHeadingData",
			method:"POST",
			dataType: 'json',
			data:{id:id},
			success:function(response){
				let bodyData='';
				for(let data of response){
					bodyData += `${data.heading_item}`;
				}
				$('#modal_details').html(bodyData);
				$('#myModalbankdetail').modal('show');
			}
		})
	});

	$('.nsclogo').click(function(){
		$("#nsc_details").html("");
		let id = "desc_" + $(this).data("id");
		let platId = $(this).data("id");
		$('#nsc_title').html($('#'+platId).text());

		$.ajax({
			url:"<?php echo base_url();?>/Enam_ctrl/getHeadingData",
			method:"POST",
			dataType: 'json',
			data:{id:id},
			success:function(response){
				let bodyData='';
				for(let data of response){
					bodyData += `${data.heading_item}`;
				}

				let splitStrings = bodyData.split('-');	

				$('#nsc_details').html(splitStrings[0]);
				$('#nsc_subdetails1').html(splitStrings[1]);
				$('#nsc_subdetails2').html(splitStrings[2]);
				$('#modalForNSC').modal('show');
			}
		})
	});
</script>


