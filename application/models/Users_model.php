<?php
class Users_model extends CI_Model
{
	
	
	function __construct()
	{
		parent::__construct();
        $this->load->database();
	}
	function where_array($where,$table)
	{
		$query=$this->db->where($where)->get($table);
		return $query;
	}

	//取得登入職員的部門資訊
	function get_dept_info($id)
	{
		$sql="SELECT * FROM leaves.view_member_dept WHERE member_id = '$id'";
		$query = $this->db->query($sql);
		$i=0;

		foreach ($query->result_array() as $key => $row  )
		{
			$dept[$i]=["dept_id"=>$row['Dept'],"dept_name"=>$row['Dept_n']];
			$i++;
		}
		
		return $dept;
	}

	//取得使用者IP
	function Get_IP()
	{
		if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) 
		{
			$ip = getenv('HTTP_CLIENT_IP');
		} 
		elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) 
		{
			$ip = getenv('HTTP_X_FORWARDED_FOR');
		} 
		elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) 
		{
			$ip = getenv('REMOTE_ADDR');
		} 
		elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) 
		{
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		$ip = preg_replace("/^([\d\.]+).*/", "\\1", $ip);
				
		
		return $ip ;

	}
	// 紀錄LOG
	function Log($id,  $action)
	{
		$ip = $this->Get_IP();
		$sql="Insert into log (`id`,`ip`,`action`) values('$id', '$ip', '$action')";
		$this->db->query($sql);
	}

	// 重設密碼
	function Reset_Password($Data)
	{
		$id = $Data['c_id'];
		$pw = $Data['password'];

		$sql = "UPDATE `leaves`.member
				SET `password` = '$pw'
				WHERE id = '$id'";
		try
		{
			$query=$this->db->query($sql);
			$message="修改密碼成功,請重新登入。";
			$this->Users_model->Log($id, '重設密碼');
		}
		catch(Exception $e)
		{
			$message=$e->getMessage();
		}
		return $message;

	}

	// 以帳號(CIN)取得信箱
	function Get_Mail_by_Username($username){
		
		$sql = "SELECT mail
				FROM `leaves`.member
				WHERE id =  '$username'";
		$query=$this->db->query($sql);
		$i=0; $Data=[];
		foreach ($query->result_array() as $key => $row)
		{
			$Data = [ "mail" => $row['mail']];
		}
		return $Data;
	}


	// 以帳號(CIN)更新信箱
	function Update_Mail_by_Username($username, $email){

		$sql = "UPDATE `leaves`.member
				SET mail = '$email'
				WHERE id = '$username'";
		try
		{
			$query=$this->db->query($sql);
			$message=["msg"=>"修改信箱成功","mail"=>$email];
			$this->Users_model->Log($username, '修改信箱');
		}
		catch(Exception $e)
		{
			$message=$e->getMessage();
		}
		return $message;
	}

	function Leavel($Leavel)
	{
		$html="";
			 if($Leavel=='admin')
			 {
				
			 	$html=<<<end_html
			 	<div id="sidebar-left" class="span2">
					<div class="nav-collapse sidebar-nav">
						<ul class="nav nav-tabs nav-stacked main-menu">
							<li><a href="../?/User/main"><i class="icon-home"></i><span class="hidden-tablet"> 主頁</span></a></li>
							
							<li><a href="../?/Maintain_C"><i class="icon-calendar"></i><span class="hidden-tablet"> 使用者工時登錄</span></a></li>
							<li><a href="../?/Assist_C"><i class="icon-comments"></i><span class="hidden-tablet"> 助理填寫頁面</span></a></li>
							<li><a href="../?/Management_C"><i class="icon-tasks"></i><span class="hidden-tablet"> 任務管理</span></a></li>
							<li><a href="../?/Analysis_C"><i class="icon-book"></i><span class="hidden-tablet"> 專案追蹤</span></a></li>
							
							
							
							<li><a href="../?/Project_C"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> 專案管理</span></a></li> 
							<li><a href="../?/Person_C"><i class="icon-group"></i><span class="hidden-tablet"> 人員管理</span></a></li>
							<li><a href="../?/Account_C"><i class="icon-wrench"></i><span class="hidden-tablet"> 帳號設定</span></a></li>
							<li><a href="../?/Setting_C"><i class="icon-cog"></i><span class="hidden-tablet"> 其他設定</span></a></li>	
							
							<!--
							<li><a href="../?/Chart_C"><i class="icon-adjust"></i><span class="hidden-tablet"> 硬體部圖表(開發中)</span></a></li>
							-->	
						</ul>
					</div>
				</div>
end_html;
			 }
			 else if($Leavel=='leader')
			 {
			 	$html=<<<end_html
			 	<div id="sidebar-left" class="span2">
				<div class="nav-collapse sidebar-nav">
					<ul class="nav nav-tabs nav-stacked main-menu">
					    <li><a href="../?/User/main"><i class="icon-home"></i><span class="hidden-tablet"> 主頁</span></a></li>
						<li><a href="../?/Maintain_C"><i class="icon-calendar"></i><span class="hidden-tablet"> 使用者工時登錄</span></a></li>
						<li><a href="../?/Management_C"><i class="icon-tasks"></i><span class="hidden-tablet"> 任務管理</span></a></li>
						<li><a href="../?/Analysis_C"><i class="icon-book"></i><span class="hidden-tablet"> 專案追蹤</span></a></li>
						<li><a href="../?/Account_C"><i class="icon-wrench"></i><span class="hidden-tablet"> 帳號設定</span></a></li>
						<!--
							<li><a href="../?/Chart_C"><i class="icon-adjust"></i><span class="hidden-tablet"> 硬體部圖表(開發中)</span></a></li>
							-->	
					</ul>
				</div>
			</div>
end_html;
			 }
			 else
			 {
			 	$html='
			 	<div id="sidebar-left" class="span2">
				<div class="nav-collapse sidebar-nav">
					<ul class="nav nav-tabs nav-stacked main-menu">
					    <li><a href="../?/User/main"><i class="icon-home"></i><span class="hidden-tablet"> 主頁</span></a></li>
						<li><a href="../?/Maintain_C"><i class="icon-calendar"></i><span class="hidden-tablet"> 使用者工時登錄</span></a></li>
						<li><a href="../?/Analysis_C"><i class="icon-book"></i><span class="hidden-tablet"> 專案追蹤</span></a></li>
						<li><a href="../?/Account_C"><i class="icon-wrench"></i><span class="hidden-tablet"> 帳號設定</span></a></li>		
					</ul>
				</div>
			</div>';
			 }
			 return $html;
	}
	function area($Leavel)
	{
		$html="";
		if($Leavel=='admin')
		{
			$html=<<<end_html

			<div style="margin:20px;border:0;padding:0;" class="row-fluid">	

				<a href="../?/Maintain_C" class="quick-button metro blue span2">
					<i class="icon-calendar"></i>
					<p>使用者工時登錄</p>
				</a>
				<a href="../?/Assist_C" class="quick-button metro blue span2">
					<i class="icon-comments"></i>
					<p>助理管理頁面</p>
					<span class="badge"></span>
				</a>
				<a href="../?/Management_C" class="quick-button metro blue span2">
					<i class="icon-tasks"></i>
					<p>任務管理</p>
					<span class="badge"></span>
				</a>
				<a href="../?/Analysis_C" class="quick-button metro blue span2">
					<i class="icon-book"></i>
					<p>專案追蹤</p>
					<span class="badge"></span>
				</a>
				
								

			</div><!--/row-->
			

			<div style="margin:20px;border:0;padding:0;"  class="row-fluid">
			
				<a href="../?/Project_C" class="quick-button metro blue span2">
					<i class="icon-folder-close-alt"></i>
					<p>專案管理</p>
					<span class="badge"></span>
				</a>
				<a href="../?/Person_C" class="quick-button metro blue span2">
					<i class="icon-group"></i>
					<p>人員管理</p>
					<span class="badge"></span>
				</a>
				<a href="../?/Account_C" class="quick-button metro blue span2">
					<i class="icon-wrench"></i>
					<p>帳號設定</p>
				</a>
				
				<a href="../?/Setting_C" class="quick-button metro blue span2">
					<i class="icon-cog"></i>
					<p>其他設定</p>
				</a>
				
				<div class="clearfix"></div>
								
			</div><!--/row-->
			
end_html;
		}
		else if($Leavel=='leader')
		{
			$html=<<<end_html

			<div style="margin:20px;border:0;padding:0;" class="row-fluid">	
				<a href="../?/Maintain_C" class="quick-button metro blue span2">
					<i class="icon-calendar"></i>
					<p>使用者工時登錄</p>
				</a>
				<a href="../?/Management_C" class="quick-button metro blue span2">
					<i class="icon-tasks"></i>
					<p>任務管理</p>
					<span class="badge"></span>
				</a>
				
					
			</div><!--/row-->

			<div style="margin:20px;border:0;padding:0;"  class="row-fluid">
				
				<a href="../?/Analysis_C" class="quick-button metro blue span2">
					<i class="icon-book"></i>
					<p>專案追蹤</p>
					<span class="badge"></span>
				</a>	
				<a href="../?/Account_C" class="quick-button metro blue span2">
					<i class="icon-wrench"></i>
					<p>帳號設定</p>
				</a>
				<div class="clearfix"></div>
			</div><!--/row-->
end_html;
		}
		else
		{
			$html=<<<end_html

			<div style="margin:20px;border:0;padding:0;" class="row-fluid">	
				<a href="../?/Maintain_C" class="quick-button metro blue span2">
					<i class="icon-calendar"></i>
					<p>使用者工時登錄</p>
				</a>
				<a href="../?/Analysis_C" class="quick-button metro blue span2">
					<i class="icon-book"></i>
					<p>專案追蹤</p>
					<span class="badge"></span>
				</a>
				<a href="../?/Account_C" class="quick-button metro blue span2">
					<i class="icon-wrench"></i>
					<p>帳號設定</p>
				</a>
				<div class="clearfix"></div>
					
			</div><!--/row-->
end_html;
		}
		return $html;
	}
}

?>