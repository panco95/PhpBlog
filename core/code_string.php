<?php

//���������֤�뺯��
function buildRandomString($type,$length){
  if($type==1){
	  //join ��implode������������һ��һά�����ֵת��Ϊ�ַ���
	  //range ����һ������ָ����Χ��Ԫ������ 
    $chars=join("",range(0,9));
  }else if($type==2){
	  // array_merge() ��һ����������ĵ�Ԫ�ϲ�������һ�������е�ֵ������ǰһ������ĺ���
    $chars=join("",array_merge(range("a","z"),range("A","Z")));
  }else if($type==3){
    $chars=join("",array_merge(range("a","z"),range("A","Z"),range("0","9")));
  }
  if($length>strlen($chars)){
    exit("�ַ������Ȳ�����");
  }

  $chars=str_shuffle($chars); // str_shuffle ����һ���ַ���˳��
  return substr($chars,0,$length); // ��ȡ�ַ������ֳ���
}

?>