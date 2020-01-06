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
						<a href="<?= base_url('/?/Analysis_C')?>">專案追蹤</a>
					</li>
				</ul>
				<!-- tab ↓ -->
				<div>
					<ul class="tab">
						<li><a href="javascript:void(0)" class="tablinks" onclick="openarea(event, 'Project_Track');">專案追蹤</a></li>
						<li><a href="javascript:void(0)" class="tablinks" onclick="openarea(event, 'Machine_Track');">機器查詢</a></li>
						<li><a href="javascript:void(0)" class="tablinks" onclick="openarea(event, 'DEPT_Check');">部門資料查詢</a></li>
						<li><a href="javascript:void(0)" class="tablinks" onclick="openarea(event, 'Member_Check');">人員追蹤</a></li>
					</ul>
				</div>
				<!-- 1.專案追蹤 -->
				<div id="Project_Track" class="tabcontent">
					<div class="row-fluid">
						<select id="Machine"></select>
						<span id="Display_Project_Name"></span>
						<button class="btn btn-info" onclick="Search_Project()">搜尋</button>
					</div>
					<div class="row-fluid">
						<div class="box span4">
							<div class="box-header">基本資料</div>
							<div class="box-content">
								<ul class="Base">
									<li>專案名稱：<span id="Base_Name"></span></li>
									<li>專案代號：<span id="Base_Number"></span></li>
									<li>專案機器：<span id="Base_Machine"></span></li>
								</ul>
							</div>
						</div>
						<div class="box span8">
							<div class="box-header">統計</div>
							<div class="box-content">
								<table class="table ">
									<tr>
										<th>部門</th>
										<th>正常時數</th>
										<th>加班時數</th>
									</tr>
									<tbody id='Sum_Area'></tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="row-fluid">
						<div class="box span12">
							<div class="box-header">部門資料</div>
							<div class="box-content">
								<div id="tab_area"></div>
								<span id="Child_Item"></span>
								<span id="Member_Item"></span>
								<span id="Display_btn"></span>
								<div id="ambit" class="row-fluid"></div>
							</div>
							
						</div>
					</div>
				</div>

				<!-- 2.機器查詢 -->
				<div id="Machine_Track" class="tabcontent">
					<select id="Machine_area"></select>
					<select id="Machine_Number"></select>
					<input type="text" id="Machine_Client">
					<button class="btn btn-info" onclick="Search_Machine_Data();">搜尋</button>
					<!-- 2.1機器查詢  -->
					<div class="row-fluid">
						<div class="box span12">
							<div class="box-header">機器查詢</div>
							<div class="box-content">
								
								<div class="row-fluid">
									<table class="table">
										<tr>
											<th>專案</th>		             				
											<th>正常時數</th>
											<th>加班時數</th>
										</tr>
										<tbody id="Machine_table"></tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<!-- 2.2圓餅圖 -->
					<div class="row-fluid">
						<div class="box span12">
							<div class="box-header">圓餅圖</div>
							<div class="box-content">
								<div id="Machine_chart_R" style="width: 900px; "></div>
								<div id="Machine_chart_O" style="width: 900px; "></div>
								<div style="position:relative" class="gantt" id="GanttChartDIV"></div> 
							</div>
						</div>
					</div>
				</div>

				<!-- 3.部門資料查詢 -->
				<div id="DEPT_Check" class="tabcontent">
					<input id="Start_date_D" type="date">
					<input id="End_date_D" type="date">
					<button class="btn btn-info" onclick="Search_Dept_Data()">搜尋</button>
					<!-- 3.1　部門資料 -->
					<div class="row-fluid">
						<div class="box span12">
							<div class="box-header">部門資料</div>
							<div class="box-content">
								<table class="table">
									<tr>
										<th>項目</th>
										<th>總時數</th>
										<th>正常時數</th>
										<th>加班時數</th>
									</tr>
									<tbody id='area4'></tbody>
								</table>
							</div>
						</div>
					</div>
                    <!-- 3.2 圓餅圖　-->
					<div class="row-fluid">
						<div class="box span12">
						
			
							<div class="box-header">圓餅圖</div>
							<br>
							<?php switch ($_SESSION['dept_id']): case '0700': ?>
							<?php break; case '0701':?>
								<table id="chart3">
									<tr>
										<td>
											<div id="chart3_1" class="chart_print">
												<span class="chart_tag" style="background: #43B5AD; border-color: #43B5AD">全部</span>
												<div id="Dept_chart" class="chart_div"></div>
											</div>
											<button class="btn btn-danger" onclick="screenshot('chart3_1')">Screenshot 全部</button>
										</td>
									
										<td>
											<div id="chart3_2" class="chart_print">
												<span class="chart_tag" style="background: #33A1EE; border-color: #33A1EE">專案開發</span>
												<div id="develope_chart" class="chart_div"></div>
											</div>
											<button class="btn btn-danger" onclick="screenshot('chart3_2')">Screenshot 專案開發</button>	
										</td>
									</tr>
									<tr>
										<td>
											<div id="chart3_3" class="chart_print">
												<span class="chart_tag " style="background: #FFAA00; border-color: #FFAA00">程式維護</span>
												<div id="maintain_chart" class="chart_div"></div>
											</div>
											<button class="btn btn-danger" onclick="screenshot('chart3_3')">Screenshot 程式維護</button>
										</td>
									
										<td>
											<div id="chart3_4" class="chart_print">
												<span class="chart_tag" style="background: #2AC075; border-color: #2AC075">設計變更</span>
												<div id="Spec_chart" class="chart_div"></div>
											</div>
											<button class="btn btn-danger" onclick="screenshot('chart3_4')">Screenshot 設計變更</button>
											
										</td>
									</tr>
								</table>
							<?php break; case '1100':?>
							<?php break; endswitch;?>

							</div>
						</div>

						<?php switch ($_SESSION['dept_id']): case '0700': ?>
						
						<?php break; case '0701':?>
							<!-- 3.3 新機開發 -->
							<div class="row-fluid">
								<div class="box span12">
									<div class="box-header">新機開發</div>
									<div class="box-content">
										<table class="table">
											<tr>
												<th>機器</th>
												<th>項目</th>
												<th>總時數</th>
												<th>正常時數</th>
												<th>加班時數</th>
											</tr>
											<tbody id='develope'></tbody>
										</table>
									</div>
								</div>
							</div>
							<!-- 3.4 程式維護 -->
							<div class="row-fluid">
								<div class="box span12">
									<div class="box-header">程式維護</div>
									<div class="box-content">
										<table class="table">
											<tr>
												<th>機器</th>
												<th>項目</th>
												<th>總時數</th>
												<th>正常時數</th>
												<th>加班時數</th>
											</tr>
											<tbody id='maintain_code'></tbody>
										</table>
									</div>
								</div>
							</div>
							<!-- 3.5 設計變更 -->
							<div class="row-fluid">
								<div class="box span12">
									<div class="box-header">設計變更</div>
									<div class="box-content">
										<table class="table">
											<tr>
												<th>機器</th>
												<th>項目</th>
												<th>總時數</th>
												<th>正常時數</th>
												<th>加班時數</th>
											</tr>
											<tbody id='change_Spec'></tbody>
										</table>
									</div>
								</div>
							</div>
							<!-- 3.6 其他 -->
							<div class="row-fluid">
								<div class="box span12">
									<div class="box-header">其他</div>
									<div class="box-content">
										<table class="table">
											<tr>
												<th>機器</th>
												<th>項目</th>
												<th>總時數</th>
												<th>正常時數</th>
												<th>加班時數</th>
											</tr>
											<tbody id='else'></tbody>
										</table>
									</div>
								</div>
							</div>
						<?php break; case '1100':?>
						<?php break; endswitch;?>
					</div>

				<!-- 4.人員追蹤 -->
				<div id="Member_Check" class="tabcontent">
					<input type="date" id="Start_date">
					<input type="date" id="End_date">
					<span id="area_member"></span>
					<button class="btn btn-info" onclick="Search_Member_performance()">搜尋</button>
					<div class="row-fluid">
						<div class="box span12">
							<div class="box-header">項目圖</div>
							<div class="box-content">
								<table class="table">
									<tr>
										<th>項目</th>
										<th>總時數</th>
										<th>正常時數</th>
										<th>加班時數</th>
									</tr>
									<tbody id='area3'></tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="row-fluid">
						<div class="box span12">
							<div class="box-header">圓餅圖</div>
							<br>
							<table id="chart4" style="padding:10px">
								<tr>
									<td>
										<div id="chart4_1" class="chart_print">
											<span class="chart_tag" style="background: #43B5AD; border-color: #43B5AD">總時數</span>
											<div id="four_chart" class="chart_div"></div>
										</div>
										<button class="btn btn-danger" onclick="screenshot('chart4_1')">Screenshot</button>
									</td>
									<td>
										<div id="chart4_2" class="chart_print">
											<span class="chart_tag" style="background: #33A1EE; border-color: #33A1EE">加班時數</span>
											<div id="overtimechart" class="chart_div"></div>
										</div>
										<button class="btn btn-danger" onclick="screenshot('chart4_2')">Screenshot</button>
									</td>
								</tr>
								<tr>
									<td>
										<div id="chart4_3" class="chart_print">
											<span class="chart_tag " style="background: #FFAA00; border-color: #FFAA00">其他細部資料</span>
											<div id="chart" class="chart_div"></div>
										</div>
										<button class="btn btn-danger" onclick="screenshot('chart4_3')">Screenshot</button>
									</td>
									<td></td>
								</tr>
							</table>
                            <!-- <div class="box-content span8">
                                <h3><span class="label label-success">總時數</span></h3>
                                <div id="four_chart"></div>
                            </div>
                            <div class="box-content span8">
                                <h3><span class="label label-warning">加班時數</span></h3>
                                <div id="overtimechart"></div>
                            </div>
							<div class="box-content span8">
                                <h3><span class="label" style="background: #f68a8e; border-color: #f68a8e">其他細部資料</span></h3>
                                <div id="chart"></div>
                            </div> -->
                        </div>
					</div>
					<div class="row-fluid">
						<div class="box span12">
							<div class="box-header">其他細部資料</div>
							<div class="box-content">
								<table class="table">
									<tr>
										<th>專案</th>
										<th>子項目</th>
										<th>正常時數</th>
										<th>加班時數</th>
									</tr>
									<tbody id='area2'></tbody>
								</table>
							</div>
						</div>
					</div>
				</div>

			</div>
			<!-- end: Content -->
		</div><!-- end: row-fluid-->
	</div><!-- end: container-fluid-full-->

	<!-- ↑ 內容 ↑  -->
	<?php require_once("require/footer.php"); ?>

	<!-- Other JS -->
		
	<script src="<?= '../assets/javascript/Analysis.js'?>"></script>
	<script src="<?= '../assets/javascript/loader.js'?>"></script>
	<script src="../assets/js//html2canvas.min.js"></script>
	
    <script type="text/javascript">
       	google.charts.load('current', {'packages':['corechart']});
	   
		function screenshot(print_area){

			html2canvas(document.getElementById(print_area)).then(function(canvas) {
				//document.body.appendChild(canvas);
				var a = document.createElement('a');
				a.href = canvas.toDataURL("image/jpeg").replace("image/jpeg", "image/octet-stream");
				a.download = print_area + '.jpg';
				a.click();
			});
		}

  </script> 
	<!-- end: JavaScript-->
	
</body>
</html>
