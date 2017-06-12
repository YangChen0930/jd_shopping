<?php
header('Content-Type:text/plain;charset=UTF-8');
@$did=$_REQUEST['did'];
@$count=$_REQUEST['count'];
if(!$did||!$count){
	echo 'err';
	return;
}
$conn=mysqli_connect('127.0.0.1','root','','jd',3306);
$sql="SET NAMES UTF8";
mysqli_query($conn,$sql);
$sql="UPDATE jd_cart_detail SET count='$count' WHERE did='$did'";
$result=mysqli_query($conn,$sql);
if(!$result){
	echo 'err';
}else{
	echo 'succ';
}