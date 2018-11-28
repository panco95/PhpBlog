<?php
/*
 * 退出登录
 */

session_start();
if(isset($_SESSION['username'])){
    $_SESSION['username'] = null;
    $_SESSION['uid'] = null;
    if(isset($_SESSION['is_admin'])){
        //删除管理员严重，防止用户直接url访问管理后台
        $_SESSION['is_admin'] = false;
    }
    echo "<script>alert('成功退出后台管理！');setTimeout(window.location.href='../../index/index.php',5);</script>";
}