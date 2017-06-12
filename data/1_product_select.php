<?php
header('Content-Type:application/json;charset=UTf-8');
@$pno=$_REQUEST['pno'];
if(!$pno){
	$pno=1;
}else{
	$pno=intval($pno);
}

$pager=[
	'recordCount'=>0,
	'pageSize'=>8,
	'pageCount'=>0,
	'pno'=>$pno,
	'data'=>[]
];
$conn=mysqli_connect('127.0.0.1','root','','jd',3306);
$sql="SET NAMES UTF8";
mysqli_query($conn,$sql);
$sql="SELECT COUNT(*)FROM jd_product";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$pager['recordCount']=intval($row['COUNT(*)']);
$pager['pageCount']=ceil($pager['recordCount']/$pager['pageSize']);
$start=($pager['pno']-1)*$pager['pageSize'];
$count=$pager['pageSize'];
$sql="SELECT*FROM jd_product LIMIT $start,$count";
$result=mysqli_query($conn,$sql);
while(($product=mysqli_fetch_assoc($result))!==null){
	$pager['data'][]=$product;
}
echo json_encode($pager);