<?php
/*
 * 数据库操作函数库
 */

require_once 'db_config.php';

class Database
{
    static $pdo;

    public function __construct()
    {
        $pdo = new PDO(PDO_TYPE . ':host=' . PDO_HOST . ';dbname=' . PDO_DBNAME, PDO_USER, PDO_PWD);
        $pdo->exec('set names utf8'); //这里一定要用utf8别用gbk，否则会出现一系列mysql错误信息
        self::$pdo = $pdo;
    }

    public function prepare($sql)
    {
        return self::$pdo->prepare($sql);
    }

}