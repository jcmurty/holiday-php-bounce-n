#!/usr/bin/php
<?php
/**
 * A left to right bounce app that picks a random colour and then chases it up and down one or more Holiday strings
 * 
 * @author James Murty <james@murty.org>
 * @version 1.0.1
 *
 * based on the efforts of:
 * @author Avi Miller <avi.miller@gmail.com>
 * @version 1.0
 * @copyright 2013 Avi Miller
 * @license MIT
 */
 
include 'class.holiday.secretapi.php';

$delay = 50000;

// Need to pass the IP address(es) or hostname(s) of the Holiday(s) on the command-line

$number_of_holidays=count($argv) - 1;

if ( $number_of_holidays >= 1 ) {

	// Set us up an array of holidays
	for ($i=1; $i <= $number_of_holidays ; $i++ ) {
 		$holiday[$i] = new HolidaySecretAPI($argv[$i]);  
	}

	// loop-de-doop
	while (true) {

		$r = rand(63, 255);
		$g = rand(63, 255);
		$b = rand(63, 255);
                
		// Now, based on another random value, squash one of these values
		switch (rand(0,2)) {
                        
			case 0:
				$r = 0;
			break;
			case 1:
				$g = 0;
			break;
			case 2:
				$b = 0;
			break;
		}

		// chaser left to right
		for ( $i=1; $i <= $number_of_holidays ; $i++ ) {

        
			for ($globe=$holiday[$i]->NUM_GLOBES; $globe >= 0 ; $globe--) {

				// First turn off all the globes
				$holiday[$i]->fill(0, 0, 0);
                        
				// Now, turn on the next globe in sequence with the random colour
				$holiday[$i]->setglobe($globe, $r, $g, $b);
                        
				// Render the globes
				$holiday[$i]->render();
                        
				// Pause for audience applause
				usleep($delay);
			}
			$holiday[$i]->fill(0, 0, 0);$holiday[$i]->render();
                        
		}		
            
		//chaser right to left
		for ( $i=$number_of_holidays; $i > 0 ; $i-- ) {

        
			for ($globe=0; $globe < $holiday[$i]->NUM_GLOBES; $globe++) {

				// First turn off all the globes
				$holiday[$i]->fill(0, 0, 0);
                        
				// Now, turn on the next globe in sequence with the random colour
				$holiday[$i]->setglobe($globe, $r, $g, $b);
                        
				// Render the globes
				$holiday[$i]->render();
                        
				// Pause for audience applause
				usleep($delay);
			}
			$holiday[$i]->fill(0, 0, 0);$holiday[$i]->render();
                        
		}
		                        
}

} else {
		printf("I need the IP address of one or more holidays listed in left to right order\n");
        exit(1);
}
 
?>
