<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
	
	<!-- Header -->
	<?php require_once("require/header.php"); ?>

	<!-- Other CSS -->
	<style>
		.multiselect {
			width: 200px;
		}

		.selectBox {
			position: relative;
		}

		.selectBox select {
			width: 100%;
			font-weight: bold;
		}

		.overSelect {
			position: absolute;
			left: 0;
			right: 0;
			top: 0;
			bottom: 0;
		}

		#checkboxes {
			display: none;
			border: 1px #dadada solid;
		}

		#checkboxes label {
			display: block;
		}

		#checkboxes label:hover {
			background-color: #1e90ff;
		}
	</style>

</head>

<body onload="Idle();">
		<?php require_once("require/navbar.php"); ?>
	
		<div class="container-fluid-full">
		<div class="row-fluid">
				
			<!-- start: Main Menu -->
			<?php echo $html;	?>
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
					<a href="<?= '../?/Project_C'?>">專案管理</a>
				</li>
			</ul>

			<div>
					<ul class="tab">
					<li><a href="javascript:void(0)" class="tablinks" onclick="openarea(event, 'Client_New');">新增客戶</a></li>
					<li><a href="javascript:void(0)" class="tablinks" onclick="openarea(event, 'Project_New');">新增專案</a></li>
					<li><a href="javascript:void(0)" class="tablinks" onclick="openarea(event, 'Machine_Due_Item')"> 專案分類</a></li>				    
					<li><a href="javascript:void(0)" class="tablinks" onclick="openarea(event, 'Project_Child_Item')">專案分類項目</a></li>
					<li><a href="javascript:void(0)" class="tablinks" onclick="openarea(event, 'Project_Search')">專案查詢</a></li>  
				</ul>
			</div>
			<!-- 新增客戶 Start -->
			<div id="Client_New" class="tabcontent row-fluid ">
				<table id="Client_table" class="table table-bordered">
					<thead>
						<tr>
							<th colspan="2">
								<div class="form-inline">
									<label>新增客戶</label>
									<input type="text" class="form-control" id="new_Client" placeholder="請輸入客戶名稱-地點">
									<button type="button" class="btn btn-default" onclick="New_Client()">新增</button>
								</div>
								
							
							</th>
						</tr>
						<tr>
							<th>index</th>
							<th>客戶名稱</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			
			</div>
			<!-- 新增客戶 end -->
			<!-- 新增專案 Start -->
			<div id="Project_New" class="tabcontent row-fluid sortable">
				<div class="box span12">
					<div style="height: 30px;" class="box-header" data-original-title>
						<h2><i class="halflings-icon white edit"></i><span class="break"></span>新增專案</h2>
						
					</div>
					<div class="box-content">
						<form class="form-horizontal">
							<fieldset>

							  <div class="control-group">
								<label style="font-family: '微軟正黑體';font-size: 20px;" class="control-label">專案名稱</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="Project_Name" type="text" value="">
								</div>
							  </div>

							  <div class="control-group">
								<label style="font-family: '微軟正黑體';font-size: 20px;" class="control-label">機器名稱</label>
								<div class="controls">
								  <Select class="input-xlarge focused" id="Machine_Name" type="text" value=""></Select>
								  <span data-toggle="modal" data-target="#New_Macine_Dialog" class=" glyphicons-icon circle_plus" ></span>
								</div>
							  </div>

							   <div class="control-group">
								<label style="font-family: '微軟正黑體';font-size: 20px;" class="control-label">機器代號</label>
								<div class="controls">
								  <Select class="input-xlarge focused" id="Macine_Number" type="text" value=""></Select>
									<span onclick="Display_Machine_Name();" data-toggle="modal" data-target="#New_Macine_Number_Dialog" class=" glyphicons-icon circle_plus"></span>
								</div>
							  </div>

							  <div class="control-group">
								<label style="font-family: '微軟正黑體';font-size: 20px;" class="control-label">預定日期</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="Start_date" type="date" value="">
								</div>
								<div class="controls">
								  <input class="input-xlarge focused" id="End_date" type="date" value="">
								</div>
							  </div>
							  
							  <div class="control-group">
								<label style="font-family: '微軟正黑體';font-size: 20px;" class="control-label" for="selectError3">狀態</label>
								<div class="controls">
								  <select id="State" >
										<option value="Open">開啟</option>
										<option value="Close">專案完成</option>
										<option value="Hold">異常中止</option>									
								  </select>
								</div>
							  </div>

							  <div class="control-group">
							  		<label style="font-family: '微軟正黑體';font-size: 20px;" class="control-label" for="selectError3">適用部門</label>
										<div class="controls">
										<form>
											<div class="multiselect">
												<div class="selectBox" onclick="showCheckboxes()">
													<select>
														<option>請勾選</option>
													</select>
													<div class="overSelect"></div>
												</div>
												<div id="checkboxes"></div>
											</div>
										</form>
										</div>
							  </div>
							 
							</fieldset>
						  </form>						  
						
							  <div class="form-actions">
								<button onclick="Send()" class="btn btn-primary">送出</button>

							  </div>						
					</div>
				</div><!--/span-->
			
			</div>
			<!-- 新增專案 end -->
                 
      <!-- 專案分類 Start -->
			<div id="Project_New_Item" class="tabcontent row-fluid sortable">
				<div class="box span12">
					<div style="height: 30px;" class="box-header" data-original-title>
						<h2><i class="halflings-icon white edit"></i><span class="break"></span>專案項目</h2>
						
					</div>
					<div class="box-content">
						<div class="form-horizontal">
							<fieldset>

							  <div class="control-group">
								<label style="font-family: '微軟正黑體';font-size: 20px;" class="control-label" for="Project_Name">專案名稱</label>
								<div class="controls">
								  <div id="Project_Select_Name"></div>
								</div>
							  </div>

							  <div class="control-group">
								<label style="font-family: '微軟正黑體';font-size: 20px;" class="control-label" for="Project_Name">部門</label>
								<div class="controls">
								  <Select id="Dept"></Select><button onclick="Search_Item()" class="btn btn-primary">搜尋</button>								  
								</div>
							  </div>
							  

							  <div class="control-group">
								  <table class="table">
							         <thead>
								        <tr>
									        <th>專案名稱</th>
									        <th>專案代號</th>
									        <th>專案項目</th>
									        <th>部門所屬</th>									       
									        <th>刪除</th>                                           
								       </tr>
							       </thead>   
							       <tbody id="Project_Item_area">
								              
							     </tbody>
						        </table>  
							  </div>

							  
							  </fieldset>
						  </div>						  
						
							  <div class="form-actions">
								<button onclick="Open_Console('UpdateDialog')" class="btn btn-primary">新增</button>
							  </div>
					</div>
				</div><!--/span-->
			</div>
			<!-- 專案分類 End -->

			<!-- 專案分類 Start -->
			<div id="Machine_Due_Item" class="tabcontent row-fluid sortable">
				<div class="box span12">
					<div style="height: 30px;" class="box-header" data-original-title>
						<h2><i class="halflings-icon white edit"></i><span class="break"></span>專案分類</h2>
						
					</div>
					<div class="box-content">
						<div class="form-horizontal">
							<fieldset>

							  <!--<div class="control-group">
								<label style="font-family: '微軟正黑體';font-size: 20px;" class="control-label" for="Project_Name">機器名稱</label>
								<div class="controls">
								  <div id="Due_Machine"></div>
								</div>
							  </div> -->

							  <div class="control-group">
								<label style="font-family: '微軟正黑體';font-size: 20px;" class="control-label" for="Project_Name">適用部門</label>
								<div class="controls">
								  <Select id="Due_Dept"></Select><button onclick="Search_Due_Item()" class="btn btn-primary">搜尋</button>								  
								</div>
							  </div>
							  

							  <div class="control-group">
								  <table class="table">
							         <thead>
								        <tr>									        
									        <th>部門所屬</th>									        
									        <th>專案項目</th>									        									        
									        <th>刪除</th>                                           
								       </tr>
							       </thead>   
							       <tbody id="Project_Due_area">
								              
							     </tbody>
						        </table>  
							  </div>

							  
							  </fieldset>
						  </div>						  
							<div class="form-actions">
								<button class="btn btn-primary" data-toggle="modal" data-target="#DueDialog">新增</button>
							</div>
					</div>
				</div><!--/span-->
			</div><!--/row-->	
			<!-- 專案分類 End -->

			<!-- 專案分類項目 Start -->
			<div id="Project_Child_Item" class="tabcontent row-fluid ">
				<div class="box span12">
					<div style="height: 30px;" class="box-header" data-original-title>
						<h2><i class="halflings-icon white edit"></i><span class="break"></span>專案分類項目</h2>
						
					</div>
					<div class="box-content">
						<div class="form-horizontal">
							<fieldset>
                             
                <!--
							  <div class="control-group">
								<label style="font-family: '微軟正黑體';font-size: 20px;" class="control-label" for="Project_Name">機器名稱</label>
								<div class="controls">
								  <Select id="Child_Due_Machine"></Select>
								</div>
							  </div> 
								-->

							  <div class="control-group">
								<label style="font-family: '微軟正黑體';font-size: 20px;" class="control-label" for="Project_Name">部門所屬</label>
								<div class="controls">
								  <Select id="Child_Due_Dept"></Select>								  
								</div>
							  </div>

							  <div class="control-group">
								<label style="font-family: '微軟正黑體';font-size: 20px;" class="control-label" for="Project_Name">分類項目</label>
								<div class="controls">
								  <Select id="Class_Item"></Select><button onclick="Search_Child_Item()" class="btn btn-primary">搜尋</button>								  
								</div>
							  </div>
							  

							  <div class="control-group">
								  <table class="table">
							         <thead>
								        <tr>									        						        								        
									        <th>專案分類</th>
									        <th>項目</th>										        									        
									        <th>刪除</th>                                           
								       </tr>
							       </thead>   
							       <tbody id="Child_Item_area">
								              
							     </tbody>
						        </table>  
							  </div>

							  
							  </fieldset>
						  </div>		
							<div class="form-actions">
								<button class="btn btn-primary" data-toggle="modal" data-target="#ChildDialog">新增</button>
							</div>
					</div>
				</div><!--/span-->
			
			</div>
			<!-- 專案分類項目 End -->	

      <!-- 專案查詢 Start -->
			<div id="Project_Search" class="tabcontent row-fluid ">
				<div class="box span12">
					<div style="height: 50px;" class="box-header">
						<h2><i class="halflings-icon white align-justify"></i><span class="break"></span>Simple Table</h2>						
					</div>
					<div class="control-group">
						  <div style="background-color: steelblue" class="box-icon">
						    <input placeholder="專案名稱" type="text" id="Search_Project_Name">
								<?php 
									$leavel=$this->session->userdata('leavel');
									$display="";
									if($leavel=='admin')
									{
											$display=' <input placeholder="部門" type="text" id="Search_Dept">';
									}
									else
									{
											$display=' <input placeholder="部門" type="hidden" id="Search_Dept" value="leader">';
									}
									echo $display;

								?>
							<button onclick="Search_Main()"  class="btn">搜尋</button>
						  </div>
						</div>
					<div class="box-content">
						<table class="table">
							  <thead>
								  <tr>
									  <th>專案名稱</th>
									  <th>機器</th>									  
									  <th>部門</th>									  
									  <th>狀態</th>
									  <th>開始日期</th>
									  <th>結束日期</th>
									  <th>修改</th>                                         
								  </tr>
							  </thead>   
							  <tbody id='Main_area'>
								         
							  </tbody>
						 </table>  
						 
					</div>
				</div><!--/span-->
			
			</div>
			<!-- 專案查詢 End -->

	</div><!--/.fluid-container-->
	
			<!-- end: Content -->
		</div><!--/#content.span10-->
		</div><!--/fluid-row-->

		
	
	
	<div class="clearfix"></div>


<div class="row">
	
	<!-- dialog -->
	<dialog id="favDialog">
		<form method="dialog">
		<div class="control-group">
					<span hidden id='Display_Name'></span>
					<span hidden id='Display_Dept'></span>

				<div class="controls"> <!-- Input  -->
					<span onclick="Add_Child_Item('Child_Item','Item_area');" class="glyphicons-icon circle_plus"></span>
					<input class="input-xlarge focused" id="Child_Item">
				</div>

				<div class="controls" id='Item_area'></div><!-- Input  -->

				<div class="form-actions">
						<button onclick="Send_Project_Item()" class="btn" data-dismiss="modal">送出</button>  
						<button  class = "btn btn-danger" id="cancel" onclick="Close_Item_Console();">取消</button>
					</div>
			</div>
		</form>
	</dialog>

	<!--新增機器預設分類 -->
	<div class="modal fade" id="DueDialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">新增機器預設分類</h4>
				</div>
				<div class="modal-body">
					<form method="dialog">
						<div class="form-group">
							<span hidden id='Display_Name'></span>
							<span hidden id='Display_Dept'></span>
							<input class="form-control" id="Due_Item" placeholder="請以,號分隔">
							<button class="btn btn-info" onclick="Add_Child_Item('Due_Item','Item_Due_area','Item_Class')">新增</button>
							<hr>
						</div>
						<div class="form-group" id='Item_Due_area'></div>
					</form>
				</div>
				<div class="modal-footer">
					<button onclick="Send_Due_Item()" class="btn btn-primary" data-dismiss="modal">送出</button>  					
					<button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
				</div>
			</div>
		</div>
	</div>


	<!-- 新增專案分類項目 -->
	<div class="modal fade" id="ChildDialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">新增專案分類</h4>
				</div>
				<div class="modal-body">
					<form method="dialog">
						<div class="form-group">
							<input class="form-control" id="Child_Item_value" placeholder="請以,號分隔">
							<button class="btn btn-info" onclick="Add_Child_Item('Child_Item_value','Child_area','Child_Class')">新增</button>
							<hr>
						</div>
						<div class="form-group" ><div id="Child_area"></div></div>
					</form>
				</div>
				<div class="modal-footer">
					<button onclick="Send_Child_Item()" class="btn btn-primary" data-dismiss="modal">送出</button>  					
					<button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
				</div>
			</div>
		</div>
	</div>

	<dialog id="UpdateDialog">
		<form method="dialog">
		<div class="control-group">
					<span hidden id='Display_Name'></span>
					<span hidden id='Display_Dept'></span>

				<div class="controls"> <!-- Input  -->
					<span onclick="Add_Child_Item('Item_Data','Item_Data_area','New_Item')" class="glyphicons-icon circle_plus"></span>
					<input class="input-xlarge focused" id="Item_Data">
				</div>

				<div class="controls" id='Item_Data_area'></div><!-- Input  -->

				<div class="form-actions">
						<button onclick="Send_Project_Item()" class="btn" data-dismiss="modal">送出</button>  
						<button  class = "btn btn-danger" id="cancel" onclick="Close_Console('UpdateDialog');">取消</button>
					</div>
			</div>
		</form>
	</dialog>


	<!-- 新增機器名稱 OK -->
	<div class="modal fade" id="New_Macine_Dialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">新增機器名稱</h4>
				</div>
				<div class="modal-body">
					<form method="dialog">
						
							<div class="controls">
									<b>機器名稱：</b><input type="text" id="New_Machine_Name">       
							</div>
							<div class="controls">
									<b>適用部門：</b>
									<div id="showCheckboxes_m"></div>
							</div>
					</form>
				</div>
				<div class="modal-footer">
					<button onclick="New_Machine()" class="btn btn-primary" data-dismiss="modal">送出</button>  					
					<button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
					
				</div>
			</div>
		</div>
	</div>
	<!-- 新增機器代號 OK -->
	<div class="modal fade" id="New_Macine_Number_Dialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">新增機器代號</h4>
				</div>
				<div class="modal-body">	
					<form method="dialog">
						<div class="control-group"> 
								<div class="controls">
									<b>機器名稱：</b><span id ="Display_Machine_Name"></span>
									<!-- <span style="font-family:'微軟正黑體';font-size: 20px " id='Display_Machine_Name'></span> -->
								</div>       
								<div class="controls"> <!-- Input  -->
									<b>機器代號：</b><input type="text" id="New_Machine_Number">       
								</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button onclick="New_Number()" class="btn btn-primary" data-dismiss="modal">送出</button>  					
					<button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
					
				</div>
			</div>
		</div>
	</div>

	<!-- 修改專案日期、狀態 -->
	<div class="modal fade" id="dialog_div" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">修改專案日期及狀態</h4>
				</div>
				<div class="modal-body">	
					<div class="control-group"> 
						<div class="controls">
							<input type="hidden" name="" id='update_index'>
							<b>預定日期：</b>
							<input class="focused" id="U_Start_date" type="date" value="">
							- 
							<input class="focused" id="U_End_date" type="date" value="">
						</div>
						<div class="controls">
							<b>專案狀態：</b>
							<select id="U_states">
								<option value="Open">開啟</option>
								<option value="Close">專案完成</option>
								<option value="Hold">異常中止</option>									
							</select>
						</div>
					
						
					</div>
				</div>
				<div class="modal-footer">
					<button onclick="Send_Update()" class="btn btn-primary" data-dismiss="modal">修改</button>  					
					<button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
					
				</div>
			</div>
		</div>
	</div>

	</div>
</div>
	<!-- ↑ 內容 ↑  -->
	<?php require_once("require/footer.php"); ?>

	<!-- Other JS -->
	<script src="<?= '../assets/javascript/Project.js'?>"></script>

</body>
</html>
