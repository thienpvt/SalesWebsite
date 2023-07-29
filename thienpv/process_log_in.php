<?php 
if(empty($_POST['email'])||empty($_POST['password'])){
	$_SESSION['notification']='Vui lòng điền đủ thông tin';
	header('location:log_in.php');
	exit;
}

$email=addslashes($_POST['email']);
$password=addslashes($_POST['password']);
if (isset($_POST['remember'])) {
	$remember=true;
} else {
	$remember=false;
}

require 'admin/connect.php';

$query=" select * from customers
where email = '$email' and password ='$password'
";
$result=mysqli_query($connect,$query);
$num_rows=mysqli_num_rows($result);
if($num_rows==0){
	$_SESSION['notification']='Tài khoản hoặc mật khẩu không chính xác';
	header('location:log_in.php');
	exit;
}

session_start();
$customer=mysqli_fetch_array($result);
$id=$customer['id'];
$_SESSION['id']=$id;
$_SESSION['name']=$customer['name'];
if($remember){
	$token = uniqid('user_'.time());
	$update_token=" update customers
	set token = '$token'
	where id ='$id'
	";
	mysqli_query($connect,$update_token);
	setcookie('remember',$token,time() + (86400 * 30));
}
mysqli_close($connect);
header('location:index.php');
exit;