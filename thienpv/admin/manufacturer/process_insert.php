<?php 
require '../sadmin_check.php';

if (empty($_POST['name'])||empty($_POST['address'])||empty($_POST['logo'])) {
	header('location:insert.php');
	exit();
}
$name=addslashes($_POST['name']);
$address=addslashes($_POST['address']);
$logo=addslashes($_POST['logo']);

require '../connect.php';
$query="select count(*) from manufacturers
where name = '$name'
";
$number_rows=mysqli_fetch_array(mysqli_query($connect,$query))['count(*)'];

if ($number_rows==1) {
	$_SESSION['notification']='Sản phẩm đã tồn tại';
	header('location:insert.php');
	exit;
}
$query2="insert into manufacturers(name,address,logo)
values('$name','$address','$logo')";

mysqli_query($connect,$query2);

mysqli_close($connect);
header('location:index.php?notification=Insert successfull!');