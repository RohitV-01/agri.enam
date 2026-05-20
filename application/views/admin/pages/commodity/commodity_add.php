<div class="col-sm-5 well">
	<form id="commodity_form" class="form-horizontal" name="f1" method="POST" action="<?php echo base_url();?>admin/Commodity_ctrl/create_commodity" enctype= "multipart/form-data">
		<div class="form-group">
		    <label class="col-sm-2 control-label">commodity Group</label>
		    <div class="col-sm-10">
		      <select class="form-control" id="commodity_group" name="commodity_group">
		      		<option value="0">Select commodity group</option>
		      	<?php if(isset($categories) && (count($categories)>0)){ ?>
		      		<?php foreach($categories as $commodity){ ?>
		      			<option value="<?php echo $commodity['c_id'];?>"><?php echo $commodity['cg_name']; ?></option>
		      		<?php } ?>
		      	<?php } ?>
		      </select>
		    </div>
		  </div>
		  
		  <div class="form-group">
		    <label class="col-sm-2 control-label"> Commodity name </label>
		    <div class="col-sm-10">
			  <input type="hidden" name="commodity_id" id="commodity_id" class="form-control" placeholder="commodity id">
			  <input type="text" name="commodity_name" id="commodity_name" class="form-control" placeholder="commodity name">
			  <div class="text-danger" id="commodity_parameter_title" style="display:none;"></div>
		    </div>
	   </div>
		  
		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <input type="button" name="submit" class="btn btn-primary" value="Create" id="submit_commodity">
		      <input type="reset" name="cancel" class="btn btn-danger" value="Cancel" id="reset_commodity">
		    </div>
		  </div>
	</form>
</div>

	<div class="col-sm-7 well">
    	<div id="comodity_category" class="col-sm-12">
    	</div>
	</div>
</div>
<script>
	var baseUrl = $('#base_url').val();
	commodity_list();
	
	$(document).on('click','#submit_commodity',function(){
		$('#commodity_form').ajaxForm({
			dataType : 'json',
			beforeSubmit:function(e){
			},
			success:function(response){
			  if(response.status == 200){
				alert(response.msg);
				location.reload();
			  }
			  else{
				alert(response.msg);
			  }
			}
	  }).submit();
	});
	
	function commodity_list(){
		$.ajax({
			type: 'POST',
			url: baseUrl+'admin/Commodity_ctrl/commodity_category',
			dataType: "json",
			data: {},
			beforeSend: function(){},
			complete: function(){},
			success:function (response){
				x = '';
				if(response.status == 200){
					console.log(response);
					var x = '';
					i = 1;
					$.each(response.result,function(key,value){
						x = x + '<a href="#demo_'+i+'" data-id="'+value.c_id+'" class="comodity_group btn btn-info col-sm-12" data-toggle="collapse">'+value.cg_name+'</a>'+
								'<div id="demo_'+i+'" class="collapse">'+
								'<div id="comodity_data_'+value.c_id+'"></div>'+
								'</div>';
							i++;	
					});
					$('#comodity_category').html(x);
				}
			},
		});
	}

$(document).on('click','.comodity_group',function(){
	var group_id = $(this).data('id');
	$.ajax({
			type:'POST',
			url: baseUrl+'admin/Commodity_ctrl/commodity_data',
			data:{group_id:group_id},
			dataType:'json',
			beforeSend:function(){},
			success:function(response){
				var x = '<table class="table">';
				var i = 1;
				
				$.each(response.result,function(key,value){
					x = x + '<tr>'+
							'<td>'+i+'</td>'+
							'<td>'+value.commodity_name+'</td>'+
							'<td><a href="javascript:void(0);" class="comm_edit" data-c_id="'+ value.c_id +'"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;'+
							    '<a href="javascript:void(0);" class="comm_delete" data-c_id="'+ value.c_id +'"><i class="fa fa-trash"></i></a></td>'+
							'</tr>';
						i++;
				});
				x = x +'</table>';
				$('#comodity_data_'+group_id).html(x);
			},
		});
});

$(document).on('click','.comm_edit',function(){
	$('#submit_commodity').val('Update');
	var c_id = $(this).data('c_id');
	$.ajax({
			type:'POST',
			url: baseUrl+'admin/Commodity_ctrl/comm_detail',
			data:{
				'c_id' : c_id
			},
			dataType:'json',
			beforeSend:function(){},
			success:function(response){
				console.log(response);
				if(response.status == 200){
					$('#commodity_group').val(response.data[0].g_id);
					$('#commodity_id').val(response.data[0].c_id);
					$('#commodity_name').val(response.data[0].commodity_name);
				}
				else{
					
				}
			}
	});
});

$(document).on('click','#reset_commodity',function(){
	$('#submit_commodity').val('Create');
	$('#commodity_group').val(0);
	$('#commodity_name').val('');
	$('#commodity_id').val('');
});

  $(document).on('click','.comm_delete',function(){
    var c_id = $(this).data('c_id'); 
     var x = confirm('Are you sure.'); 
   if(x){
    $.ajax({
			type:'POST',
			url: baseUrl+'admin/Commodity_ctrl/comm_delete',
			data:{
				'c_id' : c_id
			},
			dataType:'json',
			beforeSend:function(){},
			success:function(response){
				console.log(response);
				if(response.status == 200){
					alert(response.msg);
                                       location.reload();
				}
				else{
					alert(response.msg);
				}
			}
	});
    }
});
</script>