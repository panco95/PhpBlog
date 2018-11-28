<?php
/*
 * 首页博客文章列表控制器
 */
    require_once './controller/db.php';
    require_once '../core/limitpage.php';

    //计算总页数，这里show的noshow的情况不一样所以不能封装在limint文件里面
    $pdo = new Database();
    $sql = "select id from article where is_show = '1' and is_delete = '0'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $article_count = $stmt->rowCount();
    $pagecount = ceil($article_count/$pagesize);

    $sql = "select * from article where is_show = '1' and is_delete = '0' order by time desc limit ".($pagenow-1)*$pagesize.",$pagesize";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $num = $stmt->rowCount();
    if($result = $stmt->fetchAll()){
        for ($i=0;$i<$num;$i++) {
            $uid = $result[$i]['uid'];
            $sql = "select username from user where id = $uid";
            $stmt2 = $pdo->prepare($sql);
            $stmt2->execute();
            if ($result2 = $stmt2->fetch()) {
                $username[$i] = $result2['username'];
            }
            $title[$i] = $result[$i]['title'];
            //date函数将时间戳转换为时间格式，大写H是24小时
            $time[$i] = @date('Y/m/d H:i:s',$result[$i]['time']);
            $article_id[$i] = $result[$i]['id'];
        }
    }
