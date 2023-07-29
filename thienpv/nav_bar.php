<div class="nav_bar" >
	<div class="nav_bar2" >
		<a href="index.php"><img src="photos_homepage/convert.png"></a>
		<div class="search" >
			<form class="form-search" method="get" action="index.php">
				<input type="text" name="search" placeholder="Tìm kiếm sản phẩm..." class="input" value="<?php echo $search ?>">
				<button >Tìm kiếm</button>
			</form>
		</div>
			<div class="user">
				<a href="view_cart.php"><img src="photos_homepage/cart.png"></a>
				<a href=""><img src="photos_homepage/avatar.png"></a>
				<?php 
				if(isset($_SESSION['id'])&&$_SESSION['name']) { ?>
					<a href=""><?php echo "Chào ".$_SESSION['name'] ?></a><br>
					<a href="ordered.php">Đơn đã đặt</a><br>
					<a href="sign_out.php">Đăng xuất</a>
				<?php }  else { ?>
					<a href="log_in.php">Đăng nhập</a>
					<br>
					<a href="sign_up.php">Đăng ký</a>
				<?php }?>
			</div>
	</div>
</div>
<div class="top"></div>