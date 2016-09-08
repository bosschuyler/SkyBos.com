<?php

namespace App\Helpers;

class DiceHelper {
	protected $sides = null;
	
	public function __construct($sides) {
		if($sides > 6) {
			throw new Exception('Cannot create a dice over the size of 6');
		}
		$this->sides = $sides;
	}
	
	public static function dice() {
		// DO NOT MODIFY THIS FUNCTION
		return rand(1, 6);
	}
	
	public function roll() {
		if($this->sides == 6) {
			return self::dice();
		} else {
			if(6 % $this->sides == 0) {
				return self::dice() % $this->sides;
			} else {
				$roll = self::dice();
				while($roll > $this->sides) {
					$roll = self::dice();
				}
				return $roll;
			}
		}
	}	
}

function oneToHundred() {	
	$fourSidedDice = new Dice(4);
	$fiveSidedDice = new Dice(5);
		
	// 0-24, 25-49, 50-74, 75-99
	$bucket = ($fourSidedDice->roll()-1) * 25;	
	//generate a number 0, 5, 10, 15, 20
	$range = ($fiveSidedDice->roll()-1) * 5;
	//0-4
	$fill = ($fiveSidedDice->roll()-1);
	$total = $bucket + $range + $fill + 1;
	return $total;
}

function generateData($iterations) {
	$data = array();
	for($y=0; $y < $iterations; $y++) {
		$diceRoll = oneToHundred();
		if(isset($data[$diceRoll])) {
			$data[$diceRoll] += 1;
		} else {
			$data[$diceRoll] = 1;
		}
	}
	echo '<pre>';
	ksort($data);
	print_r($data);
}
