<style type="text/css">
	#bijak_p, #intello_p, #fpo_p{
		text-align: center;
	}

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
</style>

<div class="container-fuild" style="float:left;width:100%;background-color:#eee;padding:10px 0% 12px 0%;">
	<div class="container"><?php print_r($slider); ?></div>
</div>
 
<div class="container-fuild content-section" style="padding-top:15px;float:left;width:100%;padding-bottom:15px;">
	<div class="container">
		<div class="col-md-12 bc-nav" >
			<a href="<?php echo base_url(); ?>" title=""><?php echo $this->lang_file->heading_fetch('home');?></a>&nbsp;<i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>&nbsp;
			<a href="<?php echo base_url(); ?>pop-dashboard"><?php echo $this->lang_file->heading_fetch('pop_dashboard');?> </a><i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>&nbsp;
			<a href="<?php echo base_url(); ?>pop-dashboard/trading-platforms"><?php echo $this->lang_file->heading_fetch('trading_platform');?></a>

		</div>
		<div class="col-sm-9 content-9 h-space-padd-r">
			<?php //print_r($headingdata); ?>
			<h3 class="p-title"><span><?php echo $this->lang_file->heading_fetch('trading_platform');?><p class="t-stake-data"><a id="backBtn"><b><?php echo $this->lang_file->heading_fetch('back');?></b>  <img src="<?php echo base_url(); ?>assest/images/pop/back-arrow.png" style="width: 20px;"></a></p></span></h3>
			<div align="center" class="row">
				<p>&nbsp;</p>

				<div class="col-md-2" style="padding-top: 0px;"><a href="" target=""><img src="<?php echo base_url();?>/assest/images/pop/Star Agribazaar.jpg" style="width:108px; height: 91px;" />
				<b id="star_agri"><?php echo $this->lang_file->heading_fetch('star_agri');?></b></a><img src="<?php echo base_url();?>assest/images/pop/i_tag.png" class="imgpop" data-id="star_agri"/>
				</div>

				<div class="col-md-2" style="padding-top: 17px;"><a href="" target=""><img src="<?php echo base_url(); ?>assest/images/pop/Bijak logo.png" style="width:118px; height: 90px;" />
				<p id="bijak_p"><b id="bijak"><?php echo $this->lang_file->heading_fetch('bijak');?></b></a>&nbsp;<img class="imgpop" data-id="bijak" src="<?php echo base_url();?>assest/images/pop/i_tag.png"/></p>
				</div>

				<div class="col-md-2" style="padding-top: 36px"><a href="" target=""><img src="<?php echo base_url(); ?>/assest/images/pop/IDS Kisan Network.png" style="width:135px; height: 53px;" /><br/><br>
				<b id="ids"><?php echo $this->lang_file->heading_fetch('ids');?></b></a><img src="<?php echo base_url();?>assest/images/pop/i_tag.png" class="imgpop" data-id="ids"/>
				</div>

				<div class="col-md-2" style="padding-top: 27px;"><a href="" target=""><img src="<?php echo base_url();?>/assest/images/pop/Mark agri logo.png" style="width:80px; height: 65px;" /><br /><br>
				<b id="mark_agri"><?php echo $this->lang_file->heading_fetch('mark_agri');?></b></a><img src="<?php echo base_url();?>assest/images/pop/i_tag.png" class="imgpop" data-id="mark_agri"/>
				</div>

				<div class="col-md-2" style="padding-top: 22px;"><a href="" target=""><img src="<?php echo base_url();?>/assest/images/pop/Apna Gudam.png" style="width:100px; height: 70px;" /><br /><br>
				<b id="apna_godown"><?php echo $this->lang_file->heading_fetch('apna_godown');?></b></a>&nbsp;<img src="<?php echo base_url();?>assest/images/pop/i_tag.png" class="imgpop" data-id="apna_godown"/>
				</div>

				<div class="col-md-2" style="padding-top: 3px;"><a 
					href="" target=""><img src="<?php echo base_url(); ?>assest/images/pop/E-Tech.jpeg" style="width:100px; height: 70px;" /><br/><br>
				<p id="fpo_p"><b id="etech_pop"><?php echo $this->lang_file->heading_fetch('etech_pop');?></b></a><img class="imgpop" data-id="etech_pop" src="<?php echo base_url();?>assest/images/pop/i_tag.png"/></p>
				</div>		
				<p>&nbsp;</p>
			</div>
			

			<div align="center" class="row">
				<p>&nbsp;</p>

				<div class="col-md-2" style="padding-top: 13px;"><a href="" target=""><img src="<?php echo base_url(); ?>assest/images/pop/FPO Bazaar.png" style="width:100px; height: 70px;" /><br/><br>
				<p id="fpo_p" style="text-align: center;"><b id="fpo"><?php echo $this->lang_file->heading_fetch('fpo');?></b></a><img class="imgpop" data-id="fpo" src="<?php echo base_url();?>assest/images/pop/i_tag.png"/></p>
				</div>

				<div class="col-md-2" style="padding-top: 16px;"><a href="" target=""><img src="<?php echo base_url();?>/assest/images/pop/Intello labs.jpg" style="width:108px; height: 91px;" />
				<b id="intello"><?php echo $this->lang_file->heading_fetch('intello');?></b></a><img src="<?php echo base_url();?>assest/images/pop/i_tag.png" class="imgpop" data-id="intello"/>
				</div>
				
				<div class="col-md-2" style="padding-top: 36px"><a href="" target=""><img src="<?php echo base_url(); ?>/assest/images/pop/Subham Logistics4.png" style="width:135px; height: 53px;" /><br/><br>
				<b id="shubham_logistics"><?php echo $this->lang_file->heading_fetch('shubham_logistics');?></b></a><img src="<?php echo base_url();?>assest/images/pop/i_tag.png" class="imgpop" data-id="shubham_logistics"/>
				</div>

				<div class="col-md-2" style="padding-top: 45px;"><a href="" target=""><img src="<?php echo base_url(); ?>assest/images/pop/samunnati.jpg" style="width:106px; height: 44px;" /><br/><br>
				<p id="samunnati" style="text-align: center;"><b id="fpo"><?php echo $this->lang_file->heading_fetch('samunnati');?></b></a><img class="imgpop" data-id="samunnati" src="<?php echo base_url();?>assest/images/pop/i_tag.png"/></p>
				</div>


				<div class="col-md-2" style="padding-top: 43px;">
					<a href="" target=""><img src="<?php echo base_url(); ?>assest/images/pop/bighaat.png" style="width:115px; height: 46px;"/><br/><br>
				<p id="bighaat"><b style="white-space: nowrap;padding-left: 38px;"><?php echo $this->lang_file->heading_fetch('bighaat'); ?></b></a><img class="imgpop" data-id="bighaat" src="<?php echo base_url();?>assest/images/pop/i_tag.png"/></p>
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
					console.log(response);
					bodyData += `${data.heading_item}`;
				}
				$('#modal_details').html(bodyData);
				$('#myModalbankdetail').modal('show');
			}
		})
	});



</script>


