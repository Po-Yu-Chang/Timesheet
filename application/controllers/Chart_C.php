<?php
class Chart_C extends CI_Controller
{
 
	function __construct()
	{
		parent::__construct();//繼承
		    $this->load->helper('url');//載入URL 幫手
        $this->load->library('session');
        $this->load->model('Chart_M');
        $this->load->model('Users_model');
	}

	function index()
	{
    $leavel=$this->session->userdata('leavel');
    if(strlen($leavel)!=0)
    {
      $html['html']=$this->Users_model->Leavel($this->session->userdata('leavel')); 
      $this->load->view('Chart',$html); 
    }
    else
    {
      $this->load->view('login');
    }
		
  }
  
  function Get_Member()
  {
    $message = $this->Chart_M->Get_Member();
    echo $message;
  }

  function Search_Chart_By_member()
  {
    $message = $this->Chart_M->Search_Chart_By_member($_POST['Start_date'], $_POST['End_date'], $_POST['member_id']);
    echo $message;
  }

  function Search_Chart_By_Project_Item()
  {
    $message = $this->Chart_M->Search_Chart_By_Project_Item($_POST['Start_date'], $_POST['End_date'], $_POST['member_id'], $_POST['Item']);
    echo $message;
  }

   
  
}
	
?>