<div class="quick-link-list">
	<ul>
		<?php
		//print_r($links);die;
		
		if(count($links) > 0) { 
			foreach($links as $link){
                $str = html_entity_decode($link['link_contect']);
				$regex = "/\[(.*?)\]/";
				$data['output'] = $str;
				preg_match_all($regex, $str, $matches);
				for($i =0; $i < count($matches[1]); $i++){
					
					$link['link_contect'] = str_replace($matches[0][$i],$this->substring->image_path(),$link['link_contect']);

				}
?> 
				<li>
					<?php echo $link['link_contect']; ?>
				</li>			
		<?php } } ?>
	</ul>
</div>

