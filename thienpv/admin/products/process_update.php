<?php
require '../admin_check.php'; 
require '../connect.php';
if(empty($_POST['name'])||empty($_POST['description'])||empty($_POST['price'])||empty($_POST['manufacturer_id'])||empty($_POST['category_id'])){
	$_SESSION['notification']='Vui lòng điền đủ thông tin';
	header('location:edit.php');
	exit;
}
$id=($_POST['id']);

$query="select * from products
where id='$id'";
$num_rows=mysqli_num_rows(mysqli_query($connect,$query));
if ($num_rows==0) {
	$_SESSION['notification']='Sản phẩm không tồn tại';
	header('location:index.php');
	exit;
}

$name=addslashes($_POST['name']);
$price=addslashes($_POST['price']);
$description=addslashes($_POST['description']);
$category_id=addslashes($_POST['category_id']);
$manufacturer_id=addslashes($_POST['manufacturer_id']);
$img=$_FILES['img'];

if ($img['size']>0) {
	
	$folder= 'photos/';
	$file_type=explode('.', $img['name'][1]);
	$file_name= time().'.'.$file_type;
	$path_file= $folder.$file_name;
	move_uploaded_file( $img["tmp_name"],$path_file);
} else{
	$file_name=$_POST['old_img'];
}

require '../connect.php';

$query="update products
set
name = '$name',
price = '$price',
description = '$description',
category_id = '$category_id',
manufacturer_id = '$manufacturer_id',
img = '$file_name'
where
id = '$id' ";
mysqli_query($connect,$query);

$error=mysqli_error($connect);
if (empty($error)) {

	$_SESSION['notification']='Sửa thành công';
	
} else {
	$_SESSION['notification']='Sửa thất bại';

}
mysqli_close($connect);
header('location:index.php');

