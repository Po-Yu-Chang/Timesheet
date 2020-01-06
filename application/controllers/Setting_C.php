<?php
class Setting_C extends CI_Controller
{
 
	function __construct()
	{
		parent::__construct();//繼承
		    $this->load->helper('url');//載入URL 幫手
        $this->load->library('session');
        $this->load->model('Setting_M');
        $this->load->model('Users_model');        
	}

	function index()
	{
    $leavel=$this->session->userdata('leavel');
    if(strlen($leavel)!=0)
    {
      $html['html']=$this->Users_model->Leavel($this->session->userdata('leavel')); 
      $this->load->view('Setting',$html); 
    }
    else
    {
      $this->load->view('login');
    }
		
  }
  
  function Get_Machine()
  {
    $message = $this->Setting_M->Get_Machine();
    echo $message;
  }

  function Update_Sequence($name, $value, $table, $index){
    $message = $this->Setting_M->Update_Sequence($name, $value, $table, $index);
    echo $message;
  }

  function Get_Username_by_Member() {
    $member_id = $_POST['member'];
    $message=$this->Person_M->Get_Username_by_Member($member_id);
    echo json_encode($message);
  }
  function Test()
  {
    try {

    //connection params
    $dbCon = new PDO('sqlsrv:server=192.168.1.14;database=XMLY5000', 'sa', 'lys@123456');

    //test query
    $result = $dbCon->query('show database');

  

    } catch (PDOException $e) {

          //show exception
          echo $e->getMessage();

    } 
  }

}
	
?>