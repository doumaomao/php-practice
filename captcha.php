<?php
/**
 * Created by PhpStorm.
 * User: liyujie
 * Date: 2015/10/23
 * Time: 0:02
 */

//php验证码类

$image = imagecreatetruecolor(100,30);

$bgcolor = imagecolorallocate($image,255,255,255);

imagefill($image,0,0,$bgcolor);

$captcha_code = "";

for($i=0;$i<4;$i++)
{
    $fontsize=6;
    $fontcolor = imagecolorallocate($image, rand(0,120),rand(0,120), rand(0,120));
    $fontcontent = rand(0,10);
    $captcha_code .= $fontcontent;
    $x = ($i*100/4)+rand(5,10);
    $y = rand(5,10);

    imagestring($image,$fontsize,$x,$y,$fontcontent,$fontcolor);
}

//10>存到session
$_SESSION['authcode'] = $captcha_code;
//8>增加干扰元素，设置雪花点
for($i=0;$i<200;$i++){
    //设置点的颜色，50-200颜色比数字浅，不干扰阅读
    $pointcolor = imagecolorallocate($image,rand(50,200), rand(50,200), rand(50,200));
    //imagesetpixel — 画一个单一像素
    imagesetpixel($image, rand(1,99), rand(1,29), $pointcolor);
}
//9>增加干扰元素，设置横线
for($i=0;$i<4;$i++){
    //设置线的颜色
    $linecolor = imagecolorallocate($image,rand(80,220), rand(80,220),rand(80,220));
    //设置线，两点一线
    imageline($image,rand(1,99), rand(1,29),rand(1,99), rand(1,29),$linecolor);
}

//2>设置头部，image/png
header('Content-Type: image/png');
//3>imagepng() 建立png图形函数
imagepng($image);
//4>imagedestroy() 结束图形函数  销毁$image*/
imagedestroy($image);



