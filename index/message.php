<?php
/*
 * 留言板页面视图
 */

session_start();
if (isset($_SESSION['username'])) {
    require_once './header_login.php';
} else {
    require_once './header.html';
}

require_once 'title.html';
require_once 'navigation.html';
require_once 'message_content.php';
require_once 'footer.html';