<div class="quick-links-btn-sec pull-left"> 
<?php print_r($quickLinks); ?>
</div>


<div id="myCarousel" class="carousel slide head-slider pull-left" data-ride="carousel">
    <!-- Wrapper for slides -->
       <div class="carousel-inner">
	<?php 
	$c = 1;
	if($this->session->userdata('client_language') != ''){
		$language = $this->session->userdata('client_language');
	}
	else{
		$language = 1;
	}
	
	$c = 1;
	foreach ($sliders as $slider){ ?>
		<div class="item <?php if($c== 1){ echo "active";} ?>">
			<img src="<?php echo base_url(); ?>Slider_gallary/<?php echo $slider['lang_id']; ?>/<?php echo $slider['slider_image'];?>" alt="img1" />
		</div>
		<?php $c++;} ?>
    </div>

    <!-- Left and right controls -->
<a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <img alt="Left" src="<?php echo base_url(); ?>assest/images/slider/large_left.png" />
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
     <img alt="right" src="<?php echo base_url(); ?>assest/images/slider/large_right.png" />
    </a>
</div>

<script type="text/javascript">
	$('#myCarousel').carousel({
	  interval: 200000
	});
</script>

<div class="latest-news">
		<div class="sidebar-header-title" style="font-size:14px;"><span class="e-text-news"><?php echo $this->lang_file->heading_fetch('whats_new');?></span></div>
		<div  class="focus-news">		
			<marquee onMouseOut="start();" onMouseOver="stop();" direction="up" scrollamount="2">
				<?php if(count($newses)>0){ ?>
				<?php foreach($newses as $news) { 
					$str = html_entity_decode($news['news_contect']);
						
					$regex = "/\[(.*?)\]/";
					$data['output'] = $str;
					preg_match_all($regex, $str, $matches);
					for($i =0; $i < count($matches[1]); $i++){
						$news['news_contect'] = str_replace($matches[0][$i],$this->substring->image_path(),$news['news_contect']);
					}
					if($news['lang_id'] == $this->session->userdata['client_language']){
						if(strlen( $news['news_contect']>100)){ ?>
						<div class="focus-news-feilds">
							<?php echo substr($news['news_contect'],0,100).".."; ?>
					<?php } else{ ?>	
						<div class="focus-news-feilds">
						<?php  echo $news['news_contect'];
						}
					} else {
					    if(strlen( $news['news_contect']>100)){ ?>
						<div class="focus-news-feilds">
							<?php echo substr($news['news_contect'],0,100).".."; ?>
					<?php } else{ ?>	
						<div class="focus-news-feilds">
						<?php  echo $news['news_contect'];
						}
					}
					?>
					</div>
				<?php } ?>
			<?php } else { ?>
				no news.
			<?php } ?>
			</marquee>
		</div>

           <div class="news-achive">
			<a title="News Archive" style="color:#000;" href = "<?php echo base_url();?>all_news_desc"><?php echo $this->lang_file->heading_fetch('news_archive');?> <i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i></a> 
		</div>     

	</div>

	