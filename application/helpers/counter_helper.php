<?php defined('BASEPATH') OR exit('No direct script access allowed.');

if ( ! function_exists('count_visitor')) {
    function count_visitor()
    {
		$ci = & get_instance();  
		$counter_name = "counter.txt";
		if (!file_exists($counter_name)) {
			$f = fopen($counter_name, "w");
			fwrite($f,"0");
			fclose($f);
		}

		// Read the current value of our counter file
		$f = fopen($counter_name,"r");
		$counterVal = fread($f, filesize($counter_name));
		fclose($f);
		// Has visitor been counted in this session?
		// If not, increase counter value by one
		if(!isset($_SESSION['hasVisited'])){
			$_SESSION['hasVisited']="yes";
			$counterVal++;
			$f = fopen($counter_name, "w");
			fwrite($f, $counterVal);
			fclose($f);
		}

		//echo "You are visitor number $counterVal to this site";
		echo "$counterVal";

	}
}
?>