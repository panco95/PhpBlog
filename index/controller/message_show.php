<?php
/*
 * 显示留言板控制器
 */

require_once 'db.php';
require_once '../core/limitpage.php';

//计算总页数，这里show的noshow的情况不一样所以不能封装在limint文件里面
$pdo = new Database();
$sql = "select id from message where is_show = '1'";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$article_count = $stmt->rowCount();
$pagecount = ceil($article_count / $pagesize);

$pdo = new Database();
$sql = "select * from message where is_show = 1 order by time desc limit " . ($pagenow - 1) * $pagesize . ",$pagesize";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$num = $stmt->rowCount();
if ($result = $stmt->fetchAll()) {
    for ($i = 0; $i < $num; $i++) {
        $uid = $result[$i]['uid'];
        $sql = "select username from user where id = $uid";
        $stmt2 = $pdo->prepare($sql);
        $stmt2->execute();
        if ($result2 = $stmt2->fetch()) {
            $username = $result2['username'];
        }
        $time = @date("Y/m/d H:i:s", $result[$i]['time']);
        $content = $result[$i]['content'];
        echo <<<HTML
<div id="message_title">发表人：$username 发表时间：$time<br/></div>
<div id="message_text">$content </div><br/><br/>
HTML;
    }
    echo "<div class='limitpage'>";
    if ($pagenow != 1) {
        echo "<a href='?page=1'>首页</a>&nbsp;";
    }
    if ($pagenow != 1) {
        echo "<a href='?page={$prepage}'>上一页</a>&nbsp;";
    }
    if ($pagenow < $pagecount) {
        echo "<a href = '?page={$nextpage}' > 下一页</a >&nbsp;";
    }
    if ($pagenow < $pagecount) {
        echo "<a href='?page={$pagecount}'>末页</a>";
    }
}


