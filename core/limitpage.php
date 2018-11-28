<?php

/*
 * 分页模块
 */
$pagesize = 10; //，每页显示数量
$pagenow = 1; //当前页
if (!empty($_GET['page'])) {
    if ($_GET['page'] < 1) {
        $pagenow = 1;
    } else {
        $pagenow = $_GET['page'];
    }
}
if ($pagenow > 1) {
    $prepage = $pagenow - 1;
} else {
    $prepage = 1;
}
$nextpage = $pagenow + 1;
