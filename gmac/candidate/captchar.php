<?php /*
example of usage:

inside your form
<input type="text" name="validator" id="validator" size="4" />
<img src="random.php" alt="CAPTCHA image" width="60" height="20" vspace="1" align="top" />

and test the value of the "validator" form field like:
if (!empty($_POST['validator']) && $_POST['validator'] == $_SESSION['rand_code']) {
    process your form here
    at least destroy the session
    unset($_SESSION['rand_code']);
*/
// save this code in your random script
session_start();
if (empty($_SESSION['rand_code'])) {
    $str = "";
    $length = 0;
    for ($i = 0; $i < 5; $i++) {
        // this numbers refer to numbers of the ascii table (small-caps)
        $str .= chr(rand(97, 122));
    }
    $_SESSION['rand_code'] = $str;
}

header("Content-type: image/png");
$im = @imagecreate(110, 20)
    or die("Cannot Initialize new GD image stream");
$background_color = imagecolorallocate($im, 198, 206, 209);
$text_color = imagecolorallocate($im, 233, 14, 91);
imagestring($im, 5, 20, 0,  $_SESSION['rand_code'], $text_color);
imagepng($im);
imagedestroy($im);?>
