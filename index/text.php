<!DOCTYPE html>
<html lang="en">
<?php
require_once './controller/article_text.php';
?>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/text.css" type="text/css">
    <link rel="stylesheet" href="style/message.css" type="text/css">
</head>
<body>
<div class="text">
    <div id="text_title">
        <p><?php echo $title; ?></p>
    </div>
    <div id="text_info">
        <p>发布人：<?php echo $username; ?> 发布时间：<?php echo $time; ?></p>
    </div>
    <div id="text_content">
        <p><?php echo $content; ?></p>
    </div>
    <hr>
    <p style="font-size:26px;text-align:center;padding-top:10px;paaing-botton:10px;">评论区</p>
    <div class="message">
        <form action="./controller/comment_insert.php" method="post">
            <textarea id="send_message" name="comment_insert"></textarea><br/><br/>
            <input id="message_button" type="submit" value="发表">
            <input id="message_button" type="reset" value="清空">
            <input type="hidden" name="article_id" value="<?php echo $_GET['id']; ?>">
        </form>
    </div>
    <div class="message_show">
        <div id="message_content">
            <?php require_once './controller/comment_show.php'; ?>
        </div>
    </div>
</div>
</div>
</body>
</html>