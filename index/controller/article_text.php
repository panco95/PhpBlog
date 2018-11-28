<?php
/*
 * 文章内容页面控制器，通过id显示出文章信息和内容
 */

require_once './controller/db.php';
$pdo = new Database();
$sql = "select * from article where id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $_GET['id']);
$stmt->execute();
if ($result = $stmt->fetch()) {
    $title = $result['title'];
    $uid = $result['uid'];
    $sql = "select username from user where id = $uid";
    $stmt2 = $pdo->prepare($sql);
    $stmt2->execute();
    if ($result2 = $stmt2->fetch()) {
        $username = $result2['username'];
    }
    $time = @date('Y/m/d H:i:s', $result['time']);
    $content = $result['content'];
}
