<?php 
if(empty($_POST['email'])||empty($_POST['password'])){
	$_SESSION['notification']='Vui lòng điền đầy đủ thông tin';
	header('location:index.php');
	exit;
}
$email=$_POST['email'];
$password=$_POST['password'];


require 'connect.php';

$query=" select * from admin
where email = '$email' and password ='$password'
";
$result=mysqli_query($connect,$query);
$num_rows=mysqli_num_rows($result);
if($num_rows==0){
	$_SESSION['notification']='Tài khoản hoặc mật khẩu không chính xác';
	header('location:index.php');
	exit;
}
session_start();
$admin=mysqli_fetch_array($result);
$id=$admin['id'];
$_SESSION['id']=$id;
$_SESSION['email']=$admin['email'];
$_SESSION['level']=$admin['level'];
header('location:root/index.php?notification=Đăng nhập thành công');

