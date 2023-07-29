<?php 
session_start();
if(isset($_COOKIE['remember'])){
	require 'admin/connect.php';
	$token=$_COOKIE['remember'];
	$query=" select * from customers
	where token = '$token'";
	$results=mysqli_query($connect,$query);
	$num_rows=mysqli_num_rows($results);
	if($num_rows==1){
		$result=mysqli_fetch_array($results);
		$_SESSION['id']=$result['id'];
		$_SESSION['name']=$result['name'];
	} 

}
if(isset($_SESSION['id'])&&$_SESSION['name']){
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
	<link rel="stylesheet" type="text/css" href="css_main.css">
	
</head>
<body>
	<?php 
	require 'admin/connect.php';
	$search='';
	if(isset($_GET['search'])){
		$search=addslashes($_GET['search']);
	}
	?>
	
	
	<div id="all">
		<div id="div_all">
			<div id="header">
				<?php require_once 'nav_bar.php' ?>
				<div class="bot">
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
					
					<form method="post" action="process_sign_up.php" class="form">
						<br>
						<h1>Đăng ký</h1>
						<br>
						Email <br>
						<input type="email" name="email" id="email"><span class="error" id="wrongEmail"></span>
						<br><br>
						Mật khẩu <br>
						<input type="password" name="password" id="password"> <span class="error" id="wrongPassword"></span>
						<br><br>
						Họ và Tên <br>
						<input type="text" name="name" id="name"><span class="error" id="wrongName"></span>
						<br><br>						
						Địa chỉ <br>
						<input type="text" name="address" id="address"><span class="error" id="wrongAddress"></span>
						<br><br>
						Số điện thoại <br>
						<input type="text" name="phone" id="phone"><span class="error" id="wrongPhone"></span>
						<br><br>
						<button type="submit" onclick="return check_out()">Đăng ký</button>
						hoặc
						<a href="log_in.php">Đăng nhập</a>		
					</form>
						
				</div>
			</div>
			<div id="footer"></div>
		</div>
	</div>
	<script type="text/javascript" src="validate_signup.js"></script>
</body>
</html>