<?php
class Management_M extends CI_Model
{
  
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('Mailer');
        date_default_timezone_set("Asia/Taipei");
    }

    function Get_Project_Select_value($username)
    {
       $sql=<<<end_html
       Select Project_Name,project_Number from Project where Project_Number in(
Select Project_Number from project_item  where `Dept` =(
SELECT Dept FROM leaves.member where `name`='$username' limit 1))
end_html;
       $query=$this->db->query($sql);
       $Project_Name=[];
       $Project_Number=[];
       $i=0;
       foreach ($query->result_array() as $key => $row) {
        $Project_Name[$i]=$row['Project_Name'];
        $Project_Number[$i]=$row['project_Number'];
        $i++;
       }
       $P_Name_String=implode(",",$Project_Name);
       $P_Number_String=implode(",",$Project_Number);
       $Data=$P_Name_String.";".$P_Number_String;
       return $Data;
    }
    function Get_Child_Item_value($Data)
    {
      $username=$Data[0];
      $project_Number=$Data[1];
      $Data=[];
      $i=0;
      $sql=<<<end_html
      Select item from project_item where `project_number`='$project_Number'
      and `Dept`=(SELECT Dept FROM leaves.member where `name`='$username' limit 1)
end_html;
      $query=$this->db->query($sql);
      foreach ($query->result_array() as $key => $row)
      {
        $Data[$i]=$row['item'];
        $i++;
      }
      
      return implode(",",$Data);
    }

    function Get_Date($year,$week)
    {
       if($week==-1)
       {
         $week=$this->Get_Now_Week();
       }
       $Start_Date=$this->getFirstDayOfWeek($year,$week);
       $Date_array=explode("-",$Start_Date);
       $years=$Date_array[0];$months=$Date_array[1];$days=$Date_array[2];
       $Day=[];
       for($i=0;$i<7;$i++)
       {
          $Day[$i-1] = date("Y-m-d",mktime(0,0,0,$months,$days+$i,$years));
       }

       return implode(",", $Day);
    }

    function Get_Now_Week()
    {

      $ddate =date("Y-m-d");
      $date = new DateTime($ddate);
      $week = $date->format("W");
      return $week;
    }
    function getFirstDayOfWeek($year,$week)
    {
       $first_day = strtotime($year."-01-01");
       $is_monday = date("w", $first_day) == 1;
       $is_weekone = strftime("%V", $first_day) == 1;
       if($is_weekone)
       {
          $week_one_start = $is_monday ? strtotime("last monday", $first_day) : $first_day;
       }
       else
       {
          $week_one_start = strtotime("next monday", $first_day);
       }
       return date('Y-m-d',$week_one_start+(3600*24*7*($week-1)));
    }

    function Send($Data)
    {
      if($this->Delete($Data))
      {
        $sql="Insert into Timesheet (`Date`,`ID`,`Project`,`Project_Item`,`Normal`,`Overtime`) values ";

          $add="";
          for($i=0;$i<count($Data);$i++)
          {
             
            if($i==0)
            {
             $add.=sprintf("('%s','%s','%s','%s','%s','%s')",$Data[$i][0],$Data[$i][1],$Data[$i][2],$Data[$i][3],$Data[$i][4],$Data[$i][5]);
            }
            else
            {
             $add.=sprintf(",('%s','%s','%s','%s','%s','%s')",$Data[$i][0],$Data[$i][1],$Data[$i][2],$Data[$i][3],$Data[$i][4],$Data[$i][5]);
            }
            
          }
          $sql=$sql.$add;
          $this->db->query($sql);
      }    

      //紀錄Log
      $Log = $id."新增工時:".$day;
      $this->Users_model->Log($_SESSION['id'],$Log);


      return "儲存成功";    

      //return  $this->Delete($Data);
      
    }

    function Delete($Data)
    {
      $Day=$Data[0][0];
      $ID=$Data[0][1];
      $Log = $ID."刪除工時:".$Day;
      $this->Users_model->Log($_SESSION['id'], $Log); 

      $sql="Delete from Timesheet where `Date`='$Day' and `ID`='$ID'";
      try
      {
        $this->db->query($sql);
        $message=true;
      }
      catch (Exception $e)
      {
        $errormessage=$e->getMessage();
        $message=false;
      }
      return $sql;
    }

    function Get_History_Data($year,$week,$id)
    {
      $Date=$this->Get_Date($year,$week);
      $Date_array=explode(",",$Date);
      $Date_Group="";

      for($i=0;$i<count($Date_array);$i++)
      {
        if($i==0)
        {
          $Date_Group.="'".$Date_array[$i]."'";
        }
        else
        {
          $Date_Group.=",'".$Date_array[$i]."'";
        }
      }
$sql=<<<end_html
       Select *from (
       Select
      a.project,
      a.project_item,
      IFNULL(b.Normal,"") as b_N, 
      IFNULL(b.Overtime,"") as b_O,
      IFNULL(c.Normal,"") as c_N, 
      IFNULL(c.Overtime,"") as c_O,
      IFNULL(d.Normal,"") as d_N, 
      IFNULL(d.Overtime,"") as d_O,
      IFNULL(e.Normal,"") as e_N, 
      IFNULL(e.Overtime,"") as e_O,
      IFNULL(f.Normal,"") as f_N, 
      IFNULL(f.Overtime,"") as f_O,
      IFNULL(g.Normal,"") as g_N, 
      IFNULL(g.Overtime,"") as g_O,
      IFNULL(h.Normal,"") as h_N, 
      IFNULL(h.Overtime,"") as h_O,
      IFNULL(I.Project_Name,"") as project_Name
      from (
      SELECT project,project_item FROM timesheet where `Date`  in (%s) and `id`='$id' group by  `Project_item`)
      as a
      left join 
      ( SELECT `Date`,`ID`,`Project`,`Project_Item`,`Normal`,`Overtime` FROM leaves.timesheet where `Date`='%s' and `ID`='$id') as b
      on a.`project_item`=b.`project_item`
      left join
      (SELECT `Date`,`ID`,`Project`,`Project_Item`,`Normal`,`Overtime` FROM leaves.timesheet where `Date`='%s' and `ID`='$id') as c
      on a.`project_item`=c.`project_item`
      left join
      (SELECT `Date`,`ID`,`Project`,`Project_Item`,`Normal`,`Overtime` FROM leaves.timesheet where `Date`='%s' and `ID`='$id') as d
      on a.`project_item`=d.`project_item`
      left join
      (SELECT `Date`,`ID`,`Project`,`Project_Item`,`Normal`,`Overtime` FROM leaves.timesheet where `Date`='%s' and `ID`='$id') as e
      on a.`project_item`=e.`project_item`
      left join
      (SELECT `Date`,`ID`,`Project`,`Project_Item`,`Normal`,`Overtime` FROM leaves.timesheet where `Date`='%s' and `ID`='$id') as f
      on a.`project_item`=f.`project_item`
      left join
      (SELECT `Date`,`ID`,`Project`,`Project_Item`,`Normal`,`Overtime` FROM leaves.timesheet where `Date`='%s' and `ID`='$id') as g
      on a.`project_item`=g.`project_item`
      left join
      (SELECT `Date`,`ID`,`Project`,`Project_Item`,`Normal`,`Overtime` FROM leaves.timesheet where `Date`='%s' and `ID`='$id') as h
      on a.`project_item`=h.`project_item`
      left join 
      (select * from project )as i
      on i.project_number=a.project) as Final order by project
end_html;
      $sql=sprintf($sql,$Date_Group,$Date_array[0],$Date_array[1],$Date_array[2],$Date_array[3],$Date_array[4],$Date_array[5],$Date_array[6]);
      $html="";$j=0;
      $query=$this->db->query($sql);
      foreach ($query->result_array() as $key => $row)
      {
        if($j%2==0)
        {
          $class="background-color: rgb(170, 170, 170);";
        }
        else
        {
          $class="background-color: white;";
        }
        
        $html.=sprintf("<tr style='%s'><td><input type='hidden' class='history'><Select class='Project'><option value='%s'>%s</option></Select></td>",$class,$row['project'],$row['project_Name']);
        $html.=sprintf("<td><Select class='Child_Item'><option value='%s'>%s</option></Select></td>",$row['project_item'],$row['project_item']);
        $html.=sprintf("<td><input type='text' value='%s' class='%s_B' style='width: 50px; background-color: transparent; border: 0px; color: blue;'></td>",$row['b_N'],$Date_array[0]);
        $html.=sprintf("<td><input type='text' value='%s' class='%s_R' style='width: 50px; background-color: transparent; border: 0px; color: red;'></td>",$row['b_O'],$Date_array[0]);
        $html.=sprintf("<td><input type='text' value='%s' class='%s_B' style='width: 50px; background-color: transparent; border: 0px; color: blue;'></td>",$row['c_N'],$Date_array[1]);
        $html.=sprintf("<td><input type='text' value='%s' class='%s_R' style='width: 50px; background-color: transparent; border: 0px; color: red;'></td>",$row['c_O'],$Date_array[1]);
        $html.=sprintf("<td><input type='text' value='%s' class='%s_B' style='width: 50px; background-color: transparent; border: 0px; color: blue;'></td>",$row['d_N'],$Date_array[2]);
        $html.=sprintf("<td><input type='text' value='%s' class='%s_R' style='width: 50px; background-color: transparent; border: 0px; color: red;'></td>",$row['d_O'],$Date_array[2]);
        $html.=sprintf("<td><input type='text' value='%s' class='%s_B' style='width: 50px; background-color: transparent; border: 0px; color: blue;'></td>",$row['e_N'],$Date_array[3]);
        $html.=sprintf("<td><input type='text' value='%s' class='%s_R' style='width: 50px; background-color: transparent; border: 0px; color: red;'></td>",$row['e_O'],$Date_array[3]);
        $html.=sprintf("<td><input type='text' value='%s' class='%s_B' style='width: 50px; background-color: transparent; border: 0px; color: blue;'></td>",$row['f_N'],$Date_array[4]);
        $html.=sprintf("<td><input type='text' value='%s' class='%s_R' style='width: 50px; background-color: transparent; border: 0px; color: red;'></td>",$row['f_O'],$Date_array[4]);
        $html.=sprintf("<td><input type='text' value='%s' class='%s_B' style='width: 50px; background-color: transparent; border: 0px; color: blue;'></td>",$row['g_N'],$Date_array[5]);
        $html.=sprintf("<td><input type='text' value='%s' class='%s_R' style='width: 50px; background-color: transparent; border: 0px; color: red;'></td>",$row['g_O'],$Date_array[5]);
        $html.=sprintf("<td><input type='text' value='%s' class='%s_B' style='width: 50px; background-color: transparent; border: 0px; color: blue;'></td>",$row['h_N'],$Date_array[6]);
        $html.=sprintf("<td><input type='text' value='%s' class='%s_R' style='width: 50px; background-color: transparent; border: 0px; color: red;'></td>",$row['h_O'],$Date_array[6]);
        $html.="<td class='R_total' style='text-align: center;'></td>";
        $html.="<td class='B_total' style='text-align: center;'></td>";
        $html.="<td class='total' style='text-align: center;'></td>";
         
        $j++;
      }

      return $html;
    }

    function Get_Curren_Data($id)
    {
      $Date=date("Y-m-d");
      $sql="Select * from timesheet where `Date`='$Date' and `ID`='$id'";
      $query=$this->db->query($sql);
      $html=<<<end_html
      <table class='table'>
      <th>索引</th>
      <th>日期</th>
      <th>專案</th>
      <th>專案項目</th>
      <th>正常工時</th>
      <th>加班工時</th>
      <th>刪除</th>
end_html;

      foreach ($query->result_array() as $key => $row)
      {
        $html.=sprintf("<tr><td>%s</td>",$row['index']);
        $html.=sprintf("<td>%s</td>",$row['Date']);
        $html.=sprintf("<td>%s</td>",$row['Project']);
        $html.=sprintf("<td>%s</td>",$row['Project_Item']);
        $html.=sprintf("<td>%s</td>",$row['Normal']);
        $html.=sprintf("<td>%s</td>",$row['Overtime']);
        $html.=sprintf("<td><span onclick='Delete_Item(%s)' class='glyphicons-icon delete'><span></td></tr>",$row['index']);
      }
      return $html;
    }

    function Delete_Item($index)
    {
      $Log = "刪除工時:".$index;
      $this->Users_model->Log($_SESSION['id'], $Log); 
      $sql="Delete from timesheet where `index`='$index'";
      $errormessage="";
      
      try
      {
        $query=$this->db->query($sql);
      }
      catch(Exception $e)
      {
        $errormessage=$e->getMessage();
      }
      return $errormessage;
    }

    function Get_Dept_Member($id, $dept)
    {
      /*$sql=<<<end_html
      Select `name`,`id` from member where `Dept` in (
      Select `Dept` from member where `id`='$id') and  `id`!='$id' and `id`!=(SELECT `leader_id` as id FROM leaves.member where `id`='$id' limit 1)
      end_html;*/
      $sql = "SELECT id, `name` FROM view_member_dept WHERE Dept = '$dept' AND id != '$id'";
      $query=$this->db->query($sql);
      $html="<Select onchange='Change_Member_Data()' id='member'>";
      foreach ($query->result_array() as $key => $row)
      {
        if(strlen($row['id'])!=0)
          $html.=sprintf("<option value='%s'>%s</option>",$row['id'],$row['name']);
        else
           $html.=sprintf("<option value='%s'>%s</option>",'1',$row['name']);
      }
      $html.="</select>";

      return $html;
    }

    function statement($year,$week,$id)
    {
      $Date=$this->Get_Date($year,$week);
      $Date_array=explode(",",$Date);     
      $sql="";
      for($i=0;$i<count($Date_array);$i++)
      {
         $day=$Date_array[$i];
         if($i!=0)            
              $merge=" union ";
            else $merge="";
           

         $sql.=<<<end_html
      $merge
     Select '$day' as `date`,
IF(count(`index`)=0,-4,
   IF( @v:=(Select count(`index`)as `number` from timesheet where `id`='$id' and `supply`='Hold' and `Date`='$day')>0,-1,
       IF( @K:=(Select count(`index`)as `number` from timesheet where `id`='$id' and `supply`='Apply' and `Date`='$day')>0,-3,-2)
    )
   ) as number
 from timesheet where `id`='$id' and `Date`='$day'
end_html;
      }
     $Data=[];$i=0;
     $query=$this->db->query($sql);
     foreach ($query->result_array() as $key => $row)
     {
       $Data[$i]=$row['number'];
       $i++;
     }
     return $Data;
    }

    function Apply($day,$id)
    {
      $sql="Update timesheet set `supply`='Apply' where `id`='$id' and `Date`='$day'";
      $receive_address=$this->Get_address($id);     
      $this->email_send($receive_address,'','審核成功','您的工作日誌已經審核成功');

      //紀錄Log
      $Log = $id."審核成功:".$day;
      $this->Users_model->Log($_SESSION['id'],$Log); 

      try
      {
        $this->db->query($sql);
        $message="審核成功";
      }
      catch(Exception $e)
      {
        $message=$e->getMessage();
      }

      return $message;
    }

    function Back($day,$id,$reason)
    {
      $sql="Update timesheet set `supply`='Back',`Reason`='$reason' where `id`='$id' and `Date`='$day'";
      $receive_address=$this->Get_address($id);     
      $this->email_send($receive_address,'','退件',$reason);
      $this->Insert_Back_Reason($day,$id,$reason);

      //紀錄Log
      $Log = $day.$id."退件:".$reason;
      $this->Users_model->Log($_SESSION['id'],$Log); 

      try
      {
        $this->db->query($sql);
        $message="退件成功";
      }
      catch(Exception $e)
      {
        $message=$e->getMessage();
      }

      return $message;
      ;
    }
    function Insert_Back_Reason($day,$id,$reason)
    {
      $sql="Delete from back_reason where `id`='$id' and `date`='$day'";
      $this->db->query($sql);
      $sql="Insert into back_reason (`Date`,`id`,`reason`) values ('$day','$id','$reason')";
      $this->db->query($sql);

      $Log = $id."新增退件原因:".$day." - ".$reason;
      $this->Users_model->Log($_SESSION['id'], $Log); 
    }

    function email_send($receive_address,$receive_name,$subject,$content)
    {    
       return $this->mailer->sendmail(
        $receive_address,
        $receive_name,
        $subject,
        $content    );
    }

    function Get_address($id)
    {
      $sql="Select mail from member where `id`='$id'";
      $mail="";
      $query=$this->db->query($sql);
      foreach ($query->result_array() as $key => $row) {
        $mail=$row['mail'];
      }
      return $mail;
    }

    function Get_State($id)
    {
    
      /*$sql="Select * from(
      Select a.`Date`,`supply`,back_reason.`reason`,`name`,a.`id` from (
      Select `id`,`Date`,`supply`,`reason` from timesheet where `id` in (
      SELECT `id` FROM  member where `Dept`=(Select Dept from member where `id`='$id' limit 1)) and `supply` in ('Back','Hold','Wait')
      )as a
      left join member
      on a.id=member.id and a.`id` !='$id' and a.`id`!=(SELECT `leader_id` as id FROM leaves.member where `id`='$id' limit 1)
      left join back_reason
      on a.id=back_reason.id and a.`Date`=back_reason.`Date`
      group by `Date`,a.`id`
      ) as b where `id`!='$id' and `id`!=(SELECT `leader_id` as id FROM leaves.member where `id`='$id' limit 1)" ;
      */
      $m_id = $_SESSION['id'];
      $sql = "SELECT 
                t.ID, m.`name`, t.Date, t.Supply, b.Reason
              FROM timesheet AS t
              LEFT JOIN `leaves`.back_reason AS b 
                ON t.ID = b.id 
                AND t.Date = b.Date
              LEFT JOIN `leaves`.member AS m 
                ON m.id = t.ID 
              WHERE t.ID IN (SELECT id  FROM `leaves`.view_member_dept WHERE Dept = '$id' )
              AND t.Supply IN ('Back','Hold','Wait') -- 取出同部門，狀態為退件、待審核、待修改
              AND t.ID != '$m_id'
              
              GROUP BY t.Date, t.ID";
         
      $query=$this->db->query($sql);
      $number=$query->num_rows();
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
      

      foreach ($query->result_array() as $key => $row)
      {
         $message="";
         $icon="";
         $Date=$row['Date'];
         $name=$row['name'];
         $ID=$row['ID'];
         $Reason=$row['Reason'];
         switch ($row['Supply'])
           {
            case 'Back':
              $message="退件";
              $icon='red';
              break;
            case 'Apply':
              $message="審核成功";
              $icon='bule';
              break;
            case 'Hold':
              $message="待審核";
              $icon='Green';
              break;
            case 'Wait':
              $message="待修改";
              break;
            default:              
              break;
           }

          
          $img = '../assets/img/Notify.jpg';
   
          $html.=<<<end_html
          <li>
            <a href="javascript:void(0)" onclick="Go_to_Date('$Date');Message_Reload('$ID','$Date')">           
                        <span class="avatar"><img src="$img " alt="Avatar"></span>
                        <span class="header">
                          <span  class="from">
                            $name $Date
                            </span>
                          <span class="time">
                            
                            </span>
                        </span>
                        <span class="message">
                        $message; 
                        <span style="color:blue"> $Reason</span> 
                        </span>  
              </a>        
            </li>
end_html;
           
          //$html.=sprintf($html,$icon,$message);
      }
      $html.="</ul>";
      return $html;

    }



    
}