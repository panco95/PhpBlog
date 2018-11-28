<?php
require_once './code_string.php';
//通过GD库做验证码
//调用本验证码函数参数（类型：1/2/3  长度 黑点 线条 session名）
function verifyImage($type = 1, $length = 4, $pixel = 0, $line = 0, $sess_name = "verify")
{
    //创建画布和颜色
    $width = 80;
    $height = 18;
    $image = imagecreatetruecolor($width, $height);
    $white = imagecolorallocate($image, 255, 255, 255);
    $black = imagecolorallocate($image, 0, 0, 0);
    //用填充矩形填充画布
    imagefilledrectangle($image, 1, 1, $width - 2, $height - 2, $white);

    //获取验证码
    $chars = buildRandomString($type, $length);
    session_start();
    $_SESSION[$sess_name] = $chars;

    //画出图片验证码
    for ($i = 0; $i < $length; $i++) {
        //mt_rand()是rand()替换品，性能更好
        $size = mt_rand(14, 18);
        $angle = mt_rand(-15, 15);
        $x = 5 + $i * $size;
        $y = mt_rand(14, 18);
        $color = imagecolorallocate($image, mt_rand(50, 90), mt_rand(80, 200), mt_rand(90, 180));
        $fontfile = realpath('') . '/BirchStd.otf'; //没文件打印不出来图片
        $text = substr($chars, $i, 1); //截取字符串
        imagettftext($image, $size, $angle, $x, $y, $color, $fontfile, $text);
    }

    //点
    if ($pixel > 0) {
        for ($i = 0; $i < $pixel; $i++) {
            imagesetpixel($image, mt_rand(0, $width - 1), mt_rand(0, $height - 1), $black);
        }
    }

    //线条
    if ($line > 0) {
        for ($i = 0; $i < $line; $i++) {
            imageline($image, rand(0, 80), rand(0, 14), rand(0, 80), rand(0, 80), imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255)));
        }
    }

    //输出图片
    header("content-type:image/gif");
    imagegif($image);
    imagedestroy($image);


}

?>