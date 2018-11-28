<?php
/*
 * 具体文章显示布局，主要文章文件是test.php
 */

session_start();
if (isset($_SESSION['username'])) {
    require_once './header_login.php';
} else {
    require_once './header.html';
}

require_once 'title.html';
require_once 'navigation.html';
require_once 'text.php';
require_once 'list.html';
require_once 'footer.html';