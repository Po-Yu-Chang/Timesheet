<?php
class Account_C extends CI_Controller
{
 
	function __construct()
	{
		parent::__construct();//繼承
		    $this->load->helper('url');//載入URL 幫手
        $this->load->library('session');
        $this->load->model('Users_model');        
	}

	function index()
	{
    $leavel=$this->session->userdata('leavel');
    if(strlen($leavel)!=0)
    {
      $html['html']=$this->Users_model->Leavel($this->session->userdata('leavel')); 
      $this->load->view('Account',$html); 
    }
    else
    {
      $this->load->view('login');
    }
		
  }

  // 重設密碼
  function Reset_Password(){

    $Data = [ "c_id"     => $_POST["c_id"],
              "password" => $_POST["make_sure_pw"]];

    header('Content-type: application/json');
    $message = $this->Users_model->Reset_Password($Data);
    $Log = $_POST["c_id"]."重設密碼";
    $this->Users_model->Log($_SESSION['id'], $Log); 
    
    echo json_encode($message);

  }


  // 以帳號(CIN)取得信箱
  function Get_Mail_by_Username(){
    $username = $_POST['username']; 
    $message=$this->Users_model->Get_Mail_by_Username($username);
    echo json_encode($message);
  }

  // 以帳號(CIN)更新信箱
  function Update_Mail_by_Username(){
    $username = $_POST['username']; 
    $email    = $_POST['email'];
    $message=$this->Users_model->Update_Mail_by_Username($username, $email);
    $Log = $username . "更換信箱:" . $email;
    $this->Users_model->Log($_SESSION['id'], $Log); 
    echo json_encode($message);
  }


  

}
	
?>