<!-- 博客文章首页文章列表显示视图 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./style/content.css" type="text/css">
    <script>
        function move(item){
            item.style.background = 'black';
            item.style.color = 'white';
        }
        function over(item){
            item.style.background = 'white';
            item.style.color = 'black';
        }
    </script>
</head>
<body>
<div class="content">
<?php
require_once './controller/article_list.php';
for($i=0;$i<$num;$i++) {
echo <<<HTML
<div style="margin-top: 5px;">
<a href='article.php?id={$article_id[$i]}'><div  onmouseover="move(this)" onmouseout="over(this)">
<div class="content_title">
 $title[$i]
</div>
<div class="content_info">
发布人：$username[$i]&nbsp;&nbsp;发布时间：$time[$i]
</div>
</div></a>
</div>
HTML;
}
?>
<div class="limitpage">
<?php
    if($pagenow != 1){
        echo "<a href='?page=1'>首页</a>&nbsp;";
        $is_page = true; // 需要分页生成一个变量
    }
    if($pagenow != 1){
        echo "<a href='?page={$prepage}'>上一页</a>&nbsp;";
        $is_page = true;
    }
    if($pagenow < $pagecount) {
        echo "<a href = '?page={$nextpage}' > 下一页</a >&nbsp;";
        $is_page = true;
    }
    if($pagenow < $pagecount) {
        echo "<a href='?page={$pagecount}'>末页</a></div>";
        $is_page = true;
    }
?>
</div>
</div>
</body>
</html>
