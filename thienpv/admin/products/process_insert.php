<?php
require '../admin_check.php'; 
if(empty($_POST['name'])||empty($_POST['description'])||empty($_POST['price'])||($_FILES['img']['size']==0)||empty($_POST['manufacturer_id'])||empty($_POST['category_id'])){
	header('location:insert.php?error=Please enter all the values');
	exit;
}
$name=addslashes($_POST['name']);
$price=addslashes($_POST['price']);
$description=addslashes($_POST['description']);
$img=($_FILES['img']);
$manufacturer=addslashes($_POST['manufacturer_id']);
$category=addslashes($_POST['category_id']);
require '../connect.php';
$query="select count(*) from products
where name = '$name'
";
$number_rows=mysqli_fetch_array(mysqli_query($connect,$query))['count(*)'];
// die($number_rows);

if ($number_rows==1) {
	$_SESSION['notification']='Sản phẩm đã tồn tại';
	header('location:insert.php');
	exit;
}




$folder= 'photos/';
$file_type=explode('.', $img['name'][1]);
$file_name= time().'.'.$file_type;
$path_file= $folder.$file_name;

move_uploaded_file( $img["tmp_name"],$path_file);

$query2="insert into products(name,price,description,img,manufacturer_id,category_id)
values('$name','$price','$description','$file_name','$manufacturer','$category')";

mysqli_query($connect,$query2);

mysqli_close($connect);
header('location:index.php');

