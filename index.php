<?php
//echo ;
$hello = "hello world.";

//echo 'Percentage: ' . htmlspecialchars($_GET["percent"]);

// Define Now
$now = time(); // or your date as well

// Define $start_date
$start_date = strtotime("2020-01-01");

// Define $end_date
$end_date = strtotime("2020-12-31");

// Calculate total duration
$date_diff = $end_date - $start_date;
$total_days = round($date_diff/ (60 * 60 * 24));
echo "<br />";
echo "Total Days(duration): " . $total_days;

// Number of days passed
$date_diff = $now - $start_date;
$days_passed = round($date_diff / (60 * 60 * 24));
echo "<br />";
echo "Number of days passed: " . $days_passed ;

// Calculate percentage completed from todays date
// P = (Y/X)*100;
//watch out for divide by 0
$percent = round(($days_passed/$total_days)*100);

// Calclulate days left
// TODO: Implement days left

// Display Progress bar
echo "<br />";
echo "Percent: " . $percent ;
$progressBar = "<div class=\"dpb-blue\" style=\"height:24px;width:${percent}%\">${percent}%</div>";

 ?>
 <html>
 <title>Progress Bar Test Page</title>
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="css/dpb.css">
 <body>
 <div class="dpb-container">

 <h2>Progress Bar</h2>
 <p>The dpb-container class can be used for a progress bar.</p>
 <p>The CSS width property can be used to set the height and width.</p>

 <div class="dpb-border">
   <?php echo $progressBar ?>
 </div>

 </div>
 </body>
 </html>
