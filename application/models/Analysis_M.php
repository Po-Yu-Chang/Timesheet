<?php
class Analysis_M extends CI_Model
{
  
    function __construct() {
        parent::__construct();
         $this->load->database();
         $this->load->model('Users_model');
         date_default_timezone_set("Asia/Taipei");
    }

    function Search_Project()
    {
        $dept = $_SESSION['dept_id'];
        $sql="SELECT * FROM leaves.project WHERE apply like '%$dept%';";
        //$sql="SELECT Project_Name FROM leaves.project WHERE apply like '%$dept%'";

        $html="<SELECT id='Project_Name' onchange='Change_Project_Name();'>";
        $query=$this->db->query($sql);
        foreach ($query->result_array() as $key => $row)
        {
          $html.=sprintf("<option value='%s'>%s</option>",$row['Project_Name'],$row['Project_Name']);
        }
        $html.="</SELECT>";

        return $html;
    }
    function Search_Dept_Analysis($Data)
    {
      $start=$Data[0];
      $end=$Data[1];
      $Dept=$Data[2];
      $judge="";
      if(strlen($Data[3])>0)
      {
        if($Data[3]!='ALL')
        $judge.=sprintf("  and `project`='%s'",$Data[3]);
      }
      if(strlen($Data[4])>0)
      {
        if($Data[4]!='ALL')
        $judge.=sprintf("  and `id`='%s'",$Data[4]);
      }
      $sql=<<<end_html
SELECT project.project_name,a.project,`Dept_n`,normal,item,overtime,'$start~$end' as date,id from(
SELECT `project`,id,sum(`Normal`) as normal,sum(`overtime`) as overtime,date FROM leaves.timesheet group by `Project`
) as a
left join project
on project.project_number=a.project
left join project_item
on project.project_number=project_item.project_number
left join Dept
on Dept.Dept=project_item.Dept
where `Date` between '$start' and '$end' and Dept.Dept='$Dept' $judge
end_html;
        $html="";$Data=[];$i=0;
        $query=$this->db->query($sql);
        foreach ($query->result_array() as $key => $row)
        {
          $Data[$i]=[$row['date'],$row['project'],$row['project_name'],$row['Dept_n'],$row['item'],$row['normal'],$row['overtime']];
          $i++;
        }

        return $Data;

    }

    function Get_Project_name_Dept($Dept)
    {
      $sql=<<<end_html
SELECT project.project_name,a.project_number from (
SELECT * from project_item where `Dept`='$Dept') as a
left join project
on project.project_number=a.project_number
group by project_name
end_html;
      $query=$this->db->query($sql);
      
      $i=0;$Data=[];
      foreach ($query->result_array() as $key => $row)
      {
        $Data[$i]=[$row['project_name'],$row['project_number']];
        $i++;
      }
      return $Data;
    }

    function Get_Base_Data($Data)
    {
      $Machine=$Data[0];
      $project_name=$Data[1];
      $sql="SELECT * from project where `Project_Name`='$project_name' and `Machine`='$Machine' ";
      $Data=[];$i=0;
      $query=$this->db->query($sql);
      foreach ($query->result_array() as $key => $row)
      {
       $Data=[$row['Project_Name'],$row['Machine_Number'],$row['Machine']];
      }

      return $Data;
    }

    function Get_Sum_Data($Data)
    {
       $id           = $Data[0];
       $project_name = $Data[1];
       $leavel=$this->Get_Leavel($id);
       $html="";
     
         $sql=<<<end_html
         Select (SELECT `Dept_n` FROM dept where `dept`=(SELECT `dept` FROM member where `id`='$id' limit 1)) as `Dept_n`, sum(normal) as `normal`,sum(overtime) as `overtime` from timesheet where
         `Machine`='$project_name' and  `id` in
(
    Select `id` from member where `dept` in
    (
    SELECT `dept` FROM member where `id`='$id'
    )
)
end_html;
          $query=$this->db->query($sql);
          foreach ($query->result_array() as $key => $row)
          {
            $html.=sprintf("<tr><td>%s</td>",$row['Dept_n']);
            $html.=sprintf("<td>%s</td>",$row['normal']);
            $html.=sprintf("<td>%s</td></tr>",$row['overtime']);
          }
       

       return $html;
    }

    function Get_Leavel($id)
    {
      $sql="SELECT `leavel` FROM member where `id`='$id';";
      $query=$this->db->query($sql);
      foreach ($query->result_array() as $key => $row)
      {
       $leavel=$row['leavel'];
      }
      return $leavel;
    }

    // 1.專案追蹤→部門資料 (tablink)
    function Get_tab_area($Data)
    {
      $id           = $Data[0];
      $project_name = $Data[1];
      $Machine      = $Data[2];
      $leavel       = $this->Get_Leavel($id);
      $html         = "<ul class='tab'>";

    
        $sql = "SELECT * FROM leaves.project_item p LEFT JOIN leaves.dept d ON d.dept=p.dept WHERE  p.`Machine`='$Machine' GROUP BY d.`Dept_n`"; 
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $key => $row)
        {
          $html.= sprintf("<li><a class='tablink' onclick='Display(%s);'>%s</a></li>", $row['Dept']+"" , $row['Dept_n']);
        }
      
      $html.="</ul>";
      return $html;
    }

    function Get_Child_Item($Data)
    {
      $Dept=$Data[0];
      if(strlen($Dept)==3)
      {
        $Dept="0".$Dept;
      }
      $project_name=$Data[1];
      $sql="SELECT item FROM due_item where `Dept`='$Dept'";
      $query=$this->db->query($sql);
      $html="<SELECT id='project_name'><option value='All'>全部</option>";
      foreach ($query->result_array() as $key => $row)
      {
        $html.=sprintf("<option value='%s'>%s</option>",$row['item'],$row['item']);
      }
      $html.="</SELECT>";

      return $html;

    }

    function Get_Member($Dept)
    {
      if(strlen($Dept)==3)
      {
        $Dept='0'.$Dept;
      }
      $sql="SELECT id,name from member where `Dept`='$Dept'";
      $query=$this->db->query($sql);
      $html="<SELECT id='member'><option value='All'>全部</option>";
      foreach ($query->result_array() as $key => $row)
      {
        $html.=sprintf("<option value='%s'>%s</option>",$row['id'],$row['name']);
      }
      $html.="</SELECT>";

      return $html;
    }

    function Search($Data)
    {
      $project_item=$Data[0];
      $member=$Data[1];
      $Dept=$Data[2];
      $Machine=$Data[3];
      $judge='';
      if($project_item!='All')
      {
        $judge.=" and `project_item`='$project_item'";
      }
      if($member!='All')
      {
        $judge.=" and timesheet.`id`='$member'";
      }
        $judge.=" and `Machine`='$Machine' ";
      $sql="SELECT `name`,project_item,sum(`Normal`) as `Normal`,sum(`overtime`) as `overtime` from timesheet
            left join member on
            timesheet.id=member.id
            where timesheet.`index`>0 and `Dept`='$Dept' $judge group by `project_item`,`name`
            union 
            SELECT '' as `name`,'總合' as project_itme,sum(`Normal`) as `Normal`,sum(`overtime`) as `overtime` from timesheet
            left join member on
            timesheet.id=member.id
            where timesheet.`index`>0 and `Dept`='$Dept'  $judge";
      $query=$this->db->query($sql);
      $html="<table class='table'><tr><th>專案子項目</th><th>姓名</th><th>正常時間</th><th>加班時間</th></tr>";
      foreach ($query->result_array() as $key => $row)
      {
        $html.=sprintf("<tr><td>%s</td>",$row['project_item']);
        $html.=sprintf("<td>%s</td>",$row['name']);
        $html.=sprintf("<td>%s</td>",$row['Normal']);
        $html.=sprintf("<td>%s</td></tr>",$row['overtime']);
      }

      return $html;
    }

    function Get_area_member($id)
    {
      $dept = $_SESSION['dept_id'];
      //$sql="SELECT id,name from member where `Dept` in( SELECT Dept from member where id='$id')";
      $sql = "SELECT id, `name` FROM member 
      WHERE state = '在職' AND Dept = '$dept' 
      ORDER BY id";
      $query=$this->db->query($sql);
      $html="<SELECT id='member2'>";
      foreach ($query->result_array() as $key => $row)
      {
        $html.=sprintf("<option value='%s'>%s</option>",$row['id'],$row['name']);
      }
      $html.="</SELECT>";

      return $html;
    }
    
    function Search_Member_performance($Data)
    { //細部資料
      $start=$Data[0];
      $end=$Data[1];
      $id=$Data[2];
      $out=[];$i=0;
     //$sql="SELECT * from timesheet where `Date` between '$start' and '$end' and `id`='$id' group by Project_Item";
      $sql = "SELECT Project_Item, child_item, SUM(Normal) AS Normal , SUM(Overtime) AS Overtime  FROM timesheet 
              WHERE `Date` BETWEEN '$start' AND '$end' AND `id`='$id'
              AND Project in('其他')
              GROUP BY Project_Item, child_item";
      $query=$this->db->query($sql);
      foreach ($query->result_array() as $key => $row)
      {
        //$out[$i]=[$row['Machine'].":".$row['Project'],$row['Project_Item'],$row['Normal'],$row['Overtime']];
        $out[$i]=[$row['Project_Item'],$row['child_item'],$row['Normal'],$row['Overtime']];
        $i++;
      }
      return $out;
    }
    //「部門資料查詢」
    function Search_Dept_Data($Data)
    {
        $start  = $Data[0];
        $end    = $Data[1];
        $out    = [];
        $i      = 0;

        switch ($_SESSION['dept_id']) {
          case '0700': // 研發部硬體設計課
            $sql ="";
            break;

          case '0701': // 研發部軟體設計課
            $sql="  SELECT '專案開發' AS Item,ifnull(sum(`Normal`+`Overtime`),0) AS Total,ifnull(sum(`Normal`),0) AS Normal,ifnull(sum(`Overtime`),0) AS Overtime from timesheet 
                      where `Date` between '$start' and '$end' and `id`in(SELECT `job_n` from member where `Dept`='0701') and project in('專案開發')
                    union
                      SELECT '設計變更' AS Item,ifnull(sum(`Normal`+`Overtime`),0) AS Total,ifnull(sum(`Normal`),0) AS Normal,ifnull(sum(`Overtime`),0) AS Overtime from timesheet 
                      where `Date` between '$start' and '$end' and `id`in(SELECT `job_n` from member where `Dept`='0701') and project  not in( '專案開發','程式維護','例行性事務','管理工作','其他','新人學習') and `Machine` not in('MIS事務') 
                    union
                      SELECT '程式維護' AS Item,ifnull(sum(`Normal`+`Overtime`),0) AS Total,ifnull(sum(`Normal`),0) AS Normal,ifnull(sum(`Overtime`),0) AS Overtime from timesheet 
                      where `Date` between '$start' and '$end' and `id`in(SELECT `job_n` from member where `Dept`='0701') and project  in('程式維護')
                    union
                      SELECT '例行性事務' AS Item,ifnull(sum(`Normal`+`Overtime`),0) AS Total,ifnull(sum(`Normal`),0) AS Normal,ifnull(sum(`Overtime`),0) AS Overtime from timesheet 
                      where `Date` between '$start' and '$end' and `id`in(SELECT `job_n` from member where `Dept`='0701') and project in('例行性事務')
                    union
                      SELECT '管理工作' AS Item,ifnull(sum(`Normal`+`Overtime`),0) AS Total,ifnull(sum(`Normal`),0) AS Normal,ifnull(sum(`Overtime`),0) AS Overtime from timesheet 
                      where `Date` between '$start' and '$end' and `id`in(SELECT `job_n` from member where `Dept`='0701') and project in('管理工作')
                    union
                      SELECT 'MIS工作' AS Item,ifnull(sum(`Normal`+`Overtime`),0) AS Total,ifnull(sum(`Normal`),0) AS Normal,ifnull(sum(`Overtime`),0) AS Overtime from timesheet 
                      where `Date` between '$start' and '$end' and `id`in(SELECT `job_n` from member where `Dept`='0701') and Machine in('MIS事務')
                    union
                      SELECT '新人學習' AS Item,ifnull(sum(`Normal`+`Overtime`),0) AS Total,ifnull(sum(`Normal`),0) AS Normal,ifnull(sum(`Overtime`),0) AS Overtime from timesheet 
                      where `Date` between '$start' and '$end' and `id`in(SELECT `job_n` from member where `Dept`='0701') and project in('新人學習')
                    union
                      SELECT '其他' AS Item,ifnull(sum(`Normal`+`Overtime`),0) AS Total,ifnull(sum(`Normal`),0) AS Normal,ifnull(sum(`Overtime`),0) AS Overtime from timesheet 
                      where `Date` between '$start' and '$end' and `id`in(SELECT `job_n` from member where `Dept`='0701') and project  in('其他')";
            break;
          
          case '1100':  // 資訊部
            $sql ="";
            break;
          
          default:
            $sql ="";
            break;
        }

        
        $query=$this->db->query($sql);
        foreach ($query->result_array() as $key => $row)
        {
            $out[$i]=[$row['Item'],$row['Total'],$row['Normal'],$row['Overtime']];
            $i++;
        }
        return $out;
    }
    // 「人員追蹤」
    function Search_four_Item_member($Data)
    {
        $start=$Data[0];
        $end=$Data[1];
        $id=$Data[2];
        $out=[];$i=0;
        $sql="  SELECT '專案開發' AS Item,ifnull(sum(`Normal`+`Overtime`),0) AS Total,ifnull(sum(`Normal`),0) AS Normal,ifnull(sum(`Overtime`),0) AS Overtime from timesheet 
                where `Date` between '$start' and '$end' and `id`='$id' and project in('專案開發')
              union
                SELECT '設計變更' AS Item,ifnull(sum(`Normal`+`Overtime`),0) AS Total,ifnull(sum(`Normal`),0) AS Normal,ifnull(sum(`Overtime`),0) AS Overtime from timesheet 
                where `Date` between '$start' and '$end' and `id`='$id' AND project NOT IN ( '專案開發','程式維護','例行性事務','管理工作','其他','新人學習') and `Machine` not in('MIS事務') 
              union
                SELECT '程式維護' AS Item,ifnull(sum(`Normal`+`Overtime`),0) AS Total,ifnull(sum(`Normal`),0) AS Normal,ifnull(sum(`Overtime`),0) AS Overtime from timesheet 
                where `Date` between '$start' and '$end' and `id`='$id' and project in('程式維護')
              union
                SELECT '例行性事務' AS Item,ifnull(sum(`Normal`+`Overtime`),0) AS Total,ifnull(sum(`Normal`),0) AS Normal,ifnull(sum(`Overtime`),0) AS Overtime from timesheet 
                where `Date` between '$start' and '$end' and `id`='$id' and project in('例行性事務')
              union
                SELECT '管理工作' AS Item,ifnull(sum(`Normal`+`Overtime`),0) AS Total,ifnull(sum(`Normal`),0) AS Normal,ifnull(sum(`Overtime`),0) AS Overtime from timesheet 
                where `Date` between '$start' and '$end' and `id`='$id' and project in('管理工作')
              union
                SELECT 'MIS事務' AS Item,ifnull(sum(`Normal`+`Overtime`),0) AS Total,ifnull(sum(`Normal`),0) AS Normal,ifnull(sum(`Overtime`),0) AS Overtime from timesheet 
                where `Date` between '$start' and '$end' and `id`='$id' and `Machine` in('MIS事務')
              union
                SELECT '新人學習' AS Item,ifnull(sum(`Normal`+`Overtime`),0) AS Total,ifnull(sum(`Normal`),0) AS Normal,ifnull(sum(`Overtime`),0) AS Overtime from timesheet 
                where `Date` between '$start' and '$end' and `id`='$id' and `project` in('新人學習')
              union
                SELECT '其他' AS Item,ifnull(sum(`Normal`+`Overtime`),0) AS Total,ifnull(sum(`Normal`),0) AS Normal,ifnull(sum(`Overtime`),0) AS Overtime from timesheet 
                where `Date` between '$start' and '$end' and `id`='$id' and project in('其他')";

        $query=$this->db->query($sql);
        foreach ($query->result_array() as $key => $row)
        {
            $out[$i]=[$row['Item'],$row['Total'],$row['Normal'],$row['Overtime']];
            $i++;
        }
        return $out;
    }

    
    function Get_Detail_Data($Data)
    {

        $type=$Data[0];
        $start=$Data[1];
        $end=$Data[2];

        switch ($type):
            case 'develope': // 專案開發
                $sql = "SELECT 'develope' as Item,`Machine`,project,ifnull(sum(`Normal`+`Overtime`),0) as Total,ifnull(sum(`Normal`),0) as Normal,ifnull(sum(`Overtime`),0)as Overtime 
                        from timesheet 
                        where `Date` between '$start' and '$end' and `id` in (SELECT `job_n` from member where `Dept`='0701') 
                        and project in('專案開發') and length(project)>0
                        group by `Machine`,`project`
                        ";
                break;
            case 'maintain_code': //程式維護
                $sql = "SELECT 'maintain_code' as Item,`Machine`,project,ifnull(sum(`Normal`+`Overtime`),0) as Total,ifnull(sum(`Normal`),0) as Normal,ifnull(sum(`Overtime`),0) 
                        as Overtime 
                        from timesheet 
                        where `Date` between '$start' and '$end' and `id` in (SELECT `job_n` from member where `Dept`='0701') 
                        and project  in('程式維護')
                        group by `Machine`,`project`;";
                break;
            case 'change_Spec': //設計變更
                $sql = "SELECT 'change_Spec' as Item,`Machine`,project,ifnull(sum(`Normal`+`Overtime`),0) as Total,ifnull(sum(`Normal`),0) as Normal,ifnull(sum(`Overtime`),0) as Overtime 
                        from timesheet 
                        where `Date` between '$start' and '$end' and `id` in (SELECT `job_n` from member where `Dept`='0701') 
                        AND Machine not in ('MIS事務')
                        and project  not in('其他','程式維護','專案開發','例行性事務','MIS工作','管理工作', '新人學習') 
                        group by `Machine`,`project`;";
                break;
            case 'routine':
                $sql = "SELECT 'routine' as Item,`Machine`,project,ifnull(sum(`Normal`+`Overtime`),0) as Total,ifnull(sum(`Normal`),0) as Normal,ifnull(sum(`Overtime`),0) 
                        as Overtime 
                        from timesheet 
                        where `Date` between '$start' and '$end' and `id`in(SELECT `job_n` from member where `Dept`='0701') 
                        and project in('例行性事務')
                        group by `Machine`,`project`;";
                break;
            case 'mis':
                $sql = "SELECT 'mis' as Item,`Machine`,project,ifnull(sum(`Normal`+`Overtime`),0) as Total,ifnull(sum(`Normal`),0) as Normal,ifnull(sum(`Overtime`),0) 
                        as Overtime 
                        from timesheet 
                        where `Date` between '$start' and '$end' and `id`in(SELECT `job_n` from member where `Dept`='0701') 
                        and machine  in('MIS事務')
                        group by `Machine`,`project`;";
                break;
            case 'else':
                $sql = "SELECT 'else' as Item,`Machine`,project,ifnull(sum(`Normal`+`Overtime`),0) as Total,ifnull(sum(`Normal`),0) as Normal,ifnull(sum(`Overtime`),0) as Overtime 
                        from timesheet 
                        where `Date` between '$start' and '$end' and `id`in(SELECT `job_n` from member where `Dept`='0701') 
                        and project  in('其他','例行性事務','MIS工作','管理工作')
                        group by `Machine`,`project`;";
                break;
        endswitch;
        
        $out=[];$i=0;
        $query=$this->db->query($sql);
        foreach ($query->result_array() as $key => $row)
        {
            $out[$i] = [$row['Item'], $row['Machine'], $row['project'], $row['Total'], $row['Normal'], $row['Overtime']];
            $color = [];
            $i++;
        }
        return $out;

    }
    function Get_Machine_Data()
    {
      $dept = $_SESSION['dept_id'];
      $sql="SELECT Machine FROM machine WHERE dept like '%$dept%' ORDER BY `order`";
      $query=$this->db->query($sql);
      
      $Out=[]; $i=0;
      foreach ($query->result_array() as $key => $row)
      {
        $Out[$i]=$row['Machine'];$i++;
      }
      return $Out;
    }

    function Get_Machine_Number($Machine)
    {
      $sql="SELECT * from machine_number where `Machine`='$Machine' ";
      $query=$this->db->query($sql);
      $Out=[];$i=0;
      //$html="<SELECT id='Machine_Number'><option value='All'>All</option>";
      foreach ($query->result_array() as $key => $row)
      {
        //$html.=sprintf("<option value='%s'>%s</option>",$row['Machine_Number'],$row['Machine_Number']);
        $Out[$i]=$row['Machine_Number'];$i++;
      }
       //$html.="</SELECT>";
      return $Out;
    }

    function Search_Machine_Data($Data)
    {
      $dept = $_SESSION['dept_id'];
      $Machine=$Data[0];
      $Machine_Number=$Data[1];
      $Client=$Data[2];
      $judge="";
      $Data=[];
      $i=0;
      if($Machine_Number!='All')
      {
        $judge.=" and `Machine_number`='$Machine_Number'  and `Client` is not null ";
      }
      if(strlen($Client)!=0)
      {
        $judge.="  and `Client`like '%$Client%'";
      }
      $sql="SELECT * FROM view_timesheet_machine_dept
            WHERE machine = '$Machine' $judge
            AND dept = '$dept'";
      $query=$this->db->query($sql);
      
      foreach ($query->result_array() as $key => $row)
      {
        $Data[$i]=[$row['Machine'].":".$row['Project'].":".$row['Machine_Number'],$row['Normal'],$row['Overtime']];
        $i++;
      }
      return $Data;
      

    }


    function Get_Project_Name_By_Machine($Machine)
    {
      $dept = $_SESSION['dept_id'];
      $sql="SELECT project_name FROM project where `Machine`='$Machine' AND `apply` like '%$dept%'";
      $query=$this->db->query($sql);
      $html="<SELECT id='Project_name' >"; 
      foreach ($query->result_array() as $key => $row)
      {
        $html.=sprintf("<option value='%s'>%s</option>",$row['project_name'],$row['project_name']);
      }
      $html.="</SELECT>";
      return $html;
    }

}