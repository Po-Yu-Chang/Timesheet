delimiter $$

CREATE TABLE `announcement` (
  `index` int(10) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `classname` varchar(50) DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` varchar(8000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `editor` varchar(255) DEFAULT NULL,
  `status` int(6) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`index`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8$$


delimiter $$

CREATE TABLE `back_reason` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `Date` varchar(45) DEFAULT NULL,
  `id` varchar(45) DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB AUTO_INCREMENT=701 DEFAULT CHARSET=utf8$$


delimiter $$

CREATE TABLE `cash` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(45) DEFAULT NULL,
  `row_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8$$


delimiter $$

CREATE TABLE `cash_unit` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(45) DEFAULT NULL,
  `row_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8$$


delimiter $$

CREATE TABLE `child_item` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `Machine` varchar(45) DEFAULT NULL,
  `Dept` varchar(45) DEFAULT NULL,
  `Item` varchar(45) DEFAULT NULL,
  `Child_item` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB AUTO_INCREMENT=417 DEFAULT CHARSET=utf8$$


delimiter $$

CREATE TABLE `client` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `Client` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8$$


delimiter $$

CREATE TABLE `data_sequence` (
  `table` varchar(255) NOT NULL,
  `data_index` int(255) NOT NULL,
  `order_no` int(11) DEFAULT NULL,
  `color` varchar(255) DEFAULT '#',
  PRIMARY KEY (`table`,`data_index`) USING BTREE,
  UNIQUE KEY `DATA_UNIQUE` (`table`,`data_index`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8$$


delimiter $$

CREATE TABLE `dept` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `Dept` varchar(45) DEFAULT NULL,
  `Dept_n` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8$$


delimiter $$

CREATE TABLE `detail` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `h_index` varchar(45) DEFAULT NULL,
  `Date` varchar(45) DEFAULT NULL,
  `Start` varchar(45) DEFAULT NULL,
  `End` varchar(45) DEFAULT NULL,
  `Item` varchar(45) DEFAULT NULL,
  `Name` varchar(45) DEFAULT NULL,
  `ID` varchar(45) DEFAULT NULL,
  `Class` varchar(45) DEFAULT NULL,
  `Sign(L)` varchar(45) DEFAULT NULL,
  `Sign(HR)` varchar(45) DEFAULT NULL,
  `time` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB AUTO_INCREMENT=89936 DEFAULT CHARSET=utf8$$


delimiter $$

CREATE TABLE `door_infor` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `Data` varchar(100) DEFAULT NULL,
  `Time` varchar(100) DEFAULT NULL,
  `Station` varchar(100) DEFAULT NULL,
  `Door` varchar(100) DEFAULT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `supply` varchar(45) DEFAULT '',
  `h_index` varchar(45) DEFAULT NULL,
  `real_time` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB AUTO_INCREMENT=3212168 DEFAULT CHARSET=utf8$$


delimiter $$

CREATE TABLE `due_item` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `Machine` varchar(45) DEFAULT NULL,
  `Dept` varchar(45) DEFAULT NULL,
  `Item` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB AUTO_INCREMENT=204 DEFAULT CHARSET=utf8$$


delimiter $$

CREATE TABLE `elasticity` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8$$


delimiter $$

CREATE TABLE `holiday` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `Class` varchar(45) DEFAULT NULL,
  `Name` varchar(45) DEFAULT NULL,
  `Day` int(11) DEFAULT NULL,
  `Pay` int(11) DEFAULT NULL,
  `attendance` int(11) DEFAULT NULL,
  `expiry_date` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8$$


delimiter $$

CREATE TABLE `holiday_detail` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `item` varchar(45) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `id` varchar(45) DEFAULT NULL,
  `job_n` varchar(45) DEFAULT NULL,
  `start_date` varchar(45) DEFAULT NULL,
  `end_date` varchar(45) DEFAULT NULL,
  `hour` varchar(45) DEFAULT NULL,
  `year` varchar(45) DEFAULT NULL,
  `class` varchar(45) DEFAULT NULL,
  `class_name` varchar(45) DEFAULT NULL,
  `reason` varchar(100) DEFAULT NULL,
  `time` varchar(45) NOT NULL DEFAULT '',
  `back` varchar(45) DEFAULT NULL,
  `signoff(L)` varchar(45) NOT NULL DEFAULT '',
  `signoff(HR)` varchar(45) NOT NULL DEFAULT '',
  `other` varchar(45) NOT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB AUTO_INCREMENT=18532 DEFAULT CHARSET=utf8$$


delimiter $$

CREATE TABLE `log` (
  `index` int(11) NOT NULL DEFAULT '0',
  `action` varchar(45) DEFAULT NULL,
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `id` varchar(45) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8$$


delimiter $$

CREATE TABLE `machine` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `Machine` varchar(45) NOT NULL,
  `hardcode` varchar(255) DEFAULT NULL,
  `dept` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`index`,`Machine`),
  UNIQUE KEY `Machine_UNIQUE` (`Machine`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8$$

CREATE
DEFINER=`root`@`%`
TRIGGER `leaves`.`new_data_sequence`
AFTER INSERT ON `leaves`.`machine`
FOR EACH ROW
INSERT INTO data_sequence (`table`, data_index, order_no, color) 
VALUES ('machine', NEW.`index` , 99, 'E5E5E5')
$$


delimiter $$

CREATE TABLE `machine_number` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `Machine` varchar(45) DEFAULT NULL,
  `Machine_Number` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`index`),
  UNIQUE KEY `Machine_Number_UNIQUE` (`Machine_Number`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8$$


delimiter $$

CREATE TABLE `member` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `Dept` varchar(45) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `Card_n` varchar(45) DEFAULT NULL,
  `Job_n` varchar(45) DEFAULT NULL,
  `id` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `level` varchar(255) DEFAULT NULL COMMENT '管理系統用',
  `leavel` varchar(45) DEFAULT 'user' COMMENT '工時系統用',
  `leader` varchar(45) DEFAULT NULL,
  `leader_id` varchar(45) DEFAULT NULL,
  `F_d` varchar(45) DEFAULT NULL,
  `L_d` varchar(45) DEFAULT NULL,
  `Stay_s` varchar(45) DEFAULT NULL,
  `Stay_e` varchar(45) DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `state` varchar(45) DEFAULT '在職',
  `mail` varchar(45) DEFAULT NULL,
  `agent` varchar(45) DEFAULT '0',
  `free` varchar(45) DEFAULT 'no',
  `company` varchar(45) DEFAULT NULL,
  `area` int(255) DEFAULT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB AUTO_INCREMENT=180 DEFAULT CHARSET=utf8$$


delimiter $$

CREATE TABLE `member_dept` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` varchar(50) DEFAULT NULL,
  `Dept` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`index`),
  KEY `member_idx` (`member_id`),
  KEY `dept_idx` (`Dept`)
) ENGINE=InnoDB AUTO_INCREMENT=146 DEFAULT CHARSET=utf8$$


delimiter $$

CREATE TABLE `member_role` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) DEFAULT NULL,
  `page_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`index`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1079 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC$$


delimiter $$

CREATE TABLE `page` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) DEFAULT NULL,
  `page_name` varchar(50) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`index`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC$$


delimiter $$

CREATE TABLE `project` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `Project_Name` varchar(45) DEFAULT NULL,
  `Project_Number` varchar(45) DEFAULT NULL,
  `Machine` varchar(45) DEFAULT NULL,
  `Machine_Number` varchar(45) DEFAULT NULL,
  `Start_date` varchar(45) DEFAULT NULL,
  `End_date` varchar(45) DEFAULT NULL,
  `State` varchar(45) DEFAULT NULL,
  `apply` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB AUTO_INCREMENT=453 DEFAULT CHARSET=utf8$$


delimiter $$

CREATE TABLE `project_item` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `project_name` varchar(45) DEFAULT NULL,
  `Machine` varchar(45) DEFAULT NULL,
  `Dept` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB AUTO_INCREMENT=317 DEFAULT CHARSET=utf8$$


delimiter $$

CREATE TABLE `temp` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `class` varchar(45) DEFAULT NULL,
  `On_duty` varchar(45) DEFAULT NULL,
  `off_duty` varchar(45) DEFAULT NULL,
  `Date` varchar(45) DEFAULT NULL,
  `Day` varchar(45) DEFAULT NULL,
  `duty` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB AUTO_INCREMENT=4721144 DEFAULT CHARSET=utf8$$


delimiter $$

CREATE TABLE `temp2` (
  `Date` varchar(45) NOT NULL DEFAULT '',
  `Name` varchar(45) NOT NULL DEFAULT '',
  `Time` varchar(100) NOT NULL DEFAULT '',
  `Final` varchar(100) NOT NULL DEFAULT '',
  `first` double NOT NULL DEFAULT '0',
  `Second` double NOT NULL DEFAULT '0',
  `sum_supply` double NOT NULL DEFAULT '0',
  `r_min` varchar(100) NOT NULL DEFAULT '',
  `r_max` varchar(100) NOT NULL DEFAULT '',
  `duty` varchar(45) NOT NULL DEFAULT '',
  `day` varchar(45) NOT NULL DEFAULT '',
  `day_off` varchar(45) NOT NULL DEFAULT '',
  `day_off_sum` double NOT NULL DEFAULT '0',
  `out` varchar(45) NOT NULL DEFAULT '',
  `out_sum` double NOT NULL DEFAULT '0',
  `Trip` varchar(45) NOT NULL DEFAULT '',
  `Trip_sum` double NOT NULL DEFAULT '0',
  `Overtime` varchar(2) NOT NULL DEFAULT '',
  `Overtime_sum` double NOT NULL DEFAULT '0',
  `error` double NOT NULL DEFAULT '0',
  `hour` double NOT NULL DEFAULT '0',
  `病假` double NOT NULL DEFAULT '0',
  `公假` double NOT NULL DEFAULT '0',
  `特休` double NOT NULL DEFAULT '0',
  `生理假` double NOT NULL DEFAULT '0',
  `婚假` double NOT NULL DEFAULT '0',
  `喪假` double NOT NULL DEFAULT '0',
  `產假` double NOT NULL DEFAULT '0',
  `安胎假` double NOT NULL DEFAULT '0',
  `流產假` double NOT NULL DEFAULT '0',
  `陪產假` double NOT NULL DEFAULT '0',
  `公傷假` double NOT NULL DEFAULT '0',
  `產檢假` double NOT NULL DEFAULT '0',
  `無薪假颱風` double NOT NULL DEFAULT '0',
  `無薪假停電` double NOT NULL DEFAULT '0',
  `家庭照顧假` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8$$


delimiter $$

CREATE TABLE `test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `num` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8$$


delimiter $$

CREATE TABLE `timesheet` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `Date` varchar(45) DEFAULT NULL,
  `ID` varchar(45) DEFAULT NULL,
  `Machine` varchar(45) DEFAULT NULL,
  `Project` varchar(45) DEFAULT NULL,
  `Project_Item` varchar(45) DEFAULT NULL,
  `child_item` varchar(45) DEFAULT NULL,
  `Normal` varchar(45) DEFAULT NULL,
  `Overtime` varchar(45) DEFAULT NULL,
  `start` varchar(45) DEFAULT NULL,
  `end` varchar(45) DEFAULT NULL,
  `color` varchar(45) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `Supply` varchar(45) DEFAULT 'Hold',
  `Reason` varchar(45) DEFAULT '',
  `Client` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB AUTO_INCREMENT=207730 DEFAULT CHARSET=utf8$$


delimiter $$

CREATE TABLE `trip` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `area` varchar(45) DEFAULT NULL,
  `lunch` varchar(45) DEFAULT NULL,
  `dinner` varchar(45) DEFAULT NULL,
  `Petty_Cash` varchar(45) DEFAULT NULL,
  `unit` varchar(45) DEFAULT NULL,
  `Subsidy` varchar(45) DEFAULT NULL,
  `Stay` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8$$


delimiter $$

CREATE TABLE `trip_detail` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `h_index` varchar(45) DEFAULT NULL,
  `date` varchar(45) DEFAULT NULL,
  `id` varchar(45) DEFAULT NULL,
  `item` varchar(45) DEFAULT NULL,
  `cash` varchar(45) DEFAULT '0',
  `year` varchar(45) DEFAULT NULL,
  `Location` varchar(45) DEFAULT NULL,
  `Due_Cash` varchar(45) DEFAULT NULL,
  `sign_leader` varchar(45) NOT NULL DEFAULT '',
  `sign_HR` varchar(45) NOT NULL DEFAULT '',
  `singn_chairman` varchar(45) NOT NULL DEFAULT '',
  `rate` varchar(45) NOT NULL DEFAULT '',
  `reason` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB AUTO_INCREMENT=408 DEFAULT CHARSET=utf8$$


delimiter $$

CREATE TABLE `work_day` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `Year` varchar(45) DEFAULT NULL,
  `Month` varchar(45) DEFAULT NULL,
  `Date` varchar(45) DEFAULT NULL,
  `Day` varchar(45) DEFAULT NULL,
  `duty` varchar(45) DEFAULT NULL,
  `Notes` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB AUTO_INCREMENT=3874 DEFAULT CHARSET=utf8$$


delimiter $$

CREATE TABLE `work_table` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) DEFAULT NULL,
  `Class` varchar(45) DEFAULT NULL,
  `On_duty` varchar(45) DEFAULT '0800',
  `off_duty` varchar(45) DEFAULT '1700',
  PRIMARY KEY (`index`)
) ENGINE=InnoDB AUTO_INCREMENT=133 DEFAULT CHARSET=utf8$$