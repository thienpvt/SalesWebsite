<?php 
require '../sadmin_check.php';
include '../connect.php';
if (empty($_POST['name'])) {
	header('location:insert.php?error=Please enter all the values');
	exit();
}
$name=addslashes($_POST['name']);
$query="select * category
where name='$name'";
$num_rows=mysqli_num_rows(mysqli_query($connect,$query));
if ($num_rows==1) {
	$_SESSION['notification']='Thể loại đã tồn tại';
	header('location:index.php');
	exit;
}




$query2="insert into category(name)
values('$name')";

mysqli_query($connect,$query2);

mysqli_close($connect);
header('location:index.php?notification=Insert successfull!');