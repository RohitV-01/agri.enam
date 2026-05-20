<div class="content-wrapper">
    <!-- Content Header (Page header) -->
	<ol class="breadcrumb">
        <li><a title="Home" href="<?php echo base_url();?>admin/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Commodity Category</li>
    </ol>   
   <section class="content-header">
      <h1>Commodity Categories</h1>
    </section>
	<!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-6 connectedSortable">
			<div class="box box-primary">
				<div class="box-header with-border">
				  <h3 class="box-title">Add New commodity category</h3>
				  <div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
					  <i class="fa fa-minus"></i></button>
				  </div>
				</div>
				<form id="commodity_cat_form" role="form" method="POST" class="form-horizontal" name="video_cat_form" action="<?php echo base_url();?>admin/Commodity_ctrl/category_create">
					<div class="box-body">
						<div class="form-group">
						  <label class="col-sm-3 control-label">Category Name</label>
						  <div class="col-sm-9">
						  	<input type="text" id="c_category_name" name="c_category_name" class="form-control" placeholder="Enter category name">
						   	<div id="v_category_name_error" class="response text-danger" ></div>
						   </div>
						  <div class="col-sm-9"><input type="hidden" id="c_cat_id" name="c_cat_id" class="form-control" value=""></div>
						</div>
					</div>
					<div class="box-footer">
						<button id="c_category_update" type="button" class="btn pull-right btn-info" style="display:none;">Update</button>
						<button id="c_category_create" type="button" class="btn pull-right btn-info">Submit</button>
						<button type="reset" id="c_category_reset" class="btn btn-default pull-right btn-space">Cancel</button>
					</div>
				</form>
			</div>
		</section>
		<section class="col-lg-6 connectedSortable">
		<div class="box box-primary">
			<div class="box-header with-border">
			  <h3 class="box-title">All Language List</h3>
			  <div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
				  <i class="fa fa-minus"></i></button>
			  </div>
			</div>
			<div class="box-body table-responsive no-padding">
				<table class="table table-hover">
					<thead>
					<tr>
                  <th>S.No.</th>
                  <th>Category</th>
                  <th>Edit/Delete</th>
					</tr>
				</thead>
					<tbody>			  		
					  <?php foreach($categories as $key => $category){	
							$key = $key + 1;
							echo '<tr><td>'. $key .'.</td>'.
									 '<td class="c_cat_list_item" data-cc_id="'.$category['c_id'].'">'.$category['cg_name'].'</td>'.
									 '<td><a href="javascript:void(0);" class="btn btn-info btn-flat commodity_cat_edit" data-cname="'.$category['cg_name'].'" data-cid="'.$category['c_id'].'"><i class="fa fa-pencil"></i></a>'.
									 '&nbsp;&nbsp;<a href="javascript:void(0);" class="btn btn-info btn-flat commodity_cat_delte" data-cid="'.$category['c_id'].'"><i class="fa fa-trash"></i></a></td>'.
								  '</tr>';
							}
						?>
					</tbody>
				</table>
            </div>
		</div>
		</section>
		</div>
		</section>
</div>

<script>
	var baseUrl = $('#base_url').val();
	$(document).on('click','.commodity_cat_edit',function(){
		$('#c_category_name').val($(this).data('cname'));
		$('#c_cat_id').val($(this).data('cid'));
		$('#c_category_create').css('display','none');
		$('#c_category_update').css('display','block');
	});	
	
	$(document).on('click','#c_category_reset',function(){
		$('#c_category_name').val();
		$('#c_cat_id').val();
		$('#c_category_create').css('display','block');
		$('#c_category_update').css('display','none');
	});
	
	$(document).on('click','#c_category_create,#c_category_update',function(){
		$('#commodity_cat_form').ajaxForm({
			    dataType : 'json',
			    beforeSubmit:function(e){
				    $('#loader').modal('show');
			    },
			    success:function(response){
			  	  if(response.status == 200){
				  	  $('#loader').modal('hide');
					alert(response.msg);
					location.reload();
			      }
			      else{
				    alert(response.msg);
			      }
			    }
		  }).submit();
	});


	 $(document).on('click','.commodity_cat_delte',function(){  
         var cat_id = $(this).data('cid'); 
         var c = confirm('Are You Sure');
         if(c){
             $.ajax({
				type: 'POST',
				url: baseUrl+'admin/Commodity_ctrl/comm_cat_delete',
				dataType: "json",
				data: {
					'cat_id': cat_id
				},
				beforeSend: function(){
					$('#loader').modal({'show':true});	
				},
				complete: function(){},
				success:function (response) {
					$('#loader').modal('toggle');
                                      alert(response.msg);
					location.reload();
				}
			});
         }
    });
	


   $(document).on('keyup','#c_category_name',function(){ 
			var c_cat_name = $('#c_category_name').val();
			$.ajax({
				type: 'POST',
				url: baseUrl+'admin/Commodity_ctrl/comm_cat_check',
				dataType: "json",
				data: {
					'c_cat_name': c_cat_name
				},
				beforeSend: function(){
				},
				complete: function(){},
				success:function (response){
					console.log(response.data);
					if(response.status == 500){
						$('#v_category_name_error').html("<span class='exists'>"+ response.msg +"</span>");
						$('#c_category_create').attr("disabled","disabled");
					}
					else{
							$('#v_category_name_error').hide();
							$('#c_category_create').attr("disabled",false);
						}
				}
			});
		});
</script>