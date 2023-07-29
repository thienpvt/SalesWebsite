<?php 
require '../sadmin_check.php';
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
	include '../connect.php'; 
	$search='';
	if(isset($_GET['search'])){
		$search=addslashes($_GET['search']);
	}
	$page=1;
	if (isset($_GET['page'])) {
		$page=$_GET['page'];
	}
	$count="select count(*)
	from customers
	where email like '%$search%'";
	$table_count=mysqli_query($connect,$count);
	$array_num_customers=mysqli_fetch_array($table_count);
	$num_customers=$array_num_customers['count(*)'];

	$num_customers_in_page=20;
	$num_pages=ceil($num_customers/$num_customers_in_page);
	$ignore=$num_customers_in_page*($page-1);

	$query= "select*from customers
	where email like '%$search%'
	limit $num_customers_in_page
	offset $ignore";
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
					<div class="list">
						<br>
						<h1>Quản lý thương hiệu</h1><br>
						<table border="1">
							
							<caption><form><input type="search" name="search" value="<?php echo $search ?>" placeholder="Tìm kiếm theo email"></form></caption>
								<tr>
									<th>Mã</th>
									<th>Email</th>
									<th>Tên</th>
									<th>Địa chỉ</th>
									<th>Số điện thoại</th>
									<th>Xóa</th>
								</tr>
							<?php foreach ($results as $customer) {?>
								<tr>
									<td><?php echo $customer['id'] ?></td>
									<td><?php echo $customer['email'] ?></td>
									<td><?php echo $customer['name'] ?></td>
									<td><?php echo $customer['address']?></td>
									<td><?php echo $customer['phone']?></td>
									<td><a href="delete.php?id=<?php echo $customer['id']; ?>">Xóa</a></td>
								</tr>
							<?php } ?>
						</table>
					</div>
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
