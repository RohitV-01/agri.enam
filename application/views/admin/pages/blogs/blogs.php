<?php //print_r($this->session->all_userdata()); die;?>
<?php $group = $this->session->userdata('group_name'); ?>
<input type="hidden" name="#u_group" id="#u_group" value="<?php echo $group; ?>">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
	<ol class="breadcrumb">
        <li><a title="Home" href="<?php echo base_url();?>admin/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Enam Blogs</li>
    </ol>   
	<section class="content-header">
      <h1 class="pull-left">Enam Blogs</h1>
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
			  <h3 class="box-title">Add New Blogs</h3>
			  <div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
				  <i class="fa fa-minus"></i></button>
			  </div>
			</div>
			<p class="text-danger"><?php echo $this->session->flashdata('message'); ?></p>
			<form name="blog_form" id="blog_form" role="form" class="form-horizontal" method="POST" enctype="multipart/form-data" action="<?php echo base_url();?>admin/Blog_ctrl/blog_create">

				<div class="box-body">
					<div class="form-group">
						<label class="col-sm-2 control-label">Apmc : State</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="apmcstate" id="apmcstate">
							<div id="apmcstate_error" class="text-danger" style="display:none;"></div>
						</div>
						
					</div>
				</div>


				<?php if($group != 'subadmin'){ ?>
					<div class="box-body">
						<div class="form-group">
							<label class="col-sm-2 control-label">Images <br>(369 X 214)</label>
							<div class="col-sm-10">
								<input type="file" name="userFiles" id="userFiles" class="form-control">
								<div class="text-danger" id="userfile_error" style="display:none;"></div>
							</div>
						</div>
					</div>
				<?php } ?>
				<div class="box-body">
					<div class="form-group">
						<label class="col-sm-2 control-label">Blog Title</label>
						<div class="col-sm-10">
							<textarea id="blog_title" name="blog_title" class="form-control" rows="10" placeholder="Enter description"></textarea>
							<div class="text-danger" id="blog_title_error" style="display: none;"></div>
			            	<script>
			                	CKEDITOR.replace('blog_title');
			            	</script>
						</div>
					</div>
				</div>
				<div class="box-body">
					<div class="form-group">
						<label class="col-sm-2 control-label">Blog Description</label>
						<div class="col-sm-10">
							<textarea id="blog_desc" name="blog_desc" class="form-control" rows="10" placeholder="Enter description"></textarea>
							<div class="text-danger" id="blog_desc_error" style="display: none;"></div>
							<input id="blog_id" name="blog_id" type="hidden" class="form-control" value="" />
				            <script>
				                CKEDITOR.replace('blog_desc');
				            </script>
						</div>
					</div>
				</div>
				
				<?php if($group != 'subadmin'){ ?>
					<div class="box-body">
						<div class="form-group">
							<label class="col-sm-2 control-label">Sort Order</label>
							<div class="col-sm-10">
								<input type="text" id="blog_order" name="blog_order" class="form-control" placeholder="Enter sort order" value="999" />
								<div id="blog_order_error" class="text-danger" style="display:none;"></div>
							</div>
						</div>
					</div>
				
				<?php } ?>

				<div class="box-body">
					<div class="form-group">
						<label class="col-sm-2 control-label">Publisher</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="publisher" id="publisher">
							<div id="publisher_error" class="text-danger" style="display:none;"></div>
						</div>
						
					</div>
				</div>
				
			</div>
				<div class="box-footer">
					<button id="blog_create" type="button" class="btn pull-right btn-info">Save</button>
					<button id="blog_update" type="button" class="btn pull-right btn-info" style="display: none;">Update</button>
					<button type="button" id="blog_reset" class="btn btn-default pull-right btn-space">Cancel</button>
				</div>
			</form>
		</section>
		
		<?php if($group == 'subadmin'){ ?>
			<section class="col-lg-4 connectedSortable">
		<?php }else { ?>
			<section class="col-lg-6 connectedSortable">
		<?php } ?>
		<div class="box box-primary">
			<div class="box-header with-border">
			  <h3 class="box-title">All Blogs</h3>
			  <div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
				  <i class="fa fa-minus"></i></button>
			  </div>
			</div>

			<div class="box-body">
				<table class="table">
					<tr>
						<th>Image</th>
						<th>Blog</th>
						<?php if($group != 'subadmin'){ ?>
							<th>Sort</th>
							<th>Publish</th>
						<?php } ?>
						<th>Action</th>
					</tr>
					<tbody>
						
						
						<?php if(isset($Blogs_client) && (count($Blogs_client) > 0)){
								foreach($Blogs_client as $Blog_client) { ?>
								<?php if($Blog_client['lang_id'] == 1) {
									$find = 0;
									foreach($Blogs_client as $Blog){
										if($Blog['blog_Id'] == $Blog_client['b_id'] && $Blog['lang_id'] == $this->session->userdata('language')){
											$find = 1;
										}
									}
								?>
								<tr class="<?php if(!$find){ echo "find"; } ?>">
									<td ><img width="150" src="<?php echo base_url().'assest/images/blogs/'.$Blog_client['blog_image']; ?>"></td>
									<td ><?php echo $this->substring->trim_text($Blog_client['blog_content'],100); ?></td>
									<?php if($group != 'subadmin'){ ?>
										<td><?php echo $Blog_client['sort']; ?></td>
										<td>
											<?php if($Blog_client['publish']){ ?>
												<input class="blog_published" data-blog_id="<?php echo $Blog_client['b_id']; ?>" type="checkbox" checked />										
											<?php } else { ?>
												<input class="blog_published" data-blog_id="<?php echo $Blog_client['b_id']; ?>" type="checkbox" />
											<?php } ?>
										</td>
									<?php } ?>
									<td>
										<?php if($group == 'subadmin'){ ?>
											<a class="btn btn-info btn-flat blog_tranlate" data-blog_id="<?php echo $Blog_client['b_id']; ?>"><i class="fa fa-language"></i></a>
										<?php } else { ?>
											<a class="btn btn-info btn-flat blog_edit" data-blog_id="<?php echo $Blog_client['b_id']; ?>"><i class="fa fa-pencil"></i></a> 
									    	<a class="btn btn-info btn-flat blog_delete" data-blog_id="<?php echo $Blog_client['b_id']; ?>"><i class="fa fa-trash"></i></a>
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
			  	<h3 class="box-title">All Menus (<?php echo $language['l_name']; ?>)</h3>
			<?php } ?>
			  <div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
				  <i class="fa fa-minus"></i></button>
			  </div>
			</div>

			<div class="box-body">
				<table class="table">
					<tr>
						<th>Stories</th>
						<?php if($group != 'subadmin'){ ?>
							<th>Sort</th>
							<th>Publish</th>
						<?php } ?>
						<th>Action</th>
					</tr>
					<tbody>
						<?php if(isset($Blogs_client) && (count($Blogs_client) > 0)){ 
								foreach($Blogs_client as $Blog_client) {  ?>
								<?php if($Blog_client['lang_id'] == $this->session->userdata('language')) { ?>
								<tr>
									<td><?php echo $Blog_client['blog_content']; ?></td>
									<?php if($group != 'subadmin'){ ?>
										<td><?php echo $Blog_client['sort']; ?></td>
										<td>
											<?php if($news['publish']){ ?>
												<input class="blog_published"
													data-data_id="<?php echo $Blog_client['blog_Id']?>"
													type="checkbox" checked /> <?php } else { ?>
												<input class="blog_published" data-data_id="<?php echo $Blog_client['blog_Id']?>" type="checkbox" />
											<?php } ?>
										</td>
									<?php } ?>
									<td>
										<?php if($group == 'subadmin'){ ?>
											<a title="" class="btn btn-info btn-flat blog_tranlate" data-blog_id="<?php echo $Blog_client['blog_Id']; ?>"><i class="fa fa-language"></i></a>
										<?php } else { ?>
											<a title="Edit" class="btn btn-info btn-flat news_edit" data-blog_id="<?php echo $Blog_client['blog_Id']; ?>"><i class="fa fa-pencil"></i></a> 
									    	<a title="Delete" class="btn btn-info btn-flat news_delete" data-story_id="<?php echo $Blog_client['blog_Id']; ?>"><i class="fa fa-trash"></i></a>
										<?php } ?>
									</td>
								</tr>
						<?php } } }?>
					</tbody>
				</table>
            </div>
		</div>	
		</div>
		</section>
		</div>
		</section>
</div>
