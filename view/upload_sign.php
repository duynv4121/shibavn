<?php


function add_ZK_mark($tenlienhe,$inputfile, $outputfile) {

//    var_dump(gd_info());
    $im = @imagecreatefrompng($inputfile);

    $bg = @imagecolorallocate($im, 255, 255, 255);
    $textcolor = @imagecolorallocate($im, 128, 128, 0);
	$font = 'sign/arial.ttf';
	$black = imagecolorallocate($im, 0, 0, 0);

    list($x, $y, $type) = getimagesize($inputfile);

    $txtpos_x = $x - 140;
    $txtpos_y = $y - ($y-10);

    //@imagestring($im, 5, $txtpos_x, $txtpos_y, 'GPE EXPRESS', $textcolor);

    $txtpos_x = $x - 145;
    $txtpos_y = 20;

	imagettftext($im, 20, 0, 100, 250, $black, realpath($font), $tenlienhe);

    @imagepng($im, $outputfile);

    // Output the image
    //imagejpeg($im);

    @imagedestroy($im);

}


define('UPLOAD_DIR', 'sign/');
$img = $_POST['imgBase64'];
$tenlienhe = $_POST['tenlienhe'];
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);
$file = UPLOAD_DIR . date("Ymd-his") . '.png';
$successz = file_put_contents($file, $data);
add_ZK_mark($tenlienhe,$file,$file);

echo '<img src="'.$file.'"><input type="hidden" value="'.$file.'" name="img_sign">';
?>