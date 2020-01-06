<?php
class Maintain_M extends CI_Model
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
      $sql="Select item from due_item where `Dept`=(Select Dept from member where `id`='$id' ) ";
      $Data=[];$i=0;
      $query=$this->db->query($sql);

      foreach ($query->result_array() as $key => $row)
      {
        $Data[$i]=$row['item'];
        $i++;
      }
      return $Data;
    }

    function Get_Child_Item($Data)
    {
      //$Data=["120047", "程式維護", "程式維護"];
      $id=$Data[0];
      $project_name=$Data[1];
      $item=$Data[2];
      $sql="Select child_item from child_item where `Dept`=(Select Dept from member where `id`='$id' limit 1 ) and `item`='$item'";
      $Data=[];$i=0;
      $query=$this->db->query($sql);

      foreach ($query->result_array() as $key => $row)
      {
        $Data[$i]=$row['child_item'];
        $i++;
      }
      return $Data;
    }

    function Restore($Data)
    {
      $Date = substr($Data[0][2],0,10);
      $id = $Data[0][4];
      //Data[i]=[array[i].title,array[i].start,array[i].end,array[i].backgroundColor,id];
      $Log = $id."儲存成功:".$Date;
      $this->Users_model->Log($_SESSION['id'],$Log);
       if($this->Delete_Initial_Data($Data))
       {
          for($i=0;$i<count($Data);$i++)
          {
             $Target=explode(":",  $Data[$i][0]);
             if($Data[$i][3]=='dodgerblue')
             {
               $Normal=0;
               $Overtime=(strtotime($Data[$i][2]) - strtotime($Data[$i][1]))/ (60*60);
             } 
             else
             {
               $Normal=(strtotime($Data[$i][2]) - strtotime($Data[$i][1]))/ (60*60);
               $Overtime=0;
             }
             

             $sql=sprintf("Insert into timesheet (`Date`,`id`,`Machine`,`Project`,`project_item`,`child_item`,`Client`,`Normal`,`Overtime`,`start`,`end`,`color`,`content`) values ('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')",$Date,$id,$Target[0],$Target[1],$Target[2],$Target[3],$Target[4],$Normal,$Overtime,$Data[$i][1],$Data[$i][2],$Data[$i][3],$Data[$i][5]);

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
      $this->Users_model->Log($_SESSION['id'], $Log); 
      $sql="Delete from timesheet where `Date`='$Date' and `id`='$id'";
      $this->db->query($sql);
      
       return true;
    }

    function Reload($id,$date)
    {
       $sql="Select machine,project,project_item,`child_item`,`start`,`end`,color,content,`index`,`Client` FROM timesheet where `id`='$id' and `date`='$date'";
       $query=$this->db->query($sql);
       $Data=[];
       $i=0;

       foreach ($query->result_array() as $key => $row)
       {
         $Data[$i]=[$row['machine'].":".$row['project'].":".$row['project_item'].":".$row['child_item'].":".$row['Client'],$row['start'],$row['end'],$row['color'],$row['content'],$row['index']];
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

    function Get_Information($id,$date)
    {
      $sql="Select supply from timesheet where `id`='$id' and `Date`='$date'";
      $query=$this->db->query($sql);
      $supply="";
      foreach ($query->result_array() as $key => $row)
      {
        $supply=$row['supply'];
      }
      return $supply;
    }

    function Get_State($id)
    {
        $sql ="SELECT * 
                FROM `leaves`.timesheet 
                WHERE ID='$id'
                AND Supply='Back'
                GROUP BY `Date`";
      //$sql="Select `Date`,`supply`,`reason` FROM timesheet where `id`='$id' and `supply`='Back' group by `id` ,`Date` ";
      //$sql.=" union Select `Date`,`supply`,`reason` FROM timesheet where `id`='$id'  and `Date` in(SELECT date_format(CURDATE() -1,'%Y-%m-%d')) ";
      $query=$this->db->query($sql);
      $number=$query->num_rows();
      if($number!=0)
      {
        $html="
            <a class='btn dropdown-toggle' data-toggle='dropdown' href='#'>
              <i class='icon-bell'></i>
              <span class='badge red'>$number </span>
            </a>
           <ul class='dropdown-menu messages'>
              <li class='dropdown-menu-title'>
                <span>你有 $number 訊息</span>
                <a href='#refresh'><i class='icon-repeat'></i></a>
              </li>";
      }
      else
      {
        $html="";
      }
      
      

      foreach ($query->result_array() as $key => $row)
      {
         $message="";
         $icon="";
         $Date=$row['Date'];
         switch ($row['Supply'])
           {
            case 'Back':
              $message="退件"."\n".$row['Reason'];
              $icon='red';
              break;
            case 'Apply':
              $message="審核成功";
              $icon='bule';
            default:              
              break;
           }

           $img = '../assets/img/Notify.jpg';
           
           $html.=<<<end_html
           <li>
             <a href="javascript:void(0)" onclick="Go_to_Date('$Date'); Message_Reload('$id','$Date')">           
                         <span class="avatar"><img src="$img " alt="Avatar"></span>
                         <span class="header">
                           <span  class="from">$Date</span>
                           <span class="time"></span>
                         </span>
                         <span class="message">
                         $message;
                         </span>  
               </a>        
             </li>
end_html;
      }
      $html.="</ul>";
      return $html;

    }

    function Get_Clent()
    {
      $sql="SELECT `Client` FROM `leaves`.client;";
      $query=$this->db->query($sql);
      $i=0;
      foreach ($query->result_array() as $key => $row  )
      {
       $Out[$i]=$row['Client'];
       $i++;
      }

      return $Out;
    }
    function Delete_Data($Data)
    {
      $id=$Data[0];
      $day=$Data[1];
      $Log = $id."刪除工時:".$day;
      $this->Users_model->Log($_SESSION['id'], $Log); 
      $sql=sprintf("Delete from timesheet where `ID`='%s' and `Date`='%s'",$id,$day);
      $query=$this->db->query($sql);
      echo "成功";
    }
}