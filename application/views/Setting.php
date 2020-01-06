<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
	<!-- Header -->
	<?php require_once("require/header.php"); ?>
	
	<!-- Other CSS -->
</head>
<body>

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
						<a href="<?= '../?/User/main'?>">主頁</a> 
						<i class="icon-angle-right"></i>
					</li>
					<li>
						<i class="icon-group"></i>
						<a href="<?= '../?/Setting_C'?>">其他設定</a>
					</li>
				</ul>
				<!-- ↓ 內容 ↓ -->
				<div>
					<ul class="tab">
						<li><a href="javascript:void(0)" class="tablinks" onclick="openarea(event, 'Set_Machine');">設定機器</a></li>
						<li><a href="javascript:void(0)" class="tablinks" onclick="openarea(event, 'set_mail');">設定信箱</a></li>
					</ul>

					<div id="Set_Machine" class="tabcontent">
						
						<table id="Machine_table" class="table table-hover">
							<thead>
								<tr class="warning">
									<th>機器</td>
									<th>順序</th>
									<th>顏色</th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>

					</div>
					<div id="set_mail" class="tabcontent">
						444
					</div>


				</div>
				<!-- ↑ 內容 ↑ -->
			</div>
			<!-- end: Content -->
			<!-- <div id="person" class="tabcontent">
			
			</div> -->
		</div><!-- end: row-fluid-->
	</div><!-- end: container-fluid-full-->

	
	<!-- end: Content  -->

	<!-- ↑ 內容 ↑  -->
	<?php require_once("require/footer.php"); ?>

	<!-- Other JS -->
	<script src="<?= '../assets/javascript/Setting.js'?>"></script>

</body>
</html>
