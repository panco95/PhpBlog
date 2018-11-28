<?php
/*
 * 插入留言控制器
 */

session_start();
if (empty($_SESSION['username']) && empty($_SESSION['uid'])) {
    echo "<script>alert('留言失败！原因：没有登录！');setTimeout(window.location.href='../message.php',5);</script>";
} else {
    if (!empty($_POST['insert_message'])) {
        $message_content = htmlspecialchars($_POST['insert_message']);
        if (strlen($message_content) <= 30) {
            echo "<script>alert('留言失败！原因：字数太少，有灌水嫌疑！');setTimeout(window.location.href='../message.php',5);</script>";
        } else {
            require_once 'db.php';
            $pdo = new Database();
            $sql = "insert into message (`uid`,`time`,`content`) values (:uid,:timenow,:content)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':uid', $uid);
            $stmt->bindParam(':timenow', $timenow);
            $stmt->bindParam(':content', $content);
            $uid = $_SESSION['uid'];
            $timenow = time();
            $content = $message_content;
            $stmt->execute();
//PDO预处理中insert delete update等语句，用rowCount()检测是否执行成功
            if ($res = $stmt->rowCount()) {
                echo "<script>alert('留言成功！点击返回留言板！');setTimeout(window.location.href='../message.php',5);</script>";
            } else {
                //var_dump($stmt->errorInfo()); //打印出错误信息
                echo "<script>alert('留言失败！点击返回留言板！');setTimeout(window.location.href='../message.php',5);</script>";
            }

        }
    } else {
        echo "<script>alert('留言失败！');setTimeout(window.location.href='../message.php',5);</script>";
    }
}
