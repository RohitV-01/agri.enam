<div class="container-fuild" style="float:left;width:100%;background-color:#eee;padding:10px 0% 12px 0%;">
	<div class="container"><?php print_r($slider); ?></div>
</div>

<div class="container-fuild content-section" style="padding-top:15px;float:left;width:100%;padding-bottom:15px;">
	<div class="container">
		<div class="col-md-12 bc-nav" ><a href="<?php echo base_url(); ?>" title=""><?php echo $this->lang_file->heading_fetch('home');?></a>&nbsp;<i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>&nbsp;
		<a href="<?php echo base_url(); ?>success-stories">Success Stories</a>&nbsp;<i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>&nbsp;<a href="javascript:void(0)">Payment/Weighment</a></div>
		<div class="col-sm-9 content-9 h-space-padd-r">

			<h3 class="p-title"><span>Payment/Weighment<p class="t-stake-data"></p></span></h3>
			<div class="row">
				
				<?php if(isset($awards) && (count($awards) > 0)){

					foreach($awards as $award) {  ?>
						<div class="col-md-12 s-story-list" id="div_<?php echo $award->si_id;?>">
							<div class="row">
								<div class="col-md-12 s-story-list-box">
									<img class="blog-img" data-id = '<?php echo $award->si_id;?>' alt="" src="<?php echo base_url().'assest/images/s-story/'.$award->story_image; ?>"/>
								
									<h4><?php echo strip_tags($award->title);?></h4>
									<?php $id = $award->si_id;?>

									<div id="tag_<?php echo $id;?>"> 
										<p><?php echo substr($award->success_content, 0,150) ."<a class='read1' data-toggle='collapse' data-id='$id' href='#full_$id'>Read More</a>"?></p>
									</div>
									
									<div class="collapse" id="full_<?php echo $award->si_id;?>" data-toggle="collapse">
										<p><?php echo $award->success_content."<a data-toggle='collapse' class='less1' data-id='$id' href='#$id' style='float:right'>show less</a>"?></p>
										
									</div><br><br>
								</div>
							</div>
						</div>

				<?php } }?>
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
	$('.read1').on('click', function(){
		let id = $(this).data("id");
		$('#tag_'+id).hide();
		$('#full_'+id).show();
	});

	$('.less1').on('click', function(){
		let id = $(this).data("id");
		$('#tag_'+id).show();
		$('#full_'+id).hide();
	});
</script>

