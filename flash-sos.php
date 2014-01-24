#!/usr/bin/php
<?php
/**
 * flash SOS on a Holiday string
 * 
 * @author James Murty <james@murty.org>
 * @version 1.0
 * @license MIT
 
 * from http://en.wikipedia.org/wiki/Morse_code
 * International Morse code is composed of five elements:
 * short mark, dot or "dit" (·) — "dot duration" is one time unit long
 * longer mark, dash or "dah" (–) — three time units long
 * inter-element gap between the dots and dashes within a character — one dot duration or one unit long
 * short gap (between letters) — three time units long
 * medium gap (between words) — seven time units long[1]
 *
 */
 
include 'class.holiday.secretapi.php';

// Need to pass the IP address or hostname of the Holiday on the command-line

$message = array(".",".",".","|","-","-","-","|",".",".",".");

$unit=200000;

$holiday = new HolidaySecretAPI($argv[1]);  
$holiday->fill(0,0,0);
$holiday->render();

$r = 240; $g = 0; $b = 0;

while (true) {
	for ( $i = 0 ; $i < count($message) ; $i++) {
		switch ($message[$i]) {
			case ".":
				echo ".";
				$holiday->fill($r, $g, $b);
				$holiday->render();
				usleep($unit);
				$holiday->fill(0,0,0);
				$holiday->render();
				usleep($unit);
				break;
			case "-":
				echo "-";
				$holiday->fill($r, $g, $b);
				$holiday->render();
				usleep($unit*3);
				$holiday->fill(0,0,0);
				$holiday->render();
				usleep($unit);
				break;
			case "|":
				echo "|";
				usleep($unit*3);
				break;
			case " ";
				echo " ";
				usleep($unit*7);
				break;
		}
	}
	// gap between words
	echo " ";
	usleep($unit*7);
}
	
?>