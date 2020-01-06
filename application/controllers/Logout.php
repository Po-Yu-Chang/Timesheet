<?php
class Logout extends CI_Controller
{
	function __construct()
	{
		parent::__construct();//繼承
		$this->load->model('users_model');//載入資料庫
		$this->load->helper('url');//載入URL 幫手
        $this->load->library("multi_menu");
        $this->load->library('session');

        //$this->multi_menu->set_items($items);
	}
	function index()
	{
		$id=$this->session->userdata('id');
		$this->users_model->Log($id, "Logout");
		$this->session->sess_destroy();
		$this->load->view('login');
	}
}