<?php
//newly added
foreach($unified as $u){ 
$date = $u['created_at'] ;
$originalDate = $date;
$newDate = date("jS F Y", strtotime($originalDate)); //18th October 2019 date format
}

$table = '
<div class="col-sm-12" align="right">As on '.$newDate.'</div>
<div class="col-sm-2" style="width:100%;"><table class="table table-bordered unified">
		<tr>
			<th>S.No.</th>
			<th>Name of State/UT
			</th>
			<th>Mandis registered on e-NAM
			</th>
			<th>Registered Traders on e-NAM
			</th>
			<th>No. of Unified licenses issued by State
			</th>
		</tr>';
	$i = 1;
	$mandis_registered = '';
	$registered_traders = '';
	$unified_licence = '';
	

foreach($unified as $u){ 

	$table .= '<tr>'.
			'<td>'.$i.'</td>'.
		'<td>'.$u['name_state'].'</td>'.
		'<td>'. $this->substring->numbers($u['mandis_registered']).'</td>'.
		'<td>'. $this->substring->numbers($u['registered_traders']).'</td>'.
		'<td>'.$this->substring->numbers($u['unified_licence']).'</td>'.
	'</tr>';
	$i++;
	$mandis_registered = (int)$mandis_registered + (int)$u['mandis_registered'] ;
	$registered_traders = (int)$registered_traders+ (int)$u['registered_traders'];
	$unified_licence = (int)$unified_licence+ (int)$u['unified_licence'];
}

$table .= '<tr>
			<td colspan="2"><b>Total</b></td>
			<td><b>'.$this->substring->numbers($mandis_registered).'</b</td>
					
			<td><b>'.$this->substring->numbers($registered_traders).'</b></td>
			<td><b>'.$this->substring->numbers($unified_licence).'</b></td>
		</tr>
		</table></div>';
print_r($table);
?>
