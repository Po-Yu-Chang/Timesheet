<?php
class Person_M extends CI_Model
{
  
    function __construct() {
        parent::__construct();
         $this->load->database();
         $this->load->model('Users_model');
         date_default_timezone_set("Asia/Taipei");
    }

    // 1.連動選單 - 取得所有部門
    function Get_All_Dept(){
      $sql="SELECT * FROM leaves.dept;";

      $html="<option value=''>請選擇</option>";
      $query=$this->db->query($sql);
      foreach ($query->result_array() as $key => $row)
      {
        $html.=sprintf("<option value='%s'>%s</option>",$row['Dept'],$row['Dept_n']);
      }
      
      return $html;
    }

    // 2.連動選單 - 取得部門所有在職職員
    function Get_Member_by_Dept($dept)
    {
      $sql = "SELECT v.member_id, v.Job_n, v.`name`
              FROM view_member_dept AS v
              WHERE v.Dept = '$dept'";

      $html="<option value=''>請選擇</option>";
      $query=$this->db->query($sql);
      foreach ($query->result_array() as $key => $row)
      {
        $html.=sprintf("<option value='%s'>%s</option>",$row['member_id'], $row['name']);
      }

      return $html;
    }

    function Get_Member_List($dept)
    {
      $sql = "SELECT
                v.member_id,
                v.Job_n,
                v.`name`,
                v.Dept,
                v.Dept_n,
                v.mail
              FROM view_member_dept AS v
              WHERE v.Dept = '$dept'";

      $html="<table class='table'>";
      $html.="<tr bgcolor='#dce8fc'><th>職員編號</th><th>姓名</th><th>信箱</th><th>修改</th></tr>";


      $query=$this->db->query($sql);
      foreach ($query->result_array() as $key => $row)
      {
        $Job_n = $row['Job_n'];
        $mail = $row['mail'];
        $name = $row['name'];
        $btn = <<<end_html
        <input type="button" class="btn btn-primary" value="修改" data-toggle="modal" data-target="#Mail_Modal" onclick="Set_Mail('$Job_n','$name','$mail')">
end_html;

        $html.=sprintf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>",$Job_n, $name, $mail, $btn);
      }

      $html.="</table>";

      return $html;
    }

    // 填入表單 帳號密碼 
    function Get_Username_by_Member($member)
    {
      $sql = "SELECT `index`, id, `password` 
              FROM `leaves`.member 
              WHERE `index` = $member";
      $query=$this->db->query($sql);
      $i=0; $Data=[];
      foreach ($query->result_array() as $key => $row)
      {
        $Data = ["m_id"     => $row['index'], 
                 "username" => $row['id'], 
                 "password" => $row['password']];
      }
      return $Data;
    }

    function Set_Username($Data){
      
      $m_id     = $Data['m_id'];
      $username = $Data['username'];
      $password = $Data['password'];

      $sql="UPDATE `leaves`.member
            SET id = '$username', `password` = '$password'
            WHERE `index` = $m_id";
      try
      {
        $query=$this->db->query($sql);
        $message="設定帳密成功";

        //紀錄Log
        $Log = "設定帳密，$username";
        $this->Users_model->Log($_SESSION['id'],$Log); 
      }
      catch(Exception $e)
      {
        $message=$e->getMessage();
      }
      return $message;
    }

}