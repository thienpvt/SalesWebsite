<?php
session_start();
if(!isset($_SESSION['id'])){
	header('location:index.php');
	exit;
}
if(empty($_GET['order_id'])||empty($_GET['sum'])){
	header('location:index.php');
	exit;
}
$id=$_SESSION['id'];
require 'admin/connect.php';
$query=" select * from customers
where id = '$id'
";
$check=mysqli_query($connect,$query);
$num_rows=mysqli_num_rows($check);
if($num_rows==0){
	$_SESSION['notification']='vui lòng đăng nhập';
	header('location:log_in.php');
	exit;
}
$order_id=$_GET['order_id'];
$sum=$_GET['sum'];


$query="select order_products.*,
products.name,
products.description
from order_products
join products on products.id=order_products.product_id
where order_id='$order_id'
";
$results=mysqli_query($connect,$query);

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>
		
	</title>
	<style type="text/css">
	</style>
	<link rel="stylesheet" type="text/css" href="css_main.css">
	
</head>
<body>
	<div id="all">
		<div id="div_all">
			<div id="header">
				<?php require 'nav_bar.php' ?>
				<div class="bot">
					
				</div>
			</div>
			<div id="body">
				<div id="notification">
					<?php if(isset($_SESSION['notification'])){ ?>
						<span style="color: red;">
							<?php echo $_SESSION['notification'];
							unset($_SESSION['notification']); ?>
						</span>
					<?php } ?>
				</div>
				<div class="products" > 
					<h1>
						Orders
					</h1>
					<table border="1">
						<tr>
							<th>Mã đơn hàng</th>
							<th>Mã sản phẩm</th>
							<th>Tên</th>
							<th>Mô tả</th>
							<th>Số lượng</th>
						</tr>
							<?php foreach ($results as $result) { 	?>
								<tr>
									<td><?php echo $result['order_id'] ?></td>
									<td><?php echo $result['product_id'] ?></td>
									<td><?php echo $result['name'] ?></td>
									<td><?php echo $result['description'] ?></td>
									<td><?php echo $result['quantity']?></td>
								</tr>
							<?php } ?>
							<tr>
								<th>
									Tổng tiền: <?php echo $sum.'USD'; ?>
								</th>
							</tr>
					</table>
					<a href="ordered.php">Quay lại</a>
				</div>
			</div>
			<div id="footer"></div>
		</div>
	</div>
</body>
</html>
