<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./style/common.css" type="text/css">
    <link rel="stylesheet" href="./style/header.css" type="text/css">
</head>
<body>
<div class="header">
    <div id="header_left">
        欢迎您！管理员<b><?php echo $_SESSION['username']; ?></b>
    </div>
    <div id="header_right">
        <a href="./controller/admin_exit.php">退出后台管理</a>
    </div>
</div>
</body>
</html>