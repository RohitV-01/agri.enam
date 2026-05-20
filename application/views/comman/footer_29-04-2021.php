<div id="ak-top"><i class="fa fa-angle-up"></i>top</div>

<footer>
<div class="footer-section wow fadeInUp" data-wow-delay="0.3s">
	<div class="container ">
		<div class="row">
			<ul class="footer-site-links list-unstyle list-inline text-center">
				<li><a target="_blank" href="https://www.sfacindia.com/"><img alt="" src="<?php echo base_url(); ?>assest/images/footer/img1.jpg"/></a></li>
				<li><a target="_blank" href="https://india.gov.in/"><img alt="" src="<?php echo base_url(); ?>assest/images/footer/img2.jpg"/></a></li>
				<li><a target="_blank" href="https://digitizeindia.gov.in/"><img alt="" src="<?php echo base_url(); ?>assest/images/footer/img3.jpg"/></a></li>
				<li><a target="_blank" href="https://data.gov.in/"><img alt="" src="<?php echo base_url(); ?>assest/images/footer/img4.jpg"/></a></li>
				<li><a target="_blank" href="https://meity.gov.in/"><img alt="" src="<?php echo base_url(); ?>assest/images/footer/img5.jpg"/></a></li>
				<li><a target="_blank" href="https://pmindia.gov.in/"><img alt="" src="<?php echo base_url(); ?>assest/images/footer/img6.jpg"/></a></li>
				<li><a target="_blank" href="http://www.nagarjunafertilizers.com/"><img alt="" src="<?php echo base_url(); ?>assest/images/footer/img7.png"/></a></li>
<li><a target="_blank" href="https://digipay.gov.in/dashboard/Default.aspx"><img alt="" src="<?php echo base_url(); ?>assest/images/footer/img8.png"/></a></li>
			</ul>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="align-center footer-text-msg">Department of Agriculture, Cooperation & Farmers' Welfare, Ministry of Agriculture and Farmers' Welfare, Government of India</div>
		</div>
<div class="text-center" style="color: #fff;margin-bottom:5px;">Visitors Count: <span id="visitors_count" >0</span>   |  <a href="<?php echo base_url(); ?>Privacy-Policy" target="_blank" style="color: white">Privacy Policy</a></div>

	<div class="align-center footer-text-msg"><b><?php echo $this->lang_file->heading_fetch('copyright');?></b></div>

	</div>

<div class="modal fade" id="loader" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" style="width:70px;top:40%">
    <div class="modal-content" style="border-radius:10px;">
      <div class="modal-body">
		<img style="width:40px;" alt="" src="<?php echo base_url(); ?>/assest/images/gif-load.gif" />
      </div>
      
    </div>
  </div>
</div>



<div class="modal" id="Wheat_gram" role="dialog" tabindex="-1">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header commodity-list-h">
<img id="commodity_title_image" style="float:left;margin-right:20px;" alt="" src="" /> 
<h4 class="modal-title"><span class="commo-p">Commodity Parameter - </span><span id="commodity_name"></span><br/><span id="commodity_title"></span></h4>
<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button></div>

<div id="commodity_desc" class="modal-body"></div>
</div>
</div>
</div>



<script type="text/javascript">
$('#ak-top').hide();
    $(window).scroll(function(){
      if($(this).scrollTop() > 300){
        $('#ak-top').fadeIn();
      }else{
        $('#ak-top').fadeOut();
      }
    });
  
    $("#ak-top").click(function(){
      $('html,body').animate({scrollTop:0},600);
    });
</script>
</div>
</footer>