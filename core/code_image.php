<?php
require_once './code_string.php';
//ͨ��GD������֤��
//���ñ���֤�뺯�����������ͣ�1/2/3  ���� �ڵ� ���� session����
function verifyImage($type = 1, $length = 4, $pixel = 0, $line = 0, $sess_name = "verify")
{
    //������������ɫ
    $width = 80;
    $height = 18;
    $image = imagecreatetruecolor($width, $height);
    $white = imagecolorallocate($image, 255, 255, 255);
    $black = imagecolorallocate($image, 0, 0, 0);
    //����������仭��
    imagefilledrectangle($image, 1, 1, $width - 2, $height - 2, $white);

    //��ȡ��֤��
    $chars = buildRandomString($type, $length);
    session_start();
    $_SESSION[$sess_name] = $chars;

    //����ͼƬ��֤��
    for ($i = 0; $i < $length; $i++) {
        //mt_rand()��rand()�滻Ʒ�����ܸ���
        $size = mt_rand(14, 18);
        $angle = mt_rand(-15, 15);
        $x = 5 + $i * $size;
        $y = mt_rand(14, 18);
        $color = imagecolorallocate($image, mt_rand(50, 90), mt_rand(80, 200), mt_rand(90, 180));
        $fontfile = realpath('') . '/BirchStd.otf'; //û�ļ���ӡ������ͼƬ
        $text = substr($chars, $i, 1); //��ȡ�ַ���
        imagettftext($image, $size, $angle, $x, $y, $color, $fontfile, $text);
    }

    //��
    if ($pixel > 0) {
        for ($i = 0; $i < $pixel; $i++) {
            imagesetpixel($image, mt_rand(0, $width - 1), mt_rand(0, $height - 1), $black);
        }
    }

    //����
    if ($line > 0) {
        for ($i = 0; $i < $line; $i++) {
            imageline($image, rand(0, 80), rand(0, 14), rand(0, 80), rand(0, 80), imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255)));
        }
    }

    //���ͼƬ
    header("content-type:image/gif");
    imagegif($image);
    imagedestroy($image);


}

?>