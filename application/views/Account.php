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
						<a href="<?= base_url('/?/User/main');?>">主頁</a> 
						<i class="icon-angle-right"></i>
					</li>
					<li>
						<i class="icon-wrench"></i>
						<a href="<?= base_url('/?/Person_C');?>">帳號設定</a>
					</li>
				</ul>
				<!-- ↓ 內容 ↓ -->
				<div>
					<ul class="tab">
						<li><a href="javascript:void(0)" class="tablinks" onclick="openarea(event, 'reset_password');">修改密碼</a></li>
						<li><a href="javascript:void(0)" class="tablinks" onclick="openarea(event, 'set_mail');">設定信箱</a></li>
					</ul>
					<div id="reset_password" class="tabcontent">
						<div class="row-fluid">
							<div class="box span4">
								<div class="box-header">修改密碼</div>
								<div class="box-content">
									<form id="reset_PW">
										<div class="form-group">
											<label>新密碼</label>
											<input type="hidden" name="c_id" value="<?= $_SESSION['id'] ?>">
											<input type="password" class="form-control" name="new_pw" require="require">
										</div>
										<div class="form-group">
											<label>確認新密碼</label>
											<input type="password" class="form-control" name="make_sure_pw" require="require">
										</div>
										<input type="button" class="btn btn-primary" value="設定" onclick="Reset_password();">
									</form>
								</div>
							</div>
						</div>
					</div>
					<div id="set_mail" class="tabcontent">
						<div class="row-fluid">
							<div class="box span4">
								<div class="box-header">設定信箱</div>
								<div class="box-content">
									<form id="mail">
										<div class="form-group">
											<label>現在信箱</label>
											<input type="hidden" name="username" value="<?= $_SESSION['id'] ?>">
											<input id="NOW" type="email" class="form-control" name="now_email" value="" readonly>
										</div>
										<div class="form-group">
											<label>新信箱</label>
											<input type="email" class="form-control" name="email" require="require">
										</div>
										<input type="button" class="btn btn-primary" value="設定" onclick="Update_mail();">
									</form>
								</div>
							</div>
						</div>
					</div>


				</div>
				<!-- ↑ 內容 ↑ -->
			</div>
			<!-- end: Content -->
		
		</div><!-- end: row-fluid-->
	</div><!-- end: container-fluid-full-->

	
	<!-- end: Content  -->

	<!-- ↑ 內容 ↑  -->
	<?php require_once("require/footer.php"); ?>

	<!-- Other JS -->
	<script src="<?='../assets/javascript/Account.js'?>"></script>

</body>
</html>
