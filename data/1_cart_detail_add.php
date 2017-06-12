<?php
header('Content-Type:application/json;charset=UTF-8');
@$pid=$_REQUEST['pid'];
@$uname=$_REQUEST['uname'];
if( !$pid || !$uname ){
	echo 'err';
	return;
}

$conn=mysqli_connect('127.0.0.1','root','','jd',3306);
$sql="SET NAMES UTF8";
mysqli_query($conn,$sql);
$sql="SELECT uid FROM jd_user WHERE uname='$uname'";
$result=mysqli_query($conn,$sql);
$user=mysqli_fetch_assoc($result);
$uid=$user['uid'];
$sql="SELECT cid FROM jd_cart WHERE userID='$uid'";
$result=mysqli_query($conn,$sql);
$cart=mysqli_fetch_assoc($result);
if($cart===null){
	$sql="INSERT INTO jd_cart VALUES(NULL,'$uid')";
	$result=mysqli_query($conn,$sql);
	$cid=mysqli_insert_id($conn);
}else{
	$cid=$cart['cid'];
}
$sql="SELECT*FROM jd_cart_detail WHERE cartID='$cid' AND productID='$pid'";
$result=mysqli_query($conn,$sql);
$cart_detail=mysqli_fetch_assoc($result);
if($cart_detail===null){
	$sql="INSERT INTO jd_cart_detail VALUES(NULL,'$cid','$pid',1)";
	$result=mysqli_query($conn,$sql);
	echo '{"code":2000,"msg":"added"}';
}else{	
	$did=$cart_detail['did'];
	$sql="UPDATE jd_cart_detail SET count=count+1 WHERE did='$did'";
	$result=mysqli_query($conn,$sql);
	echo '{"code":2001,"msg":"updated"}';
}