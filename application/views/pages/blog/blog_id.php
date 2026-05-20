
<style type="text/css">
	
/* Style the buttons inside the tab */
.tab button {
  background-color: #A3A9A5;
  /*//float: left;*/
  color: #FFFFFF;
  border: 1px solid;
  outline: none;
  cursor: pointer;
  padding: 6px 57px;
  transition: 0.3s;
  font-size: 14px;

}

/* Change background color of buttons on hover */
.tab button:hover {
  	background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #6D9520;
}

/* Style the tab content */
.tabcontent {
  	display: none;
  	padding: 6px 12px;
 	/* border: 1px solid #ccc;*/
  	border-top: none;
}

/* Style the close button */
.topright {
  	float: right;
  	cursor: pointer;
  	font-size: 28px;
}

.topright:hover {color: red;}

.s-story-list-blog img{height: 70px; width:90px;float:left;margin-right:5px;margin-bottom:10px;margin-bottom: 10px;border:1px solid #ddd;}
.s-story-list-box-blog h4{color: #4f801f;    font-weight: 25;    margin-top: 0;    line-height: 10px;}
.s-story-list-box-blog{;margin-bottom:10px;}  /*padding-bottom:20px*/
.s-story-list-box-blog p{float:none !important;}
.blogs{background-color: #c8dda7;}
h6{color: #6D9520;}


</style>

<div class="container-fuild" style="float:left;width:100%;background-color:#eee;padding:10px 0% 12px 0%;">
	<div class="container"><?php //print_r($slider); ?></div>
</div>
 
<div class="container-fuild content-section" style="padding-top:15px;float:left;width:100%;padding-bottom:15px;">
	<div class="container">
		<div class="col-md-12 bc-nav" ><a href="<?php echo base_url(); ?>" title=""><?php echo $this->lang_file->heading_fetch('home');?></a>&nbsp;<i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>&nbsp;
		<a><?php echo $this->lang_file->heading_fetch('enam_blog'); ?></a></div>
		<div class="col-sm-12 content-12 h-space-padd-r">

			<h3 class="p-title"><span><?php echo $this->lang_file->heading_fetch('enam_blog'); ?><p class="t-stake-data"></p></span></h3>

				<?php if(isset($blogs_data) && (count($blogs_data) > 0)){

					foreach($blogs_data as $blogs) { 
						//print_r($blogs);
						?>
						<div class="col-md-12 s-story-list" id="div_<?php echo $blogs->b_id;?>">
							<div class="row">
								
								<div class="col-md-12 s-story-list-box"><img class="blog-img" data-id = '<?php echo $blogs->b_id;?>' alt="" src="<?php echo base_url().'assest/images/blogs/'.$blogs->blog_image; ?>"/>
								<!-- <h5><b><?php echo $blogs->state_apmc; ?></b></h5> -->
								<h4><?php echo strip_tags($blogs->title);?></h4>
								<?php $id = $blogs->bi_id;?>
								
								<div id="tag_<?php echo $id;?>"> 
									
								
									<p><?php echo $blogs->blog_content?></p>
								</div>
								<br>
								<div class="col-md-12">
									<small><i class="fa fa-clock-o"></i> <?php echo $blogs->creatingd_at; ?></small>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<small><?php echo $this->lang_file->heading_fetch('blog_publisher'); ?> : <?php echo $blogs->publisher; ?></small>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<small><?php echo $this->lang_file->heading_fetch('no_of_views');?> : <small id='userclick_<?php echo $blogs->bi_id;?>'><?php echo $blogs->user_click;?></small></small>
								</div>
								</div>

							</div>
						</div>

				<?php } }?>
			
		</div>			

		
	</div>

	
</div>
</div>










