<?php
include_once("include/dgpb.php");

 ?>
 <html>
 <title>Progress Bar Test Page</title>
 <meta name="viewport" content="width=device-width, user-scalable=no">
 <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
 <link rel="stylesheet" href="css/dgpb.css">
 <body>
 <div>

 <h2>Test Page</h2>
 <p>Contracts</p>
 <?php
 try { // every thing fine
	echo "Contract in effect<br />";
    // Change start and end dates here to try it out
    $pb = new daysGoneProgressBar("2020-09-16", "2020-10-25"); //YYYY-MM-DD
	//$pb->showInfo();
	$pb->displayBar();
} catch (Exception $e) {
    echo $e->getMessage();
}
echo '<br>';
try { // deadline close
	echo 'Contract expires soon: <a href="#">Renew</a><br />';
  //// HACK: deadline is always 3 days away for testing
  $pb = new daysGoneProgressBar("2020-09-20", date('Y-m-d', strtotime(date('Y-m-d'). ' + 4 days')));
	$pb->displayBar();
} catch (Exception $e) {
    echo $e->getMessage();
}
echo '<br>';
try { // today is the day
	echo 'Contract expires today: <a href="#">Renew</a><br />';
    // HACK: Dealine is always today for testing
    $pb = new daysGoneProgressBar("2020-03-01",  date('Y-m-d'));
	$pb->displayBar();
} catch (Exception $e) {
    echo $e->getMessage();
}

echo '<br>';
try { // today is passed deadline
    $pb = new daysGoneProgressBar("2020-03-01", "2020-09-26");
	echo 'Contract expired: <a href="#">Renew</a><br />';
	$pb->displayBar();
} catch (Exception $e) {
    echo $e->getMessage();
}
echo '<br>';

try { // first day not here yet
// HACK: start_date always 3 days ahead for testing
    $pb = new daysGoneProgressBar(date('Y-m-d', strtotime(date('Y-m-d'). ' + 4 days')), "2020-12-25");
	echo "Contract starts soon<br />";
	$pb->displayBar();
} catch (Exception $e) {
    echo $e->getMessage();
}
echo '<br>';

try { // dates reversed
	echo "Dates reversed<br />";
    $pb = new daysGoneProgressBar("2021-01-01", "2020-12-31"); //YYYY-MM-DD
	$pb->displayBar();
} catch (Exception $e) {
    echo $e->getMessage();
}
echo '<br>';

try { // bad date data
	echo "Bad dates<br />";
    $pb = new daysGoneProgressBar("20d20-01-01", "2020-12-31");
	$pb->displayBar();
} catch (Exception $e) {
    echo $e->getMessage();
}
echo '<br>';

 ?>
 </div>
 </body>
 </html>
