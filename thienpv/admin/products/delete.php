<?php 
require '../admin_check.php';
require '../connect.php';
if(empty($_GET['id'])){
	header('location:index.php');
	exit;
}

$id=addslashes($_GET['id']);
$query="select * from products
where id='$id'";
$num_rows=mysqli_num_rows(mysqli_query($connect,$query));
if ($num_rows==1) {
	$query2="delete from products
	where id='$id'";
	mysqli_query($connect,$query2);
} else {
	$_SESSION['notification']='Sản phẩm không tồn tại';
}

mysqli_close($connect);
header('location:index.php');