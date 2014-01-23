<?php
/**
+ * Colo[u]r space transformations for Holiday by Moorescloud
+ *
+ * shameless stolen from http://axonflux.com/handy-rgb-to-hsl-and-rgb-to-hsv-color-model-c
+ * who stole it from somewhere else
+ *
+ * @author James Murty <james@murty.org>
+ * @version 1.0
+ * @copyright 2013 James Murty
+ * @license MIT
+ */

function RGB2HSL($r,$g,$b) {
/**
 * Converts an RGB color value to HSL. Conversion formula
 * adapted from http://en.wikipedia.org/wiki/HSL_color_space.
 * Assumes r, g, and b are contained in the set [0, 255] and
 * returns h, s, and l in the set [0, 1].
 *
 * @param   Number  r       The red color value
 * @param   Number  g       The green color value
 * @param   Number  b       The blue color value
 * @return  Array           The HSL representation
 */
 
	$r /= 255;
	$g /= 255;
	$b /= 255;
	
	$max = max($r, $g, $b);
	$min = min($r, $g, $b);
	
	$h = $s = $l = ($max + $min) / 2;
	
	if ($max == $min) {
		$h = $s = 0; //achromatic
	}
	else {
		$d = $max - $min;
		$s = $l > 0.5 ? $d / (2 - $max - $min) : $d / ($max + $min);
        switch($max){
            case $r: $h = ($g - $b) / $d + ($g < $b ? 6 : 0); break;
            case $g: $h = ($b - $r) / $d + 2; break;
            case $b: $h = ($r - $g) / $d + 4; break;
        }
        $h /= 6;
    }
    
	return array($h,$s,$l);

}

function hue2RGB($p, $q, $t){
	if($t < 0) $t += 1;
	if($t > 1) $t -= 1;
	if($t < 1/6) return $p + ($q - $p) * 6 * $t;
	if($t < 1/2) return $q;
	if($t < 2/3) return $p + ($q - $p) * (2/3 - $t) * 6;
	return $p;
}

function HSL2RGB($h, $s, $l) {
/**
 * Converts an HSL color value to RGB. Conversion formula
 * adapted from http://en.wikipedia.org/wiki/HSL_color_space.
 * Assumes h, s, and l are contained in the set [0, 1] and
 * returns r, g, and b in the set [0, 255].
 *
 * @param   Number  h       The hue
 * @param   Number  s       The saturation
 * @param   Number  l       The lightness
 * @return  Array           The RGB representation
 */
	if($s == 0){
		$r = $g = $b = $l; // achromatic
	}
	else{
		$q = $l < 0.5 ? $l * (1 + $s) : $l + $s - $l * $s;
		$p = 2 * $l - $q;
        $r = hue2RGB($p, $q, $h + 1/3);
        $g = hue2RGB($p, $q, $h);
        $b = hue2RGB($p, $q, $h - 1/3);
    }

    return array($r * 255, $g * 255, $b * 255); 
}
