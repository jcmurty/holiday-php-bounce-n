#!/usr/bin/php
<?php
/**
 * pulse of light up and down a Holiday string - I have mine folded in half to will pulse
 * from the middle to the ends
 * 
 * @author James Murty <james@murty.org>
 * @version 1.0.0
 *
 * based on the efforts of:
 * @author Avi Miller <avi.miller@gmail.com>
 * @version 1.0
 * @copyright 2013 Avi Miller
 * @license MIT
 */
 
include 'class.holiday.secretapi.php';
//include 'hsl-rgb-functions.php';

$delay = 50000;

// Need to pass the IP address or hostname of the Holiday on the command-line

$holiday = new HolidaySecretAPI($argv[1]);  

// set initial positions for up/down pulse
$UpPos = 1; $DownPos= 24;

// up is blue, down is green
$UpR =0; $UpG = 0; $UpB = 240;
$DownR = 0; $DownG = 240; $DownB = 0;

// set blank initial state of holiday 

$holiday->fill(0,0,0); $holiday->render();

// now start pulsing
while (true) {

	// Set Up and Down positions
	$holiday->fill(0,0,0);
	
	$holiday->setglobe($UpPos, $UpR, $UpG, $UpB);
	$holiday->setglobe($DownPos, $DownR, $DownG, $DownB );
	
	// Render the globes
	$holiday->render();
            
    // move pulse
    $UpPos++;
    $DownPos++;
    
    if ( $UpPos>26 ) { $UpPos=1;}
    if ( $DownPos>50) { $DownPos=24;}
            
	// Pause for audience applause
	usleep($delay);
		                        
}
 
?>
