
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

.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 3%; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
	top:-10%;
}

/* Caption of Modal Image */
#caption {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
    text-align: center;
    color: #ccc;
    padding: 10px 0;
    height: 150px;
}

/* Add Animation */
.modal-content, #caption {    
    -webkit-animation-name: zoom;
    -webkit-animation-duration: 0.6s;
    animation-name: zoom;
    animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
    from {-webkit-transform:scale(0)} 
    to {-webkit-transform:scale(1)}
}

@keyframes zoom {
    from {transform:scale(0)} 
    to {transform:scale(1)}
}

/* The Close Button */
.close {
    position: absolute;
    top: 15px;
    right: 35px;
    color: #f1f1f1;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
}

.close:hover,
.close:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
    .modal-content {
        width: 100%;
    }
}
</style>

<div class="container-fuild" style="float:left;width:100%;background-color:#eee;padding:10px 0% 12px 0%;">
	<div class="container"><?php //print_r($slider); ?></div>
</div>
 
<div class="container-fuild content-section" style="padding-top:15px;float:left;width:100%;padding-bottom:15px;">
	<div class="container">
		<div class="col-md-12 bc-nav" ><a href="<?php echo base_url(); ?>" title=""><?php echo $this->lang_file->heading_fetch('home');?></a>&nbsp;<i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>&nbsp;
		<a><?php echo $this->lang_file->heading_fetch('enam_blog'); ?></a></div>
		<div class="col-sm-8 content-8 h-space-padd-r">

			<h3 class="p-title"><span><?php echo $this->lang_file->heading_fetch('enam_blog'); ?><p class="t-stake-data"></p></span></h3>

				<?php if(isset($blog_data) && (count($blog_data) > 0)){

					foreach($blog_data as $blogs) { 
						//print_r($blogs);
						?>
						<div class="col-md-12 s-story-list" id="div_<?php echo $blogs->b_id;?>">
							<div class="row">
								
								<div class="col-md-12 s-story-list-box"><img class="blog-img" data-id = '<?php echo $blogs->b_id;?>' alt="" src="<?php echo base_url().'assest/images/blogs/'.$blogs->blog_image; ?>"/>
								<!-- <h5><b><?php echo $blogs->state_apmc; ?></b></h5> -->
								<h4><?php echo strip_tags($blogs->title);?></h4>
								<?php $id = $blogs->bi_id;?>
								
								<div id="tag_<?php echo $id;?>"> 
									
								
									<p><?php echo substr($blogs->blog_content, 0,150) ."<a data-toggle='collapse' class='read1' data-id='$id' href='http://localhost/enam_audit/Enam_ctrl/enam_blog/" . $id . "'>Read More</a>"?></p>
								</div>
								<input type="hidden" id="hidden_<?php echo $id;?>" value="<?php echo $blogs->user_click; ?>">

								<div class="collapse" id="full_<?php echo $blogs->bi_id;?>">
									<p><?php echo $blogs->blog_content."<a data-toggle='collapse' class='less1' data-id='$id' href='#$id' style='float:right'>show less</a>"?></p>
									
								</div><br>
								

								<div class="col-md-12">
									<small><i class="fa fa-clock-o"></i> <?php echo $blogs->creatingd_at; ?></small>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<small><?php echo $this->lang_file->heading_fetch('blog_publisher'); ?> : <?php echo $blogs->publisher; ?></small>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<small><?php echo $this->lang_file->heading_fetch('no_of_views'); ?> : <small id='userclick_<?php echo $blogs->bi_id;?>'><?php echo $blogs->user_click;?></small></small>
								</div>
								
								</div>



							</div>

						</div>

				<?php } }?>
			
		</div>			

		<div class="col-sm-4 content-4 h-space-padd-r-l blogs">
			<div class="focus-section">
				<div class="tab">
				  	<button class="tablinks active" onclick="openCity(event, 'London')"><?php echo $this->lang_file->heading_fetch('most_recent'); ?></button>
				  	<button class="tablinks" onclick="openCity(event, 'Paris')"><?php echo $this->lang_file->heading_fetch('most_read'); ?></button>
					 
					<div id="London" class="tabcontent">
						<?php if(isset($recent_news) && (count($recent_news) > 0)){
							//print_r($recent_news);
						foreach($recent_news as $recent) { 
						?>
						<?php $iid = $recent['b_id'];?>
						<div class="col-md-12 s-story-list-blog">
							<div class="row">
								<div class="col-md-12 s-story-list-box-blog"><img alt="" src="<?php echo base_url().'assest/images/blogs/'.$recent['blog_image']; ?>"/>
									
								<a class='link1' data-id='<?php echo $iid;?>' href='#div_<?php echo $iid;?>'><h6 style="text-align: justify;"><b><?php echo strip_tags($recent['title']);?></b></h6></a>


								<p><small><i class="fa fa-clock-o"></i> <?php echo $recent['created_at'];?></small>&nbsp;&nbsp;&nbsp;&nbsp;<small><?php echo $this->lang_file->heading_fetch('no_of_views');?> : <small id='recentclick_<?php echo $recent['b_id'];?>'><?php echo $recent['user_click'];?></small></small></p><p><small><?php echo $this->lang_file->heading_fetch('blog_publisher');?>: <?php echo $recent['publisher']; ?></small></p>

								
								</div>
							</div>

						</div>
						<?php } }?>
					</div>

					<div id="Paris" class="tabcontent">
					 
					  	<?php if(isset($most_read) && (count($most_read) > 0)){

						foreach($most_read as $most) { 
						//print_r($most);
							$idd = $most['b_id'];
						?>
						<div class="col-md-12 s-story-list-blog">
							<div class="row">
								<div class="col-md-12 s-story-list-box-blog"><img alt="" src="<?php echo base_url().'assest/images/blogs/'.$most['blog_image']; ?>"/>
									
								<a class='most1' data-id='<?php echo $idd;?>' href='#div_<?php echo $idd;?>'><h6 style="text-align: justify;"><b><?php echo strip_tags($most['title']);?></b></h6></a>

								<p><small><i class="fa fa-clock-o"></i> <?php echo $most['created_at'];?></small>&nbsp;&nbsp;&nbsp;&nbsp;<small><?php echo $this->lang_file->heading_fetch('no_of_views');?> : <small id='userno_<?php echo $most['b_id'];?>'><?php echo $most['user_click'];?></small></small></p><p><small><?php echo $this->lang_file->heading_fetch('blog_publisher'); ?> : <?php echo $most['publisher']; ?></small></p>
					

								</div>
							</div>

						</div>
						<?php } }?> 
					</div>
				</div>
			</div>
		</div>
	</div>

	<input type="hidden" id="base_urll" value="<?php echo base_url();?>">
	<input type="hidden" id="img_urll">
	<div class="modal fade" id="event_instance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  	<div class="modal-dialog" role="document">
			<div class="modal-content">
		 	 	<div class="modal-body">
					<button style="position:absolute;top:0px;right:0;" type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i></button>
					<a style="position:absolute;top:0px;left:505px;" type="button" class="btn btn-secondary imgdwld" href="#" download><i class="fa fa-download"></i></a>
					<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
					  	<!-- Wrapper for slides -->
					 	<div class="carousel-inner" role="listbox">
							<div class="item active" style="margin-top:15px;" class="img_producto_container">
							
								<div id="modal_image" class="img_producto"></div>

							</div>
					  	</div>
					</div>
		  		</div>
			  	<div class="modal-footer">
		        	<div id="modal_content" style="text-align: left;"></div>
		      	</div>
			</div>
	  	</div>
	</div>
</div>
</div>

<script>

	$(document).ready(function(){
		$('#London').show();

	});

	$('.read1').on('click', function(){
		let id = $(this).data("id");
		
		$('#tag_'+id).hide();
		$('#full_'+id).show();

		$.ajax({
			url:"<?php echo base_url();?>Enam_ctrl/updatecount",
			method: 'POST',
			dataType: 'json',
			data:{id:id},
			success:function(response){
				console.log('----->>>', response);
				$.each(response, function(key, value) {
					$('#userno_'+id).html(value.user_click);
					$('#userclick_'+id).html(value.user_click);
					$('#recentclick_'+id).html(value.user_click);

				});
			}
		})
	});


	$(".read1").contextmenu(function(e){
		let id = $(this).data("id");
	 	$.ajax({
			url:"<?php echo base_url();?>Enam_ctrl/updatecount",
			method: 'POST',
			dataType: 'json',
			data:{id:id},
			success:function(response){
				console.log('----->>>', response);
				$.each(response, function(key, value) {

					$('#userno_'+id).html(value.user_click);
					$('#userclick_'+id).html(value.user_click);
					$('#recentclick_'+id).html(value.user_click);
				});
			}
		})
	 	
	});


	$('.less1').on('click', function(){
		let id = $(this).data("id");
	
		$('#tag_'+id).show();
		$('#full_'+id).hide();
	});



	$('.link1').bind('click', function(){
		let id = $(this).data("id");
		if ($('#tag_'+id).css('display') == 'none') {
    		$('#full_'+id).show();
		}else{
			$('#tag_'+id).hide();
			$('#full_'+id).show();
		}
	});

	$('.most1').on('click', function(){
		let id = $(this).data("id");
		if ($('#tag_'+id).css('display') == 'none') {
    		$('#full_'+id).show();
		}else{
			$('#tag_'+id).hide();
			$('#full_'+id).show();
		}
	});

	$(".most1").contextmenu(function(e){
		let id = $(this).data("id");
	 	console.log('contextmenu fired changing adding  href', id);
     	$(this).attr(`href`,`<?php echo base_url()?>Enam_ctrl/enam_blog/${id}`);
	});


	$('.blog-img').on('click', function(){
		let blogId = $(this).data('id');
		let base_url = $('#base_urll').val();
		$.ajax({
			url: "<?php echo base_url();?>Enam_ctrl/getimg",
			method: "POST",
			dataType: 'json',
			data:{blogId : blogId},
			success:function(response){
				if(response.status == 200){
				  	$.each(response.data, function(k, v) {
				  		console.log(v.title);
						$('#modal_image').html('<img style="width:100%;" src="'+base_url+'assest/images/blogs/'+ v.blog_image +'">'); 
						
						$('#img_urll').val(`${base_url}assest/images/blogs/${v.blog_image}`);
								
						$('#modal_content').text(v.title.replace(/<(.|\n)*?>/g, ''));
				  	});

					$('#event_instance').modal({'show':true,'backdrop':false});
				}
				else{
					
				}
			}
		});
	});

	$('.imgdwld').on('click', function(){
		var imgUrl = $('#img_urll').val();
		$(".imgdwld").attr('href', imgUrl);
	});

	function openCity(evt, cityName) {
	  	var i, tabcontent, tablinks;
	  	tabcontent = document.getElementsByClassName("tabcontent");
	  	for (i = 0; i < tabcontent.length; i++) {
	    	tabcontent[i].style.display = "none";
	  	}
	  	tablinks = document.getElementsByClassName("tablinks");
	  	for (i = 0; i < tablinks.length; i++) {
	    	tablinks[i].className = tablinks[i].className.replace(" active", "");
	  	}
	  	document.getElementById(cityName).style.display = "block";
	  	evt.currentTarget.className += " active";
	}


</script>







