<?php 
require '../admin_check.php'; 
if(empty($_GET['id'])){
	header('location:index.php');
	exit;
}
$id=addslashes($_GET['id']);
require '../connect.php'; 
$query="select*from products
where id ='$id'";
$num_rows=mysqli_num_rows(mysqli_query($connect,$query));
if ($num_rows==0) {
	$_SESSION['notification']='Sản phẩm không tồn tại';
	header('location:index.php');
	exit;
}
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
	
	$results=mysqli_query($connect,$query);
	$result= mysqli_fetch_array($results);

	$query2="select*from manufacturers";
	$manufacturers=mysqli_query($connect,$query2);
	$query3="select*from category";
	$categorys=mysqli_query($connect,$query3);
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
				<div class="products" >
					<?php if(isset($_SESSION['notification'])){ ?>
						<span style="color: red;text-align: center;">
							<?php echo $_SESSION['notification'];
							unset($_SESSION['notification']); ?>
						</span>
					<?php } ?>	<br>
					<a href="index.php">Quay lại</a> 
					<h1>Edit</h1><br>
					<form method="post" action="process_update.php" enctype="multipart/form-data">
						<input type="hidden" name="id" value="<?php echo $result['id'] ?>">
						Tên sản phẩm
						<input type="text" name="name" value="<?php echo $result['name'] ?>"><br>
						Giá
						<input type="text" name="price" value="<?php echo $result['price'] ?>"><br>
						Mô tả
						<textarea name="description" ><?php echo nl2br($result['description']) ?></textarea><br>
						Thể loại
						<select name="category_id">
							<?php foreach ($categorys as $category) { ?>
								<option value="<?php echo $category['id'] ?>" 
									<?php if ($category['id']==$result['category_id']) {?> selected <?php }	 ?>>
									<?php echo $category['name'] ?>						
								</option>
							<?php } ?>
						</select><br>
						Thương hiệu
						<select name="manufacturer_id">
							<?php foreach ($manufacturers as $manufacturer) { ?>
								<option value="<?php echo $manufacturer['id'] ?>" 
									<?php if ($manufacturer['id']==$result['manufacturer_id']) {?> selected <?php }	 ?>>
									<?php echo $manufacturer['name'] ?>						
								</option>
							<?php } ?>
						</select><br>
						Ảnh cũ
						<img src="photos/<?php echo $result['img'] ?>" height="100px"><br>
						<input type="hidden" name="old_img" value="<?php echo $result['img']?>">
						Ảnh mới
						<input type="file" name="img" accept="image/*"><br>
						<button>Cập nhật</button>
					</form>
				</div>
			</div>
			<div id="footer"></div>
		</div>
	</div>
</body>
</html>
