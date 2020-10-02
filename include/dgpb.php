<?php
class daysGoneProgressBar
{
	// internal
	// protected $start_date;
	// protected $end_date;
	// protected $now;
	// protected $total_days;
	// protected $days_gone;
	// protected $days_to_come;
	// protected $percent;

	// Class declaration
	 public function __construct
    (
      $start_date,
      $end_date
    )
    {
			$this->start_date = $start_date;
			$this->end_date = $end_date;
			$this->now = new DateTime();
			// $this->now = strtotime(date('Y-m-d'));

			// Validate Date inpit before moving on
			if(!$this->validateDate($start_date, 'Y-m-d') || !$this->validateDate($end_date, 'Y-m-d')){
				$msg = $this->formatErrorMessage("Error: Date input invalid.");
				throw new Exception($msg);
				return;
			} else {
				$this->start_date = new DateTime($start_date);
				$this->end_date = new DateTime($end_date);
			}

			// make sure we are not traveling backwards through time
			if($this->start_date >= $this->end_date){
				$msg = $this->formatErrorMessage("Error: Dates reversed.");
				throw new Exception($msg);
				return;
			}

			// initialize values
			$this->total_days = $this->start_date->diff($this->end_date)->format('%a');
			$this->days_gone = $this->start_date->diff($this->now)->format('%r%a');
			$this->days_to_come = $this->now->diff($this->end_date)->format('%r%a');

			// get % for progress bar
			$this->percent = $this->PercentOfTotal($this->days_gone, $this->total_days);
    }

	// Calculate percentage for progress bar
	protected function PercentOfTotal($partial, $total) {
		//days_gone/total_days
		if($this->total_days != 0){
			return floor(($partial/$total)*100);
		} else {
				throw new Exception("<br />ERROR: Can't divide by zero");
			return;
		}
	}

	protected function getCountdownToDeadline(){
		return $this->now->diff($this->end_date)->format('%yY %mM %dD');
	}

	protected function getCountdownToStart(){
		return $this->now->diff($this->start_date)->format('%yY %mM %dD');
	}

  // Display bar
  public function displayBar() {
		$msg = $this->getCountdownToDeadline();
		if($this->days_to_come == 0) {
			// Today is final day
			echo $this->buildBar($msg, "strong-warning");
		}
		else if($this->now > $this->end_date) {
			// Deadline passed
			$this->percent = 100;
			echo $this->buildBar('-' . $msg, "error");
		}
		else if($this->days_to_come <= 7) {
			// Time is almost up
			echo $this->buildBar($msg, "warning");
		}
		else if($this->now < $this->start_date) {
			// Day not here yet
			$msg = "-" . $this->getCountdownToStart();
			echo $this->buildBar( $msg, "standby");
		} else {
			// normal progression
			echo $this->buildBar($msg, "success");
		}
  }

	// Builds bar based on given data
	private function buildBar($msg, $color){
		$countdown = " test";
		$str = '<div class="flex-container">';
		$str .= '<div class="title-bar left">'.$this->start_date->format('Y-m-d') .'</div>';
		$str .= '<div class="title-bar center">'. $msg .'</div>';
		$str .= '<div class="title-bar right">'. $this->end_date->format('Y-m-d') .'</div>';
		$str .= '</div>';
		$str .= '<div class="empty-meter">';
		$str .= '<div class="meter '. $color .' " style="width:'. $this->percent .'%">';
		$str .= '<div class="meter-text"></div>';
		$str .= '</div>';
		$str .= '</div>';

		return $str;
	}

	// Validate date input - YYYY-MM-DD - bonus: can be used to validate any format :-)
	protected function validateDate($date, $format = 'Y-m-d H:i:s') {
		$d = DateTime::createFromFormat($format, $date);
		return $d && $d->format($format) == $date;
	}

	public function showInfo() {
		//TODO: show tool tip info
	}

	// Format custom exeption messages
	protected function formatErrorMessage($msg){
		$color = 'error';
		$countdown = " test";
		$str = '<div class="flex-container">';
		$str .= '<div class="title-bar left"></div>';
		$str .= '<div class="title-bar center">ERROR</div>';
		$str .= '<div class="title-bar right"></div>';
		$str .= '</div>';
		$str .= '<div class="empty-meter">';
		$str .= '<div class="fatal-error-text" style="width:100%">'. $msg;
		$str .= '<div class="meter-text"></div>';
		$str .= '</div>';
		$str .= '</div>';

		return $str;
	}
}
?>
