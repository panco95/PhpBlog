<?php
/*
 * 管理后台用户列表显示控制器
 */
    require_once './controller/db.php';
    require_once '../core/limitpage.php';

    //计算总页数，这里show的noshow的情况不一样所以不能封装在limint文件里面
    $pdo = new Database();
    $sql = "select id from user";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $article_count = $stmt->rowCount();
    $pagecount = ceil($article_count/$pagesize);

    $sql = "select * from user limit ".($pagenow-1)*$pagesize.",$pagesize";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $num = $stmt->rowCount();
    if($result = $stmt->fetchAll()){
        for ($i=0;$i<$num;$i++) {
            $email[$i] = $result[$i]['email'];
            $username[$i] = $result[$i]['username'];
            $sex[$i] = $result[$i]['sex'];
            $city[$i] = $result[$i]['city'];
            $is_vip[$i] = $result[$i]['is_vip'];
            $id[$i] = $result[$i]['id'];
        }
    }