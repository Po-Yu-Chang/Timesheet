<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
	
	<!-- Header -->
	<?php require_once("require/header.php"); ?>
	
	<!-- Other CSS -->	
	<style>	
	
	.chart_div{

		width:900px; height:600px
	}

	.chart_tag{
		font-size: 24px;
		color:#FFFFFF;
		font-weight:bold;
	}
	.chart_print{
		padding:20px;
	}
	</style>
</head>

<body >
	
	<!-- start: Header  -->
	<input type="hidden" id="temp" value="0" >
	<input type="hidden" id="week" value="-1" >
	<?php require_once("require/navbar.php"); ?>
	
	<!-- ↓ 內容 ↓  -->	
	<div class="container-fluid-full">

		<div class="row-fluid">
			
			<!-- start: Main Menu -->
			<?php  echo $html;?>

			<!-- start: Content -->
			<div id="content" class="span10">
				<ul class="breadcrumb">
					<li>
						<i class="icon-home"></i>
						<a href="<?php echo base_url('/?/User/main');?>">主頁</a> 
						<i class="icon-angle-right"></i>
					</li>
					<li>
						<i class="icon-edit"></i>
						<a href="<?= base_url('/?/Chart_C')?>">圖表</a>
					</li>
				</ul>
				<!-- tab ↓ -->
				<div>
					<ul class="tab">
						<li><a href="javascript:void(0)" class="tablinks" onclick="openarea(event, 'DEPT_Check');">部門資料查詢</a></li>
						<li><a href="javascript:void(0)" class="tablinks" onclick="openarea(event, 'Member_Check');">人員追蹤</a></li>
					</ul>
				</div>
				
				
				<!-- 3.部門資料查詢 -->
				<div id="DEPT_Check" class="tabcontent">
					<input id="Start_date_D" type="date">
					<input id="End_date_D" type="date">
					<button class="btn btn-info" onclick="Search_Dept_Data()">搜尋</button>

                    <!-- 3.2 圓餅圖　-->
					<div class="row-fluid">
						<div class="span12">
						
							
							<br>
							
						</div>
						
					</div>
					
				</div>
				<!-- 4.人員追蹤 -->
				<div id="Member_Check" class="tabcontent">
					<input type="date" id="Start_date" value="2018-11-01">
					<input type="date" id="End_date" value="2018-11-30">
					<select id="area_member"></select>
					<button class="btn btn-info" onclick="Search_Chart_By_member()">搜尋</button>
					
					<div class="row-fluid">
						<div id="table_div" class="span12">
							<table class="table">
								<thead>
									<tr class="info">
										<td>項目</td>
										<td>總時數</td>
										<td>正常時數</td>
										<td>加班時數</td>
									</tr>
								</thead>
							</table>
						</div>
						<div id="chart_div" class="span12"> </div>
					</div>

				</div>

			</div>
			<!-- end: Content -->
		</div><!-- end: row-fluid-->
	</div><!-- end: container-fluid-full-->

	<!-- ↑ 內容 ↑  -->
	<?php require_once("require/footer.php"); ?>

	<!-- Other JS -->
		
	<script src="../assets/javascript/Chart.js"></script>
	<script src="../assets/javascript/loader.js"></script>
	<script src="../assets/js/html2canvas.min.js"></script>
	<script src="../assets/javascript/screenshot.js"></script>
	
    <script type="text/javascript">
       	google.charts.load('current', {'packages':['corechart']});
  	</script> 
	<!-- end: JavaScript-->
	
</body>
</html>
