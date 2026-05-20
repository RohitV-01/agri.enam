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
		<li class="active">Logg Details</li>
	</ol>
	<section class="content-header">
		<h1 class="pull-left">Stackholder</h1>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<!-- Left col -->
			<section class="col-lg-12 connectedSortable">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Import Excel Data of Stackholders</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
								<i class="fa fa-minus"></i>
							</button>
						</div>
					</div>
					<form name="video_form" id="import_form" role="form" class="form-horizontal" method="POST">
            			<div class="box-body">
            				<div class="form-group">
            					<label class="col-sm-2 control-label">Select Excel File</label>
            					<div class="col-sm-3">
            						<input type="file" name="file" id="file" class="form-control" accept=".xls, .xlsx" />
            						<div class="text-danger" id="from_date_error" style="display:none;"></div>
            					</div>
            				</div>
            			 </div>
                		<div class="box-footer">
        					<button id="import" type="button" class="btn pull-right btn-info">Import</button>
        					<button type="reset" class="btn btn-default pull-right btn-space">Cancel</button>
                                                <a href="<?php echo base_url(); ?>docs/stackeholder.xlsx" style="margin-right:10px;" class="btn btn-primary pull-right">Sample Data</a>
        				</div>	
					</form>
					<br />
					
				</div>
			</div>
		</section>
	</div>


<script type="text/javascript">

	$(document).on('click','#import', function(){

	var formdata = new FormData();
	formdata.append('file',$('#file')[0].files[0]);

	$.ajax({
		method:"POST",
		url:"<?php echo base_url(); ?>admin/Excel_import/stackholdrs_import",
		dataType:'json',
		data:formdata,
                beforeSend: function(){
	        	$('#loader').modal({'show':true});	
	        },
		success:function(response){
		    if(response.status == 200){
			    alert(response.msg);
			    location.reload();
			    }else{
			    	alert(response.msg);
				    }
		 },
	    contentType:false,
	    cache:false,
	    processData:false,
		});
});






 

</script>