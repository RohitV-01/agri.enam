<div class="col-sm-12 well">
	<form id="commodity_form" class="form-horizontal" name="f1" method="POST" action="<?php echo base_url();?>admin/Commodity_ctrl/commodity_update" enctype= "multipart/form-data">
		<div class="form-group">
		    <label class="col-sm-2 control-label">commodity</label>
		    <div class="col-sm-10">
		      <select class="form-control" name="commodity" id="commodity">
		      		<option value="0">Select commodity</option>
		      	<?php if(isset($commodities) && (count($commodities)>0)){ ?>
		      		<?php foreach($commodities as $commodity){ ?>
		      			<option value="<?php echo $commodity['c_id'];?>"><?php echo $commodity['commodity_name']; ?></option>
		      		<?php } ?>
		      	<?php } ?>
		      </select>
		    </div>
		  </div>
		  
		  <div class="form-group" style="display:none;">
		    <label class="col-sm-2 control-label">Commodity Id</label>
		    <div class="col-sm-10">
		      <input type="text" name="commodity_id" id="commodity_id" class="form-control" />
		    </div>
		  </div>
		  
		  <div class="form-group">
		    <label class="col-sm-2 control-label">Commodity Name</label>
		    <div class="col-sm-10">
		      <input type="text" name="commodity_name" id="commodity_name" class="form-control" />
		    </div>
		  </div>
	
		  <div class="form-group">
		    <label class="col-sm-2 control-label">Commodity Image</label>
		    <div class="col-sm-10">
		      <input type="file" name="commodity_image_select" id="commodity_image_select" class="form-control" />
		    </div>
		  </div>	  
		  
		  <div class="form-group">
		    <label class="col-sm-2 control-label">Commodity Image</label>
		    <div class="col-sm-10">
		      <img src="#" id="commodity_image" >
		    </div>
		  </div>
		  
		  <div class="form-group">
		    <label class="col-sm-2 control-label"> Commodity parameter title </label>
		    <div class="col-sm-10">
		      <textarea id="commodity_parameter_title" name="commodity_parameter_title" class="form-control" rows="4"></textarea>
					<div class="text-danger" id="commodity_parameter_title" style="display:none;"></div>
		            <script>
		              CKEDITOR.replace('commodity_parameter_title');
		            </script>
		    </div>
	   </div>
	   <div class="form-group">
		    <label class="col-sm-2 control-label"> Commodity parameter contant </label>
		    <div class="col-sm-10">
		      <textarea id="commodity_parameter_content" name="commodity_parameter_content" class="form-control" rows="4"></textarea>
					<div class="text-danger" id="commodity_parameter_content" style="display:none;"></div>
		            <script>
		                CKEDITOR.replace('commodity_parameter_content');
		            </script>
		    </div>
	   </div>
		  
		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <input type="button" name="submit" class="btn btn-primary" value="Update" id="submit_commodity">
		      <input type="reset" name="cancel" class="btn btn-primary" value="Cancel" id="reset_commodity">
		    </div>
		  </div>
	</form>
</div>

<script>
	var baseUrl = $('#base_url').val();
	$(document).on('change','#commodity',function(){
		var c_id = $(this).val();
		$.ajax({
			type: 'POST',
			url: baseUrl+'admin/Commodity_ctrl/commodity_detail',
			dataType: "json",
			data: {
				'c_id' : c_id
			},
			beforeSend: function(){},
			complete: function(){},
			success:function (response) {
				console.log(response);
				if(response.status == 200){
					$('#commodity_id').val(response.data[0].comm_id);
					$('#commodity_name').val(response.data[0].comm_name);
					$('#commodity_image').attr('src', baseUrl +'/assest/images/commodity-pro/' +response.data[0].comm_image);
					CKEDITOR.instances['commodity_parameter_title'].setData(response.data[0].comm_title);
					CKEDITOR.instances['commodity_parameter_content'].setData(response.data[0].comm_desc);
				}
				else {
					$('#commodity_id').val(c_id);	
				}
			}
		});
	});
	
	$(document).on('click','#submit_commodity',function(){
		$('#commodity_form').ajaxForm({
		    dataType : 'json',
		    data : {
		    	'commodity_parameter_title' : CKEDITOR.instances.commodity_parameter_title.getData(),
		    	'commodity_parameter_content' : CKEDITOR.instances.commodity_parameter_content.getData(),	
		    	
		    },
		    beforeSubmit:function(e){
				$('#loader').modal('show');
		    },
		    success:function(response){
		    	console.log(response);
		  	  if(response.status == 200){
		    	$('#loader').modal('toggle');
		    	location.reload();
		      }
		      else{
			    alert(response.msg);
		      }
		    }
	  }).submit();
	});
	
	
	$(document).on('click','#submit_commo',function(){ 
			var add_commo = $('#add_commo').val();  
			var add_commo_id = $('#add_commo_id').val(); 
			var form_valid = true;
			if(add_commo == ''){
				$('#commo_response').html('Please Enter Commodity Name.').css('display','block');
				form_valid = false;
			}
			else{
				$('#commo_response').css('display','none');
			}
			if(add_commo_id == ''){
				$('#commodity_response').html('Please Enter Commodity Id.').css('display','block');
				form_valid = false;
			}
			else{
				$('#commodity_response').css('display','none');
			}
			if(form_valid){
				$.ajax({
						type:	'POST',
						url:	baseUrl+'admin/Commodity_ctrl/new_commo',
						dataType: 'json',
						data: {
								'add_commo':	add_commo,
								'add_commo_id':	add_commo_id
							},
							beforeSubmit: function(){
								$('#loader').modal({'show':true});
								},
							complete: function(){},
							 success: function (response) {
                                                                    alert(response.msg);
								 $('#loader').modal('toggle');
						        	location.reload();
								 }
						});
			}
		});


       $(document).on ('keyup','#add_commo_id',function(){
	var add_commo_id = $('#add_commo_id').val();
	
			$.ajax({
	            url: baseUrl +'admin/Commodity_ctrl/commo_id_check',
	            type: 'POST',
	            dataType: "json",
	            data: {
	            	'add_commo_id' : add_commo_id,
	            },
	            success: function(response){ 
	                if(response.status == 500){	
	                	 $("#submit_commo").attr("disabled", "disabled");
		                    $("#commodity_response").html("<span class='exists'>"+ response.msg +"</span>");                	                	
	                	
	                }
	                else {
	                	$("#commodity_response").html('');
	                	$("#submit_commo").attr('disabled',false);	                   
	                   
	                }
	                
	             }
	          });
		
});
</script>