<?php 
if(isset($param_state) && isset($param_apmc)){ ?>
  	<input type="hidden" id="state_id_param" value="<?php echo $param_state; ?>">
  	<input type="hidden" id="apmc_id_param" value="<?php echo $param_apmc; ?>">
<?php }?>

<section class="title-header-bg-apmc"></section>
<section class="container-fuild content-section emandi-sec" >
	<div class="container">
		<div class="" style="margin-top:10px;">
			<div class="col-md-12 bc-nav" >
				<a href="<?php echo base_url(); ?>" title=""><?php echo $this->lang_file->heading_fetch('home');?></a>&nbsp;<i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>&nbsp;
				<a href="<?php echo base_url(); ?>pop-dashboard"><?php echo $this->lang_file->heading_fetch('pop_dashboard');?> </a><i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>&nbsp;
				<?php echo $this->lang_file->heading_fetch('trading_platform');?>
			</div>
			<?php date_default_timezone_set("Asia/Kolkata");
				$date = date("Y-m-d");
			?>

			<div class="col-sm-9 content-9 h-space-padd-r" >
				<h3 class="p-title"><span><?php echo $this->lang_file->heading_fetch('pop_trade');?><p class="t-stake-data"><a id="backBtn"><b><?php echo $this->lang_file->heading_fetch('back');?></b>  <img src="<?php echo base_url(); ?>assest/images/pop/back-arrow.png" style="width: 20px;"></a></p></span></h3>
				<input type="hidden" id="previous_date" value="<?php echo date('Y-m-d', strtotime($date .' -1 day'));?>">
				<input type="hidden" id="current_date" value="<?php echo $date;?>">
				<div class="col-md-2 platforms" style="padding-left:15px;">
					<b><?php echo $this->lang_file->heading_fetch('platform');?></b>
					<select class="form-control" id="min_max_state">
						<option value="">-- <?php echo $this->lang_file->heading_fetch('pop_select');?> --</option>
						<option value="Platform 1">Platform 1</option>
						<option value="Platform 2">Platform 2</option>
						<option value="Platform 3">Platform 3</option>
						<option value="Platform 4">Platform 4</option>
					</select>
				</div>


				<div class="col-md-2 emandi-select e-trade-inputs" style="padding-left:15px;">
					<b><?php echo $this->lang_file->heading_fetch('min_max_state');?><span style="color:#F00"> *</span></b>
					<select class="form-control" id="min_max_state">
						<option value="">-- <?php echo $this->lang_file->heading_fetch('pop_select');?> --</option>
					</select>
				</div>

				<div class="col-md-2 emandi-select e-trade-inputs">
					<b><?php echo $this->lang_file->heading_fetch('min_max_district');?></b>
					<select class="form-control" id="min_max_apmc">
						<option value="0">-- <?php echo $this->lang_file->heading_fetch('pop_select');?> --</option>
					</select>

				</div>
				<div class="col-md-2 emandi-select e-trade-inputs">
					<b><?php echo $this->lang_file->heading_fetch('pop_apmc');?></b>
					<select class="form-control" id="min_max_apmc">
						<option value="0">-- <?php echo $this->lang_file->heading_fetch('pop_select');?> --</option>
					</select>
				</div>
				
				<div class="col-md-2 emandi-select e-trade-inputs">
					<b><?php echo $this->lang_file->heading_fetch('min_max_commodity');?></b>
					<select class="form-control" id="min_max_commodity">
						<option value="0">-- <?php echo $this->lang_file->heading_fetch('pop_select');?> --</option>
					</select>
				</div>
				<div class="col-md-2 emandi-select e-trade-inputs1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo $this->lang_file->heading_fetch('for_date');?> <span style="color:#F00"> *</span></b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="form-control" type="date" id="min_max_apmc_from_date"></div>

				<!-- <div class="col-md-2 emandi-select e-trade-inputs1"><b><?php echo $this->lang_file->heading_fetch('min_max_to_date');?></b> <input class="form-control" type="date" id="min_max_apmc_to_date" min="<?php echo date('Y-m-d', strtotime($date .' -7 day'));?>" max="<?php echo $date;?>"/></div> -->
				<div class="col-md-2 emandi-select e-trade-refresh-b">
					<input style="margin-top:21px;" class="btn btn-primary" type="button" value="<?php echo $this->lang_file->heading_fetch('pop_submit');?>" id="refresh">
				</div>
				<div style="padding-left: 20px;" class="col-md-2 emandi-select e-trade-refresh-b">
					<input style="margin-top:21px;" class="btn btn-danger" type="button" value="<?php echo $this->lang_file->heading_fetch('pop_refresh');?>" id="refresh">
				</div>
			</div>
			<div class="col-sm-3 content-3 h-space-padd-r-l">
				<div class="focus-section">
					<div class="sidebar-header-title"><span><?php echo $this->lang_file->heading_fetch('enam_coverage'); ?></span></div>
					<div class="home-ind-map">
						<a href="javascript:void(0);"><img src="<?php echo base_url();?>/assest/images/new-theme/map.jpg" usemap="#image-map" class="state_district"></a>
					</div>
				</div>
			</div>

		</div>
	</div>
</section>

<script type="text/javascript">
	$('#backBtn').click(function(){
		parent.history.back();
	});
</script>