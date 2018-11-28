<?php
/*
 * 插入文章评论
 */

session_start();
if (empty($_SESSION['username']) && empty($_SESSION['uid'])) {
    echo "<script>alert('评论失败！原因：没有登录！');setTimeout(window.location.href='../message.php',5);</script>";
} else {
    if (isset($_POST['article_id']) && !empty($_POST['comment_insert'])) {
        $comment_content = htmlspecialchars($_POST['comment_insert']);
        if (strlen($comment_content) <= 30) {
            echo "<script>alert('评论失败！原因：字数太少，有灌水嫌疑！');setTimeout(window.location.href='../article.php?id={$_POST['article_id']}',5);</script>";
        } else {
            require_once 'db.php';
            $pdo = new Database();
            $sql = "insert into comment (`uid`,`aid`,`time`,`content`) values (:uid,:aid,:timenow,:content)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':uid', $uid);
            $stmt->bindParam(':aid', $aid);
            $stmt->bindParam(':timenow', $timenow);
            $stmt->bindParam(':content', $content);
            $uid = $_SESSION['uid'];
            $aid = $_POST['article_id'];
            $timenow = time();
            $content = $comment_content;
            $stmt->execute();
//PDO预处理中insert delete update等语句，用rowCount()检测是否执行成功
            if ($res = $stmt->rowCount()) {
                echo "<script>alert('评论成功！点击返回文章！');setTimeout(window.location.href='../article.php?id={$_POST['article_id']}',5);</script>";
            } else {
                //var_dump($stmt->errorInfo()); //打印出错误信息
                echo "<script>alert('评论失败！点击返回文章！');setTimeout(window.location.href='../article.php?id={$_POST['article_id']}',5);</script>";
            }

        }
    } else {
        echo "<script>alert('留言失败！');setTimeout(window.location.href='../article.php?id={$_POST['article_id']}',5);</script>";
    }
}
