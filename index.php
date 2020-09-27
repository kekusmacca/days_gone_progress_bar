<?php
//echo ;
$hello = "hello world.";
$start_date = "";
$end_date = "";
echo 'Percentage: ' . htmlspecialchars($_GET["percent"]) . '!';
$percentDone = htmlspecialchars($_GET["percent"]);
$progressBar = "<div class=\"dpb-blue\" style=\"height:24px;width:${percentDone}%\"></div>";

// Define $start_date
// Define $end_date
// Calculate number of days
// Calculate percentage completed from todays date
 ?>
 <html>
 <title>dpb.CSS</title>
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
