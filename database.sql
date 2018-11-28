#CREATE DATABASE blog;
#USE blog;

#set names gbk;

#用户表
CREATE TABLE IF NOT EXISTS `user`(
 `id` SMALLINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 `email` VARCHAR(50) NOT NULL UNIQUE,
 `username` VARCHAR(20) NOT NULL UNIQUE,
 `password` VARCHAR(50) NOT NULL,
 `sex` char(1) NOT NULL DEFAULT '男',
 `city` VARCHAR(3) NOT NULL,
 `is_vip` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0'
)CHARSET=UTF8 ENGINE=Myisam;

INSERT INTO USER (`email`,`username`,`password`,`sex`,`city`,`is_vip`) VALUES ('1129443982@qq.com','panco',md5('panjiang1995'),'男','江西省','1');

#留言板表
CREATE TABLE IF NOT EXISTS `message`(
`id` MEDIUMINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
`uid` SMALLINT UNSIGNED NOT NULL,
`time` INT(20) UNSIGNED NOT NULL,
`is_show` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
`content` TEXT NOT NULL
)CHARSET=UTF8 ENGINE=Myisam;

INSERT INTO message (`uid`,`time`,`is_show`,`content`) VALUES ('1',unix_timestamp(now()),'1','我的第一个留言哦！');

#文章表
CREATE TABLE IF NOT EXISTS `article`(
`id` MEDIUMINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
`uid` SMALLINT UNSIGNED NOT NULL,
`title` VARCHAR(60) NOT NULL UNIQUE,
`time` INT(20) UNSIGNED NOT NULL,
`is_show` TINYINT(1) UNSIGNED NOT NULL DEFAULT '1',
`is_delete` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
`content` TEXT NOT NULL
)CHARSET=UTF8 ENGINE=Myisam;

INSERT INTO article (`uid`,`title`,`time`,`content`) VALUES ('1','这是第一篇测试文',unix_timestamp(now()),'世间太多美好的东西，真正属于你的并不多。');

#文章评论表
CREATE TABLE IF NOT EXISTS `comment`(
`id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
`uid` SMALLINT UNSIGNED NOT NULL,
`aid` MEDIUMINT UNSIGNED NOT NULL,
`time` INT(20) UNSIGNED NOT NULL,
`content` TEXT NOT NULL,
`is_show` TINYINT(1) UNSIGNED NOT NULL DEFAULT '1',
`is_delete` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0'
)CHARSET=UTF8 ENGINE=Myisam;

INSERT INTO comment (`uid`,`aid`,`time`,`content`) VALUES ('1','1',unix_timestamp(now()),'这篇文章写的真心好哦！');