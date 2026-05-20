<?php $group = $this->session->userdata('group_name'); ?>
<?php 
	$wiget_drop_Down = '';
	foreach($widgets as $widget){
		$wiget_drop_Down .= '<option value="'.$widget['w_id'].'">'.$widget['name'].'</option>'; 
	}
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
	<ol class="breadcrumb">
        <li><a title="Home" href="<?php echo base_url();?>admin/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="<?php echo base_url();?>/admin/admin/all_pages">All Pages</a></li>
    </ol>   
	<section class="content-header">
      <h1 class="pull-left"><?php if(isset($page_id)){echo 'Update Page';} else{ echo "New Page";} ?></h1>
    </section>
	<!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- Left col -->
		<section class="col-lg-12 connectedSortable">
		<div class="box box-primary">
			<div class="box-header with-border">
			  <h3 class="box-title"><?php if(isset($page_id)){echo 'Update Page';} else{ echo "New Page";} ?></h3>
			  <div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
				  <i class="fa fa-minus"></i></button>
			  </div>
			</div>
			<form id="page_add_form" name="f1" method="POST" role="form" class="form-horizontal" action="<?php echo base_url();?>admin/Page_ctrl/page_create">
			<div class="box-body">
				<div class="form-group">
					<label class="col-sm-2 control-label">Page Name</label>
					<div class="col-sm-9">
						<input id="page_name" name="page_name" type="text" class="form-control" placeholder="Enter new page name" value="<?php if(isset($page_details)){ echo $page_details['0']['page_name']; }?>">
						<div class="text-danger" id="page_name_error" style="display:none;"></div>
					</div>
					<div class="col-sm-12">
						<input type="hidden" id="page_id" name="page_id" class="form-control" value="<?php if(isset($page_details)){echo $page_details[0]['p_id'];}?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Page Title</label>
					<div class="col-sm-9">
						<input id="page_title" name="page_title" type="text" class="form-control" placeholder="Enter page title" value="<?php if(isset($page_details)){ echo $page_details['0']['page_title']; }?>">
						<div class="text-danger" id="page_title_error" style="display:none;"></div>
					</div>
					<div class="col-sm-12">
						<input type="hidden" id="page_id" name="page_id" class="form-control" value="<?php if(isset($page_details)){echo $page_details[0]['p_id'];}?>">
					</div>
				</div>
				<?php if($group != 'subadmin'){ ?>
				<div class="form-group">
					<label class="col-sm-2 control-label">Select Layout</label>
					<div class="col-sm-9">
						<select class="form-control" name="page_layout" id="page_layout">
						<?php if(isset($page_details)){ ?>
							<option value="0" >Please select layout</option>
							<option value="1" <?php if($page_details['0']['page_layout'] == 1){ echo "selected"; }?>>1 column (No Sidebar)</option>
							<option value="2" <?php if($page_details['0']['page_layout'] == 2){ echo "selected"; }?>>2 columns (Left Sidebar)</option>
							<option value="3" <?php if($page_details['0']['page_layout'] == 3){ echo "selected"; }?>>2 columns (Right Sidebar)</option>
							<option value="4" <?php if($page_details['0']['page_layout'] == 4){ echo "selected"; }?>>3 columns (Both Sidebar)</option>
						<?php } else { ?>
							<option value="0" selected>Please select layout</option>
							<option value="1" >1 column (No Sidebar)</option>
							<option value="2" >2 columns (Left Sidebar)</option>
							<option value="3" >2 columns (Right Sidebar)</option>
							<option value="4" >3 columns (Both Sidebar)</option>
						<?php } ?>
						</select>
						<div class="text-danger" id="page_layout_error" style="display: none;"></div>
					</div>
				</div>
				<?php } ?>
				<div class="form-group">
					<label class="col-sm-2 control-label">Is Static Page</label>
					<div class="col-sm-9">
						<input type="checkbox" name="checkbox_control" id="checkbox_control" checked />
						<input type="text" name="checkbox_url" id="checkbox_url" value="<?php if(isset($page_details)){ echo $page_details[0]['url']; }?>" />
						<div id="checkbox_url_response" class="response text-danger"></div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label">Page Type</label>
					<div class="col-sm-9">
						<select id="page_type" name="page_type" class="form-control">
							<option value="plain" <?php if(isset($page_details)){if($page_details[0]['type'] == 'plain'){echo "selected"; }} ?>>None</option>
							<option value="que_ans" <?php if(isset($page_details)){if($page_details[0]['type'] == 'que_ans'){echo "selected"; }} ?>>Question Ans.</option>
						</select>
					</div>
				</div>
			</div>
				
				
				
				<!--  -->
				<div class="form-group" id="1coumn" style="display: none;">
					<label class="col-sm-2 control-label">Select Layout</label>
					<div class="col-sm-9">
							<table class="table table-bordered">
							<tr><th>Main</th></tr>
							<tr>
								<td>
									<div id="one_col_maincontent_box"></div>
									<input type="button" id="one_col_main_addmore" value="Add more" class="btn btn-default">
								</td>
							</tr>
						</table>
					</div>
				</div>
				
				<div class="form-group" id="2coumn" style="display: none;">
					<label class="col-sm-2 control-label">Select Layout</label>
					<div class="col-sm-9">
						<table class="table table-bordered">
							<tr>
								<th>Left</th>
							</tr>
							<tr>
								<td>
									<div id="two_col_leftcontent_box"></div>
									<input type="button" id="two_col_leftcontent_addmore" value="Add more" class="btn btn-default">
								</td>
							</tr>
						</table>
					</div>
				</div>
				
				<div class="form-group" id="2coumn_right" style="display: none;">
					<label class="col-sm-2 control-label">Select Layout</label>
					<div class="col-sm-9">
						<table class="table table-bordered">
							<tr>
								<th>Right</th>
							</tr>
							<tr>
								<td>
									<div id="two_col_right_rightcontent_box"></div>
									<input type="button" id="two_col_right_rightcontent_addmore" value="Add more" class="btn btn-default">
								</td>
							</tr>
						</table>
					</div>
				</div>
				
				<div class="form-group" id="3coumn" style="display: none;">
					<label class="col-sm-2 control-label">Select Layout</label>
					<div class="col-sm-9">
						<table class="table table-bordered">
							<tr>
								<th>Left</th>
								<th>Right</th>
							</tr>
							<tr>
								<td>
									<div id="three_col_leftcontent_box"></div>
									<input type="button" id="three_col_leftcontent_addmore" value="Add more" class="btn btn-default">
								</td>
								<td>
									<div id="three_col_rightcontent_box"></div>
									<input type="button" id="three_col_rightcontent_addmore" value="Add more" class="btn btn-default">
								</td>
							</tr>
						</table>
					</div>
				</div>
				
				<?php if($group != 'subadmin'){ ?>
				<div class="form-group">
					<label class="col-sm-2 control-label">Meta tags</label>
					<div class="col-sm-9">
						<textarea name="meta_tag" id="meta_tag" rows="5" cols="" class="form-control"><?php if(isset($page_details[0]['meta_tag'])){echo $page_details[0]['meta_tag'];}?></textarea>
						<div class="text-danger" id="meta_tag_error" style="display:none;"></div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label">Key words</label>
					<div class="col-sm-9">
						<textarea rows="5" name="keyword" id="keyword" cols="" class="form-control"><?php if(isset($page_details[0]['keywords'])){echo $page_details[0]['keywords'];}?></textarea>
						<div class="text-danger" id="keyword_error" style="display:none;"></div>
					</div>
				</div>
				<?php } ?>
				<div class="form-group" id="page_body_box">
					<label class="col-sm-2 control-label">Page Body</label>
					<div class="col-sm-9">
					
						<textarea rows="5" name="page_body" id="page_body" cols="" class="form-control"><?php if(isset($page_details[0]['page_body'])){echo $page_details[0]['page_body'];}?></textarea>
						<script>
			                CKEDITOR.replace('page_body');
			            </script>
						<div class="text-danger" id="page_body_error" style="display:none;"></div>
					</div>
				</div>
				
				<div id="question_ans_box" class="question_ans" style="display:<?php if(isset($page_details['questions'])){ if(count($page_details['questions']) > 0) {echo 'block';} else{ echo 'none'; }} else{ echo 'none';}?>;">
					<div class="form-group">
						<input type="hidden" name="que[]" value="<?php if(isset($page_details['questions'])){ echo $page_details['questions'][0]['qa_id'];} else { echo '';} ?>">
						<label class="col-sm-2 control-label">Question</label>
						<div class="col-sm-9">
							<textarea rows="2" id="question_1" cols="" class="form-control"><?php if(isset($page_details['questions'][0]['question'])){echo $page_details['questions'][0]['question'];}?></textarea>
							<script>
								CKEDITOR.replace('question_1');
							</script>
							<div class="text-danger" id="question_1_error" style="display:none;"></div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Ans</label>
						<div class="col-sm-9">
							<textarea rows="2" id="ans_1" cols="" class="form-control"><?php if(isset($page_details['questions'][0]['ans'])){echo $page_details['questions'][0]['ans'];}?></textarea>
							<script>
								CKEDITOR.replace('ans_1');
							</script>
							<div class="text-danger" id="ans_1_error" style="display:none;"></div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Order</label>
						<div class="col-sm-9">
							<input type="number" id="sort_1" name="sort_1" value="<?php if(isset($page_details['questions'][0])){ echo $page_details['questions'][0]['q_sort'];} else { echo '';} ?>"> 
							<input type="button" class="btn btn-default more" id="question_1_more" value="Add More Questions">
							<?php if($group != 'subadmin'){ ?>
							<button type="button" class="btn btn-danger more question_delete"  data-id=" <?php if(isset($page_details['questions'][0])){ echo $page_details['questions'][0]['qa_id'];} ?>">Delete Questions</button>
							<?php }?>
							</div>
						</div>
					</div>
					
					<div id="question_2_box" class="question_ans" style="display:<?php if(isset($page_details['questions'])){ if(count($page_details['questions']) > 1) {echo 'block';} else{ echo 'none'; }} else{ echo 'none';}?>;">
						<div class="form-group">
						<input type="hidden" name="que[]" value="<?php if(isset($page_details['questions'][1])){ echo $page_details['questions'][1]['qa_id'];} else { echo '';} ?>">
							<label class="col-sm-2 control-label">Question 2</label>
							<div class="col-sm-9">
								<textarea id="question_2" cols="" class="form-control"><?php if(isset($page_details['questions'][1]['question'])){echo $page_details['questions'][1]['question'];}?></textarea>
								<script>
									CKEDITOR.replace('question_2');
								</script>
								<div class="text-danger" id="question_2_error" style="display:none;"></div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Ans 2</label>
							<div class="col-sm-9">
								<textarea rows="2" id="ans_2" cols="" class="form-control"><?php if(isset($page_details['questions'][1]['ans'])){echo $page_details['questions'][1]['ans'];}?></textarea>
								<script>
									CKEDITOR.replace('ans_2');
								</script>
								<div class="text-danger" id="ans_2_error" style="display:none;"></div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Order</label>
							<div class="col-sm-9">
								<input type="number" id="sort_2" name="sort_2" value="<?php if(isset($page_details['questions'][1])){ echo $page_details['questions'][1]['q_sort'];} else { echo '';} ?>"> 
								<input type="button" class="btn btn-default more" id="question_2_more" value="Add More Questions">
								<?php if($group != 'subadmin'){ ?>
								<botton type="button" class="btn btn-danger more question_delete"  data-id="<?php if(isset($page_details['questions'][1])){ echo $page_details['questions'][1]['qa_id'];}  ?>">Delete Questions </botton>
								<?php }?>
							</div>
						</div>
					</div>
					
					<div id="question_3_box" class="question_ans" style="display:<?php if(isset($page_details['questions'])){ if(count($page_details['questions']) > 2) {echo 'block';} else{ echo 'none'; }} else{ echo 'none';}?>;">
						<div class="form-group">
							<input type="hidden" name="que[]" value="<?php if(isset($page_details['questions'][2])){ echo $page_details['questions'][2]['qa_id'];} else { echo '';} ?>">
							<label class="col-sm-2 control-label">Question 3</label>
							<div class="col-sm-9">
								<textarea rows="2" id="question_3" cols="" class="form-control"><?php if(isset($page_details['questions'][2]['question'])){echo $page_details['questions'][2]['question'];}?></textarea>
								<script>
									CKEDITOR.replace('question_3');
								</script>
								<div class="text-danger" id="question_3_error" style="display:none;"></div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Ans 3</label>
							<div class="col-sm-9">
								<textarea rows="2" id="ans_3" cols="" class="form-control"><?php if(isset($page_details['questions'][2]['ans'])){echo $page_details['questions'][2]['ans'];}?></textarea>
								<script>
									CKEDITOR.replace('ans_3');
								</script>
								<div class="text-danger" id="ans_3_error" style="display:none;"></div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Order</label>
							<div class="col-sm-9">
								<input type="number" id="sort_3" name="sort_3" value="<?php if(isset($page_details['questions'][2])){ echo $page_details['questions'][2]['q_sort'];} else { echo '';} ?>"> 
								<input type="button" class="btn btn-default more" id="question_3_more" value="Add More Questions">
								<?php if($group != 'subadmin'){ ?>
								<button type="button" class="btn btn-danger more question_delete"  data-id="<?php if(isset($page_details['questions'][2])){ echo $page_details['questions'][2]['qa_id']; }?>">Delete Questions</button>
								<?php }?>
							</div>
						</div>
					</div>
					
					<div id="question_4_box" class="question_ans" style="display:<?php if(isset($page_details['questions'])){ if(count($page_details['questions']) > 3) {echo 'block';} else{ echo 'none'; }} else{ echo 'none';}?>;">
						<div class="form-group">
							<input type="hidden" name="que[]" value="<?php if(isset($page_details['questions'][3])){ echo $page_details['questions'][3]['qa_id'];} else { echo '';} ?>">
							<label class="col-sm-2 control-label">Question 4</label>
							<div class="col-sm-9">
								<textarea rows="2" id="question_4" cols="" class="form-control"><?php if(isset($page_details['questions'][3]['question'])){echo $page_details['questions'][3]['question'];}?></textarea>
								<script>
									CKEDITOR.replace('question_4');
								</script>
								<div class="text-danger" id="question_4_error" style="display:none;"></div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Ans 4</label>
							<div class="col-sm-9">
								<textarea rows="2" id="ans_4" cols="" class="form-control"><?php if(isset($page_details['questions'][3]['ans'])){echo $page_details['questions'][3]['ans'];}?></textarea>
								<script>
									CKEDITOR.replace('ans_4');
								</script>
								<div class="text-danger" id="ans_4_error" style="display:none;"></div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Order</label>
							<div class="col-sm-9">
								<input type="number" id="sort_4" name="sort_4" value="<?php if(isset($page_details['questions'][3])){ echo $page_details['questions'][3]['q_sort'];} else { echo '';} ?>"> 
								<input type="button" class="btn btn-default more" id="question_4_more" value="Add More Questions">
								<?php if($group != 'subadmin'){ ?>
								<button type="button" class="btn btn-danger more question_delete"  data-id="<?php if(isset($page_details['questions'][3])){ echo $page_details['questions'][3]['qa_id'];} ?>">Delete Questions</button>
								<?php }?>
							</div>
						</div>
					</div>
					
					<div id="question_5_box" class="question_ans" style="display:<?php if(isset($page_details['questions'])){ if(count($page_details['questions']) > 4) {echo 'block';} else{ echo 'none'; }} else{ echo 'none';}?>;">
						<div class="form-group">
							<input type="hidden" name="que[]" value="<?php if(isset($page_details['questions'][4])){ echo $page_details['questions'][4]['qa_id'];} else { echo '';} ?>">
							<label class="col-sm-2 control-label">Question 5</label>
							<div class="col-sm-9">
								<textarea rows="2" id="question_5" cols="" class="form-control"><?php if(isset($page_details['questions'][4]['question'])){echo $page_details['questions'][4]['question'];}?></textarea>
								<script>
									CKEDITOR.replace('question_5');
								</script>
								<div class="text-danger" id="question_5_error" style="display:none;"></div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Ans 5</label>
							<div class="col-sm-9">
								<textarea rows="2" id="ans_5" cols="" class="form-control"><?php if(isset($page_details['questions'][4]['ans'])){echo $page_details['questions'][4]['ans'];}?></textarea>
								<script>
									CKEDITOR.replace('ans_5');
								</script>
								<div class="text-danger" id="ans_5_error" style="display:none;"></div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Order</label>
							<div class="col-sm-9">
								<input type="number" id="sort_5" name="sort_5" value="<?php if(isset($page_details['questions'][4])){ echo $page_details['questions'][4]['q_sort'];} else { echo '';} ?>"> 
								<input type="button" class="btn btn-default more" id="question_5_more" value="Add More Questions">
								<?php if($group != 'subadmin'){ ?>
								<button type="button" class="btn btn-danger more question_delete"  data-id="<?php if(isset($page_details['questions'][4])){ echo $page_details['questions'][4]['qa_id'];}  ?>">Delete Questions</button>
								<?php }?>
							</div>
						</div>
					</div>
					
					<div id="question_6_box" class="question_ans" style="display:<?php if(isset($page_details['questions'])){ if(count($page_details['questions']) > 5) {echo 'block';} else{ echo 'none'; }} else{ echo 'none';}?>;">
						<div class="form-group">
							<input type="hidden" name="que[]" value="<?php if(isset($page_details['questions'][5])){ echo $page_details['questions'][5]['qa_id'];} else { echo '';} ?>">
							<label class="col-sm-2 control-label">Question 6</label>
							<div class="col-sm-9">
								<textarea rows="2" id="question_6" cols="" class="form-control"><?php if(isset($page_details['questions'][5]['question'])){echo $page_details['questions'][5]['question'];}?></textarea>
								<script>
									CKEDITOR.replace('question_6');
								</script>
								<div class="text-danger" id="question_6_error" style="display:none;"></div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Ans 6</label>
							<div class="col-sm-9">
								<textarea rows="2" id="ans_6" cols="" class="form-control"><?php if(isset($page_details['questions'][5]['ans'])){echo $page_details['questions'][5]['ans'];}?></textarea>
								<script>
									CKEDITOR.replace('ans_6');
								</script>
								<div class="text-danger" id="ans_6_error" style="display:none;"></div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Order</label>
							<div class="col-sm-9">
								<input type="number" id="sort_6" name="sort_6" value="<?php if(isset($page_details['questions'][5])){ echo $page_details['questions'][5]['q_sort'];} else { echo '';} ?>"> 
								<input type="button" class="btn btn-default more" id="question_6_more" value="Add More Questions">
								<?php if($group != 'subadmin'){ ?>
								<button type="button" class="btn btn-danger more question_delete"  data-id="<?php if(isset($page_details['questions'][5])){ echo $page_details['questions'][5]['qa_id'];}  ?>">Delete Questions</button>
								<?php }?>
							</div>
						</div>
					</div>
					
					<div id="question_7_box" class="question_ans" style="display:<?php if(isset($page_details['questions'])){ if(count($page_details['questions']) > 6) {echo 'block';} else{ echo 'none'; }} else{ echo 'none';}?>;">
						<div class="form-group">
							<input type="hidden" name="que[]" value="<?php if(isset($page_details['questions'][6])){ echo $page_details['questions'][6]['qa_id'];} else { echo '';} ?>">
							<label class="col-sm-2 control-label">Question 7</label>
							<div class="col-sm-9">
								<textarea rows="2" id="question_7" cols="" class="form-control"><?php if(isset($page_details['questions'][6]['question'])){echo $page_details['questions'][6]['question'];}?></textarea>
								<script>
									CKEDITOR.replace('question_7');
								</script>
								<div class="text-danger" id="question_7_error" style="display:none;"></div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Ans 7</label>
							<div class="col-sm-9">
								<textarea rows="2" id="ans_7" cols="" class="form-control"><?php if(isset($page_details['questions'][6]['ans'])){echo $page_details['questions'][6]['ans'];}?></textarea>
								<script>
									CKEDITOR.replace('ans_7');
								</script>
								<div class="text-danger" id="ans_7_error" style="display:none;"></div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Order</label>
							<div class="col-sm-9">
								<input type="number" id="sort_7" name="sort_7" value="<?php if(isset($page_details['questions'][6])){ echo $page_details['questions'][6]['q_sort'];} else { echo '';} ?>"> 
								<input type="button" class="btn btn-default more" id="question_7_more" value="Add More Questions">
								<?php if($group != 'subadmin'){ ?>
								<button type="button" class="btn btn-danger more question_delete"  data-id="<?php if(isset($page_details['questions'][6])){ echo $page_details['questions'][6]['qa_id'];}  ?>">Delete Questions</button>
								<?php }?>
							</div>
						</div>
					</div>
					
					<div id="question_8_box" class="question_ans" style="display:<?php if(isset($page_details['questions'])){ if(count($page_details['questions']) > 7) {echo 'block';} else{ echo 'none'; }} else{ echo 'none';}?>;">
						<div class="form-group">
							<input type="hidden" name="que[]" value="<?php if(isset($page_details['questions'][7])){ echo $page_details['questions'][7]['qa_id'];} else { echo '';} ?>">
							<label class="col-sm-2 control-label">Question 8</label>
							<div class="col-sm-9">
								<textarea rows="2" id="question_8" cols="" class="form-control"><?php if(isset($page_details['questions'][7]['question'])){echo $page_details['questions'][7]['question'];}?></textarea>
								<script>
									CKEDITOR.replace('question_8');
								</script>
								<div class="text-danger" id="question_8_error" style="display:none;"></div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Ans 8</label>
							<div class="col-sm-9">
								<textarea rows="2" id="ans_8" cols="" class="form-control"><?php if(isset($page_details['questions'][7]['ans'])){echo $page_details['questions'][7]['ans'];}?></textarea>
								<script>
									CKEDITOR.replace('ans_8');
								</script>
								<div class="text-danger" id="ans_8_error" style="display:none;"></div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Order</label>
							<div class="col-sm-9">
								<input type="number" id="sort_8" name="sort_8" value="<?php if(isset($page_details['questions'][7])){ echo $page_details['questions'][7]['q_sort'];} else { echo '';} ?>">
								<?php if($group != 'subadmin'){ ?>
								<button type="button" class="btn btn-danger more question_delete"  data-id="<?php if(isset($page_details['questions'][7])){ echo $page_details['questions'][7]['qa_id'];}  ?>">Delete Questions</button>
								<?php }?> 
							</div>
						</div>
					</div>
				</div>
				
            </div>
			</form>
			<div class="box-footer">
				<?php if(isset($page_details)){ ?>
					<button id="page_update" type="submit" class="btn pull-right btn-info">Update</button>
				<?php } else {?>
					<button id="page_create" type="submit" class="btn pull-right btn-info">Save</button>
				<?php }?>
				<button type="button" id="page_reset" class="btn btn-default pull-right btn-space">Cancel</button>
			</div>
		</div>
		</section>
		</div>
		</section>
		
<!--<div class="sort-code-box">
	<div class="sort-code-head sort-head-title">Sort Code <span class="pull-right"><i class="fa fa-minus"></i></span></div>
	<div class="sort-code-body" style="display:none;">
		<ul class="sort-code-body-sec">
			<li>14</li>
			<li>12</li>
			<li>11</li>
		</ul>
	</div>
</div>-->
</div>


<script>
$(document).ready(function(){
    $(".sort-head-title").click(function(){
        $(".sort-code-body").slideToggle();
    });
});
</script>
<script>
$(document).ready(function(){
	var baseUrl = $('#base_url').val();
	var uGroup = $('#u_group').val();
	
	var x = $("#page_layout").val();
	
	if(x == 1){
		$('#1coumn').hide();
		$('#2coumn').hide();
		$('#3coumn').hide();
		$('#2coumn_right').hide();

		var page_id = $('#page_id').val();	
		$.ajax({
	        type: 'POST',
	        url: baseUrl+'admin/Ajax_ctrl/get_all_widgets',
	        dataType: "json",
	        data: {
		        'page_id' : page_id
		       },
	        beforeSend: function(){
	        	//$('#loader').modal('show');	
	        },
	        success:function (response) {
	        	$.each(response.data2,function(k,v){
	        		console.log(v);
	        		var x = '';
	        		$.each(response.data,function(key,value){
		        		if(value.w_id == v.widget_id){
		        			x = x + '<option value="'+ value.w_id +'" selected>'+ value.name +'</option>';
		        		}
		        		else{
		        			x = x + '<option value="'+ value.w_id +'">'+ value.name +'</option>';
		        		}
		        	});

	        		//x = x + '<option value="'+ value.news_id +'">'+ value.news_content +'</option>';
		        	
					if(v.section == 'main_body'){
						var dropdown = '<select class="form-control col-sm-6" name="one_col_maincontent[]" id="">'+
						'<option value="0">select widget</option>'+
						x +
						'</select>';
						$('#one_col_maincontent_box').prepend(dropdown);
					}
		        });
	        }
		});
	}
	else if(x == 2){
		$('#1coumn').hide();
		$('#2coumn').show();
		$('#3coumn').hide();
		$('#2coumn_right').hide();
		var page_id = $('#page_id').val();	
		$.ajax({
	        type: 'POST',
	        url: baseUrl+'admin/Ajax_ctrl/get_all_widgets',
	        dataType: "json",
	        data: {
		        'page_id' : page_id
		       },
	        beforeSend: function(){
// 	        	$('#loader').modal({'show':true});	
	        },
	        complete: function(){},
	        success:function (response) {
		        console.log(response);
	        	$.each(response.data2,function(k,v){
	        		var x = '';
	        		var find = 0;
	        		$.each(response.data,function(key,value){
		        		if(value.w_id == v.widget_id){
		        			x = x + '<option value="'+ value.w_id +'" selected>'+ value.name +'</option>';
		        			find = 1;
		        		}
		        		else{
		        			x = x + '<option value="'+ value.w_id +'">'+ value.name +'</option>';		        		
		        		}
		        	});

					if(find){
						x = x + '<option value="-1">News</option>'+
	        			'<option value="-2">Slider</option>'+
	        			'<option value="-3">Quick Link</option>'+
	        			'<option value="-4">Event</option>'+
	        			'<option value="-5">Videos</option>'+
	        			'<option value="-6">Contact Us</option>'+
	        			'<option value="-7">Search</option>'+
	        			'<option value="-8">Subscribe</option>';
					}
					else{
						if(v.widget_id == '-1'){
		        			x = x + '<option value="-1" selected>News</option>'+
		        			'<option value="-2">Slider</option>'+
		        			'<option value="-3">Quick Link</option>'+
		        			'<option value="-4">Event</option>'+
		        			'<option value="-5">Videos</option>'+
		        			'<option value="-6">Contact Us</option>'+
		        			'<option value="-7">Search</option>'+
		        			'<option value="-8">Subscribe</option>';
		        		}
		        		else if(v.widget_id == '-2'){
		        			x = x + '<option value="-2" selected>Slider</option>'+
		        			'<option value="-1">News</option>'+
		        			'<option value="-3">Quick Link</option>'+
		        			'<option value="-4">Event</option>'+
		        			'<option value="-5">Videos</option>'+
		        			'<option value="-6">Contact Us</option>'+
							'<option value="-7">Search</option>'+
		        			'<option value="-8">Subscribe</option>';
		        		}
		        		else if(v.widget_id == '-3'){
		        			x = x + '<option value="-3" selected>Quick Link</option>'+
		        			'<option value="-1">News</option>'+
		        			'<option value="-2">Slider</option>'+
		        			'<option value="-4">Event</option>'+
		        			'<option value="-5">Videos</option>'+
		        			'<option value="-6">Contact Us</option>'+
							'<option value="-7">Search</option>'+
		        			'<option value="-8">Subscribe</option>';
		        		}
		        		else if(v.widget_id == '-4'){
		        			x = x + '<option value="-4" selected>Event</option>'+
		        			'<option value="-1">News</option>'+
		        			'<option value="-2">Slider</option>'+
		        			'<option value="-3">Quick Link</option>'+
		        			'<option value="-5">Videos</option>'+
		        			'<option value="-6">Contact Us</option>'+
							'<option value="-7">Search</option>'+
		        			'<option value="-8">Subscribe</option>';
		        		}
		        		else if(v.widget_id == '-5'){
		        			x = x + '<option value="-5" selected>Videos</option>'+
		        			'<option value="-1">News</option>'+
		        			'<option value="-2">Slider</option>'+
		        			'<option value="-3">Quick Link</option>'+
		        			'<option value="-4">Event</option>'+
		        			'<option value="-6">Contact Us</option>'+
							'<option value="-7">Search</option>'+
		        			'<option value="-8">Subscribe</option>';
		        		}
		        		else if(v.widget_id == '-6'){
		        			x = x + '<option value="-6" selected>Contact Us</option>'+
		        			'<option value="-1">News</option>'+
		        			'<option value="-2">Slider</option>'+
		        			'<option value="-3">Quick Link</option>'+
		        			'<option value="-4">Event</option>'+
		        			'<option value="-5">Videos</option>'+
							'<option value="-7">Search</option>'+
		        			'<option value="-8">Subscribe</option>';
		        		}
						else if(v.widget_id == '-7'){
		        			x = x + '<option value="-6">Contact Us</option>'+
		        			'<option value="-1">News</option>'+
		        			'<option value="-2">Slider</option>'+
		        			'<option value="-3">Quick Link</option>'+
		        			'<option value="-4">Event</option>'+
		        			'<option value="-5">Videos</option>'+
							'<option value="-7" selected>Search</option>'+
		        			'<option value="-8">Subscribe</option>';
		        		}
						else if(v.widget_id == '-8'){
		        			x = x + '<option value="-6">Contact Us</option>'+
		        			'<option value="-1">News</option>'+
		        			'<option value="-2">Slider</option>'+
		        			'<option value="-3">Quick Link</option>'+
		        			'<option value="-4">Event</option>'+
		        			'<option value="-5">Videos</option>'+
							'<option value="-7">Search</option>'+
		        			'<option value="-8" selected>Subscribe</option>';
		        		}
						
					}
		        	
					if(v.section == 'left_col'){
						var dropdown = '<select class="form-control col-sm-6" name="two_col_leftcontent[]" id="">'+
						'<option value="0">select widget</option>'+
						x +
						'</select>';
		        		$('#two_col_leftcontent_box').append(dropdown);
					}
		        });
	        }
		});
	}
	//////////////////////////////////////
	else if(x == 3){
		$('#1coumn').hide();
		$('#2coumn').hide();
		$('#3coumn').hide();
		$('#2coumn_right').show();
		
		var page_id = $('#page_id').val();	
		$.ajax({
	        type: 'POST',
	        url: baseUrl+'admin/Ajax_ctrl/get_all_widgets',
	        dataType: "json",
	        data: {
		        'page_id' : page_id
		       },
	        beforeSend: function(){
	        	$('#loader').modal({'show':true});	
	        },
	        complete: function(){},
	        success:function (response) {
	        	console.log(response);
	        	$('#two_col_right_leftcontent_box').html('');
	        	$('#two_col_right_rightcontent_box').html('');
	        	$.each(response.data2,function(k,v){
	        		var x = '';
	        		var find = 0;
	        		$.each(response.data,function(key,value){
		        		if(value.w_id == v.widget_id){
		        			x = x + '<option value="'+ value.w_id +'" selected>'+ value.name +'</option>';
		        			find = 1;
		        		}
		        		else{
		        			x = x + '<option value="'+ value.w_id +'">'+ value.name +'</option>';
		        		}
		        	});
		        	
	        		if(find){
						x = x + '<option value="-1">News</option>'+
	        			'<option value="-2">Slider</option>'+
	        			'<option value="-3">Quick Link</option>'+
	        			'<option value="-4">Event</option>'+
	        			'<option value="-5">Videos</option>'+
	        			'<option value="-6">Contact Us</option>'+
						'<option value="-7">Search</option>'+
		        		'<option value="-8">Subscribe</option>';
					}
					else{
						if(v.widget_id == '-1'){
		        			x = x + '<option value="-1" selected>News</option>'+
		        			'<option value="-2">Slider</option>'+
		        			'<option value="-3">Quick Link</option>'+
		        			'<option value="-4">Event</option>'+
		        			'<option value="-5">Videos</option>'+
		        			'<option value="-6">Contact Us</option>'+
							'<option value="-7">Search</option>'+
		        			'<option value="-8">Subscribe</option>';
		        		}
		        		else if(v.widget_id == '-2'){
		        			x = x + '<option value="-2" selected>Slider</option>'+
		        			'<option value="-1">News</option>'+
		        			'<option value="-3">Quick Link</option>'+
		        			'<option value="-4">Event</option>'+
		        			'<option value="-5">Videos</option>'+
		        			'<option value="-6">Contact Us</option>'+
							'<option value="-7">Search</option>'+
		        			'<option value="-8">Subscribe</option>';
		        		}
		        		else if(v.widget_id == '-3'){
		        			x = x + '<option value="-3" selected>Quick Link</option>'+
		        			'<option value="-1">News</option>'+
		        			'<option value="-2">Slider</option>'+
		        			'<option value="-4">Event</option>'+
		        			'<option value="-5">Videos</option>'+
		        			'<option value="-6">Contact Us</option>'+
							'<option value="-7">Search</option>'+
		        			'<option value="-8">Subscribe</option>';
		        		}
		        		else if(v.widget_id == '-4'){
		        			x = x + '<option value="-4" selected>Event</option>'+
		        			'<option value="-1">News</option>'+
		        			'<option value="-2">Slider</option>'+
		        			'<option value="-3">Quick Link</option>'+
		        			'<option value="-5">Videos</option>'+
		        			'<option value="-6">Contact Us</option>'+
							'<option value="-7">Search</option>'+
		        			'<option value="-8">Subscribe</option>';
		        		}
		        		else if(v.widget_id == '-5'){
		        			x = x + '<option value="-5" selected>Videos</option>'+
		        			'<option value="-1">News</option>'+
		        			'<option value="-2">Slider</option>'+
		        			'<option value="-3">Quick Link</option>'+
		        			'<option value="-4">Event</option>'+
		        			'<option value="-6">Contact Us</option>'+
							'<option value="-7">Search</option>'+
		        			'<option value="-8">Subscribe</option>';
		        		}
		        		else if(v.widget_id == '-6'){
		        			x = x + '<option value="-6" selected>Contact Us</option>'+
		        			'<option value="-1">News</option>'+
		        			'<option value="-2">Slider</option>'+
		        			'<option value="-3">Quick Link</option>'+
		        			'<option value="-4">Event</option>'+
		        			'<option value="-5">Videos</option>'+
							'<option value="-7">Search</option>'+
		        			'<option value="-8">Subscribe</option>';
		        		}
						else if(v.widget_id == '-7'){
		        			x = x + '<option value="-6">Contact Us</option>'+
		        			'<option value="-1">News</option>'+
		        			'<option value="-2">Slider</option>'+
		        			'<option value="-3">Quick Link</option>'+
		        			'<option value="-4">Event</option>'+
		        			'<option value="-5">Videos</option>'+
							'<option value="-7" selected>Search</option>'+
		        			'<option value="-8">Subscribe</option>';
		        		}
						else if(v.widget_id == '-8'){
		        			x = x + '<option value="-6">Contact Us</option>'+
		        			'<option value="-1">News</option>'+
		        			'<option value="-2">Slider</option>'+
		        			'<option value="-3">Quick Link</option>'+
		        			'<option value="-4">Event</option>'+
		        			'<option value="-5">Videos</option>'+
							'<option value="-7">Search</option>'+
		        			'<option value="-8" selected>Subscribe</option>';
		        		}
					}
	        		
	        		
					if(v.section == 'left_col'){
						var dropdown = '<select class="form-control col-sm-6" name="three_col_leftcontent[]" id="">'+
						'<option value="0">select widget</option>'+
						x +
						'</select>';
		        		$('#two_col_right_leftcontent_box').append(dropdown);
					}
					else if(v.section == 'main_body'){
						var dropdown = '<select class="form-control col-sm-6" name="three_col_maincontent[]" id="">'+
						'<option value="0">select widget</option>'+
						x +
						'</select>';
						$('#three_col_maincontent_box').aooend(dropdown);
					}
					else{
						var dropdown = '<select class="form-control col-sm-6" name="two_col_right_rightcontent[]" id="">'+
						'<option value="0">select widget</option>'+
						x +
						'</select>';
						$('#two_col_right_rightcontent_box').append(dropdown);
					}
		        });
	        	$('#loader').modal('toggle');
	        }
		});
	}
	//////////////////////////////////////
	else if(x == 4){
		$('#1coumn').hide();
		$('#2coumn').hide();
		$('#3coumn').show();
		$('#2coumn_right').hide();

		var page_id = $('#page_id').val();	
		$.ajax({
	        type: 'POST',
	        url: baseUrl+'admin/Ajax_ctrl/get_all_widgets',
	        dataType: "json",
	        data: {
		        'page_id' : page_id
		       },
	        beforeSend: function(){	},
	        complete: function(){},
	        success:function (response) {
	        	$.each(response.data2,function(k,v){
	        		var x = '';
	        		var find = 0;
	        		$.each(response.data,function(key,value){
		        		if(value.w_id == v.widget_id){
		        			x = x + '<option value="'+ value.w_id +'" selected>'+ value.name +'</option>';
		        			find = 1;
		        		}
		        		else{
		        			x = x + '<option value="'+ value.w_id +'">'+ value.name +'</option>';
		        		}
		        	});

	        		if(find){
						x = x + '<option value="-1">News</option>'+
	        			'<option value="-2">Slider</option>'+
	        			'<option value="-3">Quick Link</option>'+
	        			'<option value="-4">Event</option>'+
	        			'<option value="-5">Videos</option>'+
	        			'<option value="-6">Contact Us</option>'+
						'<option value="-7">Search</option>'+
		        		'<option value="-8">Subscribe</option>';
					}
					else{
						if(v.widget_id == '-1'){
		        			x = x + '<option value="-1" selected>News</option>'+
		        			'<option value="-2">Slider</option>'+
		        			'<option value="-3">Quick Link</option>'+
		        			'<option value="-4">Event</option>'+
		        			'<option value="-5">Videos</option>'+
		        			'<option value="-6">Contact Us</option>'+
							'<option value="-7">Search</option>'+
		        			'<option value="-8">Subscribe</option>';
		        		}
		        		else if(v.widget_id == '-2'){
		        			x = x + '<option value="-2" selected>Slider</option>'+
		        			'<option value="-1">News</option>'+
		        			'<option value="-3">Quick Link</option>'+
		        			'<option value="-4">Event</option>'+
		        			'<option value="-5">Videos</option>'+
		        			'<option value="-6">Contact Us</option>'+
							'<option value="-7">Search</option>'+
		        			'<option value="-8">Subscribe</option>';
		        		}
		        		else if(v.widget_id == '-3'){
		        			x = x + '<option value="-3" selected>Quick Link</option>'+
		        			'<option value="-1">News</option>'+
		        			'<option value="-2">Slider</option>'+
		        			'<option value="-4">Event</option>'+
		        			'<option value="-5">Videos</option>'+
		        			'<option value="-6">Contact Us</option>'+
							'<option value="-7">Search</option>'
		        			'<option value="-8">Subscribe</option>';
		        		}
		        		else if(v.widget_id == '-4'){
		        			x = x + '<option value="-4" selected>Event</option>'+
		        			'<option value="-1">News</option>'+
		        			'<option value="-2">Slider</option>'+
		        			'<option value="-3">Quick Link</option>'+
		        			'<option value="-5">Videos</option>'+
		        			'<option value="-6">Contact Us</option>'+
							'<option value="-7">Search</option>'+
		        			'<option value="-8">Subscribe</option>';
		        		}
		        		else if(v.widget_id == '-5'){
		        			x = x + '<option value="-5" selected>Videos</option>'+
		        			'<option value="-1">News</option>'+
		        			'<option value="-2">Slider</option>'+
		        			'<option value="-3">Quick Link</option>'+
		        			'<option value="-4">Event</option>'+
		        			'<option value="-6">Contact Us</option>'+
							'<option value="-7">Search</option>'+
		        			'<option value="-8">Subscribe</option>';
		        		}
		        		else if(v.widget_id == '-6'){
		        			x = x + '<option value="-6" selected>Contact Us</option>'+
		        			'<option value="-1">News</option>'+
		        			'<option value="-2">Slider</option>'+
		        			'<option value="-3">Quick Link</option>'+
		        			'<option value="-4">Event</option>'+
		        			'<option value="-5">Videos</option>'+
							'<option value="-7">Search</option>'+
		        			'<option value="-8">Subscribe</option>';
		        		}
						else if(v.widget_id == '-7'){
		        			x = x + '<option value="-6">Contact Us</option>'+
		        			'<option value="-1">News</option>'+
		        			'<option value="-2">Slider</option>'+
		        			'<option value="-3">Quick Link</option>'+
		        			'<option value="-4">Event</option>'+
		        			'<option value="-5">Videos</option>'+
							'<option value="-7" selected>Search</option>'+
		        			'<option value="-8">Subscribe</option>';
		        		}
						else if(v.widget_id == '-8'){
		        			x = x + '<option value="-6">Contact Us</option>'+
		        			'<option value="-1">News</option>'+
		        			'<option value="-2">Slider</option>'+
		        			'<option value="-3">Quick Link</option>'+
		        			'<option value="-4">Event</option>'+
		        			'<option value="-5">Videos</option>'+
							'<option value="-7">Search</option>'+
		        			'<option value="-8"selected>Subscribe</option>';
		        		}
					}
		        	
					if(v.section == 'left_col'){
						var dropdown = '<select class="form-control col-sm-6" name="three_col_leftcontent[]" id="">'+
						'<option value="0">select widget</option>'+
						x +
						'</select>';
		        		$('#three_col_leftcontent_box').append(dropdown);
					}
					else{
						var dropdown = '<select class="form-control col-sm-6" name="three_col_rightcontent[]" id="">'+
						'<option value="0">select widget</option>'+
						x +
						'</select>';
						$('#three_col_rightcontent_box').append(dropdown);
					}
		        });
	        }
		});
	}
	else{
		$('#1coumn').hide();
		$('#2coumn').hide();
		$('#3coumn').hide();
	}
});


$(document).on('change','#page_type',function(){
	if($(this).val() == 'que_ans'){
		$('#question_ans_box').css('display','block');
	}
	else{
		$('#question_ans_box').css('display','none');
	}
});

$(document).on('click','#question_1_more',function(){
	$('#question_2_box').css('display','block');
});
$(document).on('click','#question_2_more',function(){
	$('#question_3_box').css('display','block');
});
$(document).on('click','#question_3_more',function(){
	$('#question_4_box').css('display','block');
});
$(document).on('click','#question_4_more',function(){
	$('#question_5_box').css('display','block');
});
$(document).on('click','#question_5_more',function(){
	$('#question_6_box').css('display','block');
});
$(document).on('click','#question_6_more',function(){
	$('#question_7_box').css('display','block');
});
$(document).on('click','#question_7_more',function(){
	$('#question_8_box').css('display','block');
});

$(document).on('click','.question_delete',function(){
	var x = confirm('Are you sure.');
	if(x){
		var que = $(this).data('id');    
		var that = this;
		$.ajax({
	        url: baseUrl +'admin/Page_ctrl/que_delete',
	        type: 'POST',
	        dataType: "json",
	        data: {
	        	'que' : que,
	        },
	        success: function(response){
	            if(response.status == 200){
	                $(that).closest('.question_ans').hide('slow');
	            	alert(response.msg);
	            }
	            else{
	            	alert(response.msg);
	            }
	         }
	      });
	}
});
</script>