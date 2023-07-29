<?php session_start();
if(isset($_SESSION['level'])){
	unset($_SESSION['id']);
	unset($_SESSION['email']);
	unset($_SESSION['level']);
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
	$page=1;
	if (isset($_GET['page'])) {
		$page=$_GET['page'];
	}
	$search_cat='';
	$num_products=0;
	if(empty($_GET['search_cat'])){
		$count="select count(*) from products 
		where name like '%$search%'";
		$table_count=mysqli_query($connect,$count);
		$array_num_products=mysqli_fetch_array($table_count);
		$num_products=$array_num_products['count(*)'];
		
	} else{
		$search_cat=addslashes($_GET['search_cat']);
		$count="select count(*) from products 
		where category_id ='$search_cat'";
		$table_count=mysqli_query($connect,$count);
		$array_num_products=mysqli_fetch_array($table_count);
		$num_products=$array_num_products['count(*)'];
	}
	$num_products_in_page=8;
	$num_pages=ceil($num_products/$num_products_in_page);
	$ignore=$num_products_in_page*($page-1);
	
	
	if(empty($_GET['search_cat'])){	
		$query="select * from
		products 
		where name like '%$search%'
		limit $num_products_in_page
		offset $ignore";
		$results=mysqli_query($connect,$query);
	} else {
		$query="select * from
		products 
		where category_id='$search_cat'
		limit $num_products_in_page
		offset $ignore";
		$results=mysqli_query($connect,$query);
	}
	
	

	?>
	
	<div id="all">
		<div id="div_all">
			<div id="header">
				<?php require_once 'nav_bar.php' ?>
				<div class="bot">
					<div class="list">
						<table border="1px">
							<th>Danh mục sản phẩm</th>
							<tr>
								<td>
									<ul >
										<li>
											<a href="index.php?search_cat=1">Điện Thoại</a>
										</li>															
										<li >
											<a href="index.php?search_cat=2">Laptop</a>
										</li>
										<li >
											<a href="index.php?search_cat=3">Máy tính bảng</a>
										</li>
										<li >
											<a href="index.php?search_cat=4">Tivi</a>
										</li>
										
									</ul>
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
				<div class="products">
					
					<?php foreach ($results as $product) { ?>
					<div class="product b">
						<img src="admin/products/photos/<?php echo $product['img'] ?>" style="height: 200px; display: block; margin: auto;">
						<br>
						<h2 ><?php echo $product['name'] ?></h2><br>
						<?php echo $product['price'].'$'; ?><br><br>
						<a  href="details.php?id=<?php echo $product['id']  ?>" >Xem chi tiết</a><br><br>
						<button data-id='<?php echo  $product['id']?>' class="btn-add-cart">Thêm vào giỏ</button>
					</div>
					<?php } ?>
				</div>
				<div id="pagination">
				<?php for ($i=1; $i <=$num_pages ; $i++) { ?>
					<a href="?page=<?php echo $i ?>&search=<?php echo $search ?>&search_cat=<?php echo $search_cat ?>"><?php echo $i ?></a>
				<?php } ?>
				</div>
			</div>
			<div id="footer"></div>
		</div>
	</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
	$(document).ready(function() {
		$(".btn-add-cart").click(function() {
			let id=$(this).data( 'id');
			$.ajax({
				url: 'cart.php',
				type: 'GET',
				// dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
				data: {id},
			})
			.done(function() {
				console.log("success");
			});
			
		});
	});
</script>	
</body>
</html>