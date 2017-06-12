<?php
header('Content-Type:application/json;charset=UTF-8');
@$uname = $_REQUEST['uname'];
if(!$uname){
	echo 'err';
	return;
}
$conn = mysqli_connect( '127.0.0.1','root','','jd',3306 );
$sql = "SET NAMES UTF8";
mysqli_query($conn,$sql);
$sql="SELECT uid FROM jd_user WHERE uname='$uname'";
$result = mysqli_query($conn,$sql);
$user = mysqli_fetch_assoc($result);
$uid = $user['uid'];
$sql = "SELECT cid FROM jd_cart WHERE userID='$uid'";
$result = mysqli_query($conn,$sql);
$cart = mysqli_fetch_assoc($result);
if($cart===null){
	echo '[]';
	return;
}
$cid = $cart['cid'];
$sql = "SELECT did,pid,pic,pname,price,count FROM jd_cart_detail,jd_product WHERE cartID='$cid' AND jd_cart_detail.productID=jd_product.pid";
$result = mysqli_query($conn,$sql);
$list=[];
while(($cart_detail = mysqli_fetch_assoc($result))!==null){
	$list[]=$cart_detail;
}
echo json_encode($list);