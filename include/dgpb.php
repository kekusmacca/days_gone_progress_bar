<?php
class daysGoneProgressBar
{
	//  publics
	public $start_date;
	public $end_date;
	
	// internal
	protected $now;
	protected $total_days;
	protected $days_gone;
	protected $days_to_come;
	protected $percent;
	
	// Class declaration
	 public function __construct
    (
      $start_date,
      $end_date
    )
    {
	$this->start_date = $start_date; 
	$this->end_date = $end_date;
	$this->now = strtotime(date('Y-m-d'));
	
	// Validate Date inpit before moving on
	if(!$this->validateDate($start_date, 'Y-m-d') || !$this->validateDate($end_date, 'Y-m-d')){
		$msg = $this->formatErrorMessage("Error: Date input invalid.");
		throw new Exception($msg);
		return;
	} else {
		$this->start_date = strtotime($start_date); 
		$this->end_date = strtotime($end_date); 
	}
	
	// make sure we are not traveling backwards through time
	if($this->start_date >= $this->end_date){
		$msg = $this->formatErrorMessage("Error: Dates reversed.");
		throw new Exception($msg);
		return;
	}

	// Run through calculations
	$this->calcTotalDays();
	$this->calcDaysGone();
	$this->calcDaysToCome();
	$this->calcPercentage();
    }
	
	// Calculate total number of days
	protected function calcTotalDays() {
		$date_diff = $this->end_date - $this->start_date;	
		$this->total_days = round($date_diff/ (60 * 60 * 24));
	}
	
	// Calculate number of days gone
	protected function calcDaysGone() {
		$date_diff = $this->now - $this->start_date;
		$this->days_gone = round($date_diff / (60 * 60 * 24));
	}
	
	// Calculate number of days to come
	protected function calcDaysToCome() {
		$date_diff =  $this->end_date - $this->now;
		$this->days_to_come = round($date_diff / (60 * 60 * 24));
	}
	
	// Calculate percentage for progress bar
	protected function calcPercentage() {
		if($this->total_days != 0){
			$this->percent = floor(($this->days_gone/$this->total_days)*100);
		} else {
			throw new Exception("<br />ERROR: Can't divide by zero");
			return;
		}
	}
	
    // Display bar
    public function displayBar() {
		
		$msg = "Warning: no message"; // should have a message by the end of fuction
		
		if($this->now > $this->end_date) {
			// Deadline passed
			$msg = "Deadline overdue by  " . abs($this->days_to_come);
			echo $this->buildBar($msg, "red");
		} 
		else if($this->now == $this->end_date) { 
			// Today is final day
			$msg = "Times up!";
			echo $this->buildBar($msg, "green");
		} 
		else if($this->days_to_come <= 7) { 
			// Only 7 more days left
			$msg = "Deadline is " . $this->days_to_come . " days away.";
			echo $this->buildBar($msg, "orange");
		} 
		else if($this->now < $this->start_date) { 
			// Day not here yet
			$msg = "Starts in " . abs($this->days_gone) . " days.";
			echo $this->buildBar($msg, "yellow");
		} else {  
			// normal progression
			$msg = $this->days_to_come . " days left.";
			echo $this->buildBar($msg, "blue");
		}
    }
	
	// Builds bar based on given data
	private function buildBar($msg, $color){
		
		$str = "<div class=\"dgpb-container\">";
		$str .= "<div class=\"dgpb-border\">";
		$str .= "<div class=\"dgpb-{$color}\" style=\"height:24px;width:{$this->percent}%\">{$msg}</div>";
		$str .= "</div>";
		$str .= "</div>";
		return $str;
	}
	
	// Display days gone by
    public function displayDaysGone() {
        echo $this->days_gone;
    }
	
	// Display days left to go
    public function displayDaysLeft() {
        echo $this->days_to_come;
    }
	
	// Validate date input - YYYY-MM-DD - bonus: can be used to validate any format :-)
	protected function validateDate($date, $format = 'Y-m-d H:i:s') {
		$d = DateTime::createFromFormat($format, $date);
		return $d && $d->format($format) == $date;
	}
	
	public function showInfo() {
		echo "<div class=\"dgpb-container\">";
		echo "<br />";
		echo "Total days(duration): " . $this->total_days;
		echo "<br />";
		echo "Days gone: " . $this->days_gone ;
		echo "<br />";
		echo "Days to come: " . $this->days_to_come;
		echo "<br />";
		echo "Percentage: " . $this->percent;
		echo "<br />";
		echo "<br />";
		echo " </div>";
	}
	
	// Format custom exeption messages
	protected function formatErrorMessage($msg){
		$str =  "<div class=\"dgpb-container\">";
		$str .= "<div class=\"dgpb-border\">";
		$str .= "<div class=\"dgpb-error\" style=\"height:24px;width:100%\">";
		$str .= $msg;
		$str .= " </div>";
		$str .= " </div>";
		$str .= " </div>";
		return $str;
	}
}
?>
