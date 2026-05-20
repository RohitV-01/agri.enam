<?php $group = $this->session->userdata('group_name'); ?>
<input type="hidden" name="u_group" id="u_group" value="<?php echo $group; ?>">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
	<ol class="breadcrumb">
        <li><a title="Home" href="<?php echo base_url();?>admin/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pop up</li>
    </ol>   
	<section class="content-header">
      	<h1 class="pull-left">Pop up</h1>
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
				  	<h3 class="box-title">Add New Pop up Notice</h3>
				  	<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
					  	<i class="fa fa-minus"></i></button>
				  	</div>
				</div>
				<p class="text-danger"><?php echo $this->session->flashdata('message'); ?></p>
				<form name="pop_form" id="pop_form" role="form" class="form-horizontal" method="POST" enctype="multipart/form-data" action="<?php echo base_url();?>admin/Pop_up_ctrl/Popup_notice_create">
					<div class="box-body">

						<div class="form-group">
							<label class="col-md-2 control-label">Title</label>
							<div class="col-sm-10">
								<input type="text" id="notice_title" name="notice_title" class="form-control" placeholder="Title"/>
								<div id="notice_title_error" class="text-danger" style="display:none;"></div>
								
							</div>
							
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Notice Description</label>
							<div class="col-sm-10">
								<textarea id="notice_desc" name="notice_desc" class="form-control" rows="10" placeholder="Enter description"></textarea>
								<div class="text-danger" id="notice_desc_error" style="display: none;"></div>
								<input id="notice_id" name="notice_id" type="hidden" class="form-control" value="" />
					            <script>
					                CKEDITOR.replace('notice_desc');
					            </script>
							</div>
						</div>
					
						<?php if($group != 'subadmin'){ ?>
						<div class="form-group">
							<label class="col-sm-2 control-label">Sort Order</label>
							<div class="col-sm-10">
								<input type="text" id="notice_order" name="notice_order" class="form-control" placeholder="Enter sort order" value="999" />
								<div id="notice_order_error" class="text-danger" style="display:none;"></div>
							</div>
						</div>
						<?php } ?>
					
					</div>
					<div class="box-footer">
						<button id="notice_create" type="button" class="btn pull-right btn-info">Save</button>
						<button id="notice_update" type="button" class="btn pull-right btn-info" style="display: none;">Update</button>
						<button type="reset" id="notice_reset" class="btn btn-default pull-right btn-space">Cancel</button>
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
			  <h3 class="box-title">All Pop up notice</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
					  <i class="fa fa-minus"></i></button>
				</div>
			</div>

			
				<table class="table">
					<tr>
						<th>News</th>
						<?php if($group != 'subadmin'){ ?>
							<th>Sort</th>
							<th>Publish</th>
						<?php } ?>
						<th>Action</th>
					</tr>
					<tbody id="news_list_table">
						<?php if(isset($popup_notice) && (count($popup_notice) > 0)){ 
							
								foreach($popup_notice as $notice) { //print_r($notice); ?>
								<?php if($notice['lang_id'] == 1) {  
									$find = 0;
									foreach($popup_notice as $new){
										if($new['popup_id'] == $notice['popup_id'] && $new['lang_id'] == $this->session->userdata('language')){
											$find = 1;
										}
									}
								?>
								<tr class="<?php if(!$find){ echo "find"; } ?> notice_highlight notice_highlight_<?php echo $notice['popup_id']; ?>" data-popup_id="<?php echo $notice['popup_id']; ?>">
									<td ><?php echo $notice['popup_content']; ?></td>
									<?php if($group != 'subadmin'){ ?>
										<td><?php echo $notice['sort']; ?></td>
										<td>
											<?php if($notice['publish']){ ?>
												<input class="notice_published" data-popup_id="<?php echo $notice['popup_id']; ?>" type="checkbox" checked />										
											<?php } else { ?>
												<input class="notice_published" data-popup_id="<?php echo $notice['popup_id']; ?>" type="checkbox" />
											<?php } ?>
										</td>
									<?php }  ?>
									<td>
										<?php if($group == 'subadmin'){ ?>
											<a title="Edit" class="btn btn-info btn-flat notice_tranlate" data-popup_id="<?php echo $notice['popup_id']?>"><i class="fa fa-edit"></i></a>
										<?php } else { ?>
											<a class="btn btn-info btn-flat notice_edit" data-popup_id="<?php echo $notice['popup_id']?>"><i class="fa fa-pencil"></i></a> 
									    	<a class="btn btn-info btn-flat notice_delete" data-popup_id="<?php echo $notice['popup_id']?>"><i class="fa fa-trash"></i></a>
										<?php } ?>
									</td>
								</tr>
						<?php } } } ?>
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
			  <h3 class="box-title">All Pop up notice</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
					  <i class="fa fa-minus"></i></button>
				</div>
			</div>

			
				<table class="table">
					<tr>
						<th>News</th>
						<?php if($group != 'subadmin'){ ?>
							<th>Sort</th>
							<th>Publish</th>
						<?php } ?>
						<th>Action</th>
					</tr>
					<tbody id="news_list_table">
						<?php if(isset($popup_notice) && (count($popup_notice) > 0)){ 
							
								foreach($popup_notice as $notice) { //print_r($notice); ?>
								<?php if($notice['lang_id'] == 1) {  
									$find = 0;
									foreach($popup_notice as $new){
										if($new['popup_id'] == $notice['popup_id'] && $new['lang_id'] == $this->session->userdata('language')){
											$find = 1;
										}
									}
								?>
								<tr class="<?php if(!$find){ echo "find"; } ?> notice_highlight notice_highlight_<?php echo $notice['popup_id']; ?>" data-popup_id="<?php echo $notice['popup_id']; ?>">
									<td ><?php echo $notice['popup_content']; ?></td>
									<?php if($group != 'subadmin'){ ?>
										<td><?php echo $notice['sort']; ?></td>
										<td>
											<?php if($notice['publish']){ ?>
												<input class="notice_published" data-popup_id="<?php echo $notice['popup_id']; ?>" type="checkbox" checked />										
											<?php } else { ?>
												<input class="notice_published" data-popup_id="<?php echo $notice['popup_id']; ?>" type="checkbox" />
											<?php } ?>
										</td>
									<?php }  ?>
									<td>
										<?php if($group == 'subadmin'){ ?>
											<a title="Edit" class="btn btn-info btn-flat notice_tranlate" data-popup_id="<?php echo $notice['popup_id']?>"><i class="fa fa-edit"></i></a>
										<?php } else { ?>
											<a class="btn btn-info btn-flat notice_edit" data-popup_id="<?php echo $notice['popup_id']?>"><i class="fa fa-pencil"></i></a> 
									    	<a class="btn btn-info btn-flat notice_delete" data-popup_id="<?php echo $notice['popup_id']?>"><i class="fa fa-trash"></i></a>
										<?php } ?>
									</td>
								</tr>
						<?php } } } ?>
					</tbody>
				</table>
            </div>
		</section>
		</div>
	</section>
</div>

<script>
	
</script>