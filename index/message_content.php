<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/message.css" type="text/css">
</head>
<body>
<div class="message">
    <form action="./controller/message_insert.php" method="post">
        <textarea id="send_message" name="insert_message"></textarea><br/><br/>
        <input id="message_button" type="submit" value="发表">
        <input id="message_button" type="reset" value="清空">
    </form>
</div>
<div class="message_show">
    <div id="message_content">
        <?php require_once './controller/message_show.php'; ?>
    </div>
</div>
</div>
</body>
</html>