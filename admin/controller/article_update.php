<?php
/*
 *  发布新文章控制器
 */

session_start();
if(empty($_SESSION['username']) && empty($_SESSION['uid'])){
    echo "<script>alert('修改文章失败！原因：没有登录！');setTimeout(window.location.href='../admin.php?list=article_manger',5);</script>";
}else {
    if (!empty($_POST['article_title']) && !empty($_POST['article_content'])) {
        $article_title = htmlspecialchars($_POST['article_title']);
        $article_content = htmlspecialchars($_POST['article_content']);
        if (strlen($article_content) <= 18 && strlen($article_content) <= 150) {
            echo "<script>alert('修改文章失败！原因：字数太少，有灌水嫌疑！');setTimeout(window.location.href='../admin.php?list=article_manger',5);</script>";
        } else {
                require_once 'db.php';
                $pdo = new Database();
                $sql = "update article set title = :title,content = :content where id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':title', $article_title);
                $stmt->bindParam(':content', $article_content);
                $stmt->bindParam(':id',$_GET['article_id']);
                var_dump($stmt->execute());
                if ($res = $stmt->rowCount()) {
                    echo "<script>alert('修改文章成功！');setTimeout(window.location.href='../admin.php?list=article_manger',5);</script>";
                } else {
                    //var_dump($stmt->errorInfo()); //打印出错误信息
                   echo "<script>alert('修改文章失败！');setTimeout(window.location.href='../admin.php?list=article_manger',5);</script>";
                }
            }
    } else {
        echo "<script>alert('修改文章失败！');setTimeout(window.location.href='../admin.php?list=article_manger',5);</script>";
    }
}
