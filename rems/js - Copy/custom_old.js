load_first();
var local_data;
var total_apmc = 0;
var total_mol = 0;
var flag = 1;
var page_counter = 0;
c = 0;
function load_first(){
$.ajax({
		type : 'POST',
		url : 'http://www.enam.gov.in/NamWebSrv/rest/liveBidding/stateWise',
		dataType : 'json',
		data : {
			'orgId' : 1,
			'language' : 'en'
		},
		success : function (response){
			local_data = response;
			create_table(c);
			$.each(response.listActiveState, function(key,value){ 
				var stateName = value.stateName.toUpperCase().split(' ').join('_');
				
				if(value.activeCount != '0'){
					//$('#'+ stateName+'').css({"background-image":"url(images/state-map/"+ stateName +"_GREEN.png)","background-repeat":"no-repeat"});
					$('#'+ stateName+'').find('span').css({"background-image":"url(images/green-lamp.png)","background-repeat":"no-repeat"});
				}
				else{
					//$('#'+ stateName+'').css({"background-image":"url(images/state-map/"+ stateName +"_RED.png)","background-repeat":"no-repeat"});
					$('#'+ stateName+'').find('span').css({"background-image":"url(images/red-lamp.png)","background-repeat":"no-repeat"});
				}
			total_apmc = parseInt(parseInt(total_apmc) + parseInt(value.oprCount));
			total_mol = parseInt(parseInt(total_mol) + parseInt(value.activeCount));
			});
		}
	});
}

var nor = 6;
function create_table(c){
	page_counter = c;
	console.log(c);
	var x = '';
	var i = 0;
	var j = c;
	
	var counter = 0;
	$.each(local_data.listActiveState, function(key,value){ 
		if(counter < j*nor){
			counter++;
		}
		else{
			if(i == j || i < nor){
			var stateName = value.stateName.toUpperCase();
				x = x + '<tr>'+
					  '<td>'+ stateName +'</td>'+
					  '<td>'+ value.oprCount +'</td>'+
					  '<td>'+ value.activeCount +'</td>'+
					  '</tr>'; 
			}
			i++;
		}
	});
	var links = '';
	var link_Class = '';
	if(c == 0){
		link_Class = 'active';
	}
	links = links + '<a onclick="create_table('+ parseInt(0) +');" class="'+ link_Class +'"> 1 &nbsp;</a>';
	
	for(var i=1; i<= (local_data.listActiveState.length) / nor;i++){
		var link_Class = '';
		if(i == c){
			link_Class = 'active';
			links = links + '<a onclick="create_table('+ parseInt(i) +');" class="'+ link_Class +'">'+ parseInt(i+1) +' &nbsp;</a>';
		}
		else{
			links = links + '<a onclick="create_table('+ parseInt(i) +');">'+ parseInt(i+1) +' &nbsp;</a>';
		}
	}

	$('#pages').html(links);
	$('#state_table').html(x);
	if(local_data.listActiveState.length < parseInt(c+1)*nor){
		$('#total_apmc').html("Total APMC: "+total_apmc).show();
		$('#total_mol').html("Total Online Mandis: "+total_mol).show();
	}
	else{
		$('#total_apmc').hide();
		$('#total_mol').hide();
	}
	flag = 0;
}

$(document).on('click','#page_refresh',function(){
	location.reload();
});


if(flag){
	setInterval(hello, 5000);
}
function hello(){
	flag = 1;
	var counter = parseInt((local_data.listActiveState.length) / nor);
	if(page_counter == counter){
		page_counter = 0;
	}
	else{
		page_counter++;
	}
	create_table(page_counter);
}
setTimeout(function(){
  location.reload();
}, 900000);