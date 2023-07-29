<?php 
require '../sadmin_check.php';
if(empty($_GET['id'])){
header('location:index.php');
exit;
}
$id=addslashes($_GET['id']);
require '../connect.php';
$query=" select*from category
where id ='$id'"; 
$num_rows=mysqli_num_rows(mysqli_query($connect,$query));
if ($num_rows==0) {
	$_SESSION['notification']='Thể loại không tồn tại';
	header('location:index.php');
	exit;
}
$query2=mysqli_query($connect,$query);
$result=mysqli_fetch_array($query2);

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
					<h1>Sửa thương hiệu</h1> <br>
					<form method="post" action="process_update.php" enctype="multipart/form-data">
						Tên
						<input type="hidden" name="id" value="<?php echo $result['id'] ?>">
						<input type="text" name="name" value="<?php echo $result['name'] ?>"><br>
						<button>Cập nhật</button>
					</form>
				</div>
			</div>
			<div id="footer"></div>
		</div>
	</div>
</body>
</html>
