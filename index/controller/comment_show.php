<?php
/*
 * 显示文章评论控制器
 */

require_once 'db.php';

if (isset($_GET['id'])) {
    $aid = $_GET['id'];
    $pdo = new Database();
    $sql = "select * from comment where aid = :aid order by time desc ";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':aid', $aid);
    $stmt->execute();
    $num = $stmt->rowCount();
    if ($result = $stmt->fetchAll()) {
        for ($i = 0; $i < $num; $i++) {
            $uid = $result[$i]['uid'];
            $sql = "select username from user where id = :uid";
            $stmt2 = $pdo->prepare($sql);
            $stmt2->bindParam(':uid', $uid);
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
    }
}