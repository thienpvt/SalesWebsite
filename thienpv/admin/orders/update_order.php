<?php 
require '../admin_check.php';
session_start();
if(empty($_GET['status'])||$_GET['status']>4||$_GET['status']<0||empty($_GET['id'])){
	header('location:index.php');
	exit;
}
require '../connect.php';
$status=addslashes($_GET['status']);
$id=addslashes($_GET['id']);
$query="select * from orders
where id ='$id'";
$num_rows=mysqli_num_rows(mysqli_query($connect,$query));
if ($num_rows==0) {
	$_SESSION['notification']='Đơn không tồn tại';
	header('location:index.php');
}
if($status==4){
	$query3="delete from order_products
	where order_id ='$id'";
	$query2="delete from orders
	where id ='$id'";
	mysqli_query($connect,$query3);
	mysqli_query($connect,$query2);
} else {
	$query4="update orders
	set status='$status'
	where id=$id";
	mysqli_query($connect,$query4);
}
header('location:index.php');