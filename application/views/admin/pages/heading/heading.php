<?php if($this->session->userdata('group_name') == 'admin'){ ?>
<div class="main-content-sec container-fluid">
<!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Heding</a>
        </li>
        <li class="breadcrumb-item active">All page</li>
      </ol>
	  <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Pages</div>
        <div class="card-body">
          <div class="table-responsive">
				
			<section class="col-lg-6 connectedSortable">
				<div class="box box-primary">
				<div class="box-header with-border">
			  	<h3 class="box-title">Add New Heading</h3>
    			  <div class="box-tools pull-right">
    				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
    				  <i class="fa fa-minus"></i></button>
    			  </div>
				</div>
				<form name="insert_heading" id="insert_heading" role="form" class="form-horizontal" method="POST">
    				<div class="box-body">
    				<input type="hidden" name="id" id="id">
    				
    				<div class="form-group">
    					<label class="col-sm-2 control-label">Add Heading</label>
    					<div class="col-sm-10">
    						<input type="text" name="heading" id="heading" class="form-control" placeholder="Enter Heading Name">
    						<div class="text-danger" id="heading_err" style="display:none;"></div>
    					</div>
    				</div>
    				<div class="form-group">
    					<label class="col-sm-2 control-label">Value</label>
    					<div class="col-sm-10">
    						<input type="text" name="heading_val" id="heading_val" class="form-control" placeholder="Enter Heading Value">
    						<div class="text-danger" id="heading_val_err" style="display:none;"></div>
    					</div>
    				</div>
    
    				</div>
    				<div class="box-footer">
    					<button id="submit" type="button" class="btn pull-right btn-info">Save</button>
    					<button id="update" type="button" class="btn pull-right btn-info" style="display: none;">Update</button>
    					<button type="reset" id="event_reseet" class="btn btn-default pull-right btn-space">Cancel</button>
    				</div>
				</form>
			</div>
		</section>
		
    	<section class="col-lg-6 connectedSortable">
    		<div class="box box-primary">
    			<div class="box-header with-border">
    		  		<h3 class="box-title">All Heading List</h3>
    		  		<div class="box-tools pull-right">
    					<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
    			  		<i class="fa fa-minus"></i></button>
    		  		</div>
    			</div>
    			<div class="box-body table-responsive no-padding">
              		<table class="table table-hover">
                		<tbody><tr>
                  			<th>Sr No.</th>
                  			<th>Heading</th>
                  			<th>Edit/Delete</th>
                		</tr>
                		</tbody><tbody id="heading_list">
    					</tbody>
              		</table>
            	</div>
    		</div>
    	</section>
		
          </div>
        </div>
      </div>
</div>
<script type="text/javascript">
$.ajax({
	type:"POST",
	url:'<?php echo base_url();?>admin/Heading_ctrl/allList',
	dataType:'json',
	success:function(response){
	var x = '';
	var i = 1;
		if(response.status == 200){
			$.each(response.result, function(key, value){
				console.log(value);
				
			x = x +'<tr>'+
				   '<td>'+ i +'</td>'+
				   '<td>'+ value.heading +'</td>'+
				   '<td><button type="button" data-editid="'+value.id+'" data-head_value="'+value.heading_item+'" data-heading="'+ value.heading +'" class="btn btn-info btn-sm editbtn"><span class="glyphicon glyphicon-edit"></span> Edit </button> &nbsp;'+
				   '<button type="button" id="'+value.id +'" class="btn btn-danger btn-sm delete"><span class="glyphicon glyphicon-trash"></span> Delete </button></td>'+
				   '</tr>'
				i++; 
			});
			$('#heading_list').html(x);
			}else{
				$('#heading_list').html('<tr><td class="text-center" colspan="3"><b>Record not found.</b></td></tr>');
				}
		},
});

$(document).on('click', '.editbtn', function(){
	var id = $(this).data('editid');
	var heading = $(this).data('heading');
	var heading_val = $(this).data('head_value');
	$('#heading').val(heading);
	$('#heading_val').val(heading_val);
	$('#id').val(id);
});

$(document).on('click','#submit',function(){
	var formvalid = true;
	var heading = $('#heading').val();
	var heading_val = $('#heading_val').val();

	if(heading == 0){
		$('#heading_err').html('Please Enter Heading.').css('display','block');
		formvalid = false;
	}
	else{
		$('#heading_err').css('display','none');
	}
	if(heading_val == 0){
		$('#heading_val_err').html('Please Enter Heading Value.').css('display','block');
		formvalid = false;
	}
	else{
		$('#heading_val_err').css('display','none');
	}

	if(formvalid){
		$.ajax({
			type:"POST",
			url:'<?php echo base_url()?>admin/Heading_ctrl/insert',
			dataType:'json',
			data:{ 
				'heading' : heading,
				'heading_val': heading_val
				 },
			beforeSend:function(){
			$('#loader').modal({'show':true});
				},
			success:function(response){
				$('#loader').modal('toggle');
				if(response.status == 200){
					alert(response.msg);
					location.reload();
					}else{
						alert(response.msg);
						}
				},
			});
		}
});

$(document).on('click', '.editbtn', function(){
    $('#submit').css('display', 'none');
    $('#update').css('display', 'block'); 
});

$(document).on('click', '#update', function(){
	var formvalid = true;
	var id = $('#id').val();
	var heading = $('#heading').val();
	var heading_val = $('#heading_val').val();

	if(heading == 0){
		$('#heading_val_err').html('Please Enter Heading Value.').css('display','block');
		formvalid = false;
	}
	else{
		$('#heading_value_err').css('display','none');
	}

	if(formvalid){
		$.ajax({
			type:"POST",
			url:'<?php echo base_url()?>admin/Heading_ctrl/update',
			dataType:'json',
			data:{ 
    				'id' : id,
    				'heading' : heading,
    				'heading_val' : heading_val
				},
			beforeSend:function(){
			$('#loader').modal({'show':true});
				},
			success:function(response){
				$('#loader').modal('toggle');
				if(response.status == 200){
					alert(response.msg);
					location.reload();
					}else{
						alert(response.msg);
						}
				},
			});
		}
	
});

/*---------------------------Delete section------------------------------------*/
$(document).on('click','.delete',function(){
if(confirm( "are you sure!")){
	var delete_id=$(this).attr('id');

	$.ajax({
		type:"POST",
		url:'<?php echo base_url();?>admin/Heading_ctrl/delete',
		dataType:'json',
		data:{
			delete_id : delete_id,	
			},
		beforeSend : function(){},
		success: function(response){
			if(response.status == 200){
				location.reload();
				}else{
						alert("Error: Not Deleted.!");
					}
			},		
	});
	
}

});

</script>
<?php } ?>

<?php if($this->session->userdata('group_name') == 'subadmin'){?>
<div class="main-content-sec container-fluid">
<!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Heding</a>
        </li>
        <li class="breadcrumb-item active">All page</li>
      </ol>
	  <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Pages</div>
        <div class="card-body">
          <div class="table-responsive">
		
    	<section class="col-md-offset-1 col-lg-10 connectedSortable">
    		<div class="box box-primary">
    			<div class="box-header with-border">
    		  		<h3 class="box-title">All Heading List</h3>
    		  		<div class="box-tools pull-right">
    					<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
    			  		<i class="fa fa-minus"></i></button>
    		  		</div>
    			</div>
			<form name="heading_item_form" id="heading_item_form" role="form" class="form-horizontal" method="POST">
    			<input type="hidden" id="id" name="id"> 
    			<div class="box-body table-responsive no-padding">
              		<table class="table table-hover">
                		<tbody><tr>
                  			<th>Sr No.</th>
                  			<th>Heading</th>
                  			<th>Heading Item</th>
                		</tr>
                		</tbody><tbody id="heading_list">
    					</tbody>
              		</table>
            	</div>
            	
            	<div class="box-footer">
    					<button id="submit" type="button" class="btn pull-right btn-info">Save</button>
    					<button type="reset" id="event_reseet" class="btn btn-default pull-right btn-space">Cancel</button>
    				</div>
            	
            	
            	</form>
    		</div>
    	</section>
		
          </div>
        </div>
      </div>
</div>

<script type="text/javascript">
$.ajax({
	type:"POST",
	url:'<?php echo base_url();?>admin/Heading_ctrl/headingItemList',
	dataType:'json',
	success:function(response){
		if(response.status == 200){
			var x ='';
			var i = 1;
			console.log(response);
			$.each(response.result, function(key, value){
				
				x = x + '<tr>' +
						'<td>'+ i +'</td>'+
		        		'<td>'+ value.heading +'</td>';
		        		
		        		if(value.heading_item == null){
			        		var head_item = '';
			        	}
		        		else{
		        			var head_item = value.heading_item;
		        		}
				        x = x +'<td><input type="text" class="form-control heading_item" data-headingid="'+value.id+'" value="'+head_item+'"></td>'+
				        '<tr>'
				       i++;
				});
			$('#heading_list').html(x);
			}
		},
	});

   $(document).on('click','#submit', function(){
    	var heading_id = [];
    	var heading_item = [];
    
    $('.heading_item').each(function(){
    	var temp = {};
    	temp.heading_item = $(this).val();
    	if($(this).val() == ''){
    		f = 0;
    	}
    	temp.heading_id = $(this).data('headingid');
    	heading_item.push(temp);
    });
    atten(heading_item);

    function atten(heading_item){
		$.ajax({
			type:"POST",
			url:'<?php echo base_url();?>admin/Heading_ctrl/insert_heading_item',
			dataType:'json',
			data:{
				'data' : heading_item,
				},
			beforeSend:function(){
			$('#loader').modal({'show':true});
				},
			success:function(response){
				$('#loader').modal('toggle');
				if(response.status == 200){
					alert(response.msg);
					location.reload();
					}else{
					alert("Process Failed.!");
						}
				},
			});
        }
});   
</script>

<?php } ?>


<script> 
$(document).on('keyup','#heading',function(){ 
	var heading = $('#heading').val();
	$.ajax({
		type: 'POST',
		url: '<?php echo base_url();?>admin/Heading_ctrl/heading_check',
		dataType: "json",
		data: {
			'heading': heading
		},
		beforeSend: function(){
			
		},
		complete: function(){},
		success:function (response){
			console.log(response.data);
			if(response.status == 500){
				$('#heading_err').html('This Heading Already Exixt');
				$('#submit').attr("disabled","disabled");
			}
		}
	});
});

$(document).on('keyup','#heading',function(){ 
	var heading = $('#heading').val();
	$.ajax({
		type: 'POST',
		url: '<?php echo base_url();?>admin/Heading_ctrl/heading_check',
		dataType: "json",
		data: {
			'heading': heading
		},
		beforeSend: function(){		
		},
		complete: function(){},
		success:function (response){
			console.log(response.data);
			if(response.status == 500){
				$('#heading_err').html("<span class='exists'>"+ response.msg +"</span>");
				$('#submit').attr("disabled","disabled");
			}
			else{
					$('#heading_err').hide();
					$('#submit').attr("disabled",false);
				}
		}
	});
});
</script>
