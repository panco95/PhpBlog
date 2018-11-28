<!-- 博客文章首页文章列表显示视图 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./style/user_list.css" type="text/css">
</head>
<body>
<div class="content">
    <div class="user_list">
    <table border="1" style="border-color:white">
        <tr><td>邮箱</td><td>用户名</td><td>密码</td><td>性别</td><td>地区</td><td>管理员</td><td>修改</td></tr>
    <?php
    require_once './controller/user_list.php';
    for($i=0;$i<$num;$i++) {
echo <<<HTML
<form action="./controller/user_update.php" method="post">
<tr><td>$email[$i]</td><td><input type="text" name="username" value="$username[$i]"></td><td><input type="text" name="password" value="123456"></td><td><input type="text" name="sex" value="$sex[$i]"></td><td><input type="text" name="city" value="$city[$i]"></td><td><input type="text" name="is_vip" value="$is_vip[$i]"></td><td><input type="submit" value="修改"></td></tr><input type="hidden" name="user_id" value="$id[$i]">
</form>
HTML;
    }
    ?>
    </table>
    </div>
    <div class="limitpage">
        <?php
        $is_page = false;
        if($pagenow != 1){
            echo "<a href='?list=user_manger&page=1'>首页</a>&nbsp;";
            $is_page = true;
        }
        if($pagenow != 1){
            echo "<a href='?list=user_manger&page={$prepage}'>上一页</a>&nbsp;";
            $is_page = true;
        }
        if($pagenow < $pagecount) {
            echo "<a href = '?list=user_manger&page={$nextpage}' > 下一页</a >&nbsp;";
            $is_page = true;
        }
        if($pagenow < $pagecount) {
            echo "<a href='?list=user_manger&page={$pagecount}'>末页</a></div>";
            $is_page = true;
        }
        ?>
    </div>
</div>
</body>
</html>
