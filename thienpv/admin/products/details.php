<?php 
require '../admin_check.php';
if(empty($_GET['id'])){
header('location:index.php');
exit;
}
$id=$_GET['id'];

require '../connect.php';
$query="select * from products
where id='$id'";
$num_rows=mysqli_num_rows(mysqli_query($connect,$query));
if ($num_rows==0) {
	$_SESSION['notification']='Sản phẩm không tồn tại';
	header('location:index.php');
}

$query2="select 
products.*, 
manufacturers.name as manufacturer 
from products 
join manufacturers on manufacturers.id=products.manufacturer_id 
where products.id ='$id' ";
$results=mysqli_query($connect,$query2);
$result=mysqli_fetch_array($results);
					
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
					<br> 
					<a href="index.php">Quay lại</a>
					<h1>Chi tiết sản phẩm</h1><br>
					<p>Tên: <?php echo $result['name'] ?></p>
					<p>Giá: <?php echo $result['price'] ?></p>
					<p>Thương hiệu: <?php echo $result['manufacturer'] ?></p>
					<p>Mô tả: <?php echo nl2br($result['description']) ?></p>
					<p>Ảnh: <br><img src="photos/<?php echo $result['img'] ?>" height="100px"></p>
				</div>
			</div>
			<div id="footer"></div>
		</div>
	</div>
</body>
</html>
