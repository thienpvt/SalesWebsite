<?php
session_start();
if(empty($_POST['customer_id'])||empty($_POST['total_prices'])||empty($_POST['receiver'])||empty($_POST['address_rec'])||empty($_POST['phone_rec'])){
	$_SESSION['notification']='Vui lòng điền đầy đủ thông tin';
	header('location:view_cart.php');
	exit();
}
if(isset($_SESSION['cart'])){
	$carts=$_SESSION['cart'];
} else{
	$_SESSION['notification']='Giỏ hàng trống';
	header('location:index.php');
	exit;
}
if(count($carts)==0){
	$_SESSION['notification']='Giỏ hàng trống';
	header('location:index.php');
	exit;
}
require 'admin/connect.php';
$customer_id=addslashes($_POST['customer_id']);
$query="select * from customers
where id='$customer_id'";
$num_rows=mysqli_num_rows(mysqli_query($connect,$query));

if($num_rows==1){
	$total_prices=addslashes($_POST['total_prices']);
	$receiver=addslashes($_POST['receiver']);
	$address_rec=addslashes($_POST['address_rec']);
	$phone_rec=addslashes($_POST['phone_rec']);
} else {
	$_SESSION['notification']='Người dùng không tồn tại';
	header('location:log_in.php');
	exit();
}

foreach ($carts as $id => $product) {
	$query2="select * from products
	where id='$id'";
	$num_rows2=mysqli_num_rows(mysqli_query($connect,$query2));
	if($num_rows2==0){
		$_SESSION['notification']='Sản phẩm không tồn tại';
		header('location:view_cart.php');
		exit;
	}
}
$query3=" insert into orders(customer_id, receiver, address_rec, phone_rec, total_prices) 
values('$customer_id', '$receiver', '$address_rec', '$phone_rec',  '$total_prices')";
mysqli_query($connect,$query3);

$query4=" SELECT MAX(id) as id FROM orders
WHERE customer_id = '$customer_id'";
$result=mysqli_fetch_array(mysqli_query($connect,$query4));
$order_id=$result['id'];
print($order_id);
foreach ($carts as $product_id => $product) {
	$quantity=$product['quantity'];
	$query5="insert into order_products(order_id, product_id, quantity) 
	values ('$order_id', '$product_id', '$quantity')";
	mysqli_query($connect,$query5);
}
unset($_SESSION['cart']);
mysqli_close($connect);
$_SESSION['notification']='Đặt hàng thành công';
header('location:index.php');




