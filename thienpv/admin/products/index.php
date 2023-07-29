<?php 
require '../admin_check.php'; 
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
	
	require '../connect.php';

	$search='';
	if(isset($_GET['search'])){
		$search=addslashes($_GET['search']);
	}
	$page=1;
	if (isset($_GET['page'])) {
		$page=$_GET['page'];
	}

	$count="select count(*) from products 
	where name like '%$search%'";
	$table_count=mysqli_query($connect,$count);
	$array_num_products=mysqli_fetch_array($table_count);
	$num_products=$array_num_products['count(*)'];

	$num_products_in_page=10;
	$num_pages=ceil($num_products/$num_products_in_page);
	$ignore=$num_products_in_page*($page-1);

	$query="select 
	products.*, 
	manufacturers.name as manufacturer,
	category.name as category	 
	from products 
	join manufacturers on manufacturers.id=products.manufacturer_id
	join category on category.id=products.category_id 
	where products.name like '%$search%'
	limit $num_products_in_page
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
					<br>
					<h1>Quản lý sản phẩm</h1> 
					<table border="1" width="100%">
						<a href="insert.php">Thêm sản phẩm</a>
						<caption><form><input type="search" name="search" value="<?php echo $search ?>" placeholder="Tìm kiếm theo tên" size="40"></form></caption>
							<tr>
								<th>Mã</th>
								<th>Tên sản phẩm</th>
								<th>Thể loại</th>
								<th>Thương hiệu</th>
								<th>Ảnh</th>		
								<th>Giá</th>		
								<th>Xóa</th>
								<th>Sửa</th>
							</tr>
						<?php foreach ($results as $product) { ?>
							<tr>
								<td><?php echo $product['id'] ?></td>
								<td><a href="details.php?id=<?php echo $product['id']  ?>"><?php echo $product['name'] ?></a></td>
								<td><?php echo $product['category'] ?></td>
								<td><?php echo $product['manufacturer'] ?></td>
								<td><img src="photos/<?php echo $product['img'] ?>" height="70px"></td>
								<td><?php echo $product['price'] ?></td>
								<td><a href="delete.php?id=<?php echo $product['id'] ?>">Xóa</a></td>
								<td><a href="edit.php?id=<?php echo $product['id'] ?>">Sửa</a></td>
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
