<?php 

require '../sadmin_check.php';
include '../connect.php';
if (empty($_POST['name'])||empty($_POST['address'])||empty($_POST['logo'])) {
	header('location:insert.php');
	exit();
}
$id=addslashes($_POST['id']);
$query="select * from manufacturers
where id='$id'";
$num_rows=mysqli_num_rows(mysqli_query($connect,$query));
if ($num_rows==0) {
	$_SESSION['notification']='Sản phẩm không tồn tại';
	header('location:index.php');
	exit;
}

$name=addslashes($_POST['name']);
$address=addslashes($_POST['address']);
$logo=addslashes($_POST['logo']);



$query2="update manufacturers
set
name='$name',
address='$address',
logo='$logo'
where id='$id'
";

mysqli_query($connect,$query2);
$error=mysqli_error($connect);
if (empty($error)) {
	$_SESSION['notification']='Sửa thành công';
	
} else {
	$_SESSION['notification']='Sửa thất bại';
}
mysqli_close($connect);
header('location:index.php?notification=Edit successfull!');