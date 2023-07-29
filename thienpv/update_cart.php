<?php

session_start();
if(empty($_GET['id'])&&empty($_GET['type'])){
	header('location:index.php');
	exit;
}

if(isset($_SESSION['cart'])){
	$carts=$_SESSION['cart'];
	$id=$_GET['id'];
	$type=$_GET['type'];
} else{
	$_SESSION['notification']='Giỏ hàng trống';
	header('location:index.php');
	exit;
}
if (isset($_SESSION['cart'][$id])) {
	if($type==='decre'){
		if($carts=$_SESSION['cart'][$id]['quantity']>1){
			$carts=$_SESSION['cart'][$id]['quantity']--;
		} else{
			unset($_SESSION['cart'][$id]);
		}
	} else{
		$carts=$_SESSION['cart'][$id]['quantity']++;
	}
}
header('location:index.php');

