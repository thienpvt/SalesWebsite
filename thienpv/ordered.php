<?php
session_start();
if(!isset($_SESSION['id'])){
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
	$_SESSION['notification']='Tài khoản không tồn tại';
	header('location:log_in.php');
	exit;
}
$query2="select orders.*,
	customers.name,customers.email,customers.phone
	from customers
	join orders on orders.customer_id=customers.id
	where customers.id = '$id'
	";
$num_rows2=mysqli_num_rows(mysqli_query($connect,$query2));
if($num_rows2==0){
	$_SESSION['notification']='Không có đơn nào';
	header('location:index.php');
	exit;
}
$results=mysqli_query($connect,$query2);
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
	<?php 
	$search='';
	if(isset($_GET['search'])){
		$search=$_GET['search'];
	}

	

	?>
	<div id="all">
		<div id="div_all">
			<div id="header">
				<?php require 'nav_bar.php' ?>
				<div class="bot">
					
				</div>
			</div>
			<div id="body">
				<div class="products" >
					<div id="notification">
						<?php if(isset($_SESSION['notification'])){ ?>
							<span style="color: red;text-align: center;">
								<?php echo $_SESSION['notification'];
								unset($_SESSION['notification']); ?>
							</span>
						<?php } ?>
					</div> 
					<h1>Orders</h1>
					<table border="1">
						
						<tr>
							<th>Mã</th>
							<th>Khách hàng đặt</th>
							<th>Người nhận</th>
							<th>Thời gian đặt</th>
							<th>Tổng tiền</th>
							<th>Trạng thái</th>
							<th>Xem chi tiết</th>
						</tr>
					
						<?php foreach ($results as $result) {?>
							<tr>
								<td>
								<?php echo $result['id']; ?>
								</td>
								<td>
									<?php echo $result['name']; ?><br>
									<?php echo $result['email']; ?><br>
									<?php echo $result['phone']; ?>
								</td>
								<td>
									<?php echo $result['receiver']; ?><br>
									<?php echo $result['phone_rec']; ?><br>
									<?php echo $result['address_rec']; ?>
								</td>
								<td>
									<?php echo $result['time_order']; ?>
								</td>
								<td>
									<?php echo $result['total_prices']; ?>
								</td>
								<?php if ($result['status']==0) { ?>
									<td>
										Chờ duyệt
									</td>
								<?php } elseif ($result['status']==1){ ?>
									<td>
										Đang giao
									</td>
								<?php } elseif ($result['status']==2){ ?>
									<td>
										Đã giao
									</td>
								<?php } else {?>
									<td>
										Đã hủy
									</td>
								<?php } ?>
								<td>
									<a href="ordered_details.php?order_id=<?php echo $result['id'] ?>&sum=<?php echo $result['total_prices'] ?>">Xem</a>
								</td> 
								<?php if($result['status']==1||$result['status']==0) {?>
								    <td>
										<a href="cancel_order.php?order_id=<?php echo $result['id'] ?>">Hủy</a>
									</td>
								<?php } ?>                           
							</tr>
						<?php } ?>
					
					</table>
					<a href="index.php">Trang chủ</a>
				</div>
			</div>
			<div id="footer"></div>
		</div>
	</div>
</body>
</html>
