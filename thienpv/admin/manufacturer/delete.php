<?php 

require '../sadmin_check.php';

if(empty($_GET['id'])){
	header('location:index.php');
	exit;
} 
$id=addslashes($_GET['id']);
require '../connect.php';
$query="select*from manufacturers
where id ='$id'";
$num_rows=mysqli_num_rows(mysqli_query($connect,$query));
if ($num_rows==1) {
	$query2=" delete from manufacturers
	where id ='$id'";
	mysqli_query($connect,$query2);
}

mysqli_close($connect);
header('location:index.php');