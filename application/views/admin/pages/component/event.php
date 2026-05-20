<?php $group = $this->session->userdata('group_name'); ?>
<input type="hidden" name="u_group" id="u_group" value="<?php echo $group; ?>">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
	<ol class="breadcrumb">
        <li><a title="Home" href="<?php echo base_url();?>admin/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Events</li>
    </ol>   
	<section class="content-header">
      <h1 class="pull-left">Events</h1>
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
			  <h3 class="box-title">Add New Event</h3>
			  <div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
				  <i class="fa fa-minus"></i></button>
			  </div>
			</div>
			<form name="event_form" id="event_form" role="form" class="form-horizontal" method="POST" enctype="multipart/form-data" action="<?php echo base_url();?>admin/Event_ctrl/event_create">
			<div class="box-body">
			<?php if($group != 'subadmin'){ ?>
				<div class="form-group">
					<label class="col-sm-2 control-label">Image <br/>(308 X 205)</label>
					<div class="col-sm-10">
						<input type="file" name="userFiles" id="userFiles" class="form-control">
						<div class="text-danger" id="userfile_error" style="display:none;"></div>
					</div>
				</div>
			<?php } ?>
				
				<div class="form-group">
					<label class="col-sm-2 control-label">Event Title</label>
					<div class="col-sm-10">
						<input type="text" name="event_title" id="event_title" class="form-control">
						<div class="text-danger" id="event_title_error" style="display:none;"></div>
					</div>
				</div>
				<?php if($group != 'subadmin'){ ?>
				<div class="form-group">
					<label class="col-sm-2 control-label">Please Select Category</label>
			   <div class="col-sm-10">
			   	<select class="col-sm-2 form-control" id="event_category" name="event_category">
			   	<div class="text-danger" id="event_category_error" style="display:none;"></div>
			   		<option value="national">National Level </option>
			   		<option value="state">State Level </option>
			   		<option value="Event3_eNAM_GLIMPSES">Event3 eNAM GLIMPSES Level </option>
			   	</select>
			   </div>
			   </div>
			   <?php } ?>
				<div class="form-group">
					<label class="col-sm-2 control-label">Event Description</label>
					<div class="col-sm-10">
						<textarea id="event_desc" name="event_desc" class="form-control" rows="10"></textarea>
						<div class="text-danger" id="event_desc_error" style="display:none;"></div>
						<input id="event_id" name="event_id" type="hidden" class="form-control" value="" />
			            <script>
			                CKEDITOR.replace('event_desc');
			            </script>
					</div>
				</div>
				<?php if($group != 'subadmin'){ ?>
				<div class="form-group">
					<label class="col-sm-2 control-label">Sort Order</label>
					<div class="col-sm-10">
						<input type="text" id="event_order" name="event_order" class="form-control" placeholder="Enter sort order" value="999"/>
						<div class="text-danger" id="event_order_error" style="display:none;"></div>
					</div>
				</div>
				<?php } ?>
			</div>
				<div class="box-footer">
					<button id="event_create" type="button" class="btn pull-right btn-info">Save</button>
					<button id="event_update" type="button" class="btn pull-right btn-info" style="display: none;">Update</button>
					<button type="reset" id="event_reseet" class="btn btn-default pull-right btn-space">Cancel</button>
				</div>
			</form>
		</div>
		</section>
		
		<?php if($group == 'subadmin'){ ?>
			<section class="col-lg-4 connectedSortable">
		<?php }else { ?>
			<section class="col-lg-6 connectedSortable">
		<?php } ?>
		<div class="box box-primary">
			<div class="box-header with-border">
			  <h3 class="box-title">All Events</h3>
			  <div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
				  <i class="fa fa-minus"></i></button>
			  </div>
			</div>

			<div class="box-body" id="event_box_list">
				<div class="form-group">
				<div class="col-md-2">
					<label>Sort</label>
				<select class="form-control" id="event_sort_drop_down">
					<option value="ASC">ASC.</option>
					<option value="DESC">DESC.</option>
				</select>
				</div>
<div class="col-md-2">
				<label>Publish</label>
				<select class="form-control" id="event_publish_drop_down">
					<option value="-1">Event Publish/Un-Publish</option>
					<option value="1">Yes</option>
					<option value="0">No</option>
				</select>
				</div>
		<div class="col-md-2">
                                <label for="cat">Category</label>
                                <select class="form-control" id="cat" name="cat">
                                        <option value="">Select Category</option>
                                        <option value="national">National</option>
                                        <option value="state">State</option>
                                </select>
                                </div>
<div class="col-md-3">
<label>&nbsp;</label>
				<input class="form-control" type="text" id="event_text" placeholder="Enter event title" />
				</div>
<div class="col-md-3">
<label>&nbsp;</label>
				<input type="button" id="event_filter_search" class="form-control btn btn-info" value="Search" />
				</div>
<div class="col-md-2">
<label>&nbsp;</label>
				<select class="form-control" id="no_pages">
					<option value="0">-- All --</option>
				</select>
				</div>
				</div>
				<table class="table events-edit-bg">
					<tr>
						<th>Image</th>
						<th>Event</th>
						<th>Category</th>
						<?php if($group != 'subadmin') { ?>
							<th>Sort</th>
							<th>Publish</th>
						<?php } ?>
						<th>Action</th>
					</tr>
					<tbody id="event_list_table">
						<?php if(isset($events) && (count($events) > 0)){ 
								foreach($events as $event) { ?>
								<?php if($event['lang_id'] == 1) {
									$find=0;
									foreach($events as $even){
										if($even['event_id'] == $event['event_id'] && $even['lang_id'] == $this->session->userdata('language')){
											$find = 1;
										}
									}
									?>
									<tr class="<?php if(!$find){ echo "find"; } ?> event_highlight event_highlight_<?php echo $event['event_id']; ?>" data-event_id="<?php echo $event['event_id']; ?>">
									<td><img width="90" src="<?php echo base_url()."Event_gallary/".$event['event_image']; ?>"></td>
									<td ><?php echo substr($event['title'],0,100); ?></td>
									<td><?php echo $event['event_category']; ?></td>
									<?php if($group != 'subadmin'){ ?>
										<td><?php echo $event['sort']; ?></td>
										<td>
											<?php if($event['publish']){ ?>
												<input class="event_published" data-event_id="<?php echo $event['event_id']?>" type="checkbox" checked />										
											<?php } else { ?>
												<input class="event_published" data-event_id="<?php echo $event['event_id']?>" type="checkbox" />
											<?php } ?>
										</td>
									<?php } ?>
									<td>
										<?php if($group == 'subadmin'){ ?>
											<a class="btn btn-info btn-flat event_tranlate" data-event_id="<?php echo $event['event_id']; ?>"><i class="fa fa-language"></i></a>
										<?php } else { ?>
											<a class="btn btn-info btn-flat event_edit" data-event_id="<?php echo $event['event_id']; ?>"><i class="fa fa-pencil"></i></a> 
									    	<a class="btn btn-info btn-flat event_delete" data-event_id="<?php echo $event['event_id']; ?>"><i class="fa fa-trash"></i></a>
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
			  	<h3 class="box-title">All Events (<?php echo $language['l_name']; ?>)</h3>
			<?php } ?>
			  <div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
				  <i class="fa fa-minus"></i></button>
			  </div>
			</div>

			<div class="box-body">
				<table class="table">
					<tr>
						<th>Image</th>
						<th>Event</th>
						<?php if($group != 'subadmin'){ ?>
							<th>Sort</th>
							<th>Publish</th>
						<?php } ?>
						<th>Action</th>
					</tr>
					<tbody>
						<?php if(isset($events) && (count($events) > 0)){ 
								foreach($events as $event) { ?>
								<?php if($event['lang_id'] == $this->session->userdata('language')) { ?>
								<tr class="event_highlight event_highlight_<?php echo $event['event_id']; ?>" data-event_id="<?php echo $event['event_id']; ?>">
									<td><img width="90" src="<?php echo base_url()."Event_gallary/".$event['event_image']; ?>"></td>
									<td><?php echo substr($event['title'],0,100); ?></td>
									<?php if($group != 'subadmin'){ ?>
										<td><?php echo $event['sort']; ?></td>
										<td>
											<?php if($news['publish']){ ?>
												<input class="event_published" data-event_id="<?php echo $event['event_id']; ?>" type="checkbox" checked />										
											<?php } else { ?>
												<input class="event_published" data-event_id="<?php echo $event['event_id']; ?>" type="checkbox" />
											<?php } ?>
										</td>
									<?php } ?>
									<td>
										<?php if($group == 'subadmin'){ ?>
											<a class="event_tranlate" data-event_id="<?php echo $event['event_id']?>"><i class="fa fa-language"></i></a>
										<?php } else { ?>
											<a class="event_edit" data-event_id="<?php echo $event['event_id']?>"><i class="fa fa-pencil"></i></a> 
									    	<a class="event_delete" data-event_id="<?php echo $event['event_id']?>"><i class="fa fa-trash"></i></a>
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
	
	//filter(1);
	$(document).on('click','#event_filter_search',function(){
		filter(1);
	});	
	$(document).on('change','#no_pages',function(){
		filter(0);
	});	
	
	function filter(i = 1){
		var publish = $('#event_publish_drop_down').val();
		var sort = $('#event_sort_drop_down').val();
		var event_text = $('#event_text').val();
		var no_pages = $('#no_pages').val();
		var cat = $('#cat').val();
		var ii = i;
		if(ii){
			no_pages = 0;
		}
		$.ajax({
	        type: 'POST',
	        url: baseUrl+'admin/Ajax_ctrl/event_filter',
	        dataType: "json",
	        data: {
	        	'sort' : sort,
				'publish' : publish,
				'cat' : cat,
				'title' : event_text,
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
						x = x + '<tr class="event_highlight event_highlight_'+ value.event_id +'" data-event_id="'+ value.event_id +'">'+
									'<td><img width="90" src="'+ baseUrl +'Event_gallary/'+ value.event_image +'"></td>'+
									'<td>'+ value.title +'</td>'+
									'<td>'+ value.event_category +'</td>';
									if($('#u_group').val() != 'subadmin'){
										x = x +'<td>'+ value.sort +'</td>';
									}
									x = x + '<td>';
									if($('#u_group').val() != 'subadmin'){
										if(value.publish == 1){
											x = x + '<input class="event_published" data-event_id="'+ value.event_id +'" type="checkbox" checked="checked">';
										}
										else{
											x = x + '<input class="event_published" data-event_id="'+ value.event_id +'" type="checkbox">';
										}
									}
									x = x + '</td>'+
									'<td>'+
										'<a class="btn btn-info btn-flat event_edit" data-event_id="'+ value.event_id +'"><i class="fa fa-pencil"></i></a>'+
									    '<a class="btn btn-info btn-flat event_delete" data-event_id="'+ value.event_id +'"><i class="fa fa-trash"></i></a>'+
									'</td>'+
								'</tr>';
					});
					$('#event_list_table').html(x);
				}
				else{
					$('#event_list_table').html('No videos found on this filter.');
					$('#no_pages').html('<option>-- All --</option>');
				}
	        }
		});
	}
	
	$(document).on('mouseenter','.event_highlight',function(){
		var id = $(this).data('event_id');
		$('.event_highlight_'+id).addClass('highlight');
	});
	
	$(document).on('mouseleave','.event_highlight',function(){
		var id = $(this).data('event_id');
		$('.event_highlight_'+id).removeClass('highlight');
	});
</script>