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

	$query= "select*from category
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
						<h1>Quản lý thể loại</h1><br>
						<table border="1">
							<a href="insert.php">Thêm thể loại</a>
							<caption><form><input type="search" name="search" value="<?php echo $search ?>" placeholder="Tìm kiếm theo tên" size="40"></form></caption>
								<tr>
									<th>Mã</th>
									<th>Tên</th>
									<th>Xóa</th>
									<th>Sửa</th>
								</tr>
							<?php foreach ($results as $category) {?>
								<tr>
									<td><?php echo $category['id'] ?></td>
									<td><?php echo $category['name'] ?></td>
									<td><a href="delete.php?id=<?php echo $category['id']; ?>">Xóa</a></td>
									<td><a href="edit.php?id=<?php echo $category['id']; ?>">Sửa</a></td>
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
