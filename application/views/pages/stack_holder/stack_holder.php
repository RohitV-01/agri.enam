<section class="title-header-bg">
	<div class="text-center">
		<h3><?php echo $this->lang_file->heading_fetch('heading_stackholder'); ?></h3>
        <div style="margin-top:12px;" class="text-center"><a href="<?php echo base_url(); ?>" title=""><img style="margin-top:-6px;" alt="" src="<?php echo base_url(); ?>/assest/images/home-ico.png" /></a> <span id="bredcrum"> / <?php echo $this->lang_file->heading_fetch('heading_stackholder'); ?></span></div>

	</div>
</section>

<section class="content-section o-content-sec">
<div class="container-fuild" style="padding-left:4%;padding-right:4%;padding-bottom:35px;">
<div class="row">
<div class="col-md-12 video-gallery events-list table-responsive">
<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th style="text-align:center;">S. No.</th>
			<th style="text-align:center;">State</th>
			<th style="text-align:center;">Trader</th>
			<th style="text-align:center;">Commission Agent</th>
			<th style="text-align:center;">Service Provider</th>
			<th style="text-align:center;">Fpos</th>
			<th style="text-align:center;">Farmer</th>
		</tr>
	</thead>
	<tbody id="stack_holder_data">
	</tbody>
</table>
</div>
</div>
</div>
</section>

<?php 
$c = 1;
		$url_array ='';
		while($this->uri->segment($c) != ''){
			$url_array.= $this->uri->segment($c).'/';
			$c = $c + 1;
		}
		$url_array = strtolower(rtrim($url_array,"/ "));
		?>
<script type="text/javascript">
var baseUrl = $('#base_url').val();
$.ajax({
	type: 'post',
	url: baseUrl+'Ajax_ctrl/menu_activate/<?php echo $url_array;?>',
	dataType: "json",
	data:{},
	beforeSend: function(){},
	complete: function(){},
	success: function (response){
		if(response.status == 200){
			console.log(response);
			if (typeof response.data[0].id !== 'undefined') {
				$('#menuid_'+response.data[0].id).addClass('active');	
			}
			if (typeof response.data[0].p_id !== 'undefined') {
				$('#menuid_'+response.data[0].p_id).addClass('active');
			}
		    $('#bredcrum').html(response.bredcrum);	
		}
        else{
			$('#bredcrum').html(response.bredcrum);	
		}
	}
});


function number_formate(num){
	var a = num;
	 var b = ",";
	 if(a.length == 4){
		 var position = 1;
		 var output = [a.slice(0, position), b, a.slice(position)].join('');
	 }
	 else if(a.length == 5){
		 var position = 2;
		 var output = [a.slice(0, position), b, a.slice(position)].join('');
	 }
	 else if(a.length == 6){
		 var position = 1;
		 var output = [a.slice(0, position), b, a.slice(position)].join('');
		 var position = 4;
		 var output = [output.slice(0, position), b, output.slice(position)].join('');
	 }
	 else if(a.length == 7){
		 var position = 2;
		 var output = [a.slice(0, position), b, a.slice(position)].join('');
		 var position = 5;
		 var output = [output.slice(0, position), b, output.slice(position)].join('');
	 }
	 else if(a.length == 8){
		 var position = 1;
		 var output = [a.slice(0, position), b, a.slice(position)].join('');
		 var position = 4;
		 var output = [output.slice(0, position), b, output.slice(position)].join('');
		 var position = 7;
		 var output = [output.slice(0, position), b, output.slice(position)].join('');
	 }
	 else{
		 var output = num;
	 }
	return output;
}
 
$.ajax({
	        type: 'POST',
	        url: 'http://www.enam.gov.in/NamWebSrv/rest/getPortalUserRegisteredState',
	        dataType: "json",
	        data: {
	        	'language'	:'en'
	        },
	        beforeSend: function(){
				$('#stack_holder_data').html('<td colspan="6" style="text-align:center;"><p><b>Loading...</b></p></td>');
	        },
	        complete: function(){},
	        success:function (response) {
				var x = '';
				var c = 1;
				var buyer = 0;
                var commission_agent = 0;
                var service_provider = 0;
                var seller = 0;
				fpos = 0;
				$.each(response.portalUserStateList,function(key,value){
                     buyer = parseInt(buyer + parseInt(value.trader));
                     commission_agent = parseInt(commission_agent + parseInt(value.commsionAgent));
                     service_provider = parseInt(service_provider + parseInt(value.serviceProvider));
                     seller = parseInt(seller + parseInt(value.farmer));
					 farmer = number_formate(value.farmer);
					 trader = number_formate(value.trader);
					 commsionAgent = number_formate(value.commsionAgent);
					 serviceProvider = number_formate(value.serviceProvider);
					 /////get fpo counts
					 $.ajax({
			    	        type: 'POST',
			    	        url: 'http://enam.gov.in/NamWebSrv/rest/NfclWS/getUserRegisterFPOFPCCount',
			    	        dataType: "json",
			    	        data: {
			    	        	'language'	:'en',
			    	            'fromDate' : $('#global_previous_date').val(),
			    		    	'toDate' : $('#global_current_date').val(),
			    	        	'stateId' : value.stateId
			    	        },
			    	        async: false,
			    	        beforeSend: function(){
			    	        },
			    	        complete: function(){},
			    	        success:function (response) {
			    	        	if(response.statusMsg == "S"){
			    	        		//fpo = response.listRegistrationCounterFPOFPCCommonModel.length;
			    	        		fpo = 0;
			    	        		$.each(response.listRegistrationCounterFPOFPCCommonModel,function(k,v){
			    	        		  fpo = fpo = parseInt(fpo) + parseInt(v.count);	
			    	        		});
			    	        		fpos = parseInt(parseInt(fpos) + parseInt(fpo));
			    	        	}
			    	        	else{
			    	        		fpo = 0;
			    	        		fpos = parseInt(parseInt(fpos) + parseInt(fpo));
			    	        	}
			    	        }
			        	});
					 ///////fpo count close
					x = x + '<tr><td align="center">'+ c +'</td><td align="center">'+ value.stateName +'</td><td align="center">'+ trader +'</td><td align="center">'+ commsionAgent +'</td><td align="center">'+ serviceProvider +'</td><td align="center">'+ fpo +'</td><td align="center">'+ farmer +'</td></tr>';
				c++; });
				buyer = number_formate(buyer.toString());
				commission_agent = number_formate(commission_agent.toString());
				service_provider = number_formate(service_provider.toString());
				seller = number_formate(seller.toString());
x = x + '<tr><td style="text-align:center;" colspan="2"><b>Total</b></td><td align="center"><b>'+ buyer +'</b></td><td align="center"><b>'+ commission_agent +'</b></td><td align="center"><b>'+ service_provider +'</b></td><td align="center"><b>'+ fpos +'</b></td><td align="center"><b>'+ seller +'</b></td></tr>' 
	        	$('#stack_holder_data').html(x);
	        }
		});
</script>