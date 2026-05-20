<section class="title-header-bg-apmc"></section>

<div class="container-fuild" style="padding-top:10px;float:left;width:100%;">
<div class="container">
	<div class="col-md-12 bc-nav"><a href="<?php echo base_url(); ?>" title=""><?php echo $this->lang_file->heading_fetch('home');?></a>&nbsp;<i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>&nbsp;<a href="<?php echo base_url(); ?>elearning-videos"><?php echo $this->lang_file->heading_fetch('video_elearning');?></a>&nbsp;<i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>&nbsp;
	<?php if($this->uri->segment(2) == ''){ ?>
		all videos
	<?php } else {
				if(urldecode($this->uri->segment(2)) == 'Others Video'){ ?>
					<span><?php echo $this->lang_file->heading_fetch('video_other');?></span>
				<?php }
				if(urldecode($this->uri->segment(2)) == 'states'){ ?>
								<span><?php echo $this->lang_file->heading_fetch('state');?></span>
				<?php }
				if(urldecode($this->uri->segment(2)) == 'English Video'){ ?>
								<span>English Video</span>
				<?php }
				if(urldecode($this->uri->segment(2)) == 'Hindi Video'){ ?>
								<span>Hindi Video</span>
				<?php }
				if(urldecode($this->uri->segment(2)) == 'Gujarati Video'){ ?>
								<span>Gujarati Video</span>
				<?php }
				if(urldecode($this->uri->segment(2)) == 'Telugu Video'){ ?>
								<span>Telugu Video</span>
				<?php }
				if(urldecode($this->uri->segment(2)) == 'Marathi Video'){ ?>
								<span>Marathi Video</span>
				<?php }
				if(urldecode($this->uri->segment(2)) == 'Bengali Video'){ ?>
								<span>Bengali Video</span>
				<?php }
				if(urldecode($this->uri->segment(2)) == 'Tamil Video'){ ?>
								<span>Tamil Video</span>
				<?php }
				if(urldecode($this->uri->segment(2)) == 'Oriya Video'){ ?>
								<span>Odia Video</span>
				<?php }
				if(urldecode($this->uri->segment(2)) == 'Punjabi Video'){ ?>
								<span>Punjabi Video</span>
				<?php }
				if(urldecode($this->uri->segment(2)) == 'Malayalam Video'){ ?>
								<span>Malayalam Video</span>
				<?php }
				if(urldecode($this->uri->segment(2)) == 'Kannada Video'){ ?>
								<span>Kannada Video</span>
				<?php }
				if(urldecode($this->uri->segment(2)) == 'Dogri Video'){ ?>
								<span>Dogri Video</span>
				<?php } else{ 
					
				if(ucwords(urldecode($this->uri->segment(2))) == 'ENAM Process') { ?>
					<span><?php echo $this->lang_file->heading_fetch('video_process');?></span>
				<?php } else { ?>
					<!-- <span><?php //echo $this->lang_file->heading_fetch('state');?></span> -->
				<?php } ?>
				
		  <?php } } ?>
	</div>

<section class="content-section">
	
<div class="row">
			<div class="col-md-12 video-gallery">
				<h3 style="margin-bottom:15px;margin-top:0px;" class="p-title">
					<?php if($this->uri->segment(2) == ''){	 ?>
						<span>All Videos</span>
					<?php } else {
								if(urldecode($this->uri->segment(2)) == 'Others Video'){ ?>
									<span><?php echo $this->lang_file->heading_fetch('video_other');?></span>
								<?php }
								if(urldecode($this->uri->segment(2)) == 'states'){ ?>
												<span><?php echo $this->lang_file->heading_fetch('state');?> <?php echo $this->lang_file->heading_fetch('video');?></span>
								<?php }
								if(urldecode($this->uri->segment(2)) == 'English Video'){ ?>
												<span>English Video</span>
								<?php }
								if(urldecode($this->uri->segment(2)) == 'Hindi Video'){ ?>
												<span>Hindi Video</span>
								<?php }
								if(urldecode($this->uri->segment(2)) == 'Gujarati Video'){ ?>
												<span>Gujarati Video</span>
								<?php }
								if(urldecode($this->uri->segment(2)) == 'Telugu Video'){ ?>
									   			<span>Telugu Video</span>
								<?php } 
								if(urldecode($this->uri->segment(2)) == 'Marathi Video'){ ?>
									   			<span>Marathi Video</span>
								<?php } 
								if(urldecode($this->uri->segment(2)) == 'Bengali Video'){ ?>
									   			<span>Bengali Video</span>
								<?php } 
								if(urldecode($this->uri->segment(2)) == 'Tamil Video'){ ?>
									   			<span>Tamil Video</span>
								<?php } 
								if(urldecode($this->uri->segment(2)) == 'Oriya Video'){ ?>
									   			<span>Odia Video</span>
								<?php } 
								if(urldecode($this->uri->segment(2)) == 'Punjabi Video'){ ?>
									   			<span>Punjabi Video</span>
								<?php } 
								if(urldecode($this->uri->segment(2)) == 'Malayalam Video'){ ?>
									   			<span>Malayalam Video</span>
								<?php } 
								if(urldecode($this->uri->segment(2)) == 'Kannada Video'){ ?>
									   			<span>Kannada Video</span>
								<?php } 
								if(urldecode($this->uri->segment(2)) == 'Dogri Video'){ ?>
									   			<span>Dogri Video</span>
								<?php } else{ 
								if(ucwords(urldecode($this->uri->segment(2))) == 'ENAM Process') { ?>
									<span><?php echo $this->lang_file->heading_fetch('video_process');?></span>
								<?php } else {?>
									<!-- <span><?php //echo $this->lang_file->heading_fetch('state');?> <?php //echo $this->lang_file->heading_fetch('video');?></span> -->
								<?php } ?>
					      <?php } } ?>
				</h3>
			</div>
						
			<div class="col-md-12" id="video_lists">
<div class="row">
			<?php if(isset($videos) && count($videos)>0){?>
				<?php $c = 1; foreach($videos as $video){ ?>
				<div class="col-md-3 video-gd-view">
					<div class="row elearn-v-box" style="min-height:255px;">
<div class="e-v-list">						
<div class="col-md-12" style="padding:0px;">
							<div class="thum"><?php $v = explode('/embed/',$video['v_url']); ?>
								<div class="v-g-imag"  data-video_id="<?php echo $video['video_id']; ?>" style="background:url('http://img.youtube.com/vi/<?php echo $v[1];?>/0.jpg') center no-repeat;"></div>
								<a href="<?php echo base_url();?>elearning/id/<?php echo $video['video_id'];?>">
								<img alt="" style="width:64px;"class="play-img-gallery" src="<?php echo base_url();?>assest/images/new-theme/icon/play-ico.png" />
								</a>
								<div id="iframe_v_<?php echo $c;?>" style="display:none;"></div>
							</div>
						</div>
						<div class="col-md-12 video-g-details" style="padding-left:0px;padding-right:0px;">
							<div style="background-color:#efefef;padding:0 8px;float:left;width:100%;border:1px solid #e2e2e2;"><h5><b><?php echo $video['v_title']; ?></b></h5>
							<p><?php if($video['views']!=0){ echo $video['views']; ?> Views - <?php } echo $video['created_at']; ?></p></div>
						</div>
</div>
					</div>
				</div>
			<?php $c++; } ?>
			<?php } else{ ?>
				<div class="col-md-12"><?php echo $this->lang_file->heading_fetch('video_notfound');?></div>
			<?php } ?>
			</div>
</div>
		</div>

</section>
</div></div>
<?php 
$c = 1;
		$url_array ='';
		while($this->uri->segment($c) != ''){
			$url_array.= $this->uri->segment($c).'/';
			$c = $c + 1;
		}
		$url_array = strtolower(rtrim($url_array,"/ "));
		?>

<script>
var baseUrl = $('#base_url').val();
$.ajax({
	type: 'post',
	url: baseUrl+'Ajax_ctrl/menu_activate/<?php echo $url_array;?>',
	dataType: "json",
	data:{},
	beforeSend: function(){},
	complete: function(){},
	success: function (response){
		if(response.status == 200){
			console.log(response);
			if (typeof response.data[0].id !== 'undefined') {
				$('#menuid_'+response.data[0].id).addClass('active');	
			}
			if (typeof response.data[0].p_id !== 'undefined') {
				$('#menuid_'+response.data[0].p_id).addClass('active');
			}
		    $('#bredcrum').html(response.bredcrum);	
		}
        else{
			$('#bredcrum').html(response.bredcrum);	
		}
	}
});
</script>