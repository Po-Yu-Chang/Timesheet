<?php
class Assist_C extends CI_Controller
{
 
	function __construct()
	{
		parent::__construct();//繼承
		    $this->load->helper('url');//載入URL 幫手
        $this->load->library('session');
        $this->load->model('Assist_M');
        $this->load->model('Maintain_M');
        $this->load->model('Users_model');
	}

	function index()
	{
    $leavel=$this->session->userdata('leavel');
    if(strlen($leavel)!=0)
    {
      $html['html']=$this->Users_model->Leavel($this->session->userdata('leavel')); 
      $this->load->view('Assist',$html); 
    }
    else
    {
      $this->load->view('login');
    }
		
	}

  function Management()
  {
    $username=$this->session->userdata('username');
      $id=$this->session->userdata('id');
      $Leavel=$this->session->userdata('leavel');
      if(strlen($username)>0)
      {
          if($Leavel=="admin" or $Leavel=="Top")
          {
            $this->load->view('Management');
          }
          else
         {
           $this->load->view('login');
         }
                
               
      }
      else
      {
          $this->load->view('login');
      }     
  }

  function Get_Project_Item()
  {
    header('Content-type: application/json');
    $Data = json_decode(file_get_contents('php://input'));
    $message=$this->Maintain_M->Get_Project_Item($Data);
    echo json_encode($message);
  }

  function Restore()
  {
    header('Content-type: application/json');
    $Data = json_decode(file_get_contents('php://input'));
    $message=$this->Maintain_M->Restore($Data);
    echo $message;
  }

  function Reload($id,$date)
  {
    $Data=$this->Maintain_M->Reload($id,$date);
    echo json_encode($Data);
  }

  function Get_Day_Off()
  {
    header('Content-type: application/json');
    $Data = file_get_contents('php://input');
    $message=$this->Maintain_M->Get_Day_Off($Data);
    echo $message;
  }

  function Sumbit()
  {
    header('Content-type: application/json');
    $Data = file_get_contents('php://input');
    $message=$this->Maintain_M->Sumbit($Data);
    echo $message;
  }

  function Get_Member()
  {
    header('Content-type: application/json');
    $Dept = file_get_contents('php://input');
    $message=$this->Assist_M->Get_Member($Dept);
    echo $message;
  }

  

}
	
?>