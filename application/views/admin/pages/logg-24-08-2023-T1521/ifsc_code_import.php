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
		<li class="active">Excel Import</li>
	</ol>
	<section class="content-header">
		<h1 class="pull-left">IFSC Data Import</h1>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<!-- Left col -->
			<section class="col-lg-12 connectedSortable">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Import Excel Data of IFSC</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
								<i class="fa fa-minus"></i>
							</button>
						</div>
					</div>
					<form name="video_form" id="import_form" role="form" class="form-horizontal" method="POST">
            			<div class="box-body">
            				<div class="form-group">
            					<label class="col-sm-2 control-label">Select Excel File</label>
            					<div class="col-sm-3">
            						<input type="file" name="file" id="file" class="form-control" accept=".xls, .xlsx, .csv" />
            						<div class="text-danger" id="from_date_error" style="display:none;"></div>
            					</div>
            				</div>
            			</div>
                		<div class="box-footer">
        					<button id="import" type="button" class="btn pull-right btn-info">Upload</button>
        					<button type="reset" class="btn btn-default pull-right btn-space">Cancel</button>
                            <!-- <a href="<?php echo base_url(); ?>docs/sample_format_for_NSC.xlsx" style="margin-right:10px;" class="btn btn-primary pull-right">Sample Data</a> -->
        				</div>	
					</form>
					<br />
					
				</div>
			</div>
		</section>
	</div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript">

    // var baseUrl = $('#base_url').val();
    var newRowFlag = 0, rowCnt = 0, r=0;

    var srno ='';
    var bankname='';
    var ifsc='';
    var branch='';
    var address='';
    var city1='';
    var city2='';
    var state='';
    var stdcode='';
    var phone='';

    var dealerLat='';
    var dealerLongi='';
    var areaOfficeName='';
    var areaOfficeAdd='';
    var areaOfficePin='';
    var areaOfficeIncha='';
    var areaOfficeInchaemail='';
    var areaOfficeInchaMob='';
    var commName='';
    var hybreedSeed='';
    var opSeed='';
    var prodInfo='';

    var checkArr = [];
    var pArr = [];
    var finalArr=[];

    $(document).on('click','#import', function(){
        var path = 'docs/';
        var file = document.getElementById("file").files.length;
        var formvalid = true;
        if(file < 1){
            $('#from_date_error').html('Please select excel file.').css('display','block');
            formvalid = false;
        }else{
            $('#from_date_error').css('display','none'); 
        }

        
        if(formvalid){
            // $('#loader').modal({'show':true});	
            var fileInput = document.getElementById("file");
            var form = new FormData();
            form.append("file", fileInput.files[0]);

            var settings = {
                "url": "https://enam.gov.in/UtilityAppWS/ifscUpload", 
                "method": "POST",
                "timeout": 0,
                "headers": {
                    "Cookie": "SERVERID=node44"
                },
                "processData": false,
                "contentType": false,
                "data": form
            };

            $.ajax(settings).done(function(response) {
                console.log(response);
                            if(response.status == 'S'){
                                // $('#loader').modal('hide');
                                    alert(response.message);
                                    location.reload();
                                }else{
                                    alert(response.message);
                                    // $('#loader').modal('hide');
                                    $("#file").val("");

                                }
                
            });
        }

});       


 
   
</script>