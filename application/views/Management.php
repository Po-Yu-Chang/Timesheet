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
						<a href="<?= '../?/User/main'?>">主頁</a> 
						<i class="icon-angle-right"></i>
					</li>
					<li>
						<i class="icon-edit"></i>
						<a href="<?= '../?/Management_C'?>">任務管理</a> 
					</li>
				</ul>
			
				<div>
					<button class="btn btn-info" onclick="Apply()">審核</button>
					<button class="btn btn-info" data-toggle="modal" data-target="#Return">退件</button>
					<span id="Statement"></span>
					<div id="member_area"></div>
				</div>

				<div id=User_Console class="tabcontent">
					
				</div>
				
				<!-- Project_New area -->
				<span id='calendar'></span>

			</div><!--/#content.span10-->
			<!-- Project_New end -->                
		</div><!--/fluid-row-->
	</div><!--/.fluid-container-->
	<!-- 退件 Modal -->
	<div class="modal fade" id="Return" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">輸入退件原因</h4>
			</div>
			<div class="modal-body">
				<span>退件原因： </span><textarea style="width: 400px" id="myTextarea"></textarea>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-info" data-dismiss="modal" id="Update_btn" onclick="Back()">送出</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
			</div>
			</div>
		</div>
	</div>


	<!-- start: JavaScript-->

	<?php require_once("require/footer.php"); ?>

	<script src="<?= '../assets/javascript/Management.js'?>"></script>
	<link href="<?= '../assets/fullcalendar/fullcalendar.min.css'?>" rel='stylesheet' />
	<link href="<?= '../assets/fullcalendar/fullcalendar.print.min.css'?>" rel='stylesheet' media='print' />
	<script src="<?= '../assets/fullcalendar/lib/moment.min.js'?>"></script>
	<script src="<?= '../assets/fullcalendar/lib/jquery.min.js'?>"></script>
	<script src="<?= '../assets/fullcalendar/fullcalendar.min.js'?>"></script>

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
	  eventClick:  function(event, jsEvent, view) {
			alert("【標題】" + event.title + "\n【描述】" + event.description);
       },
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

				            }/*,
				            items: {
				                "edit": {name: "Edit", icon: "edit"},
				                "delete": {name: "Delete", icon: "delete"}

				            }*/
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
       
       Reload(Get_Day(dat.addDays(0)));
   
    });

  $('.fc-prev-button').click(function() //上一頁按鈕
  {
      var moment = $('#calendar').fullCalendar('getDate');
      var dat = new Date(moment.format('YYYY-MM-DD'));       
      Reload(Get_Day(dat.addDays(0)));
  });

   $('.fc-today-button').click(function() //今天按鈕
  {
      var moment = $('#calendar').fullCalendar('getDate');
      var dat = new Date(moment.format('YYYY-MM-DD'));       
      Reload(Get_Current_Day());
  });

  Get_Day_Off();
 
    
  });

</script>

	<!-- end: JavaScript-->
	
</body>
</html>
