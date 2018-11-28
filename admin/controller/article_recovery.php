<?php
/*
 *  恢复文章控制器
 */

session_start();
if(empty($_SESSION['username']) && empty($_SESSION['uid'])){
    echo "<script>alert('恢复文章失败！原因：没有登录！');setTimeout(window.location.href='../admin.php?list=article_recybin',5);</script>";
}else {
    //这里是GET，当初弄了好久POST没找出原因
    if (!empty($_GET['article_id'])) {
        require_once 'db.php';
        $pdo = new Database();
        echo $id = $_GET['article_id'];
        $sql = "update article set is_delete = 0 where id = $id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
//PDO预处理中insert delete update等语句，用rowCount()检测是否执行成功
        if ($res = $stmt->rowCount()) {
            echo "<script>alert('恢复文章成功！');setTimeout(window.location.href='../admin.php?list=article_recybin',5);</script>";
        } else {
            //var_dump($stmt->errorInfo()); //打印出错误信息
            echo "<script>alert('恢复文章失败！');setTimeout(window.location.href='../admin.php?list=article_recybin',5);</script>";
        }

    } else {
        echo "<script>alert('恢复文章失败！');setTimeout(window.location.href='../admin.php?list=article_recybin',5);</script>";
    }
}
