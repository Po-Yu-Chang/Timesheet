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
						<a href="<?='../?/User/main'?>">主頁</a> 
						<i class="icon-angle-right"></i>
					</li>
				</ul>
				<?= $area ?>
			</div>
			<!-- end: Content -->
			<div id=Project_Track class="tabcontent">
			
			</div>

		</div><!-- end: row-fluid-->
	</div><!-- end: container-fluid-full-->

	
	<!-- end: Content  -->

	<!-- ↑ 內容 ↑  -->
	<?php require_once("require/footer.php"); ?>

	<!-- Other JS -->


</body>
</html>
