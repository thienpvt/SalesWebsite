<?php 
if(empty($_GET['order_id'])){
	header('location:index.php');
	exit;
}
$id=addslashes($_GET['order_id']);
require 'admin/connect.php';
$query="select * from orders
where id='$id' ";
$num_rows=mysqli_num_rows(mysqli_query($connect,$query));
if($num_rows==1){
	$order=mysqli_fetch_array(mysqli_query($connect,$query));
	if($order['status']!=2){
		$query3="update orders
		set status='3'
		where id='$id'";
		mysqli_query($connect,$query3);
	}
}
header('location:ordered.php');