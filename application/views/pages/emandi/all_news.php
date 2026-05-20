<style>
.form-t-title{width:100%; background:#F5f5f5; text-align:left; padding:10px; margin:20px auto; font-weight:bold;}
</style>
 
<div class="container-fuild" style="float:left;width:100%;background-color:#eee;padding:10px 4% 12px 4%;">
	<?php print_r($slider); ?>
</div>
 

<div class="container-fuild content-section " style="padding-left:4%;padding-right:4%;padding-top:10px;float:left;width:100%;">
<div class="col-md-12 bc-nav"><a href="<?php echo base_url(); ?>" title="">Home</a>&nbsp;<i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>&nbsp; What's New&nbsp;<i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>&nbsp;  News Archive</div>
<div class="col-sm-9 content-9" style="padding-left:0;">

<h3 style="margin-top:0px;" class="p-title"><span>All News</span></h3>
<?php if(isset($newses) && count($newses) > 0 ){
                                        echo '<section class="content-section"><ul style="padding-left:0px;" class="b-line col-md-12">';
					    foreach ($newses as $news){
						echo '<li>' .$news['news_contect'].'</li>';
					  }
                                        echo '</ul></section>';
           
				} ?>
</div>
<div class="col-sm-3 content-3" style="padding-right:0;">
<div class="focus-section">
  <div class="sidebar-header-title"><span><?php echo $this->lang_file->heading_fetch('enam_coverage'); ?></span></div>
   <div class="home-ind-map">
     <a href="javascript:void(0);"><img src="<?php echo base_url();?>/assest/images/new-theme/map.jpg" usemap="#image-map" 
     class="state_district"></a>
   </div>
  </div>
</div>
</div>
</div>
