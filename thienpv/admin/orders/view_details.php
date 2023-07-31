<?php
require '../admin_check.php';
if(empty($_GET['order_id'])||empty($_GET['sum'])||!isset($_GET['position'])){
	header('location:index.php');
	exit;
}
$order_id=addslashes($_GET['order_id']);
$sum=addslashes($_GET['sum']);
$position=$_GET['position'];
require '../connect.php';

$query="select order_products.*,
products.name,
products.description
from order_products
join products on products.id=order_products.product_id
where order_id='$order_id'
";
$num_rows=mysqli_num_rows(mysqli_query($connect,$query));
if ($num_rows==0) {
	$_SESSION['notification']='Đơn hàng không tồn tại';
	header('location:index.php');
	exit;
}
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
	<link rel="stylesheet" type="text/css" href="../../css_main.css">
	
</head>
<body>
	<div id="all">
		<div id="div_all">
			<div id="header">
				<?php require '../nav_bar.php' ?>
				<div class="bot">
					<div class="list">
						<table border="1px">

							<tr>
								<td>
									<?php 
									require '../menu.php';
									?>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<div id="body">
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
					<?php if ($position==0) { ?>
						<a href="pending.php">Quay lại</a>
					<?php } elseif ($position==1) {?>
						<a href="approved.php">Quay lại</a>
					<?php } elseif ($position==3) {?>
						<a href="canceled.php">Quay lại</a>
					<?php } else{?>
						<a href="index.php">Quay lại</a>
					<?php } ?>
				</div>
			</div>
			<div id="footer"></div>
		</div>
	</div>
</body>
</html>
