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
					<a href="index.php">Quay lại</a>
					<h1>Thêm thương hiệu</h1>	
					<form method="post" action="process_insert.php" enctype="multipart/form-data">
						Tên
						<input type="text" name="name"><br>
						Địa chỉ
						<input type="text" name="address"><br>
						Logo
						<input type="text" name="logo"><br>
						<button>Thêm</button>
					</form>
				</div>
			</div>
			<div id="footer"></div>
		</div>
	</div>
</body>
</html>