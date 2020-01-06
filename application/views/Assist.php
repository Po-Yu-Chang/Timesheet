<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
	<!-- Header -->
	<?php require_once("require/header.php"); ?>
	
	<!-- Other CSS -->

</head>

<body >
	<!-- start: Header -->
	<?php require_once("require/navbar.php"); ?>
	<!-- start: Header -->
	<div class="container-fluid-full">
		<div class="row-fluid">
				
			<!-- start: Main Menu -->
			<?php echo $html; ?>
			<!-- end: Main Menu -->
			
			
			
			<!-- start: Content -->
			<div id="content" class="span10">
				<ul class="breadcrumb">
					<li>
						<i class="icon-home"></i>
						<a href="<?='../?/User/main'?>">主頁</a> 
						<i class="icon-angle-right"></i>
					</li>
					<li>
						<i class="icon-edit"></i>
						<a href="<?='../?/Assist_C'?>">助理填寫頁面</a> 
					</li>
				</ul>
			
				<div>
					<!-- new -->
					<button class="btn btn-info"data-toggle="modal" data-target="#Return">新增</button>
					<button class="btn btn-info" onclick="Restore();">儲存</button>
					<button class="btn btn-info" onclick="Sumbit();">審核</button>
					<select id='Dept_area'></select>
					<span id='Member_Item'></span>
					<span id='Statement'></span>
				</div>

					
				<span id='calendar'></span>
				
				<!-- Project_New area -->
				

			</div><!--/#content.span10-->
			<!-- Project_New end -->                
		</div><!--/fluid-row-->
	</div><!--/.fluid-container-->

	

	
	

	<dialog id="Dialog">
		<form method="dialog">
		<div class="control-group"> 
			<input type="hidden" id='Update_id'>
			<div  class="controls" >
				<table>
					<tr>
						<td>機器</td>
						<td>專案名稱</td>            	          	
					</tr>
					<tr >
						<td><SELECT id='Machine'></SELECT></td>
						<td><Select onchange="Get_Project_Item()" id='Project_Name'></Select></td>        		       		
					</tr>
					<tr>
					<td >專案分類</td> 
					<td >分類項目</td>        	 
					</tr>
					<tr>
					<td><Select id='Project_item'></Select></td> 
					<td><Select id='Child_item'></Select></td>        	
					</tr>
					<tr>
						<td >開始時間</td>
						<td >結束時間</td>
					</tr>
					<tr>
						<td><Select class='Time_Select' id="Start_hour">       		
						</Select>
						<Select class='Time_Select' id="Start_Second">
						<option value="00">00</option>
						<option value="30">30</option>
						</Select></td>
						<td><Select class='Time_Select' id="End_hour">       		
						</Select>
						<Select class='Time_Select' id="End_Second">
						<option value="00">00</option>
						<option value="30">30</option>
						</Select></td>
					</tr>
					<tr>
					<td colspan="2"><textarea style="width: 300px"  id='myTextarea'></textarea></td>
						
					</tr>
				</table>     	
			</div><!-- Input  -->   
			<div  class="form-actions">
				<table>
					<tr>
					<td>加班<input type="checkbox" id='Overtime'></td>
					<td><button  class = "btn btn-info" id='Send_btn'  onclick="Send()">送出</button> </td>
					<td><button  class = "btn btn-info" id="Update_btn"  onclick="Edit()">送出</button></td>
					<td><button  class = "btn btn-danger" id="cancel" onclick="Close_Consloe('Dialog');">取消</button></td>
					</tr>
				</table>          
				</div>
			</div>
		</form>
	</dialog>

	<!-- ↑ 內容 ↑  -->
	<?php require_once("require/footer.php"); ?>

	<!-- Other JS -->
	<script src="<?='../assets/javascript/Assist.js'?>"></script>
	<link href="<?='../assets/fullcalendar/fullcalendar.min.css'?>" rel='stylesheet' />
	<link href="<?='../assets/fullcalendar/fullcalendar.print.min.css'?>" rel='stylesheet' media='print' />
	<script src="<?='../assets/fullcalendar/lib/moment.min.js'?>"></script>
	<script src="<?='../assets/fullcalendar/lib/jquery.min.js'?>"></script>
	<script src="<?='../assets/fullcalendar/fullcalendar.min.js'?>"></script>

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

		$(document).ready(function() {
			
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
										Open_Console('Dialog');
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
	
</body>
</html>
