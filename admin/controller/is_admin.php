<?php

require_once '../../index/controller/db.php';
session_start();
if(!empty($_SESSION['username'])){
    $pdo =  new Database();
    $sql = "select is_vip from user where username = :username ";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username',$_SESSION['username']);
    $stmt->execute();
    if($result = $stmt->fetch()){
        if ($result['is_vip'] == 0){
            echo "<script>alert('您的账号不是管理员，无法进入后台管理！');setTimeout(window.location.href='../../index/index.php',5);</script>";
        }else if($result['is_vip'] == 1){
            echo "<script>alert('欢迎管理员 {$_SESSION['username']}');setTimeout(window.location.href='../admin.php',1);</script>";
            //如果是管理员账户，生成一个session管理员标示，后面admin页面要验证这个session才能访问管理页面
            $_SESSION['is_admin'] = true;
        }
    }
}else{
    echo "<script>alert('没有登录，无法进入后台管理！');setTimeout(window.location.href='../../index/index.php',5);</script>";
}