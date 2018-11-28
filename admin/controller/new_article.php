<?php
/*
 *  发布新文章控制器
 */

session_start();
if(empty($_SESSION['username']) && empty($_SESSION['uid'])){
    echo "<script>alert('发布文章失败！原因：没有登录！');setTimeout(window.location.href='../admin.php?list=new_article',5);</script>";
}else {
    if (!empty($_POST['article_title']) && !empty($_POST['article_content'])) {
        $article_title = htmlspecialchars($_POST['article_title']);
        $article_content = htmlspecialchars($_POST['article_content']);
        if (strlen($article_content) <= 18 && strlen($article_content) <= 150) {
            echo "<script>alert('发布文章失败！原因：原因：字数太少，有灌水嫌疑！');setTimeout(window.location.href='../admin.php?list=new_article',5);</script>";
        } else {
            require_once 'db.php';
            $pdo = new Database();
            $sql = "INSERT INTO article (`uid`,`time`,`title`,`content`) VALUES (:uid,:timenow,:title,:content)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':uid', $uid);
            $stmt->bindParam(':timenow', $timenow);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':content', $content);
            $uid = $_SESSION['uid'];
            $timenow = time();
            $title = $article_title;
            $content = $article_content;
            $stmt->execute();
//PDO预处理中insert delete update等语句，用rowCount()检测是否执行成功
            if ($res = $stmt->rowCount()) {
                echo "<script>alert('发布文章成功！');setTimeout(window.location.href='../admin.php?list=new_article',5);</script>";
            } else {
                //var_dump($stmt->errorInfo()); //打印出错误信息
                echo "<script>alert('修改文章失败！');setTimeout(window.location.href='../admin.php?list=new_article',5);</script>";
            }

        }
    } else {
        echo "<script>alert('发布文章失败！');setTimeout(window.location.href='../admin.php?list=new_article',5);</script>";
    }
}
