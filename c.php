<?php
  session_start();

  // Generate captcha code
  $random_num    = md5(random_bytes(64));
  $captcha_code  = substr($random_num, 0, 6);

  // Assign captcha in session
  $_SESSION['CAPTCHA_CODE'] = $captcha_code;

  // Create captcha image
  $layer = imagecreatetruecolor(168, 33);
  $captcha_bg = imagecolorallocate($layer, 150,70 , 80);
  imagefill($layer, 0, 0, $captcha_bg);
  $captcha_text_color = imagecolorallocate($layer, 171, 171, 171);
  $font_size =27;
  $img_width =108;
  $img_height =108;

  $line_color= imagecolorallocate($layer,64,64,64);
  for($i =0 ;$i <6;$i++){
    imageline($layer,0,rand()%50,200,rand()%50,$line_color);
  }
  $pixel_color=imagecolorallocate($layer,0,0,255);
  for($i=0;$i<1000;$i++){
    imagesetpixel($layer,rand()%200,rand()%50,$pixel_color);
  }
   imagettftext($layer,$font_size,5,55,35,$captcha_text_color,'IsiniScript.ttf',$captcha_code);
  // imagestring($layer, 5, 55, 10, $captcha_code, $captcha_text_color);
  header("Content-type: image/jpeg");
  imagejpeg($layer);

?>