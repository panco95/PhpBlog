<?php

//生成随机验证码函数
function buildRandomString($type,$length){
  if($type==1){
	  //join 是implode函数别名，将一个一维数组的值转化为字符串
	  //range 建立一个包含指定范围单元的数组 
    $chars=join("",range(0,9));
  }else if($type==2){
	  // array_merge() 将一个或多个数组的单元合并起来，一个数组中的值附加在前一个数组的后面
    $chars=join("",array_merge(range("a","z"),range("A","Z")));
  }else if($type==3){
    $chars=join("",array_merge(range("a","z"),range("A","Z"),range("0","9")));
  }
  if($length>strlen($chars)){
    exit("字符串长度不够！");
  }

  $chars=str_shuffle($chars); // str_shuffle 打乱一个字符串顺序
  return substr($chars,0,$length); // 截取字符串部分长度
}

?>