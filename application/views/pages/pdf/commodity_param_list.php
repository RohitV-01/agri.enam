
    
    <?php 
	$html = '';
	 $c = 1;
	 foreach($commodity as $key => $com){
	    $count = $key + 1; 
		if(!$key){
			$x = $com['cg_name'];
			$html .= '<div id="container"><div id="ravi" class="mitem"><table class="table table-border table-striped comm-li-box"><thead><tr><th colspan="1">'.$com['cg_name'].'</th></tr></thead><tbody>';
		}
		if($x == $com['cg_name']){
			$html .= '<tr><td>'.$c.'. <a class="commodity_modal" data-id="'.$commodity[$count-1]['c_id'].'" href="javascript:void(0);">'.$com['commodity_name'].'</a></td></tr>';
			$c = $c + 1;
		}
		else{
			$x = $com['cg_name'];
			$html .= '</tbody></table><br/><br/></div><div class="mitem"><table class="table table-border table-striped comm-li-box"><thead><tr><th colspan="1">'.$com['cg_name'].'</th></tr></thead></tbody><tr><td> 1. <a class="commodity_modal" data-id="'.$commodity[$count-1]['c_id'].'" href="javascript:void(0);">'.$com['commodity_name'].'</a></td></tr>';
			$c = 2;
		}
	 }
		$html .= '</tbody></table></div></div>'; 
		echo $html; 
	?>	
	


	 