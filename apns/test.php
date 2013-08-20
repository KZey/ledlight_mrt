<?php
	include 'MrtApns.php';
// 	$deviceToken = '61207a39 27361dbf 18dacf31 83a99be4 2cc7c85e fb68564c 8564f0da 880c07ca';
	$deviceToken = '3a56bd4c 4c07b2ed d73bd374 57dbf8e1 cf4b6772 60f4a2a3 349d5044 81de2b41';
	echo 111;
$apns = new MrtApns($deviceToken, date('Y-M-D H:i:s').'Vincent,are you ready?');
echo 222;
$apns->doPush();
echo 333;
?>