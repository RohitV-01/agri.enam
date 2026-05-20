<?php $group = $this->session->userdata('group_name'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
	<ol class="breadcrumb">
        <li><a title="Home" href="<?php echo base_url();?>admin/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Logg Details</li>
    </ol>   
	<section class="content-header">
      <h1 class="pull-left">Loggs</h1>
    </section>
	<!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- Left col -->
		<section class="col-lg-12 connectedSortable">
		<div class="box box-primary">
			<div class="box-header with-border">
			  <h3 class="box-title">Logg Details</h3>
			  <div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
				  <i class="fa fa-minus"></i></button>
			  </div>
			</div>
			<form name="video_form" id="video_form" role="form" class="form-horizontal" method="POST">
			<div class="box-body">
				<div class="form-group">
					<label class="col-sm-2 control-label">From Date</label>
					<div class="col-sm-3">
						<input type="date" name="from_date" id="from_date" class="form-control">
						<div class="text-danger" id="from_date_error" style="display:none;"></div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label">To Date</label>
					<div class="col-sm-3">
						<input type="date" name="to_date" id="to_date" class="form-control">
						<div class="text-danger" id="to_date_error" style="display:none;"></div>
					</div>
				</div>

				
			</div>
				<div class="box-footer">
					<button id="search" type="button" class="btn pull-right btn-info">Search</button>
					<button type="reset" class="btn btn-default pull-right btn-space">Cancel</button>
				</div>
				
			</form>
		</div>
		</section>
		
		<section class="col-lg-12 connectedSortable" style="display: none;" id="logg_body">
		<div class="box box-primary">
			<div class="box-header with-border">
			  <h3 class="box-title">Logg Details</h3>
			  <div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
				  <i class="fa fa-minus"></i></button>
			  </div>
			</div>
			<div class="box-body">
				<input type="button" id="excel_export" value="Export Excel" class="btn pull-right btn-success">
			<table class="table">
    			<thead>
    				<th>Sr. No.</th>
    				<th>User Name</th>
    				<th>Event Name</th>
    				<th>Event Date</th>
    			</thead>
    			<tbody id="record"></tbody>	
			</table>
			</div>
		</div>
  </section>
  
  
	</div>
  </section>
</div>


<script type="text/javascript">

$(document).on('click','#search',function(){
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

	if(formvalid){
			$.ajax({
					type:'POST',
					url:'<?php echo base_url();?>admin/Logg_ctrl/logg_report',
					dataType:'json',
					data:{from_date:from_date,to_date:to_date},
					beforeSend:function(){},
					success:function(response){
						console.log(response);
						if(response.status == 200){
							$('#logg_body').css('display','block');
							var x='';
							var i = 1;
							$.each(response.data, function(key, value){
								x = x + '<tr>'+
										'<td>'+ i +'</td>'+
										'<td>'+value.username+'</td>'+
										'<td>'+ value.event_name +'</td>'+
										'<td>'+ value.created_at +'</td>'+
										'</tr>';
									i++;
								});
							
							$('#record').html(x);
							}else{
								$('#logg_body').html('<tr><td class="text-center" colspan="4"><b>No record found.</b></td></tr>');
								}
						}
				});
		
		}
	
});


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

	if(formvalid){
			$.ajax({
					type:'POST',
					url:'<?php echo base_url();?>admin/Logg_ctrl/excel_download',
					dataType:'json',
					data:{from_date:from_date,to_date:to_date},
					beforeSend:function(){},
					success:function(response){
						openExcelfile(response.download);
					},
	
			});
	}
});

	function openExcelfile(strFilePath){
		openExcelDocPath(baseUrl + strFilePath, false);
	}

	function openExcelDocPath(strLocation, boolReadOnly){
		window.location.href = strLocation;
	} 

</script>




