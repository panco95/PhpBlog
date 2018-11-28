<?php
/*
 * 二次验证用户是否管理员，防止用户直接用URL访问
 */

session_start();
if(isset($_SESSION['is_admin'])) {
    if ($_SESSION['is_admin'] == true) {
        require_once './header.php';
        require_once './title.html';
        require_once './list.html';
        if (isset($_GET['list'])) {
            if ($_GET['list'] == 'user_manger') {
                require_once './user_manger.php';
            } else if ($_GET['list'] == 'article_manger') {
                require_once './article_manger.php';
            } else if ($_GET['list'] == 'article_recybin') {
                require_once './article_recybin.php';
            } else if ($_GET['list'] == 'new_article'){
                require_once './new_article.html';
            } else if ($_GET['list'] == 'article_update'){
                require_once './article_update.php';
            } else if ($_GET['list'] == 'user_manger'){
                require_once './user_manger.php';
            }
        }else{
            require_once './article_manger.php';
        }
        require_once './footer.html';
    }else{
        //这里也要跳转，不然页面是一个空白
        header('location:../index/index.php');
    }
} else {
        header('location:../index/index.php');
    }
