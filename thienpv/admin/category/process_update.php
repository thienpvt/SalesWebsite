<?php 

require '../sadmin_check.php';
include '../connect.php';
if (empty($_POST['name'])||empty($_POST['id'])) {
	header('location:insert.php');
	exit();
}
$id=addslashes($_POST['id']);
$name=addslashes($_POST['name']);
$query="select * category
where id='$id'";
$num_rows=mysqli_num_rows(mysqli_query($connect,$query));
if ($num_rows==0) {
	$_SESSION['notification']='Thể loại không tồn tại';
	header('location:index.php');
	exit;
}



$query2="update category
set
name='$name'
where id='$id'
";

mysqli_query($connect,$query2);


mysqli_close($connect);
header('location:index.php?notification=Edit successfull!');