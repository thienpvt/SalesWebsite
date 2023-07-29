<?php 
if(empty($_POST['email'])||empty($_POST['name'])||empty($_POST['address'])||empty($_POST['phone'])||empty($_POST['password'])){
	$_SESSION['notification']='Vui lòng điền đủ thông tin';
	header('location:sign_up.php');
	exit;
}

$email=addslashes($_POST['email']);
$name=addslashes($_POST['name']);
$address=addslashes($_POST['address']);
$phone=addslashes($_POST['phone']);
$password=addslashes($_POST['password']);

require 'admin/connect.php';

$query="select count(*) from customers
where email = '$email'
";
$number_rows=mysqli_fetch_array(mysqli_query($connect,$query))['count(*)'];
// die($number_rows);

if ($number_rows==1) {
	$_SESSION['notification']='Email này đã đăng ký rồi';
	header('location:sign_up.php');
	exit;
}

$query2="insert into customers(email,name,address,phone,password)
values('$email','$name','$address','$phone','$password')";
mysqli_query($connect,$query2);

$log_in="
select * from customers
where email='$email'";
$result=mysqli_fetch_array(mysqli_query($connect,$log_in));
session_start();

$_SESSION['id']=$result['id'];
$_SESSION['name']=$result['name'];
mysqli_close($connect);
header('location:index.php');
exit;