<?php $group = $this->session->userdata('group_name');  ?>
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
		<h1 class="pull-left">Unified Licence</h1>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<!-- Left col -->
			<section class="col-lg-12 connectedSortable">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Import Excel Data of Unified Licence</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
								<i class="fa fa-minus"></i>
							</button>
						</div>
					</div>
					<form name="unified_import" id="import_unified" role="form" class="form-horizontal" method="POST">
            			<div class="box-body">
            				<div class="form-group">
            					<label class="col-sm-2 control-label">Select Excel File</label>
            					<div class="col-sm-3">
            						<input type="file" name="unified_file" id="unified_file" class="form-control" accept=".xls, .xlsx" />
            						<div class="text-danger" id="unified_file" style="display:none;"></div>
            					</div>
            				</div>
            			 </div>
                		<div class="box-footer">
        					<button id="unified_import" type="button" class="btn pull-right btn-info">Import</button>
        					<button type="reset" class="btn btn-default pull-right btn-space">Cancel</button>
                                                <a href="<?php echo base_url();?>/docs/unifield_licence.xlsx" class="btn pull-right btn-primary">Sample Data</a>
        				</div>	
					</form>
					<br />
					
				</div>
			</div>
		</section>
	</div>


<script type="text/javascript">

	$(document).on('click','#unified_import', function(){

	var formdata = new FormData();
	formdata.append('file',$('#unified_file')[0].files[0]);

	$.ajax({
		method:"POST",
		url:"<?php echo base_url(); ?>admin/Excel_import/unified_licencce_import",
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