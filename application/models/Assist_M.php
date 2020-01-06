<?php
class Assist_M extends CI_Model
{
  
    function __construct() {
        parent::__construct();
         $this->load->database();
         $this->load->model('Users_model');
         date_default_timezone_set("Asia/Taipei");
    }

    function Get_Project_Item($Data)
    {
      $id=$Data[0];
      $project_name=$Data[1];
      $sql="Select item from project_item where `project_name`='$project_name' and `Dept`=(Select Dept from member where `id`='$id')";
      $Data=[];$i=0;
      $query=$this->db->query($sql);

      foreach ($query->result_array() as $key => $row)
      {
        $Data[$i]=$row['item'];
        $i++;
      }
      return $Data;
    }

    function Restore($Data)
    {
      $Date=substr($Data[0][2],0,10);
      $id=$Data[0][4];
      $Log = $id."儲存工時:".$Date;
      $this->Users_model->Log($_SESSION['id'],$Log);
      //Data[i]=[array[i].title,array[i].start,array[i].end,array[i].backgroundColor,id]; 
       if($this->Delete_Initial_Data($Data))
       {
          for($i=0;$i<count($Data);$i++)
          {
             $Target=explode(":",  $Data[$i][0]);
             if($Data[$i][3]=='Red')
             {
               $Normal=0;
               $Overtime=(strtotime($Data[$i][2]) - strtotime($Data[$i][1]))/ (60*60);
             } 
             else
             {
               $Normal=(strtotime($Data[$i][2]) - strtotime($Data[$i][1]))/ (60*60);
               $Overtime=0;
             }

             $sql=sprintf("Insert into timesheet (`Date`,`id`,`Project`,`project_item`,`Normal`,`Overtime`,`start`,`end`,`color`,`content`) values ('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')",$Date,$id,$Target[0],$Target[1],$Normal,$Overtime,$Data[$i][1],$Data[$i][2],$Data[$i][3],$Data[$i][5]);

             $this->db->query($sql);
          }
       }

      return "儲存成功";

    }

    function Delete_Initial_Data($Data)
    {
      $Date=substr($Data[0][2],0,10);
      $id=$Data[0][4];
      
      $Log = $id."刪除工時:".$Date;
      $this->Users_model->Log($_SESSION['id'],$Log);

      $sql="Delete from timesheet where `Date`='$Date' and `id`='$id'";
      $this->db->query($sql);
       
       return true;
    }

    function Reload($id,$date)
    {
       $sql="Select project,project_item,`start`,`end`,color,content,`index` FROM timesheet where `id`='$id' and `date`='$date'";
       $query=$this->db->query($sql);
       $Data=[];
       $i=0;

       foreach ($query->result_array() as $key => $row)
       {
         $Data[$i]=[$row['project'].":".$row['project_item'],$row['start'],$row['end'],$row['color'],$row['content'],$row['index']];
         $i++;
       }
       return $Data;
    }

    
    function Get_Day_Off($Data)
    {
      $Data=explode("-",$Data);
      $format_Date=($Data[0]-1911).$Data[1].$Data[2];
      $sql="Select `duty` from work_day where `Date`='$format_Date'";
      
      $duty="";
      $query=$this->db->query($sql);
      foreach ($query->result_array() as $key => $row)
      {
         $duty=$row['duty'];
      }

      return $duty;
    }

    function Sumbit($Data)
    {
      $Array=explode(',', $Data);
      $id=$Array[0];
      $Date=$Array[1];
      $Log = $id."送出審核:".$Date;
      $this->Users_model->Log($_SESSION['id'],$Log); 
      $sql="Update timesheet set `Supply`='Wait' where `id`='$id' and `Date`='$Date' ";
      try
      {
         $query=$this->db->query($sql);
         $message="送出審核成功";
      }
      catch(Exception $e)
      {
        $message=$e->getMessage();
      }
      return $message;
    }

    function Get_Member($Dept)
    {
      if(strlen($Dept)==3)
      {
        $Dept='0'.$Dept;
      }
      $sql="Select id,name from member where `Dept`='$Dept'";
      $query=$this->db->query($sql);
      $html=<<<end_html
      <Select id='member' onchange="Reload('')">
end_html;
      foreach ($query->result_array() as $key => $row)
      {
        if(strlen($row['id'])==0)
        {
          $id='0';
        }
        else
        {
          $id=$row['id'];
        }
        $html.=sprintf("<option value='%s'>%s</option>",$id,$row['name']);
      }
      $html.="</Select>";

      return $html;
    }
}