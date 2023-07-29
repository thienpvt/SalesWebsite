<?php 
session_start();

if(isset($_SESSION['cart'])){
	$carts=$_SESSION['cart'];
} else{
	$_SESSION['notification']='Giỏ hàng trống';
	header('location:index.php');
	exit;
}
if(count($carts)==0){
	$_SESSION['notification']='Giỏ hàng trống';
	header('location:index.php');
	exit;
}
$sum=0;
require 'admin/connect.php';
if(isset($_SESSION['id'])){
	$id_cus=$_SESSION['id'];
	$query="select * from customers
	where id='$id_cus'";
	$customer=mysqli_fetch_array(mysqli_query($connect,$query));
} else{
	header('location:index.php?notification=Bạn cần phải đăng nhập!');
	exit;
}
$search='';
	if(isset($_GET['search'])){
		$search=addslashes($_GET['search']);
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

					<div class="details">
						<table border="1px">
							<tr>
								<th>Tên</th>
								<th>Mô tả</th>
								<th>Ảnh</th>
								<th>Số lượng</th>
								<th>Đơn giá</th>
								<th>Thành tiền</th>
								<th>Xóa sản phẩm</th>
							</tr>
							<?php foreach ($carts as $id => $product) { 
								$sum+=$product['price']*$product['quantity'];
								?>
								<tr>
									<td><?php echo $product['name'] ?></td>
									<td><?php echo $product['description'] ?></td>
									<td><img src="admin/products/photos/<?php echo $product['img'] ?>" style="height:100px"></td>
									<td>
										<button class="update-quantity" data-id='<?php echo $id?>' data-type='decre'>-</button>	
										<span class="s-quantity"><?php echo $product['quantity'] ?></span>
										<button class="update-quantity" data-id='<?php echo $id?>' data-type='incre'>+</button>	
									</td>
									<td><span class="s-price"><?php echo $product['price'] ?></span></td>
									<td><span class="s-sum"><?php echo $product['price']*$product['quantity'] ?></span></td>
									<td><button class="delete" data-id='<?php echo $id?>'>Xóa</button></td>
								</tr>
							<?php } ?>
							<tr>
								<th>
									<span id="s-total"><?php echo $sum; ?></span> USD
								</th>
							</tr>
						</table>
						<form method="post" action="process_order.php" style="text-align: left;padding-left:15px;padding-top:30px ;">
							<h1>Đặt hàng</h1>
							<input type="hidden" name="customer_id" value="<?php echo $id_cus?>">
							<input type="hidden" name="total_prices" value="<?php echo $sum?>">
							Tên người nhận <br>
							<input type="t" name="receiver" value="<?php echo $customer['name'] ?>" id="name"><span class="error" id="wrongName"></span>
							<br><br>
							Địa chỉ nhận <br>
							<input type="text" name="address_rec" value="<?php echo $customer['address'] ?>" id="address"><span class="error" id="wrongAddress"></span>
							<br><br>
							Số điện thoại người nhận <br>
							<input type="text" name="phone_rec" value="<?php echo $customer['phone'] ?>" id="phone"><span class="error" id="wrongPhone"></span>
							<br><br>
							<button type="submit" onclick="return check_out()">Đặt hàng</button>
						</form>
					</div>
				</div>
			</div>
			<div id="footer"></div>
		</div>
	</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script >
	$(document).ready(function() {
		$(".update-quantity").click(function() {
			let btn=$(this);
			let id = btn.data('id');
			let type = btn.data('type');
			$.ajax({
				url: 'update_cart.php',
				type: 'GET',
				// dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
				data: {id,type},
			})
			.done(function() {
				let parent_tr=btn.parents('tr');
				let price = parent_tr.find('.s-price').text();
				let quantity = parent_tr.find('.s-quantity').text();
				if (type=='incre') {quantity++;}
				else {quantity--;}
				if(quantity==0) {parent_tr.remove();}
				else{
				let sum=quantity*price;
				parent_tr.find('.s-sum').text(sum);
				parent_tr.find('.s-quantity').text(quantity);
				}
				getTotal();	
					
			});
			
		});
		$(".delete").click(function() {
			let btn=$(this);
			let id = btn.data('id');
			$.ajax({
				url: 'delete_cart.php',
				type: 'GET',
				// dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
				data: {id},
			})
			.done(function() {
				btn.parents('tr').remove();
				getTotal();	
			});
	
		});
	});
	function getTotal() {
		let total=0;
		$(".s-sum").each(function() {
			total+= parseFloat($(this).text());
			$("#s-total").text(total);			
		});
	}

</script>
<script type="text/javascript" src="validate_order_infor.js"></script>
</body>
</html>