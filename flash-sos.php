#!/usr/bin/php
<?php
/**
 * flash SOS on a Holiday string
 * 
 * @author James Murty <james@murty.org>
 * @version 1.0.0
 * @version 1.0
 * @copyright 2013 Avi Miller
 * @license MIT
 */
 
include 'class.holiday.secretapi.php';

$shortdelay = 1000000;
$longdelay = 3000000;

// Need to pass the IP address or hostname of the Holiday on the command-line

$holiday = new HolidaySecretAPI($argv[1]);  
$holiday->fill(0,0,0);
$holiday->render();

$r = 240; $g = 0; $b = 0;

$state = 1;

while (true) {

// fast flash

	for ( $i = 0 ; $i < 3 ; $i++) {
		$holiday->fill($r, $g, $b);
		$holiday->render();
		if ( $state ) {
				echo "blip";
				usleep($shortdelay);
		}
		else {
				echo "beep";
				usleep($longdelay);
		}
		$holiday->fill(0,0,0);
		$holiday->render();
	}
	$state = ! $state;
}
	
?>