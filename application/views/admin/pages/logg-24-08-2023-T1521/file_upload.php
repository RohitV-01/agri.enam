<?php $group = $this->session->userdata('group_name'); ?>
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<ol class="breadcrumb">
		<li>
			<a title="Home" href="
				<?php echo base_url();?>admin/admin">
				<i class="fa fa-dashboard"></i> Home
			</a>
		</li>
		<li class="active">File Upload</li>
	</ol>
	<section class="content-header">
		<h1 class="pull-left">File Upload</h1>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<!-- Left col -->
			<section class="col-lg-12 connectedSortable">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Import File</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
								<i class="fa fa-minus"></i>
							</button>
						</div>
					</div>
					<form name="video_form" id="import_form" role="form" class="form-horizontal" method="POST">
            			<div class="box-body">
            				<div class="form-group">
            					<label class="col-sm-2 control-label">Select File</label>
            					<div class="col-sm-3">
            						<input type="text" name="path" id="path" class="form-control" placeholder="Enter location path" />
            						<div class="text-danger" id="path_error" style="display:none;"></div>
            					</div>
            				</div>
            			 </div>
            		
            			<div class="box-body">
            				<div class="form-group">
            					<label class="col-sm-2 control-label">Select File</label>
            					<div class="col-sm-3">
            						<input type="file" name="file" id="file" class="form-control" />
            						<div class="text-danger" id="file_error" style="display:none;"></div>
            					</div>
            				</div>
            			 </div>
                		<div class="box-footer">
        					<button id="import" type="button" class="btn pull-right btn-info">Import</button>
        					<button type="reset" class="btn btn-default pull-right btn-space">Cancel</button>
        				</div>	
					</form>
				</div>
		<div class="table table-striped table-bordered">
				<table class="table">
					<thead><tr>
						<th>Sr. No.</th>
						<th>Folder/File Name</th></tr>
					</thead>
					<tbody id="file_list"></tbody>
				</table>
				</div>
			</section>		
			</div>
		</section>
	</div>

<script type="text/javascript">	

$(document).on('keyup','#path',function(){
	var path = $('#path').val();
    $.ajax({
    	type:'POST',
    	url:"<?php echo base_url(); ?>admin/File_upload_ctrl/file_list",
    	dataType:'json',
		data:{path:path},
    	beforeSend:function(){},
    	success:function(response){
    		console.log(response);
    	if(response.status == 200){
        	var x = '';
        	var i = 1;
        		$.each(response.files,function(key, value){
					x = x + '<tr>'+
						  '<td>'+ i +'</td>'+
						  '<td>'+ key +'/'+ value +'</td>'+
						  '</tr>';
					  i++;
                });
                $('#file_list').html(x);
        	}
    	},
    });
});


$(document).on('click','#import', function(){

	var path = $('#path').val();
	var file = document.getElementById("file").files.length;

	var formvalid = true;
	if(path == 0){
		$('#path_error').html('Path is required.').css('display','block');
		formvalid = false;
		}else{
			$('#path_error').css('display','none');	
			}
	if(file < 1){
		$('#file_error').html('Path is required.').css('display','block');
		formvalid = false;
		}else{
			$('#file_error').css('display','none');	
			}
	
	var formdata = new FormData();
	formdata.append('path',$('#path').val());
	formdata.append('file',$('#file')[0].files[0]);
	if(formvalid){
		$.ajax({
    		method:"POST",
    		url:"<?php echo base_url(); ?>admin/File_upload_ctrl/import",
    		dataType:'json',
    		data:formdata,
    		success:function(response){
    		    if(response.status == 200){
    			    alert(response.msg);
    			    location.reload();
    			    }
    		 },
    		 error:function(){
				alert("Path not valid.");
    	     },
    	    contentType:false,
    	    cache:false,
    	    processData:false,
    		}); 
    	
	}//end of form validation
	
});
</script>