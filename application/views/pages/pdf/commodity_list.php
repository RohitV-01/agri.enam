     <?php
	 /*$to = '<div class="col-sm-2" style="width:20%;"><table class="table"><tr><th>S.No.</th><th>Commodity</th></tr>';
	 $tc = '</table></div>';
	 $total = '';
	 $x = '';
	 $x1 = '';
	 
	 for($i=1; $i<= count($commodity); $i++){
	     if($i % 25 != 0){
	         $x = $x1.$x.'<tr><td>'.$i.'.</td><td><a class="" data-id="'.$commodity[$i-1]['c_id'].'" href="javascript:void(0);">'.$commodity[$i-1]['commodity_name'].'</a></td></tr>';
	          $x1 = '';
	          if($i==count($commodity)){
	              $total = $total.$to.$x.$tc;
	          }
	     }
	     else{
	         $total = $total.$to.$x.$tc;
	         $x1 = $x1.'<tr><td>'.$i.'.</td><td><a class="" data-id="'.$commodity[$i-1]['c_id'].'" href="javascript:void(0);">'.$commodity[$i-1]['commodity_name'].'</a></td></tr>';
	         $x = '';
	     }
	  }
	  print_r($total);*/
	  ?>
    

	 <?php 
	 $html = '';
	 $c = 1;
	 foreach($commodity as $key => $com){
	    $count = $key + 1; 
		if(!$key){
			$x = $com['cg_name'];
			$html = '<div id="container"><div id="ravi" class="mitem"><table class="table table-border table-striped comm-li-box"><thead><tr><th colspan="1">'.$com['cg_name'].'</th></tr></thead><tbody>';
		}
		if($x == $com['cg_name']){
			$html .= '<tr><td>'.$c.'. '.$com['commodity_name'].'</td></tr>';
			$c = $c + 1;
		}
		else{
			$x = $com['cg_name'];
			$html .= '</tbody></table><br/><br/></div><div class="mitem"><table class="table table-border table-striped comm-li-box"><thead><tr><th colspan="1">'.$com['cg_name'].'</th></tr></thead></tbody><tr><td> 1. '.$com['commodity_name'].'</td></tr>';
			$c = 2;
		}
	 }
		$html .= '</tbody></table><br/><br/></div></div>'; 
		print_r($html);
	?>	


	 