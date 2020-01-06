<?php
class Management_C extends CI_Controller
{
 
	function __construct()
	{
		parent::__construct();//繼承
		    $this->load->helper('url');//載入URL 幫手
        $this->load->library('session');
        $this->load->model('Management_M');
        $this->load->model('Users_model');        
	}

	function index()
	{
    $leavel=$this->session->userdata('leavel');
    if(strlen($leavel)!=0)
    {
      $html['html']=$this->Users_model->Leavel($this->session->userdata('leavel')); 
      $this->load->view('Management',$html); 
    }
    else
    {
      $this->load->view('login');
    }
		
	}

  function Get_Project_Select_value()
  {
    $username=file_get_contents('php://input');    
    $message=$this->Maintain_M->Get_Project_Select_value($username);
    echo $message;
  }

  function Get_Child_Item_value()
  {
    header('Content-type: application/json');
    $Data = json_decode(file_get_contents('php://input'));
    //$Data=["張柏榆", "TSM"];
    $message=$this->Maintain_M->Get_Child_Item_value($Data);
    echo $message;
  }

  function Get_Date($year,$week)
  {
    $message=$this->Maintain_M->Get_Date($year,$week);
    echo $message;
  }

  function Send()
  {
    header('Content-type: application/json');
    $Data = json_decode(file_get_contents('php://input'));

    $message=$this->Maintain_M->Send($Data);
    echo $message;
  }

  function Get_History_Data($year,$week,$id)
  {
    $message=$this->Maintain_M->Get_History_Data($year,$week,$id);
    echo $message;
  }

  function Get_Curren_Data($id)
  {
    $message=$this->Maintain_M->Get_Curren_Data($id);
    echo $message;
  }

  function Delete_Item($index)
  {
    $message=$this->Maintain_M->Delete_Item($index);
    echo $message;
  }

 
  function Get_Now_Week()
  {
    $message=$this->Maintain_M->Get_Now_Week();
    echo $message;
  }

  //取得部門成員
  function Get_Dept_Member($id,$dept_id)
  {
    // $id = $_POST['id'];
    // $dept = $_POST['dept'];
    $message=$this->Management_M->Get_Dept_Member($id, $dept_id);
    echo $message;
  }

  function statement($year,$week,$id)
  {
    $message=$this->Management_M->statement($year,$week,$id);
    echo json_encode($message);
  }

  function Apply($day,$id)
  {
    $message=$this->Management_M->Apply($day,$id);
    echo $message;
  }

  function Back($day,$id)
  {
    header('Content-type: application/json');
    $reason = json_decode(file_get_contents('php://input'));
    $message=$this->Management_M->Back($day,$id,$reason);
    echo $message;
  }

  function Get_State($id)
  {
      $message=$this->Management_M->Get_State($id);
      echo $message;
  }
  function test_send()
  {
   echo $this->Management_M->email_send('una@mail.cin-phown.com.tw','test','test','test');
  }
  

  

}
	
?>