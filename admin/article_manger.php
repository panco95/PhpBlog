<!-- 博客文章首页文章列表显示视图 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./style/content.css" type="text/css">
</head>
<body>
<div class="content">
    <?php
    require_once './controller/article_list.php';
    for($i=0;$i<$num;$i++) {
        echo <<<HTML
    <div class="content_title">
        <font style='color:gray;'>文章名：</font> $title[$i]&nbsp;&nbsp;---&nbsp;&nbsp;
        <a href="./admin.php?list=article_update&article_id=$article_id[$i]">修改</a>&nbsp;<a href="./controller/article_delete.php?article_id=$article_id[$i]">删除</a>
    </div>
HTML;
    }
    ?>
    <div class="limitpage">
        <?php
        $is_page = false;
        if($pagenow != 1){
            echo "<a href='?list=article_manger&page=1'>首页</a>&nbsp;";
            $is_page = true;
        }
        if($pagenow != 1){
            echo "<a href='?list=article_manger&page={$prepage}'>上一页</a>&nbsp;";
            $is_page = true;
        }
        if($pagenow < $pagecount) {
            echo "<a href = '?list=article_manger&page={$nextpage}' > 下一页</a >&nbsp;";
            $is_page = true;
        }
        if($pagenow < $pagecount) {
            echo "<a href='?list=article_manger&page={$pagecount}'>末页</a></div>";
            $is_page = true;
        }
        ?>
    </div>
</div>
</body>
</html>
