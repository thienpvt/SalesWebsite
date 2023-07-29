<?php
session_start();
if(isset($_SESSION['level'])){
	header('location:root/index.php');
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
	<link rel="stylesheet" type="text/css" href="../css_main.css">
	
</head>
<body>

	<div id="all">
		<div id="div_all">
			<div id="header">
				<div class="nav_bar" >
					<div class="nav_bar2" >
						<a href="index.php"><img src="logo.png"></a>
						
						<div class="user">
							
						</div>
					</div>
				</div>
				<div class="top"></div>
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
					
					<form method="post" action="process_log_in.php" class="form">
						<br>
						<h1>Đăng nhập</h1>
						
						<br>
						Email <br>
						<input type="email" name="email" id="email"><span class="error" id="wrongEmail"></span>
						<br><br>
						Mật khẩu <br>
						<input type="password" name="password" id="password"> <span class="error" id="wrongPassword"></span>
						<br><br>
						<button type="submit" onclick="return check_out()">Đăng nhập</button>	
					</form>
						
				</div>
			</div>
			<div id="footer"></div>
		</div>
	</div>
	<script type="text/javascript" src="../validate_login.js"></script>
</body>
</html>