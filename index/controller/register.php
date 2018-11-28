<?php
/*
 * 注册账号控制器
 */

session_start();
if (!empty($_SESSION['verify_code']) && !empty($_POST['verify_code'])) {
    if ($_SESSION['verify_code'] != $_POST['verify_code']) {
        echo "<script>alert('验证码错误！');setTimeout(window.location.href='../register.html',5);</script>";
    } else {
        require_once 'db.php';
        if (!empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['sex']) && !empty($_POST['city'])) {
            $email = htmlspecialchars($_POST['email']);
            $username = htmlspecialchars($_POST['username']);
            $password = htmlspecialchars(md5($_POST['password']));
            $sex = htmlspecialchars($_POST['sex']);
            $city = htmlspecialchars($_POST['city']);
        } else {
            echo "<script>alert('注册信息填写错误！');setTimeout(window.location.href='../register.html',5);</script>";
        }

        $pdo = new Database();
        $sql = "INSERT INTO user (`email`,`username`,`password`,`sex`,`city`,`is_vip`) VALUES (:email,:username,:password,:sex,:city,'0')";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':sex', $sex);
        $stmt->bindParam(':city', $city);
        $stmt->execute();
//PDO预处理中insert delete update等语句，用rowCount()检测是否执行成功
        if ($res = $stmt->rowCount()) {
            echo "<script>alert('注册成功！点击返回主页！');setTimeout(window.location.href='../index.php',5);</script>";
        } else {
            //var_dump($stmt->errorInfo()); //打印出错误信息
            echo "<script>alert('注册失败！点击返回注册页面！');setTimeout(window.location.href='../register.html',5);</script>";
        }
    }
} else {
    echo "<script>alert('验证码错误！');setTimeout(window.location.href='../register.html',5);</script>";
}

