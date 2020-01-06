<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
	<!-- Header -->
	<?php require_once("require/header.php"); ?>
</head>
<body>
	<!-- start: Header -->
	<?php require_once("require/navbar.php"); ?>
	<!-- start: Header -->
	<!-- ↓ 內容 ↓  -->
	<div class="container-fluid-full">
		<div class="row-fluid">
				
			<!-- start: Main Menu -->
			<?php echo $html ?>
			<!-- end: Main Menu -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<!-- start: Content -->
			<div id="content" class="span10">
			
			
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="<?= base_url('/?/User/main') ?>">主頁</a>
					<i class="icon-angle-right"></i> 
				</li>
				<li>
					<i class="icon-edit"></i>
					<a href="<?= base_url('/?/Maintain_C');?>">使用者填寫</a>
				</li>
			</ul>
			<div>
				<button id="btn_modal" type="button" class="btn btn-info" data-toggle="modal" data-target="#AddModal">新增</button>
                <button id="btn_modal_updata" type="button" data-toggle="modal" data-target="#AddModal" hidden="hidden">修改</button>
				<button class="btn btn-info" onclick="Restore();">儲存</button>
				<button class="btn btn-info" onclick="Sumbit();">審核</button>
				<button class="btn btn-info" onclick=" Delete_Data()">全部刪除</button>
				<!-- <button class="btn btn-info" onclick="New_Noteificate('HELLO','yoyoyo','https://getbootstrap.com/docs/3.3/css/#forms');">通知我</button> -->

				
				<span id='Statement'></span>
			</div>

           	 <span id='calendar'></span>

           </div><!--/.fluid-container-->
	
			<!-- end: Content -->
		</div><!--/#content.span10-->
	</div><!--/fluid-row-->

	<!-- start: Modal (新增彈跳視窗)-->
	<div id="AddModal" class="modal fade" tabindex="-1" role="dialog" style="display:none;">
		<div class="modal-dialog">
			<form method="dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" onclick="Disable_Button()" >&times;</button>
						<h4 class="modal-title" id ="Modal-Title">新增</h4>
					</div>
					<div class="modal-body">
						<input id="Update_id" type="hidden">
						<table>
							<tr>
								<td>客戶</td>
								<td></td>
							</tr>
							<tr>
								<td><Select id="Client"></Select></td>
								<td></td>
							</tr>
							<tr>
								<td>工作項目</td>
								<td>工作名稱</td>            	          	
							</tr>
							<tr>
								<td><Select id="Machine" onchange="Get_Project_Name()"></Select></td>
								<td><Select id="Project_Name" onchange="Get_Project_Item()"></Select></td>          		       		
							</tr>
							<tr>
								<td >工作分類</td> 
								<td >分類細項</td>        	 
							</tr>
							<tr>
								<td><Select id="Project_item" onchange="Get_Child_Item();"></Select></td> 
								<td><Select id="Child_item"></Select></td>        	
							</tr>
							<tr>
								<td>開始時間</td>
								<td>結束時間</td>
							</tr>
							<tr>
								<td>
									<select id="Start_hour" class="Time_Select"></select>
									<select id="Start_Second" class="Time_Select">
										<option value="00">00</option>
										<option value="30">30</option>
									</select>
								</td>
								<td>
									<select id="End_hour" class="Time_Select"></select>
									<select id="End_Second" class="Time_Select">
										<option value="00">00</option>
										<option value="30">30</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>備註</td>
							</tr>
							<tr>
								<td colspan="2"><textarea style="width: 300px"  id='myTextarea'></textarea></td>
							</tr>
							<tr>
								<td><span>加班</span> <input type="checkbox" id="Overtime"> </td>
							</tr>
						</table>
					</div>
					<div class="modal-footer">
                        <button type="submit"  class="btn btn-info" id="Send_btn"  data-dismiss="modal" onclick="Send()">新增</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="Disable_Button()" >取消</button>
					</div>
				</div>
				
			</form>
		</div>
	</div>
	<!-- end: Modal -->
	

	
	<!-- ↑ 內容 ↑  -->
	<?php require_once("require/footer.php"); ?>

	<!-- Other JS -->
	
	<script src="<?='../assets/javascript/Maintain.js'?>"></script>
	<link href="<?= '../assets/fullcalendar/fullcalendar.min.css'?>" rel='stylesheet' />
	<link href="<?= '../assets/fullcalendar/fullcalendar.print.min.css'?>" rel='stylesheet' media='print' />
	<script src="<?= '../assets/fullcalendar/lib/moment.min.js'?>"></script>
	<script src="<?= '../assets/fullcalendar/lib/jquery.min.js'?>"></script>
	<script src="<?= '../assets/fullcalendar/fullcalendar.min.js'?>"></script>
	<!-- 滑鼠右鍵選單 -->
	<script src="../assets/js/jquery.contextMenu.js" type="text/javascript"></script>
	<script src="../assets/js/jquery.ui.position.min.js" type="text/javascript"></script>

	<script src="../assets/css/highlight.min.js"></script>
	<script src="../assets/js/theme.js"></script>
	<script src="../assets/js/main.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="../assets/css/screen.css"/>
	<link rel="stylesheet" type="text/css" href="../assets/css/theme.css"/>
	<link rel="stylesheet" type="text/css" href="../assets/css/theme-fixes.css"/>
	<link rel="stylesheet" type="text/css" href="../assets/css/github.min.css"/>
	<link rel="stylesheet" type="text/css" href="../assets/css/jquery.contextMenu.css"/>

	<script>
		// 設定通知內容
		var i = 0;
		function New_Noteificate(title, message, url) {
			i++;
			var notify = new Notification(title + '-' +i, {
				body: message,
				icon: '<?= base_url() ?>assets/img/logo.png'
			});

			notify.onclick = function (e) { // 綁定點擊事件
				e.preventDefault(); // prevent the browser from focusing the Notification's tab
				window.open(url); // 打開特定網頁
			}
		}
		$(document).ready(function() {

			// notification ↓
			/*
			if (Notification.permission === 'default' || Notification.permission === 'undefined') {
				Notification.requestPermission(function (permission) {
					// permission 可為「granted」（同意）、「denied」（拒絕）和「default」（未授權）
					// 在這裡可針對使用者的授權做處理
				});
			}*/
			// notification ↑


			Reload('');
			Date.prototype.addDays = function(days) {
						var dat = new Date(this.valueOf());
						dat.setDate(dat.getDate() + days);
						return dat;
						}
						
			$('#calendar').fullCalendar({ 
			minTime: '00:00:00',
			maxTime: '24:00:00',
			allDaySlot:false,
			defaultDate: new Date(),
			defaultView:'agendaDay', // can click day/week names to navigate views
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			timeFormat: 'H(:mm)',
			axisFormat: 'HH:mm',
			events: [
				
			], 
			eventRender: function(event, element) { 
					element.find('.fc-title').append("<br/>" + event.description); 
					element.bind('mousedown', function (e) {
					if (e.which == 3) {
						$(function() {
								$.contextMenu({
									selector: '.'+event.id, 
									callback: function(key, options) {
										if(key=='delete')
										{
											var r=confirm("是否確認要刪除?");
											if(r==true)
											{
												Destory(event.id);				                		
											}
										}
										else
										{
											Edit_Fill(event);
                                            //$('#AddModal').modal('show');
                                            $("#btn_modal_updata").click();
											$('#Send_btn').attr('onclick', 'Edit()');
                                            $('#Send_btn').text('修改');
											$('#Modal-Title').html('修改');

										} 
									
									},
									items: {
										"edit": {name: "Edit", icon: "edit"},                              
										"delete": {name: "Delete", icon: "delete"}
									
									}
								});				        
							});              
					}
				});
				}     

			});

			$('#btn_modal').click(function () {

                $('#Send_btn').attr('onclick', 'Send()');
                $('#Send_btn').text('新增');
                $('#Modal-Title').html('新增');

            });
			
			$('.fc-next-button').click(function()// 下一頁按鈕
			{
			var moment = $('#calendar').fullCalendar('getDate');
			var dat = new Date(moment.format('YYYY-MM-DD'));
			Get_Day_Off();
			Reload(Get_Day(dat.addDays(0)));
		
			});

			$('.fc-prev-button').click(function() //上一頁按鈕
			{
				var moment = $('#calendar').fullCalendar('getDate');
				var dat = new Date(moment.format('YYYY-MM-DD'));       
				Reload(Get_Day(dat.addDays(0)));
				Get_Day_Off();
			});

			$('.fc-today-button').click(function() //今天按鈕
			{
				var moment = $('#calendar').fullCalendar('getDate');
				var dat = new Date(moment.format('YYYY-MM-DD')); 
				Get_Day_Off();      
				Reload(Get_Current_Day());
			});

			Get_Day_Off();
			
			
		});
	</script>

	<!-- end: JavaScript-->

	<style>
		body, btn, h4{
			font-family: Microsoft JhengHei;
		}
	</style>
	
</body>
</html>
