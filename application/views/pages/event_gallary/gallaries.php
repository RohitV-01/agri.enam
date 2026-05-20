<style>
#myImg {

    cursor: pointer;
    transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
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

<section class="title-header-bg-apmc"></section>
<div class="container-fuild" style="padding-left:4%;padding-right:4%;padding-top:10px;float:left;width:100%;">
	<div class="col-md-12 bc-nav"><a href="<?php echo base_url(); ?>" title=""><?php echo $this->lang_file->heading_fetch('home');?></a>&nbsp;<i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>&nbsp;<a href="<?php echo base_url(); ?>events"><?php echo $this->lang_file->heading_fetch('event_gallery');?></a>&nbsp;<i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>&nbsp;
			<?php $cat= $this->uri->segment(2);
				if(isset($cat) && $cat != ''){?>
					<?php if($cat == 'national'){ 	
						echo $this->lang_file->heading_fetch('event_nation');
					} else {
						echo $this->lang_file->heading_fetch('state');
					}?>
			<?php	}
				else{
				     echo "All Events";
				}
				?>
	</div>
</div>


<section class="content-section">
	<div class="container-fuild" style="padding-left:4%;padding-right:4%;">
		<div class="row">
			<div class="col-md-12 video-gallery events-list">
			<?php $cat= $this->uri->segment(2);
				if(isset($cat) && $cat != ''){?>
					
					
					 <h3 style="margin-bottom:15px;margin-top:0px;" class="p-title"><span><?php if($cat == 'national'){ 	
						echo $this->lang_file->heading_fetch('event_nation');
					} else {
						echo $this->lang_file->heading_fetch('state');
					}?></span></h3>
			<?php	}
				else{
					echo '<h3 style="margin-bottom:15px;margin-top:0px;" class="p-title"><span>All Events</span>';
				}
				?>
				</h3>
				
			
			
			<div id="myCarousel" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner"> 
						<?php
						$c = count($events);
						$event_seq = 0;
						for($i = 0 ; $i <= $c ; $i = $i+4){
							if($i == 0){
								echo '<div class="item active">';
							}
							else{
								echo '<div class="item">';
							}
							
							for($j = $i; $j < $i+4; $j++){ 
								if($j < $c) { ?>
							<div class="col-md-3 events-de">
								<img class="event_inst" data-id="<?php echo $events[$j]['event_id']; ?>" data-content="<?php echo $events[$j]['event_content']; ?>" data-image="<?php echo $events[$j]['event_image']; ?>" data-sequence="<?php echo $event_seq;?>"  style="width:100%;" alt="<?php echo $events[$j]['title']; ?>" src="<?php echo base_url(); ?>/Event_gallary/<?php echo $events[$j]['event_image']; ?>" />
								<div class="register-user-box">
									<h5><?php echo $events[$j]['title']; ?></h5>
									<?php echo $events[$j]['event_content'];?>
<a data-id="<?php echo $events[$j]['event_id']; ?>" class="event_inst click-event-details"><b>Click for Details</b></a>
								</div>
							</div>	
					  <?php
					  			$event_seq = $event_seq + 1;
								}
								else{
									break;
								}
					   		}
					  	echo '</div>';		
						}
						?>
				</div>

				
				<a class="left carousel-control" href="#myCarousel" data-slide="prev">
				  <i class="fa fa-angle-left"></i>
				  <span class="sr-only">Previous</span>
				</a>
				<a class="right carousel-control" href="#myCarousel" data-slide="next">
				  <i class="fa fa-angle-right"></i>
				  <span class="sr-only">Next</span>
				</a>
			  </div> 
			
			
			<div class="modal fade" id="event_instance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow: auto">
					  <div class="modal-dialog" role="document">
						<div class="modal-content">
						  <div class="modal-body" >
							<button style="position:absolute;top:0px;right:0;" type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i></button>
							<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">		
							  <!-- Wrapper for slides -->
							 <div class="carousel-inner" role="listbox">
								<div class="item active" style="margin-top:15px;">
								<input type="hidden" id="eve_id" value="">
								<div id="modal_image"></div>

								<div id="modal_content"></div>
								</div>
							  </div>

							  
							</div>
							
						  </div>
						</div>
					  </div>
		</div>	
			</div>
		</div>
	</div>
</section>