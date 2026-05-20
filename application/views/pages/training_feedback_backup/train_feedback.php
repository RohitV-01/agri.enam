<style type="text/css">
.star-rating {
  font-size: 0;
  white-space: nowrap;
  display: inline-block;
  /* width: 250px; remove this */
  height: 50px;
  overflow: hidden;
  position: relative;
  background: url('assest/images/rating_0.png');
  background-size: contain;
}

.star-rating i.s  {
  opacity: 0;
  position: absolute;
  left: 0;
  top: 0;
  height: 100%;
  /* width: 20%; remove this */
  z-index: 1;
  background: url('assest/images/rating_2.png');
  background-size: contain;
}
.star-rating i {
  opacity: 0;
  position: absolute;
  left: 0;
  top: 0;
  height: 100%;
  /* width: 20%; remove this */
  z-index: 1;
  background: url('assest/images/rating_5.png');
  background-size: contain;
}
.star-rating input {
  -moz-appearance: none;
  -webkit-appearance: none;
  opacity: 0;
  display: inline-block;
  /* width: 20%; remove this */
  height: 100%;
  margin: 0;
  padding: 0;
  z-index: 2;
  position: relative;
}
.star-rating input:hover + i,
.star-rating input:checked + i {
  opacity: 1;
}
.star-rating i ~ i {
  width: 30%;
}
.star-rating i ~ i ~ i {
  width: 50%;
}
.star-rating i ~ i ~ i ~ i {
  width: 70%;
}
.star-rating i ~ i ~ i ~ i ~ i {
  width: 90%;
}
.star-rating.star-5 {width: 150px;height: 30px}
.star-rating.star-5 input,
.star-rating.star-5 i {width: 20%;}
.star-rating.star-5 i ~ i {width: 40%;}
.star-rating.star-5 i ~ i ~ i {width: 60%;}
.star-rating.star-5 i ~ i ~ i ~ i {width: 80%;}
.star-rating.star-5 i ~ i ~ i ~ i ~i {width: 100%;}
</style>

<section class="title-header-bg-apmc"></section>
<section class="content-section" style="min-height:300px;float:left;width:100%;padding:10px 0;">
	<div class="container-fuild" style="padding-left:4%;padding-right:4%;">
<div class="col-md-4 bc-nav" ><a href="<?php echo base_url(); ?>" title=""><?php echo $this->lang_file->heading_fetch('home'); ?></a>&nbsp;<i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>&nbsp; <?php echo $this->lang_file->heading_fetch('training_feedback'); ?>
	<?php if(!empty($msg)){ ?>
	<div class="label label-success"><?php  echo $msg;?></div>
<?php }?>
</div>
<form class="contact-form" method="post" id="contact_us" name="contact_us" action="<?php echo base_url();?>Feedback_ctrl/feedback_save">
	<div class="row">
	<div class="col-md-12">

		<div class="col-md-6">
				<div class="col-md-6 mb-2">
					<strong>  <?php echo $this->lang_file->heading_fetch('feed_date'); ?>  *</strong>
					<input type="date" class="form-control" name="feed_date" id="feed_date" required="">
				</div>
				<script type="text/javascript">
					$(function(){
					    var dtToday = new Date();
					    var month = dtToday.getMonth() + 1;
					    var day = dtToday.getDate();
					    var year = dtToday.getFullYear();
					    if(month < 10)
					        month = '0' + month.toString();
					    if(day < 10)
					        day = '0' + day.toString();
					    
					    var maxDate = year + '-' + month + '-' + day;
					    //alert(maxDate);
					    $('#feed_date').attr('max', maxDate);
					});
				</script>

				<div class="col-md-6">
					<strong>  <?php echo $this->lang_file->heading_fetch('feed_round'); ?>  *</strong>
					<select class="form-control" id="feed_round" name="feed_round" required>
						<option value="">-- Select Round --</option>
						<option value="1">Round 1</option>
						<option value="2">Round 2</option>
						<option value="3">Round 3</option>
						<option value="4">Round 4</option>
					</select>					
				</div>

				<div class="col-md-12 mb-2">
					<strong> <?php echo $this->lang_file->heading_fetch('feed_name'); ?> *</strong>
					<input type="text" class="form-control" name="name" required="">
				</div>

				<div class="col-md-12">
					<strong> <?php echo $this->lang_file->heading_fetch('feed_cont_no'); ?>  *</strong>
					<input type="text" class="form-control" name="contact_no"  onkeypress="return isNumber(event)" autocomplete="off" pattern="^[67890]\d{9}$"  maxlength="10" required>
				</div>
				<div class="col-md-12">
					<strong> <?php echo $this->lang_file->heading_fetch('feed_village'); ?>  *</strong>
					<input type="text" class="form-control" name="village" required>
				</div>

				<div class="col-md-12">
					<strong> <?php echo $this->lang_file->heading_fetch('feed_email_id'); ?></strong>
					<input type="text" class="form-control" name="email_id" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2, 4}$">
				</div>
				<div class="col-md-12">
					<strong> <?php echo $this->lang_file->heading_fetch('min_max_state'); ?> *</strong>
					<select class="form-control" id="feed_state" name="feed_state" required>
						<option value="">-- All --</option>
					</select>					
				</div>
				<div class="col-md-12">
					<strong> <?php echo $this->lang_file->heading_fetch('min_max_apmcs'); ?> *</strong>
				<select class="form-control" id="feed_apmc" name="feed_apmc" required>
					<option value="0">-- Select APMCs --</option>
				</select>				
				</div>
				<div class="col-md-12">
					<strong> <?php echo $this->lang_file->heading_fetch('feed_user_category'); ?> *</strong>
					<select class="form-control" id="category" name="category" required>
						<option value="">-Select Category-</option>
						<option value="F"><?php echo $this->lang_file->heading_fetch('feed_farmer'); ?></option>
                        <option value="T"><?php echo $this->lang_file->heading_fetch('feed_trader'); ?></option>
                        <option value="A"><?php echo $this->lang_file->heading_fetch('feed_com_agent'); ?></option>
                        <option value="M"><?php echo $this->lang_file->heading_fetch('feed_mandi_staff'); ?></option>
                        <option value="O"><?php echo $this->lang_file->heading_fetch('feed_others'); ?></option>
					</select>				
				</div>

		</div>

			<style>
			.checked {
			  color: orange;
			}
			</style>

		<div class="col-md-6">
				<div class="col-md-12">
					<strong> <?php echo $this->lang_file->heading_fetch('feed_valuable'); ?></strong>
				</div>
				<div class="col-md-12" id="questions">
				
					
				</div>
		</div>


<div class="col-md-12">&nbsp;</div>
	<div class="col-md-12" align="center">
		<!-- 	<button  class='btn btn-success' type="button" id="agri_save"> Submit</button> -->
			  <button  type="submit" class="btn btn-success" onclick="return myFunction()">Submit</button>
	</div>	
	  </div>
  </form>

<script type="text/javascript">
$(function() {
    	$('#category').on('change', function() {
        var val = $(this).val();
        if (val == 'F' || val == 'T' || val == 'A' || val == 'M' || val == 'O') {
          $('#questions').show();
            load_first();
			function load_first(){
			$.ajax({
					type : 'POST',
					url : 'https://enam.gov.in/NamWebSrv/rest/mobile/feedback/getFeedbackQuestionnaire',
					//url : 'http://192.168.1.232:8080/NamWebSrv/rest/mobile/feedback/getFeedbackQuestionnaire',
					data : {
						'category': val
					},
					success : function (response){
							if (response.status = "S") 
							{
								//alert("works");
										var x = '';
										var y = "Questions Not Found";
								/*		$.each(response.listData,function(key,value){
												x = x + '<div>'+
										        			'<br><p name="questionId">'+ value.questionId+'</p>'+'<br><span class="fa fa-star-o checked" data-rating="1" style="font-size:20px;">'+ '</span>'+'<span class="fa fa-star-o" data-rating="2" style="font-size:20px;">'+ '</span>'+'<span class="fa fa-star-o" data-rating="3" style="font-size:20px;">'+ '</span>'+'<span class="fa fa-star-o" data-rating="4" style="font-size:20px;">'+ '</span>'+'<span class="fa fa-star-o" data-rating="5" style="font-size:20px;">'+ '</span>'
										  				'</div>';
										});*/
										$.each(response.listData,function(key,value){

												var rate = value.questionId;
												x = x + '<br><p name="question">'+ value.question+'</p>'+'<input type="hidden" id="questionId" name="questionId[]" value="'+ value.questionId+'">'+
												'<span class="star-rating star-5" id= "rating">'+
												  '<input type="radio" name="rating'+rate+'" value="1" id="checked"><i class="s"></i>'+
												  '<input type="radio" name="rating'+rate+'" value="2" id="checked_1"><i class="s"></i>'+
												  '<input type="radio" name="rating'+rate+'" value="3" id="checked_2"><i></i>'+
												  '<input type="radio" name="rating'+rate+'" value="4" id="checked_3"><i></i>'+
												  '<input type="radio" name="rating'+rate+'" value="5" id="checked_4"><i></i>'+
												'</span>';
										});
										$('#questions').html(x);

										if (x == false) 
										{
											$('#questions').html(y);
										}
							}
							else
							{	
								
							}
					}
				});
			}
        }
        else
        {
        	 $('#questions').hide();
        }

    });
});
</script>

<script type="text/javascript">
	function myFunction() {
	 return confirm("Are you Sure to Submit the Responses");
	}


	function checkvalidation(){
		var org = $('#org_logistic').val();   

			if($('#org_logistic').val() == ''){
		/*		$('#org_logistic_err').text('Please Enter Name.').show();*/
					$('#org_logistic_err').html('Please Enter Contact No.').css('display','block');	
			}
		 else{
				$('#org_logistic_err').css('display','none');
			}
	}
</script>
<script type="text/javascript">
     	function isNumber(evt) {
			    evt = (evt) ? evt : window.event;
			    var charCode = (evt.which) ? evt.which : evt.keyCode;
			    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
			        return false;
			    }
			    return true;
			}
</script>

		</div>
	</div>
</section>



	<script type="text/javascript">
			var baseUrl = $('#base_url').val();
						$.ajax({
					    type: 'POST',
					    url: baseUrl+'ajax_ctrl/states_name',
					    dataType: "json",
					    data: {},
					    beforeSend: function(){
					    },
					    complete: function(){},
						success:function (response) {
							if(response.status == 200){
								var x = '<option value="">-- All --</option>';
								$.each(response.data,function(key,value){
									x = x + '<option value="'+ value.state_id +'">'+ value.state_name +'</option>';
								});
								$('#feed_state').html(x);
							}
						}
				});
												
		
				$(document).on('change','#feed_state',function(){
					$('#feed_apmc').val(0);
			
					var stateId = $('#feed_state').val();
					$.ajax({
						    type: 'POST',
						    url: baseUrl + 'Feedback_ctrl/apmc_list',
						    dataType: "json",
						    data: {
						    	'state_id' : stateId
						    },
						    beforeSend: function(){
						    	
						    },
						    complete: function(){},
						    success:function (response) {
						    	var x = '<option value="">-- Select APMCs --</option>';
						    	$.each(response.data,function(key,value){
									if($('#apmc_id_param').val() == value.apmc_id){
								
										x = x + '<option value="'+ value.apmc_id +'" selected>'+ value.apmc_name +'</option>';								
									}
									else {

										x = x + '<option value="'+ value.apmc_id +'">'+ value.apmc_name +'</option>'; 
									}
						    	});
						    	$('#feed_apmc').html(x);
						    }
						});
				
				});			
								

				
				function mandi_count(){
					$.ajax({
				        type: 'POST',
				        url: baseUrl+'Feedback_ctrl/mandi_count',
				        dataType: "json",
				        data: {
							'state' : $('#today_states').val(),
							'district' : $('#today_district').val(),
						
						},
				        beforeSend: function(){},
				        complete: function(){},
				        success:function (response) {
				        	if(response.status == 200){
								$('#contact_page_mandi_count_span').html(response.count);
							}
							else{
								$('#contact_page_mandi_count_span').html('1000');
							}
				        }
					});
				}
</script>
