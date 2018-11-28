<?php
/*
 * 登录账号控制器
 */

session_start();
if (!empty($_SESSION['verify_code']) && !empty($_POST['verify_code'])) {
    if ($_SESSION['verify_code'] != $_POST['verify_code']) {
        echo "<script>alert('验证码错误！');setTimeout(window.location.href='../login.html',5);</script>";
    } else {
        require_once 'db.php';
        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars(md5($_POST['password']));
        } else {
            header('location:../login.html');
        }

        $pdo = new Database();
        //sql语句的表名大小写最好和数据表一致，有些服务器配置会出错
        $sql = "select * from user where email = :email and password=:password";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        if ($res = $stmt->fetch()) {
            echo '登录成功！....';
            $_SESSION['username'] = $res['username'];
            $_SESSION['uid'] = $res['id'];
            echo "<script>alert('登录成功！点击返回主页！');setTimeout(window.location.href='../index.php',5);</script>";
        } else {
            echo "<script>alert('登录失败！点击返回重新登录！');setTimeout(window.location.href='../login.html',5);</script>";
        }
    }
} else {
    echo "<script>alert('验证码错误！');setTimeout(window.location.href='../login.html',5);</script>";
}

