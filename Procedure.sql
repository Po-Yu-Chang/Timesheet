delimiter $$

CREATE DEFINER=`root`@`%` PROCEDURE `Absence`(S_D varchar(100) ,E_D varchar(100),D_n varchar(100))
BEGIN
Declare S varchar(100);
Declare E varchar(100);
set @num=0;
Set S= CONCAT( substring(S_D,1,4)-1911,substring(S_D,6,2),substring(S_D,9,2)) ;
Set E= CONCAT( substring(E_D,1,4)-1911,substring(E_D,6,2),substring(E_D,9,2)) ;

 -- select S,E,D_n;


if(D_n='All') then
			Select * from(
		Select
		(@num:=@num+1) as nu,
        m.Dept_n,
		g.Dept,
		g.`name`,
       `Date`,On_duty,off_duty,
		ifnull(`Time`,'未刷卡') as `Time`,
		ifnull(`Final`,'未刷卡') as `Final`,
		ifnull(((SUBSTRING(`On_duty`,1,2)*60 )+(SUBSTRING(`On_duty`,3,2))-(SUBSTRING(`time`,1,2)*60 )-(SUBSTRING(`time`,3,2))),0)as `first`,
		ifnull(((SUBSTRING(`Final`,1,2)*60 )+(SUBSTRING(`Final`,3,2))-(SUBSTRING(`off_duty`,1,2)*60 )-(SUBSTRING(`off_duty`,3,2))),0)as `Second`,
		item
		 from(
		SELECT 
		temp.`name`,temp.`Date`,
		if(length(`item`)>0 ,if(`Time1`!=0 and `s_t`>`time1`,`time1`,`s_t`),`Time1`) as `Time`,
		if(length(`item`)>0 and `item`!='加班' ,if(`Final1`is not null and `e_t`<`Final1` and `item`!='加班',`Final1`,`e_t`),`Final1`) as `Final`,
		On_duty,off_duty,
		ifnull(`item`,'')as `item`,`r_min`,`r_max`
		FROM leaves.temp
		left join 
		(
		SELECT `Data`,ifnull(min(`Time`),0)as `Time1`,ifnull(max(`Time`),0) as Final1,`name`,min(`real_time`)as r_min,max(`real_time`) as r_max FROM leaves.door_infor
		 where `Data` between S and E
		group by `Data`,`Name` order by `Data`,`Time`) as A
		on temp.`Date`=A.`Data` and temp.`name`=A.`name`

		left join 
		(
		  Select `Date`,`Name`,`item`, Min(`Start`)as  s_t,Max(`End`) as e_t from detail where `Date` between S and E
		 group by `Date`,`Name`
		) as c
		on temp.`Date`=c.`Date` and  temp.`name`=c.`name`) as d

		left join
		(
		   Select `Dept`,`state`,`name` from member 
		)as g
		on d.`name`=g.`name` and g.`state`!='離職'

		left join
		(
			Select `Dept` as D,`Dept_n` from dept
		)as m
		on g.`Dept`=m.`D`



		where `Date` between S and E and g.`name` is not null ) as f;
else
		Select * from(
		Select
        (@num:=@num+1) as nu,
		m.Dept_n,
		g.Dept,
		g.`name`,`Date`,On_duty,off_duty,
		ifnull(`Time`,'未刷卡') as `Time`,
		ifnull(`Final`,'未刷卡') as `Final`,
		ifnull(((SUBSTRING(`On_duty`,1,2)*60 )+(SUBSTRING(`On_duty`,3,2))-(SUBSTRING(`time`,1,2)*60 )-(SUBSTRING(`time`,3,2))),0)as `first`,
		ifnull(((SUBSTRING(`Final`,1,2)*60 )+(SUBSTRING(`Final`,3,2))-(SUBSTRING(`off_duty`,1,2)*60 )-(SUBSTRING(`off_duty`,3,2))),0)as `Second`,
		item
		 from(
		SELECT 
		temp.`name`,temp.`Date`,
		if(length(`item`)>0 ,if(`Time1`!=0 and `s_t`>`time1`,`time1`,`s_t`),`Time1`) as `Time`,
		if(length(`item`)>0 and `item`!='加班' ,if(`Final1`is not null and `e_t`<`Final1` and `item`!='加班',`Final1`,`e_t`),`Final1`) as `Final`,
		On_duty,off_duty,
		ifnull(`item`,'')as `item`,`r_min`,`r_max`
		FROM leaves.temp
		left join 
		(
		SELECT `Data`,ifnull(min(`Time`),0)as `Time1`,ifnull(max(`Time`),0) as Final1,`name`,min(`real_time`)as r_min,max(`real_time`) as r_max FROM leaves.door_infor
		 where `Data` between S and E
		group by `Data`,`Name` order by `Data`,`Time`) as A
		on temp.`Date`=A.`Data` and temp.`name`=A.`name`

		left join 
		(
		  Select `Date`,`Name`,`item`, Min(`Start`)as  s_t,Max(`End`) as e_t from detail where `Date` between S and E
		 group by `Date`,`Name`
		) as c
		on temp.`Date`=c.`Date` and  temp.`name`=c.`name`) as d

		left join
		(
		   Select `Dept`,`state`,`name` from member 
		)as g
		on d.`name`=g.`name` and g.`state`!='離職'

		left join
		(
			Select `Dept` as D,`Dept_n` from dept
		)as m
		on g.`Dept`=m.`D`


		where `Date` between S and E and g.`Dept`=D_n and g.`name` is not null ) as f;
end if;

END$$


delimiter $$

CREATE DEFINER=`root`@`%` PROCEDURE `analysis_by_member`(sta varchar(100),en varchar(100),id varchar (100))
BEGIN
Select '新機開發' as Item,sum(`Normal`+`Overtime`) as Total,sum(`Normal`) as Normal,sum(`Overtime`) as Overtime from timesheet where `Date` between 'sta' and 'en' and `id`=id and project not in('其他','程式維護','設計變更','例行性事務')
union
Select '程式維護' as Item,sum(`Normal`+`Overtime`) as Total,sum(`Normal`) as Normal,sum(`Overtime`) as Overtime from timesheet where `Date` between 'sta'and 'en' and `id`=id and project  in('程式維護')
union
Select '設計變更' as Item,sum(`Normal`+`Overtime`) as Total,sum(`Normal`) as Normal,sum(`Overtime`) as Overtime from timesheet where `Date` between 'sta' and 'en' and `id`=id and project  in('設計變更')
union
Select '其他' as Item,sum(`Normal`+`Overtime`) as Total,sum(`Normal`) as Normal,sum(`Overtime`) as Overtime from timesheet where `Date` between 'sta' and 'en' and `id`=id and project  in('其他','例行性事務');

END$$


delimiter $$

CREATE DEFINER=`root`@`%` PROCEDURE `attendance`(v_name varchar(100),v_date varchar(100))
begin
Select ifnull(`first`,0) as `first`,ifnull(`late`,0) as `late`,ifnull(`sum_supply`,0) as `sum_supply`,
floor((ifnull(`first`,0)+ifnull(`late`,0)+ifnull(`sum_supply`,0))/3) as `attendance`
 from (
Select ifnull(`name`,v_name) as `name`,count(`name`) as `first` from temp2 where `first`>-10 and `first`<0 and `name`=v_name and `duty`='on'  and `date` like v_date)as a

left join
(Select ifnull(`name`,v_name) as `name`,count(`name`)as `late`  from temp2 where `Second`>-10 and `Second`<0 and `name`=v_name and `duty`='on'  and `date` like v_date)as b
on a.name=b.name

left join
(Select ifnull(`name`,v_name) as `name`,sum(`sum_supply`)as `sum_supply`  from temp2 where `sum_supply`>0 and `name`=v_name and `date` like v_date )as c
on c.name=a.name;



end$$


delimiter $$

CREATE DEFINER=`root`@`%` PROCEDURE `Change_recipes`()
begin
Update recipes_01_diameter set Spec_Format='~';
Update recipes_02_edge_wear set Spec_Format='≦';
Update recipes_03_chips set Spec_Format='≦';
Update recipes_04_overlap set Spec_Format='≦';
Update recipes_05_vertical_open set Spec_Format='≦';
Update recipes_06_horizontal_open set Spec_Format='≦';
Update recipes_07_chisel_point set Spec_Format='≦';
Update recipes_08_flare set Spec_Format='≦';
Update recipes_09_negative set Spec_Format='≦';
Update recipes_10_offset set Spec_Format='≦';
Update recipes_11_hook set Spec_Format='≦';
Update recipes_12_layback set Spec_Format='≦';
Update recipes_13_web_thickness set Spec_Format='~';
Update recipes_14_taper set Spec_Format='~';
Update recipes_15_polish set Spec_Format='/';
Update recipes_16_cutting_lip set Spec_Format='≧';
Update recipes_17_linear set Spec_Format='~';
Update recipes_18_cld set Spec_Format='≦';
Update recipes_19_cut set Spec_Format='≦';
Update recipes_20_cut_differ set Spec_Format='≦';
Update recipes_21_clca set Spec_Format='≦';
Update recipes_22_axispolishng set Spec_Format='≦';
Update recipes_23_scratch set Spec_Format='≦';
Update recipes_24_shapeng set Spec_Format='S';
end$$


delimiter $$

CREATE DEFINER=`root`@`%` PROCEDURE `create_temp2`(v_date varchar(100))
begin
 Delete from temp2 ;
 Insert into temp2
Select a_table.* ,
ifnull(b_table.`hour`,0) as `hour`,
ifnull(b_table.`病假`,0) as `病假`,
ifnull(b_table.`公假`,0) as `公假`,
ifnull(b_table.`特休`,0) as `特休`,
ifnull(b_table.`生理假`,0) as `生理假`,
ifnull(b_table.`婚假`,0) as `婚假`,
ifnull(b_table.`喪假`,0) as `喪假`,
ifnull(b_table.`產假`,0) as `產假`,
ifnull(b_table.`安胎假`,0) as `安胎假`,
ifnull(b_table.`流產假`,0) as `流產假`,
ifnull(b_table.`陪產假`,0) as `陪產假`,
ifnull(b_table.`公傷假`,0) as `公傷假`,
ifnull(b_table.`產檢假`,0) as `產檢假`,
ifnull(b_table.`無薪假颱風`,0) as `無薪假颱風`,
ifnull(b_table.`無薪假停電`,0) as `無薪假停電`,
ifnull(b_table.`家庭照顧假`,0) as `家庭照顧假`
from(
Select 
ifnull(First_table.`Date`,0) as `Date`,
ifnull(First_table.`Name`,0) as `Name`,
ifnull(First_table.`Time`,0) as `Time`,
ifnull(First_table.`Final`,0) as `Final`,
ifnull(First_table.`first`,0) as `first`,
ifnull(First_table.`Second`,0) as `Second`,
ifnull(First_table.`sum_supply`,0) as `sum_supply`,
ifnull(First_table.`r_min`,0) as `r_min`,
ifnull(First_table.`r_max`,0) as `r_max`,
ifnull(First_table.`duty`,0) as `duty`,
ifnull(First_table.`day`,0) as `day`,
ifnull(Second_table.`day_off`,0) as `day_off`,
ifnull(Second_table.`day_off_sum`,0) as `day_off_sum`,
ifnull(Second_table.`out`,0) as `out`,
ifnull(Second_table.`out_sum`,0) as `out_sum`,
ifnull(Second_table.`Trip`,0) as `Trip`,
ifnull(Second_table.`Trip_sum`,0) as `Trip_sum`,
ifnull(Second_table.`Overtime`,0) as `Overtime`,
ifnull(Second_table.`Overtime_sum`,0)   as `Overtime_sum`,
if(
if(`first`<-10 and `Second`<-10,`first`+`second`+ifnull(day_off_sum,0)+ifnull(out_sum,0)+ifnull(Trip_sum,0),0)+
if(`first`<-10 and `Second`>-10,`first`+ifnull(day_off_sum,0)+ifnull(out_sum,0)+ifnull(Trip_sum,0),0)+
if(`first`>-10 and `Second`<-10,`second`+ifnull(day_off_sum,0)+ifnull(out_sum,0)+ifnull(Trip_sum,0),0)+
if(`duty`='on' and `first`=0 and `Second`=0,ifnull(day_off_sum,0)+ifnull(out_sum,0)+ifnull(Trip_sum,0)-480,0)>-480,

if(`first`<-10 and `Second`<-10,`first`+`second`+ifnull(day_off_sum,0)+ifnull(out_sum,0)+ifnull(Trip_sum,0),0)+
if(`first`<-10 and `Second`>-10,`first`+ifnull(day_off_sum,0)+ifnull(out_sum,0)+ifnull(Trip_sum,0),0)+
if(`first`>-10 and `Second`<-10,`second`+ifnull(day_off_sum,0)+ifnull(out_sum,0)+ifnull(Trip_sum,0),0)+
if(`duty`='on' and `first`=0 and `Second`=0,ifnull(day_off_sum,0)+ifnull(out_sum,0)+ifnull(Trip_sum,0)-480,0),
-480)
 as `error`
 from
(SELECT 
temp.`Date`,temp.`name`,temp.`class`,temp.`On_duty`,temp.`off_duty`,a.`Time`,a.`Station`,a.`Door`,a.`Final`,a.`sum_supply`,a.`r_min`,a.`r_max`,temp.`duty`,temp.`day`,
ifnull(((SUBSTRING(`On_duty`,1,2)*60 )+(SUBSTRING(`On_duty`,3,2))-(SUBSTRING(`time`,1,2)*60 )-(SUBSTRING(`time`,3,2))),0)as `first`,
ifnull(((SUBSTRING(`Final`,1,2)*60 )+(SUBSTRING(`Final`,3,2))-(SUBSTRING(`off_duty`,1,2)*60 )-(SUBSTRING(`off_duty`,3,2))),0)as `Second`
 FROM (Select * from temp where `Date` like v_date)  as temp
left join(
SELECT `index`,`Data`,min(`Time`) as `Time`,`Station`,`Door`,`Name`,`supply`,`h_index`,max(`Time`) as Final,sum(`supply`) as sum_supply,min(`real_time`)as r_min,max(`real_time`) as r_max FROM leaves.door_infor
 where `Data` like v_date
group by `Data`,`Name` order by `Data`,`Time`) AS a
ON a.`data`=temp.`date` and a.`name`=temp.`name`) as First_table
left join
(Select
f_table.*,b_table.item as `out`,
b_table.`hour` as out_sum,
h_table.`item` as `Trip`,
h_table.`hour` as `Trip_sum`,
i_table.`item` as `Overtime`,
i_table.`hour` as `Overtime_sum`
 from(
Select d_table.`Date`,d_table.`Name`,c_table.item as day_off,c_table.`sum` as day_off_sum -- 請假
from (Select `Date`,`Name` from detail where `Date` like v_date group by `Date`,`Name`  ) as d_table

left join
(
Select * from (

Select *,sum(`hour`) as `sum` from (

SELECT *,
((SUBSTRING(`End`,1,2)*60 )+(SUBSTRING(`End`,3,2))-(SUBSTRING(`Start`,1,2)*60 )-(SUBSTRING(`Start`,3,2))) as `hour`
 FROM leaves.detail where `Date` like v_date )  as a_table group by `Date`,`Name`,`item`)
 as b_table ) 

as c_table
on d_table.`name`=c_table.`name` and d_table.`Date`=c_table.`Date`
and c_table.item='請假'
 )as f_table
left join 
(
SELECT *,
((SUBSTRING(`End`,1,2)*60 )+(SUBSTRING(`End`,3,2))-(SUBSTRING(`Start`,1,2)*60 )-(SUBSTRING(`Start`,3,2))) as `hour`
 FROM leaves.detail where `item`='外出' and`Date` like v_date  group by `Date`,`Name` ) as b_table 
on  f_table.`name`=b_table.`name` and f_table.`Date`=b_table.`Date`
left join
(
SELECT *,
((SUBSTRING(`End`,1,2)*60 )+(SUBSTRING(`End`,3,2))-(SUBSTRING(`Start`,1,2)*60 )-(SUBSTRING(`Start`,3,2))) as `hour`
 FROM leaves.detail where `item`='出差' and`Date` like v_date  group by `Date`,`Name` ) as h_table 
on  f_table.`name`=h_table.`name` and f_table.`Date`=h_table.`Date`
left join
(
Select 
'加班' as `item`,
`Data`,`name`,
`overtime_start`,
`overtime_end`,
((SUBSTRING(`overtime_end`,1,2)*60 )+(SUBSTRING(`overtime_end`,3,2))-(SUBSTRING(`overtime_start`,1,2)*60 )-(SUBSTRING(`overtime_start`,3,2))) as `hour`
 from(
Select 
`Data`
,`Name`,
if(`overtime_start`>0 and `Final`>`overtime_start`,
`Time`,0
) as `overtime_start`,
if(`overtime_start`>0 and `Final`>`overtime_start`,
`Final`,0
) as `overtime_end`

 from( 
Select 
`work`.`Data`,
`work`.`Name`,
`work`.`Time`,
`work`.`Final`,
ifnull(`Trip`.`Start`,0) as `Trip_start`,
ifnull(`Trip`.`End`,0) as `Trip_end`,
ifnull(`out`.`Start`,0) as `out_start`,
ifnull(`out`.`End`,0) as `out_end`,
ifnull(`overtime`.`Start`,0) as `overtime_start`,
ifnull(`overtime`.`End`,0) as  `overtime_end`
 from
(SELECT `Data`,`Name`,`Time`,max(`Time`) as Final FROM leaves.door_infor
 where `Data` like v_date  and `Station` in('065','067','069')
group by `Data`,`Name` order by `Data`,`Time`) as `work`

left join 
(Select `item`,`Date`,`Start`,`End`,`Name` from detail 
where `item`='出差' and `Date` like v_date group by `Date`,`Name`) as `Trip`
on `Trip`.`date`=`work`.`data` and `Trip`.`Name`= `work`.`Name`

left join 
(Select `item`,`Date`,`Start`,`End`,`Name` from detail 
where `item`='外出' and `Date` like v_date group by `Date`,`Name`) as `out`
on `out`.`date`=`work`.`data` and `out`.`Name`= `work`.`Name`

left join 
(Select `item`,`Date`,`Start`,`End`,`Name` from detail 
where `item`='加班' and `Date` like v_date group by `Date`,`Name`) as `overtime`
on `overtime`.`date`=`work`.`data` and `overtime`.`Name`= `work`.`Name`) as overtime_table
)i_table

) as i_table 
on  f_table.`name`=i_table.`name` and f_table.`Date`=i_table.`Data`) as second_table
on First_table.`Date`=second_table.`Date` and First_table.`Name`=second_table.`name`
order by First_table.`Date`,First_table.`Name`) as a_table
left join 
(
Select 
c.Date,c.name,c.hour,d.`病假`,f.`公假`,g.`特休`,i.`生理假`,j.`婚假`,
k.`喪假`,L.`產假`,M.`安胎假`,P.`流產假`,Q.`陪產假`,R.`公傷假`,
S.`產檢假`,h.`無薪假颱風`,o.`家庭照顧假`,x.`無薪假停電`
 from(
Select a.Date,a.name,b.hour from 
(Select `Date`,`name` from detail where `Date` like v_date group by `Date`,`name`)as a
left join 
(Select Date,name,sum(
if(SUBSTRING(`start`,1,2)<12 and SUBSTRING(`end`,1,2)>12,
((SUBSTRING(`end`,1,2)*60 )+(SUBSTRING(`end`,3,2))-(SUBSTRING(`start`,1,2)*60 )-(SUBSTRING(`start`,3,2)))-60,
((SUBSTRING(`end`,1,2)*60 )+(SUBSTRING(`end`,3,2))-(SUBSTRING(`start`,1,2)*60 )-(SUBSTRING(`start`,3,2)))))
as `hour`
from detail where `class`='事假'  and `Date` like v_date group by `Date`,`name`)as b
on a.Date=b.Date and a.`Name`=b.`name`)as c
left join 
(Select Date,name,sum(
if(SUBSTRING(`start`,1,2)<12 and SUBSTRING(`end`,1,2)>12,
((SUBSTRING(`end`,1,2)*60 )+(SUBSTRING(`end`,3,2))-(SUBSTRING(`start`,1,2)*60 )-(SUBSTRING(`start`,3,2)))-60,
((SUBSTRING(`end`,1,2)*60 )+(SUBSTRING(`end`,3,2))-(SUBSTRING(`start`,1,2)*60 )-(SUBSTRING(`start`,3,2)))))
as `病假`
from detail where `class`='病假'  and `Date` like v_date group by `Date`,`name`) as d
on c.Date=d.Date and c.`Name`=d.`name` 

left join 
(Select Date,name,sum(
if(SUBSTRING(`start`,1,2)<12 and SUBSTRING(`end`,1,2)>12,
((SUBSTRING(`end`,1,2)*60 )+(SUBSTRING(`end`,3,2))-(SUBSTRING(`start`,1,2)*60 )-(SUBSTRING(`start`,3,2)))-60,
((SUBSTRING(`end`,1,2)*60 )+(SUBSTRING(`end`,3,2))-(SUBSTRING(`start`,1,2)*60 )-(SUBSTRING(`start`,3,2)))))
as `公假`
from detail where `class`='公假'  and `Date` like v_date group by `Date`,`name`) as f
on c.Date=f.Date and c.`Name`=f.`name` 
  
left join 
(Select Date,name,sum(
if(SUBSTRING(`start`,1,2)<12 and SUBSTRING(`end`,1,2)>12,
((SUBSTRING(`end`,1,2)*60 )+(SUBSTRING(`end`,3,2))-(SUBSTRING(`start`,1,2)*60 )-(SUBSTRING(`start`,3,2)))-60,
((SUBSTRING(`end`,1,2)*60 )+(SUBSTRING(`end`,3,2))-(SUBSTRING(`start`,1,2)*60 )-(SUBSTRING(`start`,3,2)))))
as `特休`
from detail where `class`='特休'  and `Date` like v_date group by `Date`,`name`) as g
on c.Date=g.Date and c.`Name`=g.`name` 


left join 
(Select Date,name,sum(
if(SUBSTRING(`start`,1,2)<12 and SUBSTRING(`end`,1,2)>12,
((SUBSTRING(`end`,1,2)*60 )+(SUBSTRING(`end`,3,2))-(SUBSTRING(`start`,1,2)*60 )-(SUBSTRING(`start`,3,2)))-60,
((SUBSTRING(`end`,1,2)*60 )+(SUBSTRING(`end`,3,2))-(SUBSTRING(`start`,1,2)*60 )-(SUBSTRING(`start`,3,2)))))
as `生理假`
from detail where `class`='生理假'  and `Date` like v_date group by `Date`,`name`) as i
on c.Date=i.Date and c.`Name`=i.`name` 

left join 
(Select Date,name,sum(
if(SUBSTRING(`start`,1,2)<12 and SUBSTRING(`end`,1,2)>12,
((SUBSTRING(`end`,1,2)*60 )+(SUBSTRING(`end`,3,2))-(SUBSTRING(`start`,1,2)*60 )-(SUBSTRING(`start`,3,2)))-60,
((SUBSTRING(`end`,1,2)*60 )+(SUBSTRING(`end`,3,2))-(SUBSTRING(`start`,1,2)*60 )-(SUBSTRING(`start`,3,2)))))
as `婚假`
from detail where `class`='婚假'  and `Date` like v_date group by `Date`,`name`) as j
on c.Date=j.Date and c.`Name`=j.`name`

left join 
(Select Date,name,sum(
if(SUBSTRING(`start`,1,2)<12 and SUBSTRING(`end`,1,2)>12,
((SUBSTRING(`end`,1,2)*60 )+(SUBSTRING(`end`,3,2))-(SUBSTRING(`start`,1,2)*60 )-(SUBSTRING(`start`,3,2)))-60,
((SUBSTRING(`end`,1,2)*60 )+(SUBSTRING(`end`,3,2))-(SUBSTRING(`start`,1,2)*60 )-(SUBSTRING(`start`,3,2)))))
as `喪假`
from detail where `class`='喪假'  and `Date` like v_date group by `Date`,`name` ) as k
on c.Date=k.Date and c.`Name`=k.`name` 
 
left join 
(Select Date,name,sum(
if(SUBSTRING(`start`,1,2)<12 and SUBSTRING(`end`,1,2)>12,
((SUBSTRING(`end`,1,2)*60 )+(SUBSTRING(`end`,3,2))-(SUBSTRING(`start`,1,2)*60 )-(SUBSTRING(`start`,3,2)))-60,
((SUBSTRING(`end`,1,2)*60 )+(SUBSTRING(`end`,3,2))-(SUBSTRING(`start`,1,2)*60 )-(SUBSTRING(`start`,3,2)))))
as `產假`
from detail where `class`='產假'  and `Date` like v_date group by `Date`,`name`) as L
on c.Date=L.Date and c.`Name`=L.`name` 

left join 
(Select Date,name,sum(
if(SUBSTRING(`start`,1,2)<12 and SUBSTRING(`end`,1,2)>12,
((SUBSTRING(`end`,1,2)*60 )+(SUBSTRING(`end`,3,2))-(SUBSTRING(`start`,1,2)*60 )-(SUBSTRING(`start`,3,2)))-60,
((SUBSTRING(`end`,1,2)*60 )+(SUBSTRING(`end`,3,2))-(SUBSTRING(`start`,1,2)*60 )-(SUBSTRING(`start`,3,2)))))
as `安胎假`
from detail where `class`='安胎假'  and `Date` like v_date group by `Date`,`name`) as M
on c.Date=M.Date and c.`Name`=M.`name` 

left join 
(Select Date,name,sum(
if(SUBSTRING(`start`,1,2)<12 and SUBSTRING(`end`,1,2)>12,
((SUBSTRING(`end`,1,2)*60 )+(SUBSTRING(`end`,3,2))-(SUBSTRING(`start`,1,2)*60 )-(SUBSTRING(`start`,3,2)))-60,
((SUBSTRING(`end`,1,2)*60 )+(SUBSTRING(`end`,3,2))-(SUBSTRING(`start`,1,2)*60 )-(SUBSTRING(`start`,3,2)))))
as `流產假`
from detail where `class`='流產假'  and `Date` like v_date group by `Date`,`name`) as P
on c.Date=P.Date and c.`Name`=P.`name` 

left join 
(Select Date,name,sum(
if(SUBSTRING(`start`,1,2)<12 and SUBSTRING(`end`,1,2)>12,
((SUBSTRING(`end`,1,2)*60 )+(SUBSTRING(`end`,3,2))-(SUBSTRING(`start`,1,2)*60 )-(SUBSTRING(`start`,3,2)))-60,
((SUBSTRING(`end`,1,2)*60 )+(SUBSTRING(`end`,3,2))-(SUBSTRING(`start`,1,2)*60 )-(SUBSTRING(`start`,3,2)))))
as `陪產假`
from detail where `class`='陪產假'  and `Date` like v_date group by `Date`,`name`) as Q
on c.Date=Q.Date and c.`Name`=Q.`name` 

left join 
(Select Date,name,sum(
if(SUBSTRING(`start`,1,2)<12 and SUBSTRING(`end`,1,2)>12,
((SUBSTRING(`end`,1,2)*60 )+(SUBSTRING(`end`,3,2))-(SUBSTRING(`start`,1,2)*60 )-(SUBSTRING(`start`,3,2)))-60,
((SUBSTRING(`end`,1,2)*60 )+(SUBSTRING(`end`,3,2))-(SUBSTRING(`start`,1,2)*60 )-(SUBSTRING(`start`,3,2)))))
as `公傷假`
from detail where `class`='公傷假'  and `Date` like v_date group by `Date`,`name`) as R
on c.Date=R.Date and c.`Name`=R.`name`

left join 
(Select Date,name,sum(
if(SUBSTRING(`start`,1,2)<12 and SUBSTRING(`end`,1,2)>12,
((SUBSTRING(`end`,1,2)*60 )+(SUBSTRING(`end`,3,2))-(SUBSTRING(`start`,1,2)*60 )-(SUBSTRING(`start`,3,2)))-60,
((SUBSTRING(`end`,1,2)*60 )+(SUBSTRING(`end`,3,2))-(SUBSTRING(`start`,1,2)*60 )-(SUBSTRING(`start`,3,2)))))
as `產檢假`
from detail where `class`='產檢假'  and `Date` like v_date group by `Date`,`name`) as S
on c.Date=S.Date and c.`Name`=S.`name`

left join 
(Select Date,name,sum(
if(SUBSTRING(`start`,1,2)<12 and SUBSTRING(`end`,1,2)>12,
((SUBSTRING(`end`,1,2)*60 )+(SUBSTRING(`end`,3,2))-(SUBSTRING(`start`,1,2)*60 )-(SUBSTRING(`start`,3,2)))-60,
((SUBSTRING(`end`,1,2)*60 )+(SUBSTRING(`end`,3,2))-(SUBSTRING(`start`,1,2)*60 )-(SUBSTRING(`start`,3,2)))))
as `無薪假颱風`
from detail where `class`='無薪假颱風'  and `Date` like v_date group by `Date`,`name`) as h
on c.Date=h.Date and c.`Name`=h.`name`

left join 
(Select Date,name,sum(
if(SUBSTRING(`start`,1,2)<12 and SUBSTRING(`end`,1,2)>12,
((SUBSTRING(`end`,1,2)*60 )+(SUBSTRING(`end`,3,2))-(SUBSTRING(`start`,1,2)*60 )-(SUBSTRING(`start`,3,2)))-60,
((SUBSTRING(`end`,1,2)*60 )+(SUBSTRING(`end`,3,2))-(SUBSTRING(`start`,1,2)*60 )-(SUBSTRING(`start`,3,2)))))
as `家庭照顧假`
from detail where `class`='家庭照顧假'  and `Date` like v_date  group by `Date`,`name`) as o
on c.Date=o.Date and c.`Name`=o.`name`

left join 
(Select Date,name,sum(
if(SUBSTRING(`start`,1,2)<12 and SUBSTRING(`end`,1,2)>12,
((SUBSTRING(`end`,1,2)*60 )+(SUBSTRING(`end`,3,2))-(SUBSTRING(`start`,1,2)*60 )-(SUBSTRING(`start`,3,2)))-60,
((SUBSTRING(`end`,1,2)*60 )+(SUBSTRING(`end`,3,2))-(SUBSTRING(`start`,1,2)*60 )-(SUBSTRING(`start`,3,2)))))
as `無薪假停電`
from detail where `class`='無薪假停電'  and `Date` like v_date  group by `Date`,`name`) as x
on c.Date=x.Date and c.`Name`=x.`name`
) as b_table
on a_table.`Date`=b_table.`Date` and a_table.name=b_table.name
group by a_table.`Date`,a_table.name;
end$$


delimiter $$

CREATE DEFINER=`root`@`%` PROCEDURE `Days_off`(v_name varchar(100),v_date varchar(100))
begin

Select
sum(`hour`)/60 as `事假`,
sum(`病假`/60) as `病假`, 
sum(`公假`)/60 as `公假`, 
sum(`特休`)/60 as `特休`, 
sum(`生理假`)/60 as `生理假`, 
sum(`婚假`)/60 as `婚假`, 
sum(`喪假`)/60 as `喪假`, 
sum(`產假`)/60 as `產假`, 
sum(`安胎假`)/60 as `安胎假`, 
sum(`流產假`)/60 as `流產假`,
sum(`陪產假`)/60 as `陪產假`,  
sum(`公傷假`)/60 as `公傷假`,  
sum(`產檢假`)/60 as `產檢假`,  
sum(`無薪假颱風`)/60 as `無薪假颱風`, 
sum(`無薪假停電`)/60 as `無薪假停電`,   
sum(`家庭照顧假`)/60 as `家庭照顧假` 
 from temp2 where `name`=v_name and `date` like v_date;
end$$


delimiter $$

CREATE DEFINER=`root`@`%` PROCEDURE `elasticity`(v_name varchar(100),v_date varchar(100),v_type int)
begin

Declare y varchar(100);

Declare z varchar(100);
Declare a varchar(100);
Declare b varchar(100);

Declare c int(100);
Declare d int(100);

Select on_duty,off_duty into a,b from work_table where `Name`=v_name;
Select min(`Time`)  into y from door_infor where `Name`=v_name and `Data`=v_date;
Select max(`Time`)  into z from door_infor where `Name`=v_name and `Data`=v_date;
Select ((SUBSTRING(a,1,2)*60 )+(SUBSTRING(a,3,2))-(SUBSTRING(y,1,2)*60 )-(SUBSTRING(y,3,2))) into c;
Select ((SUBSTRING(z,1,2)*60 )+(SUBSTRING(z,3,2))-(SUBSTRING(b,1,2)*60 )-(SUBSTRING(b,3,2))) into d;

if( c<0) then
     if(d>=c*-v_type) then
	 Update door_infor set `real_time`=y where `Name`=v_name and `Data`=v_date and `Time`=y;
     Update door_infor set `real_time`=z where `Name`=v_name and `Data`=v_date and `Time`=z;
     Update door_infor set `Time`=a where `Name`=v_name and `Data`=v_date and `Time`=y;
     Update door_infor set `Time`=b where `Name`=v_name and `Data`=v_date and `Time`=z;

  
     
	 end if;

end if;


end$$


delimiter $$

CREATE DEFINER=`root`@`%` PROCEDURE `Final_count`()
begin
Select a.*,b.`first`,c.`late`,d.`on_overtime`,e.`off_overtime` from(
Select
name,
ifnull(sum(day_off_sum)/60,0) as a,
ifnull(round(sum(out_sum)/60,1),0) as b, 
ifnull(sum(Trip_sum)/60,0) as c, 
ifnull(sum(`sum_supply`),0) as d,
if(`error`<0,ceil(sum(`error`)*-1/60),0)as e,
ifnull(sum(`hour`)/60,0) as f,
ifnull(sum(`病假`)/60,0) as g, 
ifnull(sum(`公假`)/60,0) as h, 
ifnull(sum(`特休`)/60,0) as i,
ifnull(sum(`生理假`)/60,0) as j,
ifnull(sum(`婚假`)/60,0) as k,
ifnull(sum(`喪假`)/60,0) as l,
ifnull(sum(`產假`)/60,0) as m,
ifnull(sum(`安胎假`)/60,0) as n,
ifnull(sum(`流產假`)/60,0) as o,
ifnull(sum(`陪產假`)/60,0) as p,
ifnull(sum(`公傷假`)/60,0) as q,
ifnull(sum(`產檢假`)/60,0) as r,
ifnull(sum(`無薪假`)/60,0) as s,
ifnull(sum(`家庭照顧假`),0) as w
 from  temp2 group by name)as a
left join
(
Select name,count(`name`) as `first` from temp2 where `first`<-10 group by `name`
)as b
on a.name=b.name

left join
(
Select name,count(`name`)as `late` from temp2 where `Second`<-10 group by `name`
)as c
on a.name=c.name

left join
(
SELECT `name`,ifnull(round(sum(`overtime`)/60,1),0) as on_overtime FROM  temp2 where `duty`='on' group by `name`
)as d
on a.name=d.name

left join
(
SELECT `name`,ifnull(round(sum(`overtime`)/60,1),0) as off_overtime FROM  temp2 where `duty`='off' group by `name`
)as e
on a.name=e.name;
end$$


delimiter $$

CREATE DEFINER=`root`@`%` PROCEDURE `Sum_by_detail`(v_name varchar(100),v_date varchar(100))
begin
Select 
`Date`,`day`,`duty`,`Name`,work_time,overtime,
if((work_hour)/60>8,8,if(floor((work_hour)/60)<0,0,floor((work_hour)/60))) as 'work_hour',
if(substring(overtime_hour/60,3,1)>4,concat(substring(overtime_hour/60,1,1),'.','5'),substring(overtime_hour/60,1,1)) as 'overtime_hour',
`late`,`early`,`error`,
`sum_supply`,
ceil(`有薪`/60) as '有薪',
ceil(`半薪`/60) as '半薪',
ceil(`半薪不扣全勤`/60) as '半薪不扣全勤',
ceil(`無薪扣全勤`/60) as '無薪扣全勤',
ceil(`無薪不扣全勤`/60) as '無薪不扣全勤'
from(
-- ***3
select `Date`,`day`,`duty`,`Name`,`sum_supply`,
ifnull(`late`*-1,0) as `late`,
ifnull(`early`*-1,0) as `early`,
if(`error`<0 and `duty`='on',`error`*-1,0) as `error`,
ifnull(concat(`Time`,"~",`Final`),0) as work_time,
ifnull(concat(`Start`,"~",`end`),0) as overtime,

if(SUBSTRING(`Time`,1,2)<12 and SUBSTRING(`Final`,1,2)>12 and SUBSTRING(`Final`,1,2)<18,-- 1
ifnull(((SUBSTRING(`Final`,1,2)*60 )+(SUBSTRING(`Final`,3,2))-(SUBSTRING(`Time`,1,2)*60 )-(SUBSTRING(`Time`,3,2)))-60,0),

if(SUBSTRING(`Time`,1,2)<12 and SUBSTRING(`Final`,1,2)>12 and SUBSTRING(`Final`,1,2)>18
,ifnull(((SUBSTRING('1700',1,2)*60 )+(SUBSTRING('1700',3,2))-(SUBSTRING(`Time`,1,2)*60 )-(SUBSTRING(`Time`,3,2)))-60,0)
,if(SUBSTRING(`Time`,1,2)>0,
ifnull(((SUBSTRING('1700',1,2)*60 )+(SUBSTRING('1700',3,2))-(SUBSTRING(`Time`,1,2)*60 )-(SUBSTRING(`Time`,3,2))),0)
,0)
) 

) as work_hour,-- 1
ifnull(((SUBSTRING(`End`,1,2)*60 )+(SUBSTRING(`End`,3,2))-(SUBSTRING(`Start`,1,2)*60 )-(SUBSTRING(`Start`,3,2))),0) as overtime_hour,
(ifnull(`公假`,0)+ifnull(`婚假`,0)+ifnull(`喪假`,0)+ifnull(`產假`,0)+ifnull(`產檢假`,0)+ifnull(`陪產假`,0)+ifnull(`公傷假`,0)) as '有薪',
(ifnull(`病假`,0)+ifnull(`安胎假`,0)+ifnull(`流產假`,0)) as '半薪',
ifnull(`生理假`,0) as '半薪不扣全勤',
ifnull(`hour`,0) as '無薪扣全勤'
,(ifnull(`無薪假颱風`,0)+ifnull(`無薪假停電`,0)+ifnull(`家庭照顧假`,0)) as '無薪不扣全勤'
from (
-- **2
Select * from (
-- **1
Select a.*,b.`Start`,b.`end`,c.`late`,d.`early` from(
SELECT *
 FROM leaves.temp2 where `name`=v_name and `Date` like v_date order by `date` asc) as a

left join
(Select * from detail where `item`='加班' and `Name`=v_name and `Date` like v_date ) as b

on a.`Date`=b.`Date` and a.`Name`=b.`Name` 

left join 
(Select  `Date`,`name`,`first` as `late` from temp2 where `first`>-10 and `first`<0 group by `Date`,`name`) as c
on a.`name`=c.`name` and a.`Date`=c.`Date`

left join 
(Select`Date`, `name`,`Second` as `early` from temp2 where `Second`>-10 and `Second`<0 group by `Date`,`name`) as d

on a.`name`=d.`name` and a.`Date`=d.`Date`

)as e group by `Date`,`name` )-- ***1

as f -- ***2
) as g ;-- ***3



end$$


delimiter $$

CREATE DEFINER=`root`@`%` PROCEDURE `supply`(v_no varchar(100),v_type varchar(100))
begin
Declare x varchar(100) default '0';
Declare y varchar(100);
Declare z varchar(100);
Select `name` ,DATE_FORMAT(`start_date`,'%Y%m%d')-19110000 into y,z from holiday_detail where `index`=v_no limit 1;
Select count(`index`) into x from door_infor where `Data`=y and `Name`=z;
if x=0 then
   if v_type='上班' then

   Insert into door_infor (`Data`,`Time`,`Station`,`Door`,`Name`,`supply`) values(z,'0800','001','001',y,'1');

   elseif v_type='下班' then

   Insert into door_infor (`Data`,`Time`,`Station`,`Door`,`Name`,`supply`) values(z,'1700','001','001',y,'1');

   else
   Insert into door_infor (`Data`,`Time`,`Station`,`Door`,`Name`,`supply`) values(z,'0800','001','001',y,'1');
   Insert into door_infor (`Data`,`Time`,`Station`,`Door`,`Name`,`supply`) values(z,'1700','001','001',y,'1');
   end if;

end if;


end$$


delimiter $$

CREATE DEFINER=`root`@`%` PROCEDURE `Test`(dept varchar(100) )
BEGIN

UPDATE work_day SET `Day`=
 CASE
  WHEN `Day`='1' THEN '一'
  WHEN `Day`='2' THEN '二'
  WHEN `Day`='3' THEN '三'
  WHEN `Day`='4' THEN '四'
  WHEN `Day`='5' THEN '五'
  WHEN `Day`='6' THEN '六'
  WHEN `Day`='7' THEN '日'
  ELSE `Day`
 END;
END$$


delimiter $$

CREATE DEFINER=`root`@`%` PROCEDURE `View_Detail`(_Dept varchar(100),_Start varchar(100),_End varchar(100),_Member varchar(100))
BEGIN


if(_Member='All') then
    Select a.*,member.`name` from (
	SELECT * FROM  timesheet where `ID` in (Select `Job_n` from member where `Dept` =_Dept)
	and `Date` between DATE_FORMAT(_Start, '%Y-%m-%d') and DATE_FORMAT(_End, '%Y-%m-%d')) as a
	left join member 
	on member.`id`=a.`id` order by `Date`,`ID`;


else 

     Select a.*,member.`name` from (
	SELECT * FROM  timesheet where `ID` in (Select `Job_n` from member where `Dept` =_Dept)
	and `Date` between   DATE_FORMAT(_Start, '%Y-%m-%d') and DATE_FORMAT(_End, '%Y-%m-%d') and id=_Member ) as a
	left join member 
	on member.`id`=a.`id` order by `Date`,`ID`;


end if;


END$$


