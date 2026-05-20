<?php $group = $this->session->userdata('group_name'); ?>
<input type="hidden" name="u_group" id="u_group" value="<?php echo $group; ?>">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
	<ol class="breadcrumb">
        <li><a title="Home" href="<?php echo base_url();?>admin/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Mobile Notification</li>
    </ol>   
	<section class="content-header">
      	<h1 class="pull-left">Mobile Notification</h1>
    </section>
	<!-- Main content -->
    <section class="content">
      	<div class="row">
        <!-- Left col -->
        
	        <?php if($group == 'subadmin'){ ?>
				<section class="col-lg-4 connectedSortable">
			<?php } else { ?>
				<section class="col-lg-8 connectedSortable">
			<?php } ?>
			<div class="box box-primary">
				<div class="box-header with-border">
				  	<h3 class="box-title">Add New Mobile Notification</h3>
				  	<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
					  	<i class="fa fa-minus"></i></button>
				  	</div>
				</div>
				<?php date_default_timezone_set("Asia/Kolkata");
					$date = date("Y-m-d");
				?>
				<input type="hidden" id="current_date" value="<?php echo $date;?>">
				<p class="text-danger"><?php echo $this->session->flashdata('message'); ?></p>
				<form name="notification_form" id="notification_form" role="form" class="form-horizontal" method="POST" enctype="multipart/form-data" action="<?php echo base_url();?>admin/Pop_up_ctrl/mobile_notification_create">
					<div class="box-body">
						<div class="col-sm-12">
							<div class="form-group">
								<label class="col-md-2 control-label">From Date</label>
								<div class="col-sm-4">
									<input type="date" id="from_date" name="from_date" class="form-control" min="<?php echo date('Y-m-d'); ?>"/>
									<div id="from_date_error" class="text-danger" style="display:none;"></div>
									
								</div>
								<label class="col-md-2 control-label">To Date</label>
								<div class="col-sm-4">
									<input type="date" id="to_date" name="to_date" class="form-control" min="<?php echo date('Y-m-d'); ?>"/>
									<div id="to_date_error" class="text-danger" style="display:none;"></div>
									
								</div>
								
							</div>
						</div><br>

						<div class="form-group">
							<label class="col-md-2 control-label">Title</label>
							<div class="col-sm-4">
								<input type="text" id="msg_title" name="msg_title" class="form-control" maxlength = "200" placeholder="Enter only 200 characters"/>
								<div id="msg_title_error" class="text-danger" style="display:none;"></div>
							</div>
							
								<label  class="col-md-2 control-label">Language</label>
								<div class="col-sm-4">
									<select class="form-control" id="lang_id1" name="lang_id1">
                                        <option value="en" >English</option>
										<option value="hi">हिंदी (HINDI)</option>
										<option value="gu">ગુજરાતી (GUJRATI)</option>
										<option value="ma">मराठी (MARATHI)</option>
										<option value="te">తెలుగు (TELUGU)</option>
										<option value="bn">বাঙালি (BANGLA)</option>
										<option value="ta">தமிழ் (TAMIL)</option>
										<option value="or">ଓଡ଼ିଆ (ORIA)</option>
										<option value="pu">ਪੰਜਾਬੀ (PUNJABI)</option>
										<option value="ml"> മല്യാലം (MALAYAM)</option>
										<option value="kn">ಕನ್ನಡ (KANNAD)</option>
										<option value="dgr">डोगरी (DOGRI)</option>
										<option value="as">Assam (ASSAM)</option>
									</select>
								<div id="lang_id_error" class="text-danger" style="display:none;">
								</div></div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Message Body</label>
							<div class="col-sm-10">
								<textarea id="msg_body" name="msg_body" class="form-control" rows="9" placeholder="Enter Message only 1000 characters" maxlength="1000"></textarea>
								<div class="text-danger" id="msg_body_error" style="display: none;"></div>
								<input id="msg_id" name="msg_id" type="hidden" class="form-control" value="" />
					           <!--  <script>
					                CKEDITOR.replace('msg_body');
					            </script> -->
							</div>
						</div>	
                        <?php if($group != 'subadmin'){ ?>
						<div class="form-group">
							<label class="col-sm-2 control-label">Sort Order</label>
							<div class="col-sm-10">
								<input type="text" id="display_order" name="display_order" class="form-control" placeholder="Enter display order" value="" />
								<div id="display_order_error" class="text-danger" style="display:none;"></div>
							</div>
						</div>
						<?php } ?>					
					</div>
					<div class="box-footer">
						<button id="notification_create" type="button" class="btn pull-right btn-info">Save</button>
						<button id="notification_update" type="button" class="btn pull-right btn-info" style="display: none;">Update</button>
						<button type="reset" id="notification_reset" class="btn btn-default pull-right btn-space">Cancel</button>
					</div>
				</form>
			</div>
		</section>
		
		<?php if($group == 'subadmin'){ ?>
			<section class="col-lg-4 connectedSortable">
		<?php }else { ?>
			<section class="col-lg-4 connectedSortable">
		<?php } ?>
		<div class="box box-primary">
			<div class="box-header with-border">
			  <h3 class="box-title">All Mobile Notification</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
					  <i class="fa fa-minus"></i></button>
				</div>
			</div>

			
				<table class="table">
					<tr>
                    <th>Title</th>
					<th>Sort Order</th>
					<th>Publish</th>
					<th>Action</th>
						<!-- <th>Action</th> -->
					</tr>
					<tbody id="news_list_table">
						<?php if(isset($mobile_notification) && (count($mobile_notification) > 0)){ 
							
								foreach($mobile_notification as $notification) { //print_r($notification); ?>
								<?php 
									$find = 0;
									foreach($mobile_notification as $new){
										if($new['mn_tranid'] == $notification['mn_tranid'] ){
											$find = 1;
										}
									}
								?>
								<tr class="<?php if(!$find){ echo "find"; } ?> notice_highlight notice_highlight_<?php echo $notification['mn_tranid']; ?>" data-mn_tranid="<?php echo $notification['mn_tranid']; ?>">
									<td ><?php echo $notification['mn_title']; ?></td>
									<?php if($group != 'subadmin'){ ?>
										<td><?php echo $notification['mn_display_order']; ?></td>
										<td>
                                        <?php if($notification['mn_publish'] == "Y"){ ?>
												<input class="notification_published" data-mn_tranid="<?php echo $notification['mn_tranid']; ?>" type="checkbox" checked />										
											<?php } else { ?>
												<input class="notification_published" data-mn_tranid="<?php echo $notification['mn_tranid']; ?>" type="checkbox" />
											<?php } ?>
										</td>
									<?php }  ?>
									 <td>
										<?php if($group == 'subadmin'){ ?>
											<a title="Edit" class="btn btn-info btn-flat notification_tranlate" data-mn_tranid="<?php echo $notification['mn_tranid']?>"><i class="fa fa-edit"></i></a>
										<?php } else { ?>
											<a class="btn btn-info btn-flat notification_edit" data-mn_tranid="<?php echo $notification['mn_tranid']?>"><i class="fa fa-pencil"></i></a> 
									    	<a class="btn btn-info btn-flat notification_delete" data-mn_tranid="<?php echo $notification['mn_tranid']?>"><i class="fa fa-trash"></i></a>
										<?php } ?>
									</td> 
								</tr>
						<?php  } } ?>
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
												<input class="notification_published" data-popup_id="<?php echo $notice['popup_id']; ?>" type="checkbox" checked />										
											<?php } else { ?>
												<input class="notification_published" data-popup_id="<?php echo $notice['popup_id']; ?>" type="checkbox" />
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

	$('#from_date').val($('#current_date').val());
	$('#to_date').val($('#current_date').val());
	
</script>
