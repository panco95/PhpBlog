<?php
/*
 * 退出登录
 * 需要清除一切登录相关的session
 */

session_start();
if (isset($_SESSION['username'])) {
    $_SESSION['username'] = null;
    $_SESSION['uid'] = null;
    if (isset($_SESSION['is_admin'])) {
        $_SESSION['is_admin'] = null;
    }
    echo "<script>alert('退出登录成功！');setTimeout(window.location.href='../index.php',5);</script>";
}