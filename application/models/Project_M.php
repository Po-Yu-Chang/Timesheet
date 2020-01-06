<?php
class Project_M extends CI_Model
{

  function __construct()
  {
    parent::__construct();
    $this->load->database();
    $this->load->library('session');
  }

  function Check_Double($Project_Name, $Machine_Number)
  {
    $sql = "Select count(`index`) as Number from Project where `Machine_Number`='$Machine_Number' and `Project_Name`='$Project_Name' ";

    $query = $this->db->query($sql);

    foreach ($query->result_array() as $key => $row) {
      $Number = $row['Number'];
    }
    return $Number;
  }

  function Send($Data)
  {

    $Project_Name = $Data[0];
    $Machine_Number = $Data[1];
    $Machine = $Data[2];
    $Start_date = $Data[3];
    $End_date = $Data[4];
    $State = $Data[5];
    $apply = $Data[6];

    $sql = "Insert into Project (`Project_Name`,`Machine_Number`,`Machine`,`Start_date`,`End_date`,`State`,`apply`) values ('$Project_Name','$Machine_Number','$Machine','$Start_date','$End_date','$State','$apply')";

    try {
      $this->db->query($sql);
      $this->Insert_Due_Item($Project_Name, $Machine_Number, $Machine);
      $message = "Success";
    } catch (Exception $e) {
      $errormessage = $e->getMessage();
    }
    return "Success";
  }
  function Insert_Due_Item($Project_Name, $Machine_Number, $Machine)
  {
    $sql = <<<end_html
      Insert into project_item (`project_name`,`Machine_number`,`Machine`,`Item`,`Dept`) 
SELECT '$Project_Name' as Project_Name,'$Machine_Number' as Machine_number ,Machine,Item,Dept FROM due_item where `Machine`='$Machine';
end_html;
    try {
      $this->db->query($sql);
      $message = "Success";
    } catch (Exception $e) {
      $message = $e->getMessage();
    }
  }

  function Insert_Project_Item($Machine_Number, $Dept, $Item)
  {
    for ($i = 0; $i < count($Item); $i++) {
      $value = $Item[$i];
      $sql = "Insert into Project_Item (`Machine_Number`,`Item`) values ('$Machine_Number','$value')";
      $this->db->query($sql);
    }
  }

  function Get_Dept()
  {
    $sql = "Select Dept,Dept_n FROM leaves.dept;";
    $Data = [];
    $i = 0;
    $query = $this->db->query($sql);
    foreach ($query->result_array() as $key => $row) {
      $Data[$i] = [$row['Dept'], $row['Dept_n']];
      $i++;
    }


    return $Data;
  }

  function Get_Project_Name()
  {
    $sql = "Select Project_Name, Machine_Number FROM project;";
    $html = "<Select id='Get_Project_Name'>";

    $query = $this->db->query($sql);
    foreach ($query->result_array() as $key => $row) {
      $html .= sprintf("<option value=%s>%s</option>", $row['Project_Name'], $row['Project_Name']);
    }
    $html .= "</Select>";

    return $html;
  }
  function Get_Project_Name_by_machine($machine, $dept)
  {
    $sql = "Select Project_Name, Machine_Number FROM project where `Machine`='$machine' AND apply like '%$dept%'";
    $html = "<Select id='Get_Project_Name'>";
    $query = $this->db->query($sql);
    $i = 0;
    foreach ($query->result_array() as $key => $row) {

      if ($i == 0) {
        $selected = "selected";
      } else {
        $selected = '';
      }
      $html .= sprintf("<option value=%s %s>%s</option>", $row['Project_Name'], $selected, $row['Project_Name']);
      $i++;
    }
    $html .= "</Select>";

    return $html;
  }

  function Search_Item($Data)
  {
    $Project_Name = $Data[0];
    $dept = $Data[1];
    $html = "";
    $sql = <<<end_html
        Select a.`index`,a.`Machine_Number`,`Dept_n`,`Item`,`Project_Name` from(
SELECT `index`,`Machine_Number`,`Dept`,`Item` FROM project_item where `Project_Name`='$Project_Name' and  `Dept`='$dept')as a
left join Project on a.`Machine_Number`=Project.`Machine_Number`
left join dept
on a.dept=dept.dept
end_html;

    $query = $this->db->query($sql);
    foreach ($query->result_array() as $key => $row) {
      $html .= "<tr><td>" . $row['Project_Name'] . "</td>";
      $html .= "<td>" . $row['Machine_Number'] . "</td>";
      $html .= "<td>" . $row['Item'] . "</td>";
      $html .= "<td>" . $row['Dept_n'] . "</td>";
      $html .= sprintf("<td><button onclick='Delete(%d)'>刪除</button></td></tr>", $row['index']);
    }
    return $html;
  }

  function Check_Double_Item($Item, $dept, $table)
  {
    $Data = explode(",", $Item);
    $string = "";
    $number = "";

    for ($i = 0; $i < count($Data); $i++) {
      if ($i == 0) {
        $string .= sprintf("'%s'", $Data[$i]);
      } else {
        $string .= sprintf(",'%s'", $Data[$i]);
      }
    }

    $sql = sprintf("Select count(`index`) as number from $table where `item` in (%s) and `dept`='%s'", $string, $dept);

    $query = $this->db->query($sql);

    foreach ($query->result_array() as $key => $row) {
      $number = $row['number'];
    }
    return (int) $number;
  }

  function Check_Child_Item($dept, $item, $child_item, $table)
  {
    $Data = explode(",", $child_item);
    $string = "";
    $number = "";

    for ($i = 0; $i < count($Data); $i++) {
      if ($i == 0) {
        $string .= sprintf("'%s'", $Data[$i]);
      } else {
        $string .= sprintf(",'%s'", $Data[$i]);
      }
    }

    $sql = sprintf("Select count(`index`) as number from $table where `child_item` in (%s) and `item`='%s' and Dept = '%s'", $string, $item, $dept);

    $query = $this->db->query($sql);

    foreach ($query->result_array() as $key => $row) {
      $number = $row['number'];
    }
    return (int) $number;
  }

  function Send_Project_Item($Data)
  {
    $Project_Name = $Data[0];
    $Dept = $Data[1];
    $Item = explode(",", $Data[2]);

    for ($i = 0; $i < count($Item); $i++) {
      $sql = sprintf("Insert into project_item (`project_name`,`Machine_number`,`Machine`,`Item`,`Dept`) SELECT `Project_Name`,`Machine_number`,`Machine`,'%s','%s' FROM project where `Project_Name`='%s'", $Item[$i], $Dept, $Project_Name);
      $this->db->query($sql);
    }
    return "Success";
  }

  function Check_Project_Item($Data)
  {
    $Item = explode(",", $Data[2]);
    $string = "";
    $number = "";

    for ($i = 0; $i < count($Item); $i++) {
      if ($i == 0) {
        $string .= sprintf("'%s'", $Item[$i]);
      } else {
        $string .= sprintf(",'%s'", $Item[$i]);
      }
    }
    $sql = "Select count(`index`) as number from Project_Item where `item` in (%s) and `Project_Name`='%s' and `Dept`='%s'";
    $sql = sprintf($sql, $string, $Data[0], $Data[1]);
    $number = 0;
    $query = $this->db->query($sql);
    foreach ($query->result_array() as $key => $row) {
      $number = $row['number'];
    }
    return $number;
  }

  function Send_Child_Item($Data)
  {
    //$Machine=$Data[0];
    $Dept = $Data[0];
    $item = $Data[1];
    $child_item = explode(",", $Data[2]);

    for ($i = 0; $i < count($child_item); $i++) {
      $sql = sprintf("Insert into child_item (`Dept`,`Item`,`child_item`) values ('%s','%s','%s')", $Dept, $item, $child_item[$i]);
      $this->db->query($sql);
    }
    return "Success";
  }

  function Send_Due_Item($Data)
  {
    //$Machine=$Data[0];
    $Dept = $Data[0];
    $Item = explode(",", $Data[1]);

    for ($i = 0; $i < count($Item); $i++) {
      $sql = sprintf("Insert into due_item (`Dept`,`Item`) values ('%s','%s')", $Dept, $Item[$i]);
      $this->db->query($sql);
    }
    return "Success";
  }

  function Delete($index)
  {
    $sql = "Delete from project_item where `index`='$index'";

    try {
      $this->db->query($sql);
      $message = "Success";
    } catch (Exception $e) {
      $message = $e->getMessage();
    }

    return $message;
  }

  function Delete_Child_Item($index)
  {
    $sql = "Delete from child_item where `index`='$index'";

    try {
      $this->db->query($sql);
      $message = "Success";
    } catch (Exception $e) {
      $message = $e->getMessage();
    }

    return $message;
  }

  function Update($item, $index)
  {
    $sql = "Update Project_Item Set `Item`='$item' where `index`='$index'";
    $id = $_SESSION['id'];
    //紀錄Log XXX
    $Log = $id . "送出審核";
    $this->Users_model->Log($id, $Log);

    try {
      $this->db->query($sql);
      $message = "Success";
    } catch (Exception $e) {
      $message = $e->getMessage();
    }

    return $message;
  }

  function Search_Main($Data)
  {

    //$Data= ["2015-01-01", "2017-11-24", "", "0701"];

    $Project_Name = $Data[0];
    $Dept         = $Data[1];
    if ($Dept == 'leader') {
      $id = $leavel = $this->session->userdata('id');
      $sql = "Select `Dept` from member where `id`='$id'";
      $query = $this->db->query($sql);
      foreach ($query->result_array() as $key => $row) {
        $Dept = $row['Dept'];
      }
    }
    $Data_name = ['start_date', 'end_date', 'Project_Name'];
    $judge = "";
    $html = "";
    $Dept_n = $this->Get_Dept_Name($Dept);
    $sql = "select `index`,`project_name`,`machine`,`Start_date`,`End_date`,`State` from project";

    if (strlen($Project_Name) > 0) {
      $judge .= sprintf(" and `%s`='%s'", 'Project_Name', $Project_Name);
    }

    if (strlen($Dept) > 0) {
      $judge .= sprintf(" and `%s` like '%s'", 'apply', '%' . $Dept . '%');
    }

    $sql .= $judge;

    $query = $this->db->query($sql);
    foreach ($query->result_array() as $key => $row) {
      $html .= sprintf("<tr><td>%s</td>", $row['project_name']);
      $html .= sprintf("<td>%s</td>", $row['machine']);
      $html .= sprintf("<td>$Dept_n</td>");
      $html .= sprintf("<td>%s</td>", $row['State']);
      $html .= sprintf("<td>%s</td>", $row['Start_date']);
      $html .= sprintf("<td>%s</td>", $row['End_date']);
      $html .= sprintf("<td><button data-toggle='modal' data-target='#dialog_div' onclick=Update('%s','%s','%s','%s')>修改</button></td></tr>", $row['index'], $row['Start_date'], $row['End_date'], $row['State']);
    }
    return $html;
  }

  function Get_Dept_Name($Dept)
  {
    $sql = "Select `Dept_n` from dept where `Dept`='$Dept'";
    $query = $this->db->query($sql);
    $Dept_n = "";
    foreach ($query->result_array() as $key => $row) {
      $Dept_n = $row['Dept_n'];
    }
    return $Dept_n;
  }
  function New_Client($client)
  {


    $sql = "Insert into leaves.`client` (`Client`) values ('$client')";

    $this->db->query($sql);
    $message = "新增成功";

    echo $message;
  }

  function Get_Client()
  {
    $html = "";
    $sql = "SELECT * FROM leaves.`client`";
    $query = $this->db->query($sql);
    foreach ($query->result_array() as $key => $row) {
      $index  = $row['index'];
      $Client = $row['Client'];
      // onchange='Update_Client(this.name, this.value, $index)' ←修改code
      $html .= "<tr><td>$index</td><td><input type='text' class='form-control' name='Client' value='$Client' ></td></tr>";
    }
    return $html;
  }

  function Get_Machine_ALL()
  {
    $sql = "SELECT Machine FROM view_machine ORDER BY order_no";
    $query = $this->db->query($sql);
    $i = 0;
    $Data = [];
    foreach ($query->result_array() as $key => $row) {
      $Data[$i] = $row['Machine'];
      $i++;
    }
    return $Data;
  }

  function Get_Machine()
  {
    $sql = "SELECT Machine, ( CASE COALESCE ( hardcode, '' ) WHEN '' THEN Machine ELSE CONCAT( Machine, ' - ', hardcode ) END ) AS Machine_Name  FROM view_machine WHERE dept LIKE '%" . $_SESSION['dept_id'] . "%' ORDER BY order_no";
    $query = $this->db->query($sql);
    $i = 0;
    $Data = [];
    $html = "";
    foreach ($query->result_array() as $key => $row) {

      $html .= "<OPTION value='" . $row['Machine'] . "'>" . $row['Machine_Name'] . "</OPTION>";
      //$Data[$i]=$row['Machine'];
      //$i++;
    }
    return $html;
  }

  function Get_Machine_Number($Machine)
  {
    $Machine = urldecode($Machine);
    $sql = "SELECT Machine_Number FROM Machine_Number WHERE `Machine` = '$Machine'";
    $query = $this->db->query($sql);
    $Data = [];
    $i = 0;
    foreach ($query->result_array() as $key => $row) {
      $Data[$i] = $row['Machine_Number'];
      $i++;
    }
    return $Data;
  }
  function New_Machine_Name($Machine_Name, $dept)
  {
    $sql = "Insert into Machine (`Machine`,`dept`) values ('$Machine_Name', '$dept')";
    try {
      if ($this->Check_Machine_Name_Double($Machine_Name) > 0) {
        $message = "機器名稱重複";
      } else {
        $query = $this->db->query($sql);
        $message = "更新成功";
      }
    } catch (Exception $e) {
      $message = $e->getMessage();
    }
    echo $message;
  }

  function New_Machine_Number($Data)
  {
    $Machine_Name = $Data[0];
    $Machine_Number = $Data[1];
    $sql = "Insert into Machine_Number (`Machine`,`Machine_Number`) values ('$Machine_Name','$Machine_Number')";
    try {
      if ($this->Check_Machine_Number_Double($Machine_Name, $Machine_Number) > 0) {
        $message = "重複";
      } else {
        $query = $this->db->query($sql);
        $message = "更新成功";
      }
    } catch (Exception $e) {
      $message = $e->getMessage();
    }
    echo $message;
  }

  function Check_Machine_Name_Double($Machine_Name)
  {
    $sql = "Select count(`index`) as number from Machine where `Machine`='$Machine_Name'";
    $query = $this->db->query($sql);
    $number = 0;
    foreach ($query->result_array() as $key => $row) {
      $number = $row['number'];
    }
    return (int) $number;
  }

  function Check_Machine_Number_Double($Machine_Name, $Machine_Number)
  {
    $sql = "Select count(`index`) as number from Machine_Number where `Machine`='%s' and `Machine_Number`='%s' ";
    $sql = sprintf($sql, $Machine_Name, $Machine_Number);
    $query = $this->db->query($sql);
    $number = 0;
    foreach ($query->result_array() as $key => $row) {
      $number = $row['number'];
    }
    return (int) $number;
  }
  function Get_Due_Machine()
  {
    $sql = "Select * FROM leaves.machine";
    $html = "<Select id='Target_Machine'>";
    $query = $this->db->query($sql);
    foreach ($query->result_array() as $key => $row) {
      $html .= sprintf("<Option value='%s'>%s</option>", $row['Machine'], $row['Machine']);
    }
    $html .= "</Select>";
    return $html;
  }

  function Search_Due_Item($Data)
  {
    // $Machine=$Data[0];
    $Dept = $Data[0];
    $html = "";
    $sql = <<<end_html
      Select a.`index`,`Dept_n`,`Item` from(
Select `index`,`Machine`,`Dept`,`Item` from due_item where `Dept`='$Dept')
as a 
left join dept 
on dept.dept=a.dept
end_html;
    $query = $this->db->query($sql);
    foreach ($query->result_array() as $key => $row) {
      $html .= sprintf("<tr><td>%s</td>", $row['Dept_n']);
      $html .= sprintf("<td>%s</td>", $row['Item']);
      $html .= sprintf("<td><button onclick='Delete_Item(%s)'>Delete</button></td></tr>", $row['index']);
    }
    return $html;
  }
  function Delete_Item($index)
  {
    $sql = "Delete from due_item where `index`='$index'";
    try {
      $query = $this->db->query($sql);
      $message = "Success";
    } catch (Exception $e) {
      $message = $e->getMessage();
    }
    return $message;
  }

  function Find_Class_Item($Data)
  {
    //$Machine=$Data[0];
    $Dept = $Data[0];
    $out = [];
    $i = 0;
    $sql = "Select item FROM due_item where   `Dept`='$Dept'";

    $query = $this->db->query($sql);

    foreach ($query->result_array() as $key => $row) {
      $out[$i] = $row['item'];
      $i++;
    }
    return $out;
  }
  function Search_Child_Item($Data)
  {
    //$Machine=$Data[1];
    $Dept = $Data[0];
    $Item = $Data[1];

    $html = "";

    $sql = "Select `index`,`machine`,`item`,`child_item` FROM child_item where `Dept`='$Dept' and `item`='$Item'";

    $query = $this->db->query($sql);
    foreach ($query->result_array() as $key => $row) {

      $html .= sprintf("<tr><td>%s</td>", $row['item']);
      $html .= sprintf("<td>%s</td>", $row['child_item']);
      $html .= sprintf("<td><button onclick='Delete_Child_Item(%s)'>刪除</button></td></tr>", $row['index']);
    }
    return $html;
  }

  function Get_Check_box($type)
  {
    $sql = "Select `Dept`,`Dept_n` FROM dept;";
    $html = "";
    $query = $this->db->query($sql);

    switch ($type) {
      case 1:
        $class = "Checkbox_Dept";
        break;
      case 2:
        $class = "Dept2";
        break;
    }

    foreach ($query->result_array() as $key => $row) {
      $html .= sprintf("<label for='%s'><input class='%s' type='checkbox' id='%s' value='%s' /> %s</label>", $class . '-' . $row['Dept'], $class, $class . '-' . $row['Dept'], $row['Dept'], $row['Dept_n']);
    }

    return $html;
  }
  function Send_Update($Data)
  {

    $index  = $Data[0];
    $start  = $Data[1];
    $end    = $Data[2];
    $state  = $Data[3];

    //紀錄Log
    $Log = $index . "修改專案日期及狀態:$start - $end($state)";
    $this->Users_model->Log($_SESSION['id'], $Log);

    $sql = "update project set `Start_date`='$start' ,`End_date`='$end',`State`='$state' where `index`='$index'";
    $this->db->query($sql);
    return "Success";
  }
}
