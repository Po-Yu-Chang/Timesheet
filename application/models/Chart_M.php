<?php
class Chart_M extends CI_Model
{
  
    function __construct() {
        parent::__construct();
         $this->load->database();
         $this->load->library('session');
         $this->load->model('Users_model');
         date_default_timezone_set("Asia/Taipei");
    }

    function Get_Member()
    {
      $dept   = $_SESSION['dept_id'];
      $sql    = "SELECT id, `name` FROM leaves.member WHERE state = '在職' AND Dept = '$dept' ORDER BY id";
      $query  = $this->db->query($sql)->result_array();
      foreach ($query as $key => $row)
      {
        $Data[] =  [
          "id"    => $row['id'],
          "name"  => $row['name'] 
        ];

      }
     
      return json_encode($Data);
    }
    
    function Search_Chart_By_member($start_date, $end_date, $member_id){

      $sql    = sprintf("SELECT Project_Item FROM view_timesheet_back_reason
                          WHERE `Date` BETWEEN '%s' AND '%s' 
                          AND dept = '0700'
                          AND ID = '%s'
                          GROUP BY Project_Item", $start_date, $end_date, $member_id);
      $query  = $this->db->query($sql)->result_array();
      foreach ($query as $key => $row)
      {
        $Data[] = [
            'div_area'  =>  'Chart_'.$key,
            'Title'  =>  $row['Project_Item']
          ];
        
      }
     
      return json_encode($Data);
    }

    function Search_Chart_By_Project_Item($start_date, $end_date, $member_id, $Item)
    {

      $sql    = sprintf(" SELECT child_item, SUM(Normal + Overtime) AS myHour
                  FROM leaves.view_timesheet_back_reason
                  WHERE `Date` BETWEEN '%s' AND '%s' 
                  AND dept = '0700'
                  AND ID = '%s'
                  AND Project_Item = '%s'
                  GROUP BY Project_Item, child_item
                  ORDER BY ID, project_item, child_item", $start_date, $end_date, $member_id, $Item);
      
      $query  = $this->db->query($sql)->result_array();

      //處理圖表格式 JSON
      $rows = array();
      $table['cols'] =[
        ['label' => 'Task', 'type' => 'string'],
        ['label' => 'Percentage', 'type' => 'number']
      ];

      foreach ($query as $row)
      {
       
        $temp = [
          ['v' => (string) $row['child_item'] .":". $row['myHour']. "小時"] ,
          ['v' => (int) $row['myHour']]
        ]; 

        $rows[] = ['c' => $temp];

      }
      $table['rows'] = $rows;
      return json_encode($table);
    }

    






   







}