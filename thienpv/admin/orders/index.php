<?php
require '../admin_check.php';

require '../connect.php';


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
	<?php 
	$search='';
	if(isset($_GET['search'])){
		$search=addslashes($_GET['search']);
	}
	$page=1;
	if (isset($_GET['page'])) {
		$page=$_GET['page'];
	}
	$count="select count(*),
	customers.name
	from orders
	join customers ON customers.id=orders.customer_id
	where name like '%$search%'
	group by customers.name";
	$table_count=mysqli_query($connect,$count);
	$array_num_orders=mysqli_fetch_array($table_count);
	$num_orders=$array_num_orders['count(*)'];

	$num_orders_in_page=10;
	$num_pages=ceil($num_orders/$num_orders_in_page);
	$ignore=$num_orders_in_page*($page-1);

	$query="select orders.*,
	customers.name,customers.email,customers.phone
	from customers
	join orders on orders.customer_id=customers.id
	where customers.name like '%$search%'
	limit $num_orders_in_page
	offset $ignore
	";
	$results=mysqli_query($connect,$query);

	?>
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
				<div id="notification">
					<?php if(isset($_SESSION['notification'])){ ?>
						<span style="color: red;">
							<?php echo $_SESSION['notification'];
							unset($_SESSION['notification']); ?>
						</span>
					<?php } ?>
				</div>
				<div class="products" > 
					<br>
					<h1>Quản lý đơn hàng</h1>
					<table border="1">
						<caption><form><input type="search" name="search" value="<?php echo $search ?>" placeholder="Tìm kiếm theo tên khách đặt" size="40"></form></caption>
						<tr>
							<th>Mã</th>
							<th>Khách hàng đặt</th>
							<th>Người nhận</th>
							<th>Thời gian đặt</th>
							<th>Tổng tiền</th>
							<th>Trạng thái</th>
							<th>Chỉnh sửa</th>
							<th>Xóa</th>
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
										Đã duyệt
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
								<?php if ($result['status']==0) { ?>
									<td>
										<a href="update_order.php?status=1&id=<?php echo $result['id']; ?>">Duyệt</a>
										<a href="update_order.php?status=3&id=<?php echo $result['id']; ?>">Hủy</a>
									</td>
								<?php } elseif ($result['status']==1){ ?>
									<td>
										<a href="update_order.php?status=2&id=<?php echo $result['id']; ?>">Đã giao</a>
										<a href="update_order.php?status=3&id=<?php echo $result['id']; ?>">Hủy</a>
									</td>
								<?php } else { ?>
									<td>
										
									</td>
								<?php } ?>
								<?php if ($result['status']==1||$result['status']==0){ ?>
									<td>
										<a href="update_order.php?status=3&id=<?php echo $result['id']; ?>">Xóa</a>
									</td>
								<?php } else{ ?>
									<td>
										
									</td>
								<?php } ?>
								<td>
									<a href="view_details.php?order_id=<?php echo $result['id'] ?>&sum=<?php echo $result['total_prices'] ?>">Xem</a>
								</td>                              
							</tr>
						<?php } ?>
					
					</table>
				</div>
				<div id="pagination">
				<?php for ($i=1; $i <=$num_pages ; $i++) { ?>
					<a href="?page=<?php echo $i ?>&search=<?php echo $search ?>"><?php echo $i ?></a>
				<?php } ?>
				</div>
			</div>
			<div id="footer"></div>
		</div>
	</div>
</body>
</html>
