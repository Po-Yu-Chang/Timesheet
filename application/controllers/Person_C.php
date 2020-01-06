<?php
class Person_C extends CI_Controller
{
 
	function __construct()
	{
		parent::__construct();//繼承
		    $this->load->helper('url');//載入URL 幫手
        $this->load->library('session');
        $this->load->model('Person_M');
        $this->load->model('Users_model');        
	}

	function index()
	{
    $leavel=$this->session->userdata('leavel');
    if(strlen($leavel)!=0)
    {
      $html['html']=$this->Users_model->Leavel($this->session->userdata('leavel')); 
      $this->load->view('Person',$html); 
    }
    else
    {
      $this->load->view('login');
    }
		
  }
  
  //
  function Get_All_Dept()
  {
    $message=$this->Person_M->Get_All_Dept();
    echo $message;
  }

  function Get_Member_by_Dept() {

    $dept = $_POST['dept'];
    $message=$this->Person_M->Get_Member_by_Dept($dept);
    echo $message;

  }
  
  function Get_Member_List() {

    $dept = $_POST['dept'];
    $message=$this->Person_M->Get_Member_List($dept);
    echo $message;

  }



  function Get_Username_by_Member() {
    $member_id = $_POST['member'];
    $message=$this->Person_M->Get_Username_by_Member($member_id);
    echo json_encode($message);
  }

  function Set_Username(){
    $Data = array( 
              "m_id"      => $_POST['m_id'],
              "username"  => $_POST['username'],
              "password"  => $_POST['password'] );

    header('Content-type: application/json');
    $message=$this->Person_M->Set_Username($Data);
    echo json_encode($message);
  }

  function Update_Mail()
  {
    $username = $_POST['username']; 
    $email    = $_POST['email'];
    $message=$this->Users_model->Update_Mail_by_Username($username, $email);
    echo json_encode($message);
  }


}
	
?>