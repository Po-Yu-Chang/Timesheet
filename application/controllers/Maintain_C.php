<?php
class Maintain_C extends CI_Controller
{
 
	function __construct()
	{
		parent::__construct();//繼承
		    $this->load->helper('url');//載入URL 幫手
        $this->load->library('session');
        $this->load->model('Maintain_M');
        $this->load->model('Users_model');
        header('Access-Control-Allow-Origin: http://60.251.220.112:5000');
	}

	function index()
	{
      $leavel=$this->session->userdata('leavel');
    if(strlen($leavel)!=0)
    {
      $html['html']=$this->Users_model->Leavel($leavel); 
      $this->load->view('Maintain',$html); 
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

  function Get_Child_Item()
  {
    header('Content-type: application/json');
    $Data = json_decode(file_get_contents('php://input'));
    $message=$this->Maintain_M->Get_Child_Item($Data);
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

    function Get_Information($id,$date)
    {
      $message=$this->Maintain_M->Get_Information($id,$date);
      echo $message;
    }

    function Get_State($id)
    {

        $message=$this->Maintain_M->Get_State($id);
        echo $message;
    }

    function Get_Clent()
    {
      $message=$this->Maintain_M->Get_Clent();
       echo json_encode($message);
    }
    function Delete_Data()
    {
       header('Content-type: application/json');
       $Data = json_decode(file_get_contents('php://input'));
       $message=$this->Maintain_M->Delete_Data($Data);
       echo $message;
    }
  

}
	
?>