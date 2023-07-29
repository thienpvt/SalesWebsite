<?php
require '../admin_check.php';
require '../connect.php';

$query="SELECT count(*),
status
FROM   orders
WHERE  YEARWEEK(`time_order`, 1) = YEARWEEK(CURDATE(), 1)
GROUP by status";
$query2="SELECT count(*)
FROM   orders
WHERE  YEARWEEK(`time_order`, 1) = YEARWEEK(CURDATE(), 1)";
$arr_countW=mysqli_fetch_array(mysqli_query($connect,$query2));
$countW=$arr_countW['count(*)'];


$results=mysqli_query($connect,$query);
$arrW=[];
foreach ($results as $result) {
	if ($result['status']==0) {
		$arrW['Đơn chờ duyệt']=($result['count(*)']*100/$countW);
	}
	if ($result['status']==1) {
		$arrW['Đơn đã duyệt']=($result['count(*)']*100/$countW);
	}
	if ($result['status']==2) {
		$arrW['Đơn thành công']=($result['count(*)']*100/$countW);
	}
	if ($result['status']==3) {
		$arrW['Đơn đã hủy']=($result['count(*)']*100/$countW);
	}
}
$query3="SELECT count(*),
status
FROM   orders
WHERE MONTH(time_order) = MONTH(CURRENT_DATE())
AND YEAR(time_order) = YEAR(CURRENT_DATE())
GROUP by status";
$query4="SELECT count(*)
FROM   orders
WHERE MONTH(time_order) = MONTH(CURRENT_DATE())
AND YEAR(time_order) = YEAR(CURRENT_DATE())";
$arr_countM=mysqli_fetch_array(mysqli_query($connect,$query4));
$countM=$arr_countM['count(*)'];


$resultsM=mysqli_query($connect,$query3);
$arrM=[];
foreach ($resultsM as $result) {
	if ($result['status']==0) {
		$arrM['Đơn chờ duyệt']=($result['count(*)']*100/$countM);
	}
	if ($result['status']==1) {
		$arrM['Đơn đã duyệt']=($result['count(*)']*100/$countM);
	}
	if ($result['status']==2) {
		$arrM['Đơn thành công']=($result['count(*)']*100/$countM);
	}
	if ($result['status']==3) {
		$arrM['Đơn đã hủy']=($result['count(*)']*100/$countM);
	}
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
		.highcharts-figure,
		.highcharts-data-table table {
		    min-width: 400px;
		    max-width: 600px;
		    margin: 1em auto;
		}


		#container {
		    height: 500px;
		}

		.highcharts-data-table table {
		    font-family: Verdana, sans-serif;
		    border-collapse: collapse;
		    border: 1px solid #ebebeb;
		    margin: 10px auto;
		    text-align: center;
		    width: 100%;
		    max-width: 500px;
		}

		.highcharts-data-table caption {
		    padding: 1em 0;
		    font-size: 1.2em;
		    color: #555;
		}

		.highcharts-data-table th {
		    font-weight: 600;
		    padding: 0.5em;
		}

		.highcharts-data-table td,
		.highcharts-data-table th,
		.highcharts-data-table caption {
		    padding: 0.5em;
		}

		.highcharts-data-table thead tr,
		.highcharts-data-table tr:nth-child(even) {
		    background: #f8f8f8;
		}

		.highcharts-data-table tr:hover {
		    background: #f1f7ff;
		}

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

					<figure class="highcharts-figure">
					    <div id="container"></div>
					    
					</figure>
					<figure class="highcharts-figure">
					    <div id="container2"></div>
					    
					</figure>

				</div>
			</div>
			<div id="footer"></div>
		</div>
	</div>
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/modules/exporting.js"></script>
	<script src="https://code.highcharts.com/modules/accessibility.js"></script>
	<script type="text/javascript">
		// Data retrieved from https://netmarketshare.com/
		Highcharts.chart('container', {
		    chart: {
		        plotBackgroundColor: null,
		        plotBorderWidth: 0,
		        plotShadow: false
		    },
		    title: {
		        text: 'Đơn hàng<br>trong tháng: <?php echo $countM ?>',
		        align: 'center',
		        verticalAlign: 'middle',
		        y: 60
		    },
		    tooltip: {
		        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
		    },
		    accessibility: {
		        point: {
		            valueSuffix: '%'
		        }
		    },
		    plotOptions: {
		        pie: {
		            dataLabels: {
		                enabled: true,
		                distance: -50,
		                style: {
		                    fontWeight: 'bold',
		                    color: 'white'
		                }
		            },
		            startAngle: -90,
		            endAngle: 90,
		            center: ['50%', '75%'],
		            size: '110%'
		        }
		    },
		    series: [{
		        type: 'pie',
		        name: 'Browser share',
		        innerSize: '50%',
		        data: [
		        	<?php foreach ($arrM as $key => $value) {?>
		            	['<?php echo $key ?>',<?php echo $value; ?>],
		            <?php } ?>
		            
		        ]
		    }]
		});
		Highcharts.chart('container2', {
		    chart: {
		        plotBackgroundColor: null,
		        plotBorderWidth: 0,
		        plotShadow: false
		    },
		    title: {
		        text: 'Đơn hàng<br>trong tuần: <?php echo $countW ?>',
		        align: 'center',
		        verticalAlign: 'middle',
		        y: 60
		    },
		    tooltip: {
		        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
		    },
		    accessibility: {
		        point: {
		            valueSuffix: '%'
		        }
		    },
		    plotOptions: {
		        pie: {
		            dataLabels: {
		                enabled: true,
		                distance: -50,
		                style: {
		                    fontWeight: 'bold',
		                    color: 'white'
		                }
		            },
		            startAngle: -90,
		            endAngle: 90,
		            center: ['50%', '75%'],
		            size: '110%'
		        }
		    },
		    series: [{
		        type: 'pie',
		        name: 'Browser share',
		        innerSize: '50%',
		        data: [
		            <?php foreach ($arrW as $key => $value) {?>
		            	['<?php echo $key ?>',<?php echo $value; ?>],
		            <?php } ?>
		        ]
		    }]
		});

	</script>
</body>
</html>