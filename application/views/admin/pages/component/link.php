<?php $group = $this->session->userdata('group_name'); ?>
<input type="hidden" name="u_group" id="u_group" value="<?php echo $group; ?>">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
	<ol class="breadcrumb">
        <li><a title="Home" href="<?php echo base_url();?>admin/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Links</li>
    </ol>   
	<section class="content-header">
      <h1 class="pull-left">Links</h1>
    </section>
	<!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- Left col -->
        
        <?php if($group == 'subadmin'){ ?>
			<section class="col-lg-4 connectedSortable">
		<?php } else { ?>
			<section class="col-lg-6 connectedSortable">
		<?php } ?>
		<div class="box box-primary">
			<div class="box-header with-border">
			  <h3 class="box-title">Add New Links</h3>
			  <div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
				  <i class="fa fa-minus"></i></button>
			  </div>
			</div>
			<form name="link_form" id="link_form" role="form" class="form-horizontal" method="POST" enctype="multipart/form-data" action="<?php echo base_url();?>admin/Links_ctrl/link_create">
			<div class="box-body">
				<div class="form-group">
					<label class="col-sm-2 control-label">Link content</label>
					<div class="col-sm-10">
						<textarea id="link_desc" name="link_desc" class="form-control" rows="10"></textarea>
						<div class="text-danger" id="link_desc_error" style="display: none;"></div>
						<input id="link_id" name="link_id" type="hidden" class="form-control" value="" />
			            <script>
			                CKEDITOR.replace('link_desc');
			            </script>
					</div>
				</div>
				
				<?php if($group != 'subadmin'){ ?>
				<div class="form-group">
					<label class="col-sm-2 control-label">Sort Order</label>
					<div class="col-sm-10">
						<input type="text" id="link_order" name="link_order" class="form-control" value="999" placeholder="Enter sort order" />
						<div class="text-danger" id="link_order_error" style="display: none;"></div>
					</div>
				</div>
				<?php } ?>
				
			</div>
			</form>
			<div class="box-footer">
				<button id="link_create" type="submit" class="btn pull-right btn-info">Save</button>
				<button id="link_update" type="submit" class="btn pull-right btn-info" style="display: none;">Update</button>
				<button type="reset" id="link_reset" class="btn btn-default pull-right btn-space">Cancel</button>
			</div>
		</div>
		</section>
		
		<?php if($group == 'subadmin'){ ?>
			<section class="col-lg-4 connectedSortable">
		<?php }else { ?>
			<section class="col-lg-6 connectedSortable">
		<?php } ?>
		<div class="box box-primary">
			<div class="box-header with-border">
			  <h3 class="box-title">All Links</h3>
			  <div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
				  <i class="fa fa-minus"></i></button>
			  </div>
			</div>
			
			<div class="box-body">
				<div class="form-group">
				<div class="col-md-2">
					<label>Sort</label>
					<select class="form-control" id="link_sort_drop_down">
						<option value="ASC">ASC.</option>
						<option value="DESC">DESC.</option>
					</select>
					</div>
<div class="col-md-2">
					<label>Publish</label>
					<select class="form-control" id="link_publish_drop_down">
						<option value="-1">Select link Publish/Un-Publish</option>
						<option value="1">Yes</option>
						<option value="0">No</option>
					</select>
					</div>
<div class="col-md-3">
<label>&nbsp;</label>
					<input class="form-control" type="text" id="link_text" placeholder="Enter link title" />
					</div>
<div class="col-md-3">
<label style="clear:both;width:100%;">&nbsp;</label>
					<input type="button" id="link_filter_search" class="btn btn-info" value="Search" />
					<input type="button" onclick="location.reload();" class="btn btn-default" value="Reset" />
					</div>
<div class="col-md-2">
<label>&nbsp;</label>
					<select class="form-control" id="no_pages">
						<option value="0">-- All --</option>
					</select>
				</div>
				</div>
				<table class="table">
					<tr>
						<th>Links</th>
						<?php if($group != 'subadmin'){ ?>
							<th>Sort</th>
							<th>Publish</th>
						<?php } ?>
						<th>Action</th>
					</tr>
					<tbody id="link_list_table">
						<?php if(isset($links) && (count($links) > 0)){ 
								foreach($links as $link) { ?>
								<?php if($link['lang_id'] == 1) {
									$find=0;
									foreach($links as $lin){
										if($lin['link_id'] == $link['link_id']  && $lin['lang_id'] == $this->session->userdata('language')){
											$find = 1;
										}
									}
									?>
								<tr class="<?php if(!$find){ echo "find"; } ?> link_highlight link_highlight_<?php echo $link['link_id'];?>" data-link_id="<?php echo $link['link_id'];?>">
									<td><?php echo $link['link_contect']; ?></td>
									
									<?php if($group != 'subadmin'){ ?>
										<td><?php echo $link['sort']; ?></td>
										<td>
											<?php if($link['publish']){ ?>
												<input class="link_published" data-link_id="<?php echo $link['link_id'];?>" type="checkbox" checked />										
											<?php } else { ?>
												<input class="link_published" data-link_id="<?php echo $link['link_id'];?>" type="checkbox" />
											<?php } ?>
										</td>
									<?php } ?>
									<td>
										<?php if($group == 'subadmin'){ ?>
											<a class="btn btn-info btn-flat link_tranlate" data-link_id="<?php echo $link['link_id']?>"><i class="fa fa-language"></i></a>
										<?php } else { ?>
											<a class="btn btn-info btn-flat link_edit" data-link_id="<?php echo $link['link_id']?>"><i class="fa fa-pencil"></i></a> 
									    	<a class="btn btn-info btn-flat link_delete" data-link_id="<?php echo $link['link_id']?>"><i class="fa fa-trash"></i></a>
										<?php } ?>
									</td>
								</tr>
						<?php } } }?>
					</tbody>
				</table>
            </div>

			
		</div>
		</section>
		
		<?php if($group == 'subadmin'){ ?>
			<section class="col-lg-4 connectedSortable" style="display: block;">
		<?php } else { ?>
			<section class="col-lg-4 connectedSortable" style="display: none;">
		<?php } ?>
		<div class="box box-primary">
			<div class="box-header with-border">
			<?php if(isset($language)){ ?>
			  	<h3 class="box-title">All Links (<?php echo $language['l_name']; ?>)</h3>
			<?php } ?>
			  <div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
				  <i class="fa fa-minus"></i></button>
			  </div>
			</div>

			<div class="box-body">
				<table class="table">
					<tr>
						<th>Links</th>
						<?php if($group != 'subadmin'){ ?>
							<th>Sort</th>
							<th>Publish</th>
						<?php } ?>
						<th>Action</th>
					</tr>
					<tbody>
						<?php if(isset($links) && (count($links) > 0)){ 
								foreach($links as $link) { ?>
								<?php if($link['lang_id'] == $this->session->userdata('language')) { ?>
								<tr class="link_highlight link_highlight_<?php echo $link['link_id'];?>" data-link_id="<?php echo $link['link_id'];?>">  
									<td><?php echo $link['link_contect']; ?></td>
									<?php if($group != 'subadmin'){ ?>
										<td><?php echo $link['sort']; ?></td>
										<td>
											<?php if($link['publish']){ ?>
												<input class="link_published" data-link_id="<?php echo $link['link_id']?>" type="checkbox" checked />										
											<?php } else { ?>
												<input class="link_published" data-link_id="<?php echo $link['link_id']?>" type="checkbox" />
											<?php } ?>
										</td>
									<?php } ?>
									<td>
										<?php if($group == 'subadmin'){ ?>
											<a title="" class="link_tranlate" data-link_id="<?php echo $link['link_id']?>"><i class="fa fa-language"></i></a>
										<?php } else { ?>
											<a title="Edit" class="link_edit" data-news_id="<?php echo $link['link_id']?>"><i class="fa fa-pencil"></i></a> 
									    	<a title="Delete" class="link_delete" data-news_id="<?php echo $link['link_id']?>"><i class="fa fa-trash"></i></a>
										<?php } ?>
									</td>
								</tr>
						<?php } } }?>
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
	
	filter(1);
	$(document).on('click','#link_filter_search',function(){
		filter(1);
	});	
	$(document).on('change','#no_pages',function(){
		filter(0);
	});	
	
	function filter(i = 1){
		var publish = $('#link_publish_drop_down').val();
		var sort = $('#link_sort_drop_down').val();
		var link_text = $('#link_text').val();
		var no_pages = $('#no_pages').val();
		var ii = i;
		if(ii){
			no_pages = 0;
		}
		$.ajax({
	        type: 'POST',
	        url: baseUrl+'admin/Ajax_ctrl/quick_link_filter',
	        dataType: "json",
	        data: {
	        	'sort' : sort,
				'publish' : publish,
				'title' : link_text,
				'page' : no_pages
	        },
	        beforeSend: function(){},
	        complete: function(){},
	        success:function (response) {
				if(response.status == 200){
					if(ii){
						var len = Math.ceil(response.count/10);
						y = '';
						for(var i = 1; i <= len; i++){
							y = y + '<option value="'+ i +'">'+ i +'</option>';
						}
						$('#no_pages').html(y);
					}
					var x = '';
					$.each(response.data,function(key,value){
						x = x + '<tr class="link_highlight link_highlight_'+ value.link_id +'" data-link_id="'+ value.link_id +'">'+
									'<td>'+ value.link_contect +'</td>';
									if($('#u_group').val() != 'subadmin'){
										x = x +'<td>'+ value.sort +'</td>';
									}
									x = x +'<td>';
									if($('#u_group').val() != 'subadmin'){
										if(value.publish == 1){
											x = x + '<input class="link_published" data-link_id="'+ value.link_id +'" type="checkbox" checked="checked">';
										}
										else{
											x = x + '<input class="link_published" data-link_id="'+ value.link_id +'" type="checkbox">';
										}
									}
									x = x + '</td>'+
									'<td>'+
										'<a class="btn btn-info btn-flat link_edit" data-link_id="'+ value.link_id +'"><i class="fa fa-pencil"></i></a>'+
									    '<a class="btn btn-info btn-flat link_delete" data-link_id="'+ value.link_id +'"><i class="fa fa-trash"></i></a>'+
									'</td>'+
								'</tr>';
					});
					console.log(x);
					$('#link_list_table').html(x);
				}
				else{
					$('#link_list_table').html('No Quick Link found on this filter.');
					$('#no_pages').html('<option>-- All --</option>');
				}
	        }
		});
	}
	
	$(document).on('mouseenter','.link_highlight',function(){
		var id = $(this).data('link_id');
		$('.link_highlight_'+id).addClass('highlight');
	});
	
	$(document).on('mouseleave','.link_highlight',function(){
		var id = $(this).data('link_id');
		$('.link_highlight_'+id).removeClass('highlight');
	});
	
</script>