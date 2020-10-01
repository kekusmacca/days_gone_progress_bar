
<?php
echo "<hr>";

/**
 *  Use php DateInterval::format to display a
 *  human readable countdown clock in years, months days.
 *  https://www.php.net/manual/en/dateinterval.format.php
 */
$origin = new DateTime('2020-10-01');
$target = new DateTime('2022-05-24');
$interval = $origin->diff($target);
$countdown =  $interval->format('%yY %mM %dD');
echo "<br>";
?>
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, user-scalable=no">
<link rel="stylesheet" href="css/style.css">
    <head>
        <title>CSS Test Page</title>
    </head>
    <body>
      <h1>CSS Test Page</h1>
      <div class="flex-container">
        <div class="title-bar left">2020-10-01</div>
        <div class="title-bar center">ENDS <?php echo $countdown ?></div>
        <div class="title-bar right">2020-12-31</div>
      </div>
	  <div class="empty-meter">
		  <div class="meter success" style="width:46%">
			<div class="meter-text"></div>
		  </div>
	  </div>





    </body>
</html>
