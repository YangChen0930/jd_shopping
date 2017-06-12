<?php
header('Content-Type:application/json;charset=UTF-8');
$uname=$_REQUEST['uname'];
$upwd=$_REQUEST['upwd'];
$conn=mysqli_connect('127.0.0.1','root','','jd',3306);
$sql="SET NAMES UTF8";
mysqli_query($conn,$sql);
$sql="SELECT*FROM jd_user WHERE uname='$uname' AND upwd='$upwd'";
$result=mysqli_query($conn,$sql);
if(!$result){
	echo '{"code":1001,"msg":"SQL语法错误"}';
}else{
	if(($user=mysqli_fetch_assoc($result))===null){
		echo '{"code":1002,"msg":"用户名或密码错误"}';
	}else{
		echo '{"code":1000,"msg":"登陆信息验证正确"}';
	}
}
