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

	$query= "select*from manufacturers
	where name like '%$search%'";
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
							<a href="insert.php">Thêm thương hiệu</a>
							<caption><form><input type="search" name="search" value="<?php echo $search ?>" placeholder="Tìm kiếm theo tên" size="40"></form></caption>
								<tr>
									<th>Mã</th>
									<th>Tên</th>
									<th>Địa chỉ</th>
									<th>Logo</th>
									<th>Xóa</th>
									<th>Sửa</th>
								</tr>
							<?php foreach ($results as $manufacturer) {?>
								<tr>
									<td><?php echo $manufacturer['id'] ?></td>
									<td><?php echo $manufacturer['name'] ?></td>
									<td><?php echo $manufacturer['address']?></td>
									<td><img src="<?php echo $manufacturer['logo'] ?>" style="height: 100px;"></td>
									<td><a href="delete.php?id=<?php echo $manufacturer['id']; ?>">Xóa</a></td>
									<td><a href="edit.php?id=<?php echo $manufacturer['id']; ?>">Sửa</a></td>
								</tr>
							<?php } ?>
						</table>
					</div>
				</div>
			</div>
			<div id="footer"></div>
		</div>
	</div>
</body>
</html>
