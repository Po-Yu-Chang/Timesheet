<?php
class Setting_M extends CI_Model
{
    function __construct() {
        parent::__construct();
         $this->load->database();
         $this->load->model('Users_model');
         date_default_timezone_set("Asia/Taipei");
    }

    // 取得機器
    function Get_Machine(){
      $html ="";
      $sql="SELECT `index`, Machine, order_no, color FROM leaves.view_machine ORDER BY order_no";

      $query=$this->db->query($sql);
      foreach ($query->result_array() as $key => $row)
      {

        $index    = $row['index'];
        $Machine  = $row['Machine']; 
        $order_no = $row['order_no']; 
        $color    = $row['color'];

        $html.= <<<end_html
                <tr>
                  <td>$Machine</td>
                  <td><input type="text" class="form-control" name="order_no" value="$order_no" onchange="Update_Sequence(this.name, this.value, 'machine', $index)"></td>
                  <td>
                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1">#</span>
                      <input type="text" class="form-control" name="color" value="$color" onchange="Update_Sequence(this.name, this.value, 'machine', $index)">
                    </div>
                  </td>
                </tr>
end_html;
      }



      
      return $html;
    }

    function Update_Sequence($name, $value, $table, $index){

      if ($value == ''){

      }

      $Log = "$table: $index $name UPDATE $value";
      $this->Users_model->Log($_SESSION['id'], $Log);
      
      $sql=" UPDATE data_sequence SET $name = '$value' WHERE `table` = '$table' AND data_index = $index";
      try
      {
        $query=$this->db->query($sql);
        $message="修改成功";
      }
      catch(Exception $e)
      {
        $message=$e->getMessage();
      }
      
      return $message;
    }

}