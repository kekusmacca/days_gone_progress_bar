<?php
include_once("include/dgpb.php");

 ?>
 <html>
 <title>Progress Bar Test Page</title>
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="css/dgpb.css">
 <body>
 <div class="dgpb-container">

 <h2>Days Gone Progress Bar</h2>
 <p>Test page.</p>
 <?php
 try { // every thing fine
	echo "Normal progression<br />";
    $pb = new daysGoneProgressBar("2020-01-01", "2020-12-31"); //YYYY-MM-DD
	//$pb->showInfo();
	$pb->displayBar();
} catch (Exception $e) {
    echo $e->getMessage();
}

try { // deadline close
	echo "Deadline is close.<br />";
    $pb = new daysGoneProgressBar("2020-03-01", "2020-10-05");	
	$pb->displayBar();
} catch (Exception $e) {
    echo $e->getMessage();
}

try { // today is the day
	echo "Today is the last day.  Deadlline.<br />";
    $pb = new daysGoneProgressBar("2020-03-01", "2020-09-28");	
	$pb->displayBar();
} catch (Exception $e) {
    echo $e->getMessage();
}

try { // today is passed deadline
    $pb = new daysGoneProgressBar("2020-03-01", "2020-09-26");
	echo "Deadline passed<br />";
	$pb->displayBar();
} catch (Exception $e) {
    echo $e->getMessage();
}

try { // first day not here yet
    $pb = new daysGoneProgressBar("2020-10-01", "2020-10-26");
	echo "First day not here yet<br />";
	$pb->displayBar();
} catch (Exception $e) {
    echo $e->getMessage();
}

try { // dates reversed
	echo "Dates reversed<br />";
    $pb = new daysGoneProgressBar("2021-01-01", "2020-12-31"); //YYYY-MM-DD
	$pb->displayBar();
} catch (Exception $e) {
    echo $e->getMessage();
}

try { // bad date data
	echo "Bad dates<br />";
    $pb = new daysGoneProgressBar("20d20-01-01", "2020-12-31");
	$pb->displayBar();
} catch (Exception $e) {
    echo $e->getMessage();
}

 ?>
 </div>
 </body>
 </html>
