<?php
/*
 *  用户信息管理控制器
 */

session_start();
if(empty($_SESSION['username']) && empty($_SESSION['uid'])){
    echo "<script>alert('管理用户失败！原因：没有权限！');setTimeout(window.location.href='../admin.php?list=user_manger',5);</script>";
}else {
    //这里的条件语句is_vip如果可能值为0，不能用!empty，因为0会判断为空，要用isset
    if (!empty($_POST['user_id']) && !empty($_POST['username']) && !empty($_POST['password'] && !empty($_POST['sex']) && !empty($_POST['city']) && isset($_POST['is_vip']))) {
        if (strlen($_POST['password']) < 8) {
            echo "<script>alert('修改失败，密码少于8位！');setTimeout(window.location.href='../admin.php?list=user_manger',5);</script>";
        } else {
            $username = htmlspecialchars($_POST['username']);
            $password = htmlspecialchars(md5($_POST['password']));
            $sex = htmlspecialchars($_POST['sex']);
            $city = htmlspecialchars($_POST['city']);
            $is_vip = htmlspecialchars($_POST['is_vip']);
            $user_id = htmlspecialchars($_POST['user_id']);

            require_once './db.php';
            $pdo = new Database();
            $sql = "update user set username = :username,password = :password,sex = :sex,city = :city,is_vip = :is_vip where id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password',$password);
            $stmt->bindParam(':sex', $sex);
            $stmt->bindParam(':city', $city);
            $stmt->bindParam(':is_vip', $is_vip);
            $stmt->bindParam(':id', $user_id);
            $stmt->execute();
            if ($res = $stmt->rowCount()) {
                echo "<script>alert('用户修改成功！');setTimeout(window.location.href='../admin.php?list=user_manger',5);</script>";
            } else {
                //var_dump($stmt->errorInfo()); //打印出错误信息
                echo "<script>alert('用户修改失败！');setTimeout(window.location.href='../admin.php?list=user_manger',5);</script>";
            }
        }
    }
}

