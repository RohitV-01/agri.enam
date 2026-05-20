<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Substring  {
	function trim_text($input, $length, $ellipses = true, $strip_html = true) {
		//strip tags, if desired
		if ($strip_html) {
			$input = strip_tags($input);
		}
	
		//no need to trim, already shorter than trim length
		if (strlen($input) <= $length) {
			return $input;
		}
	
		//find last space within length
		$last_space = strrpos(substr($input, 0, $length), ' ');
		$trimmed_text = substr($input, 0, $last_space);
	
		//add ellipses (...)
		if ($ellipses) {
			$trimmed_text .= '...';
		}
	
		return $trimmed_text;
	}
	
	function time_elapsed_string($time) {
		$time_difference = time() - $time;
		if( $time_difference < 1 ) { return 'less than 1 second ago'; }
		$condition = array( 12 * 30 * 24 * 60 * 60 =>  'year',
				30 * 24 * 60 * 60       =>  'month',
				24 * 60 * 60            =>  'day',
				60 * 60                 =>  'hour',
				60                      =>  'minute',
				1                       =>  'second'
		);
	
		foreach( $condition as $secs => $str )
		{
			$d = $time_difference / $secs;
			if( $d >= 1 )
			{
				$t = round( $d );
				return 'about ' . $t . ' ' . $str . ( $t > 1 ? 's' : '' ) . ' ago';
			}
		}
	}

        function image_path(){
		return base_url();
	}
	
	
	
	function numbers($num){
		$a = $num;
		$b = ",";
		if(strlen($a) == 4){
			$position = 1;
			$output = substr($a,-4,$position).$b.substr($a,-3);
		}
		else if(strlen($a) == 5){
			$position = 2;
			$output = substr($a,-5,$position).$b.substr($a,-3);
		}
		else if(strlen($a) == 6){
			$position = 1;
			$output = substr($a,-6,$position).$b.substr($a,-5);
			$position = 4;
			$output = substr($output,-7,$position).$b.substr($a,-3);
		}
		else if(strlen($a) == 7){
			$position = 2;
			$output = substr($a,-7,$position).$b.substr($a,-5);
			$position = 5;
			$output = substr($output,-8,$position).$b.substr($a,-3);
		}
		else if(strlen($a) == 8){
			$position = 1;
			$output = substr($a,-8,$position).$b.substr($a,-7);
			$position = 4;
			$output = substr($output,-9,$position).$b.substr($a,-5);
			$position = 7;
			$output = substr($output,-10,$position).$b.substr($a,-3);
		}
		else{
			$output = $num;
		}
		return $output;
	}
	
	
	
}

?>
