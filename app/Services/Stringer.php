<?php namespace App\Services;

use Exception;

class Stringer {

	
	
	protected $attributes = array(
		'unit'=>'Inches',
		'maxTreadRise'=>self::MAXIMUM_TREAD_RISE
	);

	const MAXIMUM_TREAD_RISE = '7.75';
	const MINIMUM_TREAD_RUN = '9';

	public function __construct($boardWidth, $treadRun, $deckingHeight) {
		$this->boardWidth = $boardWidth;

		if($treadRun < self::MINIMUM_TREAD_RUN) {
			throw new Exception("Tread Run is not large enough, Minimum Required: ".$this->minTreadRun);
		} else {
			$this->treadRun = $treadRun;
		}

		$this->deckingHeight = $deckingHeight;
	}

	/**
	 * Dynamically retrieve attributes on the model.
	 *
	 * @param  string  $key
	 * @return mixed
	 */
	public function __get($key)
	{
		return $this->getAttribute($key);
	}

	/**
	 * Dynamically set attributes on the model.
	 *
	 * @param  string  $key
	 * @param  mixed   $value
	 * @return void
	 */
	public function __set($key, $value)
	{
		$this->setAttribute($key, $value);
	}

	public function getAttributes()
	{
		return $this->attributes;
	}

	public function setAttribute($key, $value) {
		$this->attributes[$key] = $value;
	}

	public function getAttribute($key) {
		if (array_key_exists($key, $this->attributes))
		{
			return $this->attributes[$key];
		}
	}

	public function calculate() {
		// the distance from one point on the tread to the same point on the next tread. 
		// this will be the same for all but the bottom step.
		$this->treadSpacing = sqrt(pow($this->treadRun, 2) + pow($this->treadRise, 2));

		// the angles that match the rise and the run for the step.  these will be used to calculate the
		// distances of all the relative pieces of the board using trig
		$this->treadRiseAngle = asin($this->treadRise / $this->treadSpacing);
		$this->treadRunAngle = asin($this->treadRun / $this->treadSpacing);

		// this is the number of inches the tread will cut into the board perpendicular, the point where the most
		// board is removed to create the tread on the stringer.
		$this->boardInset = sin($this->treadRiseAngle) * $this->treadRun;

		// the amount of board that remains along the same plane as the board inset.  the point of the board where the
		// least material will remain on the stringer.
		$this->boardRemaining = $this->boardWidth - $this->boardInset;

		// this ratio can be used to calculate some of the values like the attachement point.  for instance if the board was 14" in depth the amount
		// of board left for attaching to the ledger will be greater than a 12" board, but it varies by a ratio of the board to the inset.
		$ratioMissing = $this->boardRemaining / $this->boardInset;

		// using the ratio we can calculate how much attachment remains based on the treadRise
		$this->boardAttachment = $ratioMissing * $this->treadRise;

		// using the tread rise angle we can figure out the max distance across the board, which
		// is food for thought for the bottom tread as that will be the max amount of board remaining
		// after shortening the height of the bottom tread to accomodate for the decking.
		$this->crossSection = $this->boardWidth / sin($this->treadRiseAngle); 

		// the bottom stair needs the decking height subtracted from it so when you put the decking onto
		// the stringers all the stairs will be the same height.
		$this->bottomStairRise = $this->treadRise - $this->deckingHeight;

		// these numbers are used to draw the remaining parts of the bottom step.  since drawing in 
		// computers is x,y point based, we need to know the distances
		$this->bottomInset = sin($this->treadRunAngle) * $this->bottomStairRise;
		$this->bottomOffset = cos($this->treadRunAngle) * $this->bottomStairRise;

		$this->boardRemainingBottom = $this->boardWidth - $this->bottomInset;

		$this->bottomBoardLength = $this->boardRemainingBottom / cos($this->treadRunAngle);
		$this->bottomBoardBack = sqrt( pow($this->bottomBoardLength,2) - pow($this->boardRemainingBottom, 2));

		$this->largeTreadOffset = $this->treadRun * cos($this->treadRiseAngle);
		$this->smallTreadOffset = $this->treadRise * sin($this->treadRiseAngle);

		$this->attachmentOffset = sin($this->treadRiseAngle) * $this->boardAttachment;
	}	


	public static function calculateByTotalHeight($boardWidth, $treadRun, $deckingHeight, $totalHeight, $maxTreadRise = null) {
		$stringer = new static($boardWidth, $treadRun, $deckingHeight);

		if($maxTreadRise !== null) {
			if($maxTreadRise > static::MAXIMUM_TREAD_RISE) {
				throw new Exception("The absolute maximum tread cannot exceed: ".self::MAXIMUM_TREAD_RISE);
			} else {
				$stringer->maxTreadRise = $maxTreadRise;
			}
		} else {
			$stringer->maxTreadRise = static::MAXIMUM_TREAD_RISE;
		}		

		$stringer->heightOfStairs = $totalHeight;
		
		$stringer->numberOfStairs = ceil($totalHeight / $stringer->maxTreadRise);		
		$stringer->treadRise = $stringer->heightOfStairs / $stringer->numberOfStairs;

		$stringer->calculate();

		return $stringer;
	}

	public static function calculateByNumberOfStairs($numberOfStairs, $maxTreadRise = null) {
		if($maxTreadRise > self::MAXIMUM_TREAD_RISE) {
			throw new Exception("The absolute maximum tread cannot exceed: ".$this->maxTreadRise);
		}

		$stringer = new static($boardWidth, $treadRun, $deckingHeight);

		$stringer->treadRise = $maxTreadRise;
		$stringer->numberOfStairs = $numberOfStairs;
		$stringer->heightOfStairs = $stringer->treadRise * $stringer->numberOfStairs;

		$stringer->calculate();
	}

}
