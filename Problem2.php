<?php
/*
PROBLEM #2:
Using PHP's GD Image primatives (squares, circles, lines) draw any image you'd like.*/

/*Solution for PROBLEM #2 by Indira Pandey*/

header("Content-type: image/png");

// Create a blank image with the given width(700) and height(600)
$img = imagecreatetruecolor(700, 600);
//Setting RGB colors
$red   = imagecolorallocate($img, 255, 0, 0); 
$white = imagecolorallocate($img, 255, 255, 255);
$black = imagecolorallocate($img, 0, 0, 0);
$orange = imagecolorallocate($img, 255, 200, 0);
$backgroundtop  = imagecolorallocate($img, 153, 102, 51);
$backgroundButtom = imagecolorallocate($img, 96, 64, 32);
$wall = imagecolorallocate($img, 204, 51, 0);

// Set the line thickness to 5
imagesetthickness($img, 5);

//Fill the image with given color starting at the given coordinate(top left 0,0) 
imagefill($img, 0, 0, $white);

//Top background as a rectangle
imagefilledrectangle($img, 0, 0, 700, 500, $backgroundtop);

//Sun circle and little cresent on the sun
imagefilledellipse($img, 103, 103, 108, 108, $wall);
imagefilledellipse($img, 100, 100, 100, 100, $orange);

//House top black color
imagefilledpolygon($img, [320,20 , 210, 240, 450, 240], 3, $white);
imagefilledpolygon($img, [320,40 , 220, 240, 440, 240], 3, $black);

//White circle insde the house
imagefilledellipse($img, 320, 150, 40, 40, $white);

//House Wall
imagefilledrectangle($img, 210, 240, 450, 500, $white);
imagefilledrectangle($img, 220, 240, 440, 500, $wall);

//Inner and the outer Window 
imagefilledrectangle($img, 275, 275, 405, 345, $black); 
imagefilledrectangle($img, 280, 280, 400, 340, $white);

imageline($img, 210, 370, 450, 370, $black);

//Inner and the outer door
imagefilledrectangle($img, 295, 395, 365, 505, $black);
imagefilledrectangle($img, 300, 400, 360, 500, $white);

//Line between the house and the ground
imageline($img, 0, 500, 700, 500, $black);

//Bottom rectangle
imagefilledrectangle($img, 0,500, 700, 600, $backgroundButtom);
 
imagepng($img);
?>