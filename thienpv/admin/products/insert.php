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
					<h1>Thêm sản phẩm</h1>
					<?php 
					require '../connect.php'; 

					$query="select*from manufacturers";
					$results=mysqli_query($connect,$query);
					$query2="select*from category";
					$results2=mysqli_query($connect,$query2);
					?>

					<form method="post" action="process_insert.php" enctype="multipart/form-data"> 
						Tên
						<input type="text" name="name"><br>
						Giá
						<input type="text" name="price"><br>
						Mô tả
						<textarea name="description"></textarea><br>
						Thể loại
						<select name="category_id">
							<?php foreach ($results2 as $category) { ?>
								<option value="<?php echo $category['id'] ?>" ><?php echo $category['name'] ?></option>
							<?php } ?>
						</select><br>
						Thương hiệu
						<select name="manufacturer_id">
							<?php foreach ($results as $manufacturer) { ?>
								<option value="<?php echo $manufacturer['id'] ?>" ><?php echo $manufacturer['name'] ?></option>
							<?php } ?>
						</select><br>
						Ảnh
						<input type="file" name="img" accept="image/*"><br>
						<button>Thêm</button>
					</form>
				</div>
			</div>
			<div id="footer"></div>
		</div>
	</div>
</body>
</html>

