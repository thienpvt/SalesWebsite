<?php 
if(empty($_GET['id'])){
	header('location:index.php');
	exit;
}
session_start();
// unset($_SESSION['cart']);
$id=$_GET['id'];
require 'admin/connect.php';
$query=" select * from products
where id='$id'
";
$num_rows=mysqli_num_rows(mysqli_query($connect,$query));
if ($num_rows==0) {
	header('location:index.php');
	exit;
}
if(empty($_SESSION['cart'][$id])){
	
	$result=mysqli_query($connect,$query);
	$product=mysqli_fetch_array($result);
	$_SESSION['cart'][$id]['name']=$product['name'];
	$_SESSION['cart'][$id]['description']=$product['description'];
	$_SESSION['cart'][$id]['img']=$product['img'];
	$_SESSION['cart'][$id]['price']=$product['price'];
	$_SESSION['cart'][$id]['quantity']=1;
} else {
	$_SESSION['cart'][$id]['quantity']++;
}
header('location:index.php');