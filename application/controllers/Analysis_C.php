<?php
class Analysis_C extends CI_Controller
{
 
	function __construct()
	{
		parent::__construct();//繼承
		    $this->load->helper('url');//載入URL 幫手
        $this->load->library('session');
        $this->load->model('Analysis_M');
        $this->load->model('Users_model');
	}

	function index()
	{
    $leavel=$this->session->userdata('leavel');
    if(strlen($leavel)!=0)
    {
      $html['html']=$this->Users_model->Leavel($this->session->userdata('leavel')); 
      $this->load->view('Analysis',$html); 
    }
    else
    {
      $this->load->view('login');
    }
		
	}

    function Search_Project()
  {
    $id = $this->session->userdata('id');

    $this->Users_model->Log($id,"Search_Project"); //紀錄LOG

    $message=$this->Analysis_M->Search_Project();
    echo $message;
  }

    function Search_Dept_Analysis()
  {
      $id=$this->session->userdata('id');
      $this->Users_model->Log($id,"Search_Dept_Analysis");

      header('Content-type: application/json');
    $Data = json_decode(file_get_contents('php://input'));
    $message=$this->Analysis_M->Search_Dept_Analysis($Data);
    echo json_encode($message);
  }

    function Get_Project_name_Dept($Dept)
    {
    $message=$this->Analysis_M->Get_Project_name_Dept($Dept);
    echo json_encode($message);
    }

    function Get_Base_Data()
  {
    header('Content-type: application/json');
    $Data = json_decode(file_get_contents('php://input'));

    $message=$this->Analysis_M->Get_Base_Data($Data);
    echo json_encode($message);
  }
    function Get_Sum_Data()
  {
    header('Content-type: application/json');
    $Data = file_get_contents('php://input');
    $Data=explode(',', $Data);
    $message=$this->Analysis_M->Get_Sum_Data($Data);
    echo $message;
  }
   function Get_tab_area()
  {
    header('Content-type: application/json');
    $Data = file_get_contents('php://input');
    $Data=explode(',', $Data);
    $message=$this->Analysis_M->Get_tab_area($Data);
    echo $message;
  }

  function Get_Child_Item()
  {
    header('Content-type: application/json');
    $Data = file_get_contents('php://input');
    $Data=explode(',', $Data);
    $message=$this->Analysis_M->Get_Child_Item($Data);
    echo $message;
  }

  function Get_Member()
  {
    header('Content-type: application/json');
    $Dept = file_get_contents('php://input');
    $message=$this->Analysis_M->Get_Member($Dept);
    echo $message;
  }

  function Search()
  {
    $username=$this->session->userdata('username');
    $this->Users_model->Log($username,"Search");

    header('Content-type: application/json');
    $Data = json_decode(file_get_contents('php://input'));
    //$Data=["功能新增", "All", "0701", "大铣刀檢查機"];    
    $message=$this->Analysis_M->Search($Data);
    echo $message;
  }

  function Get_area_member($id)
  {
    $message=$this->Analysis_M->Get_area_member($id);
    echo $message;
  }

  function Search_Member_performance()
  {
    header('Content-type: application/json');
    $Data = json_decode(file_get_contents('php://input'));
    $message=$this->Analysis_M->Search_Member_performance($Data);
    echo json_encode($message);
  }
  function Search_four_Item_member()
  {
      header('Content-type: application/json');
      $Data = json_decode(file_get_contents('php://input'));
      $message=$this->Analysis_M->Search_four_Item_member($Data);
      echo json_encode($message);
  }
  function Search_Dept_Data()
  {
      header('Content-type: application/json');
      $Data = json_decode(file_get_contents('php://input'));
      $message=$this->Analysis_M->Search_Dept_Data($Data);
      echo json_encode($message);
  }
  function  Get_Detail_Data()
  {
      header('Content-type: application/json');
      $Data = json_decode(file_get_contents('php://input'));
      $message=$this->Analysis_M->Get_Detail_Data($Data);
      echo json_encode($message);
  }
  function Get_Machine_Data()
  {
    $message=$this->Analysis_M->Get_Machine_Data();
    echo json_encode($message);
  }

  function Get_Machine_Number()
  {
    header('Content-type: application/json');
    $Machine = file_get_contents('php://input');
    $message=$this->Analysis_M->Get_Machine_Number($Machine);
    echo json_encode($message);
  }

  function Search_Machine_Data()
  {
    header('Content-type: application/json');
    $Data = json_decode(file_get_contents('php://input'));
    
    $message=$this->Analysis_M->Search_Machine_Data($Data);
    echo json_encode($message);
  }
  function Get_Project_Name_By_Machine()
  {
    header('Content-type: application/json');
    $Machine = file_get_contents('php://input');
    $message=$this->Analysis_M->Get_Project_Name_By_Machine($Machine);
    echo $message;
  }

  
}
	
?>