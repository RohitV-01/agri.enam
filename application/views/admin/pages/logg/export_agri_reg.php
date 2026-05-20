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
		<li class="active">Agri_registration_Export</li>
	</ol>
	<section class="content-header">
		<h1 class="pull-left">Agri-Logistics</h1>
	</section>
	<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
	<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<!-- Left col -->
			<section class="col-lg-12 connectedSortable">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Export Excel Data of Logistics Registration</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
								<i class="fa fa-minus"></i>
							</button>
						</div>
					</div>
					<!--  <form name="video_form" id="import_form" role="form" class="form-horizontal" method="POST">  -->
					 <form action="<?php echo base_url();?>/Logistic_ctrl/export" method="POST">
            			<div class="box-body">
            				<div class="form-group">
            					<label class="col-md-offset-3 col-md-1 control-label">From Date</label>
            					<div class="col-md-2" >
            						 <input id="from_date" name="from_date" placeholder="dd-mm-yyyy" class="form-control input-sm" required/>
            						<div class="text-danger" id="from_date_error" style="display:none;"></div>
            					</div>

            					<label class="col-md-1 control-label">To Date</label>
            					<div class="col-md-2">
            						 <input id="to_date"  name="to_date" placeholder="dd-mm-yyyy" class="form-control input-sm" required/> 
            						<div class="text-danger" id="to_date_error"   style="display:none;"></div>
            					</div>
            				</div>
            			 </div>
                		<div class="box-footer" align="center">
        					<button id="excel_export" type="submit" class="btn btn-info">Export</button>&nbsp;&nbsp;
        					<button type="reset" class="btn btn-default">Reset</button>
        				</div>
					</form> 
					<br />
				</div>
		</div>
	</section>
	</div>
	<script type="text/javascript">
		$("#to_date").change(function () {
			    var startDate = document.getElementById("from_date").value;
			    var endDate = document.getElementById("to_date").value;

			    if ((Date.parse(startDate) >= Date.parse(endDate))) {
			        alert("End date should be greater than Start date");
			        document.getElementById("to_date").value = "";
			    }
		});
	</script>
	<script type="text/javascript">
			$('#from_date').datepicker(
				{
				    format: "dd-mm-yyyy",
				    maxDate: new Date()
				    });
				    $('#to_date').datepicker(
				  {
				    format: "dd-mm-yyyy",
				    maxDate: new Date()
				});
    </script>
	<script type="text/javascript">
		$(document).on('click','#excel_export',function(){
			var from_date = $('#from_date').val();
			var to_date = $('#to_date').val();
			var formvalid = true;

			if(from_date == ''){
				$('#from_date_error').html('From Date is Required.').css('display','block');
				formvalid = false;
				}else{
					$('#from_date_error').css('display','none');
				}
			
			if(to_date == ''){
				$('#to_date_error').html('To Date is Required.').css('display','block');
				formvalid = false;
				}else{
					$('#to_date_error').css('display','none');
				}
			/*if(formvalid){
					$.ajax({
							type:'POST',
							url:'<?php //echo base_url();?>Logistic_ctrl/export',
							dataType:'json',
							data:{from_date:from_date,to_date:to_date},
							beforeSend:function(){},
							success:function(response){
								openExcelfile(response.download);
							},
			
					});
			}*/
		});
	</script>