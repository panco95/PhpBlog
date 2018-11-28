<?php
/*
 *  文章标题搜索控制器
 */

if (!empty($_POST['search_word'])) {
    $word = $_POST['search_word'];

    require_once './controller/db.php';
    require_once '../core/limitpage.php';

    $pdo = new Database();
    //分页的sql语句和下面的查找结果sql语句应该一样，保持记录数一样，分页才正确
    $sql = "select id from article where is_show = '1' and is_delete = '0' and title LIKE '%{$word}%'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $article_count = $stmt->rowCount();
    $pagecount = ceil($article_count / $pagesize);

    //使用模糊查询实现搜索文章标题功能
    $sql = "select * from article where is_show = '1' and is_delete = '0' and title LIKE '%{$word}%' order by time desc limit " . ($pagenow - 1) * $pagesize . ",$pagesize";
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
                $username[$i] = $result2['username'];
            }
            $title[$i] = $result[$i]['title'];
            //date函数将时间戳转换为时间格式，大写H是24小时
            $time[$i] = @date('Y/m/d H:i:s', $result[$i]['time']);
            $article_id[$i] = $result[$i]['id'];
        }
    } else {
        echo "<p style='font-size:20px;padding:10px;'>抱歉！没有搜索到结果！</p>";
    }
} else {
    echo "<script>alert('请输入关键字进行搜索！');setTimeout(window.location.href='../index.php',5);</script>";
}