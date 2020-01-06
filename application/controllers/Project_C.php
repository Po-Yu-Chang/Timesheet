<?php
class Project_C extends CI_Controller
{
	function __construct()
	{
		    parent::__construct();//繼承
		    $this->load->helper('url');//載入URL 幫手
        $this->load->library('session');
        $this->load->model('Project_M');       
        $this->load->model('Users_model');
        header('Access-Control-Allow-Origin: http://60.251.220.112:5000');
	}
	function index()
	{
    $leavel=$this->session->userdata('leavel');
    if(strlen($leavel)!=0)
    {
      $html['html']=$this->Users_model->Leavel($this->session->userdata('leavel')); 
      $this->load->view('Project',$html); 
    }
    else
    {
      $this->load->view('login');
    }
    	
	}

  function Check_Double($Project_Number)
  {
    $Data=$this->Project_M->Check_Double($Project_Number);
    return $Data;
  }

  function Send()
  {
    header('Content-type: application/json');
    $Data = json_decode(file_get_contents('php://input'));
    
    $number=$this->Project_M->Check_Double($Data[0],$Data[1]);//$Data[1] is Project Number
   
    if($number==0)
    {
      $message=$this->Project_M->Send($Data);
    }
    else
    {
      $message="Project_Number is Double";
    }
    echo $message;
  }

  function Get_Client(){
    $message=$this->Project_M->Get_Client();
    echo $message;
  } 
  
  function New_Client(){
    $client = $_POST['client'];
    $message=$this->Project_M->New_Client($client);
    echo $message;
  }

  function Get_Dept()
  {
     $message=$this->Project_M->Get_Dept();
     echo json_encode($message);
  }

  function Get_Project_Name()
  {
      $message=$this->Project_M->Get_Project_Name();
      echo $message;
  }
  function Get_Project_Name_by_machine()
  {
      $dept = $_SESSION['dept_id'];
      $machine  = $_POST['Machine'];
      $message=$this->Project_M->Get_Project_Name_by_machine(urldecode($machine), $dept);
      echo $message;
  }

  function Send_Project_Item()
  {
    header('Content-type: application/json');
    $Data = json_decode(file_get_contents('php://input'));   
    $number=$this->Project_M->Check_Project_Item($Data);
    
    if($number==0)
    {
      $message=$this->Project_M->Send_Project_Item($Data);      
    }
    else
    {
      $message="專案檔以建立過項目";
    }
    
    echo $message;
  }
  function Send_Due_Item()
  {
    header('Content-type: application/json');
    $Data = json_decode(file_get_contents('php://input'));
    $number=$this->Project_M->Check_Double_Item($Data[1],$Data[0],'due_item');

    if($number==0)
    {
      $message=$this->Project_M->Send_Due_Item($Data);      
    }
    else
    {
      $message="以建立過項目";
    }
    
    echo $message;

  }

   function Send_Child_Item()
  {
    header('Content-type: application/json');
    $Data = json_decode(file_get_contents('php://input'));
    
    $number=$this->Project_M->Check_Child_Item($Data[0],$Data[1],$Data[2],'child_item');

    if($number==0)
    {
      $message=$this->Project_M->Send_Child_Item($Data);      
    }
    else
    {
      $message="以建立過項目";
    }
    
    echo $message;

  }

  function Search_Item()
  {
    header('Content-type: application/json');
    $Data = json_decode(file_get_contents('php://input'));

    $message=$this->Project_M->Search_Item($Data);
    echo $message;
  }

  function Delete($index)
  {
     $message=$this->Project_M->Delete($index);
     echo $message;
  }

  function Delete_Child_Item($index)
  {
    $message=$this->Project_M->Delete_Child_Item($index);
     echo $message;
  }

  function Update()
  {
     header('Content-type: application/json');
     $Data = json_decode(file_get_contents('php://input'));
     $Item=$Data[0];
     $index=$Data[1];
     $message=$this->Project_M->Update($Item,$index);
     echo $message;
  }

  function Search_Main()
  {
     header('Content-type: application/json');
     $Data = json_decode(file_get_contents('php://input'));
     
     $message=$this->Project_M->Search_Main($Data);
     echo $message;
  }

  function Get_Machine_ALL()
  {
    $message=$this->Project_M->Get_Machine_ALL();
    echo json_encode($message);
  }

  function Get_Machine()
  {
    $message=$this->Project_M->Get_Machine();
    echo $message;
  }

  function Get_Machine_Number()
  {
    header('Content-type: application/json');
    $Machine=  json_decode(file_get_contents('php://input'));
    $message=$this->Project_M->Get_Machine_Number($Machine);
    echo json_encode($message);
  }
  function New_Machine_Name()
  {
    header('Content-type: application/json');
    $Data=json_decode(file_get_contents('php://input'));   
    $Machine_Name = $Data[0];
    $apply = $Data[1];
    $message=$this->Project_M->New_Machine_Name($Machine_Name, $apply);
    echo $message;
  }
  function New_Machine_Number()
  {
    header('Content-type: application/json');
    $Data=  json_decode(file_get_contents('php://input'));
    $message=$this->Project_M->New_Machine_Number($Data);
    echo $message;
  }

  function Get_Due_Machine()
  {
    $message=$this->Project_M->Get_Due_Machine();
    echo $message;
  }

  function Search_Due_Item()
  {
    header('Content-type: application/json');
    $Data=  json_decode(file_get_contents('php://input'));
    $message=$this->Project_M->Search_Due_Item($Data);
    echo $message;
  }

  function Delete_Item($index)
  {
    $message=$this->Project_M->Delete_Item($index);
    echo $message;
  }

  function Find_Class_Item()
  {
    header('Content-type: application/json');
    $Data=  json_decode(file_get_contents('php://input'));    
    $message=$this->Project_M->Find_Class_Item($Data);
    echo json_encode($message);
  }

  function Search_Child_Item()
  {
    header('Content-type: application/json');
    $Data=  json_decode(file_get_contents('php://input'));  
    
    $message=$this->Project_M->Search_Child_Item($Data);
    echo $message;
  }

  function Get_Check_box($type)
  {
    $message=$this->Project_M->Get_Check_box($type);
    echo $message;
  }

  function Send_Update()
  {
    header('Content-type: application/json');
    $Data=  json_decode(file_get_contents('php://input'));  
    
    $message=$this->Project_M->Send_Update($Data);
    echo $message;
  }

}
?>