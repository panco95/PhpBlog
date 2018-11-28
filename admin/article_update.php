<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./style/new_article.css">
</head>
<?php
require_once './controller/db.php';
if(empty($_SESSION['username']) && empty($_SESSION['uid'])){
    echo "<script>alert('修改失败！原因：没有登录！');setTimeout(window.location.href='../article.php',5);</script>";
}else {
    if (!empty($_GET['article_id'])) {
        $pdo = new Database();
        $id = $_GET['article_id'];
        $sql = "select title,content from article where id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        if($res = $stmt->fetch()){
            $title = $res['title'];
            $content = $res['content'];
        }
    }
}
?>
<body>
<div class="article">
    <form action="./controller/article_update.php?article_id=<?php echo $id; ?>" method="post">
        文章标题：<br/><input id="article_title" type="text" name="article_title" value="<?php echo $title; ?>"><br/><br/>
        文章内容：<br/><textarea id="article_content" name="article_content"><?php echo $content; ?></textarea><br/><br/>
        <input id="article_button" type="submit" value="修改">
        <input id="article_button" type="reset" value="还原">
    </form>
</div>
</body>
</html>