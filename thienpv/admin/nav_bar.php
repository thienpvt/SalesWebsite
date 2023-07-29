<div class="nav_bar" >
	<div class="nav_bar2" >
		<a href="../root/index.php"><img src="../logo.png"></a>
		
		<div class="user">
			
			<?php 
			if(isset($_SESSION['level'])) { ?>
				<a href=""><img src="../avatar.png"></a>
				<a href=""><?php echo "Chào ".$_SESSION['email'] ?></a><br>
				<a href="../sign_out.php">Đăng xuất</a>
			<?php }?>
		</div>
	</div>
</div>
<div class="top"></div>