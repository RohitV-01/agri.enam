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
		<li class="active">Run Sql Query</li>
	</ol>
	<section class="content-header">
		<h1 class="pull-left">Run</h1>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<!-- Left col -->
			<section class="col-lg-12 connectedSortable">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Run Sql Query</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
								<i class="fa fa-minus"></i>
							</button>
						</div>
					</div>
					<form name="video_form" id="import_form" role="form" class="form-horizontal" method="POST">
            			<div class="box-body">
            				<div class="form-group">
	            				<label class="col-sm-2 control-label"></label>
	            				<div class="col-sm-3">
	                				<input type="radio" name="query_check" id="query_check" value="select_query" checked>Select Query<br>
	      							<input type="radio" name="query_check" id="query_check" value="other">Other<br>			
	            				</div>
            				</div>
            				
            				<div class="form-group">
            					<label class="col-sm-2 control-label">Select Excel File</label>
            					<div class="col-sm-3">
            						<textarea rows="5" cols="100" class="form-control" name="box_query" id="box_query"></textarea>
            						<div class="text-danger" id="box_query_error" style="display:none;"></div>
            					</div>
            				</div>
            			 </div>
                		<div class="box-footer">
        					<button id="query_run" type="button" class="btn pull-right btn-info">Run</button>
        				</div>	
					</form>
					<br />
					<div class="table-responsive">
						<table class="table table-striped table-bordered">
							<thead id="column_name"></thead>
							<tbody id="query_list"></tbody>
						</table>
					</div>
				</div>
				</section>
			</div>
		</section>
	</div>
<script type="text/javascript">
	$(document).on('click','#query_run',function(){
		var query_check = $('input[name="query_check"]:checked').val();
		var box_query = $('#box_query').val();
		var formvalid = true;

		if(box_query == ''){
			$('#box_query_error').html('textarea not be empty').css('display','block');
			formvalid = false;
			}else{
				$('box_query_error').css('display','none');
				}

		if(formvalid){
			$.ajax({
					type:'POST',
					url:'<?php base_url();?>Query_ctrl/run_query',
					data:{box_query:box_query,query_check:query_check},
					dataType:'json',
					beforeSend:function(){},
					success:function(response){
						console.log(response);
						if(response.status == 200){
							if(response.msg){
								alert(response.msg);
							}
							var y = y;
							var i = 1;

							var x = '<tr>';
							x = x +'<th>Sr No.</th>';
							$.each(response.result[0],function(key,value){
								 x = x +'<th>'+key+'</th>';
						    });
							x = x + '</tr>';
							$('#column_name').html(x);

							$.each(response.result,function(k,val){
								y = y + '<tr>'+
								'<td>'+ i +'</td>';

								$.each(response.result[0],function(kk,vv){
									y = y + '<td>'+val[kk]+'</td>';
								});
						        
								y = y + '</tr>';
				        	i++;
							});
							$('#query_list').html(y);

						}else{
								alert(response.msg);
							}
					},
					error:function(){
					alert('Query Error..');
					}
				});
			}
	});
</script>