<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

	function __construct()
	{
		parent::__construct(); //繼承
		$this->load->model('Users_model'); //載入資料庫
		$this->load->helper('url'); //載入URL 幫手        
		$this->load->library('session');
		//$this->multi_menu->set_items($items);
	}
	function index()
	{
		$this->load->view('login');
	}
	function login()
	{
		//取得員工基本資訊
		$where = array(
			'id' => $this->input->post('ID'),
			'password' => $this->input->post('Password')
		);
		$query = $this->Users_model->where_array($where, 'member');

		$ImageCode = $this->input->post('ImageCode');
		if ($query->num_rows() > 0 && $_SESSION["checkNum"] == $ImageCode) {

			$data = $query->row_array();

			//取得部門資訊
			$dept = $this->Users_model->get_dept_info($data['index']);
			//取得目前IP位置
			$ip = $this->Users_model->Get_IP();

			$userdata = array(
				'username'	=> $data['name'],
				'id'		=> $data['id'],
				'leavel'	=> $data['leavel'],
				'dept_id'	=> $dept[0]['dept_id'],
				'dept'		=> $dept[0]['dept_name'],
				'ip' => $ip
			);

			//切換身分用
			$dept_array = array("dept_array" => $dept);

			$this->session->set_userdata($userdata);
			$this->session->set_userdata($dept_array);
			$this->Users_model->Log($data['id'], "Login");
			$html['html'] = $this->Users_model->Leavel($this->session->userdata('leavel'));
			$html['area'] = $this->Users_model->area($this->session->userdata('leavel'));
			// $this->load->view('Main', $html);
			$this->main();
		} else {
			$this->Users_model->Log($this->input->post('ID'), "Login_fail");
			$errormessage = "帳號密碼錯誤";
			echo "<script>alert('$errormessage');</script>";
			$this->home();
		}
	}
	function login2($id, $password)
	{
		//取得員工基本資訊
		$where = array(
			'id' => $id,
			'password' => $password
		);
		$query = $this->Users_model->where_array($where, 'member');
		if ($query->num_rows() > 0) {

			$data = $query->row_array();

			//取得部門資訊
			$dept = $this->Users_model->get_dept_info($data['index']);
			//取得目前IP位置
			$ip = $this->Users_model->Get_IP();

			$userdata = array(
				'username'	=> $data['name'],
				'id'		=> $data['id'],
				'leavel'	=> $data['leavel'],
				'dept_id'	=> $dept[0]['dept_id'],
				'dept'		=> $dept[0]['dept_name'],
				'ip' => $ip
			);

			//切換身分用
			$dept_array = array("dept_array" => $dept);

			$this->session->set_userdata($userdata);
			$this->session->set_userdata($dept_array);
			$this->Users_model->Log($data['id'], "Login");
			$html['html'] = $this->Users_model->Leavel($this->session->userdata('leavel'));
			$html['area'] = $this->Users_model->area($this->session->userdata('leavel'));
			echo "<script>";
			echo "window.location.href = '../?/User/main';";
			echo "</script>";
		} else {
			$this->Users_model->Log($id, "Login_fail");
			$errormessage = "帳號密碼錯誤";
			echo "<script>alert('$errormessage');</script>";
			$this->home();
		}
	}
	function main()
	{
		$html['html'] = $this->Users_model->Leavel($this->session->userdata('leavel'));
		$html['area'] = $this->Users_model->area($this->session->userdata('leavel'));
		$this->load->view('Main', $html);
	}
	function home()
	{
		$this->load->view('login');
	}
	function Relogin($Login_id, $Login_pass)
	{
		$where = array(
			'id' => $Login_id,
			'password' => $Login_pass
		);
		$query = $this->Users_model->where_array($where, 'member');
		if ($query->num_rows() > 0) {
			$data = $query->row_array();
			$userdata = array(
				'username' => $data['name'],
				'id' => $data['id'],
				'leavel' => $data['leavel']
			);
			$this->session->set_userdata($userdata);
			echo "Login_Success";
		} else {
			echo "Fail";
		}
	}
	function Check_Image_Code()
	{
		$img_height = 25;  //圖片高度
		$img_width = 80;   //圖片寬度
		$mass = 200;       //圖片上雜點的數量，值越大，畫面越雜

		$num = "";           //驗證碼的數字
		$num_max = 6;      //驗證碼數字的數量，目前設定6位數

		for ($i = 0; $i < $num_max; $i++) //亂數產生數字
		{
			$num .= rand(0, 9);
		}


		$_SESSION["checkNum"] = $num;  // 將產生的驗證碼寫入到session

		// 創造圖片，定義圖形和文字顏色
		Header("Content-type: image/PNG"); //這句是最重要的一句！
		srand((float) microtime() * 1000000);
		$im = imagecreate($img_width, $img_height);
		$black = imagecolorallocate($im, 0, 0, 0); // (0,0,0)文字為黑色
		$sliver = imagecolorallocate($im, 139, 134, 130); // 
		$gray = imagecolorallocate($im, 200, 200, 200); //(200,200,200)背景是灰色
		imagefill($im, 0, 0, $gray);

		// 隨機給予兩條虛線，起干擾作用
		$style = array($sliver, $sliver, $sliver, $sliver, $sliver, $gray, $gray, $gray, $gray, $gray);
		imagesetstyle($im, $style);
		$y1 = rand(0, $img_height);
		$y2 = rand(0, $img_height);
		$y3 = rand(0, $img_height);
		$y4 = rand(0, $img_height);
		imageline($im, 0, $y1, $img_width, $y3, IMG_COLOR_STYLED);
		imageline($im, 0, $y2, $img_width, $y4, IMG_COLOR_STYLED);

		// 在圖形產上黑點，起干擾作用;
		for ($i = 0; $i < $mass; $i++) {
			imagesetpixel($im, rand(0, $img_width), rand(0, $img_height), $sliver);
		}

		// 將數字隨機顯示在圖形上,文字的位置都按一定波動範圍隨機生成
		$strx = rand(3, 8);
		for ($i = 0; $i < $num_max; $i++) {
			$strpos = rand(1, 8);
			imagestring($im, 5, $strx, $strpos, substr($num, $i, 1), $black);
			$strx += rand(8, 14);
		}
		imagepng($im);
		imagedestroy($im);
	}
	//切換部門身分
	function swich_dept()
	{
		$_SESSION['dept']		= $_POST['dept'];
		$_SESSION['dept_id']	= $_POST['dept_id'];
	}
}
