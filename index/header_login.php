<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width,
                                     initial-scale=1.0, 
                                     maximum-scale=1.0, 
                                     user-scalable=no">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/common.css" type="text/css">
    <link rel="stylesheet" href="style/header.css" type="text/css">
</head>
<body>
<div class="header">
    <div id="header_left">
        <p>欢迎您！<?php echo $_SESSION['username']; ?>&nbsp;<a href="./controller/login_exit.php">退出登录</a></p>
    </div>
    <div id="header_right">
        <a href="../admin/controller/is_admin.php">后台管理</a>
    </div>
</div>
</body>
</html>