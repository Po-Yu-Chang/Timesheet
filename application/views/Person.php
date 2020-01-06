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
						<a href="<?= '../?/Person_C'?>">人員管理</a>
					</li>
				</ul>
				<!-- ↓ 內容 ↓ -->
				<div>
					<ul class="tab">
						<li><a href="javascript:void(0)" class="tablinks" onclick="openarea(event, 'set_account');">設定帳號</a></li>
						<li><a href="javascript:void(0)" class="tablinks" onclick="openarea(event, 'set_mail');">設定信箱</a></li>
					</ul>

					<div id="set_account" class="tabcontent">
						<select id="dept1" onchange="Get_Member_by_Dept()"></select> <!-- 部門 --> 
 						<select id="member" onchange="Get_Member_ID()"></select> <!-- 人員 -->

						<div class="row-fluid">
							<div class="box span4">
								<div class="box-header">建立帳號、修改密碼</div>
								<div class="box-content">
									<form id="Set_Username">
										<div class="form-group">
											<label>帳號</label>
											<input type="hidden" name="m_id">
											<input type="text" class="form-control" name="username" placeholder="請輸入職員編號" value="" require="require">
										</div>
										<div class="form-group">
											<label>密碼</label>
											<input type="password" class="form-control" name="password" placeholder="請輸入密碼" value="" require="require">
										</div>
									</form>
										<input type="button" class="btn btn-primary" value="設定" onclick="Set_Username();">
									
								</div>
							</div>
						</div>
						

					</div>
					<div id="set_mail" class="tabcontent">
						<select id="dept2" onchange="Get_Member_List()"></select> <!-- 部門 --> 
						<div id="member_list"></div>

						

						<!-- Modal -->
						<div class="modal fade" id="Mail_Modal" tabindex="-1" role="dialog">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">設定信箱</h4>
									</div>
									<div class="modal-body">
										<form id="Set_Email">
										<table>
											<tr>
												<th>姓名：</th>
												<td><span id="name"></span></td>
											</tr>
											<tr>
												<th>E-Mail：</th>
												<td>
													<input id="username" name="username" type="hidden">
													<input id="email" name="email"  type="email">
												</td>
											</tr>
										</table>
										</form>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
										<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="Update_mail()">修改</button>
									</div>
								</div>
							</div>
						</div>
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
	<script src="<?= '../assets/javascript/Person.js'?>"></script>

</body>
</html>
