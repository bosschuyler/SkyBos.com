<?php

namespace App\Helpers;

class ViewHelper {
	public static function fraction($number, $fraction = 32) {
		$wholeNumber = floor($number);
		$leftOver = $number - $wholeNumber;

		$output = $wholeNumber; 

		if($leftOver > 0) {
			$numerator = round($leftOver * $fraction);
			if($numerator > 0) {
				$newDenom = $fraction;
				while(($numerator % 2) == 0) {
					$numerator = $numerator / 2;
					$newDenom = $newDenom / 2;
				}
				

				$output .= '&nbsp;<sup>'.$numerator.'</sup>&frasl;<sub>'.$newDenom."</sub>";
			}

			
		}

		return $output;
	}

}	
	