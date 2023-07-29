<?php 

require '../sadmin_check.php';

if(empty($_GET['id'])){
	header('location:index.php');
	exit;
} 
$id=addslashes($_GET['id']);
require '../connect.php';
$query="select * category
where id='$id'";
$num_rows=mysqli_num_rows(mysqli_query($connect,$query));
if ($num_rows==0) {
	$_SESSION['notification']='Thể loại không tồn tại';
	header('location:index.php');
	exit;
}
$query2=" delete from category
where id ='$id'";

mysqli_query($connect,$query2);

mysqli_close($connect);

header('location:index.php?notification=Delete successfull!');