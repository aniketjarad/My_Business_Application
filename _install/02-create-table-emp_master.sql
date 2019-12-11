
CREATE TABLE `users` (
  `wiw_id` varchar(20) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `last_login` date DEFAULT NULL,
  PRIMARY KEY (`wiw_id`),
  FOREIGN KEY (wiw_id) REFERENCES emp_master(wiw_id) 
  FOREIGN KEY (email_id) REFERENCES emp_master(email_id)
)


/*done*/
CREATE TABLE `certification` (
  `emp_code` int(11) NOT NULL,
  `emp_name` varchar(50) default NULL,
  `cert_name` varchar(60) NOT NULL,
  `cert_expiry` date DEFAULT '2999-12-31',
  `category` enum('ServiceNow','ITIL','Other') DEFAULT 'Other',
 FOREIGN KEY (emp_code) REFERENCES emp_master(emp_code) 
)



CREATE TABLE `emp_master` (
 `emp_code` int(11) NOT NULL,
 `emp_name` varchar(50) NOT NULL,
 `wiw_id` varchar(20) NOT NULL,
 `emea_id` varchar(25) NOT NULL,
 `email_id` varchar(50) NOT NULL,
 `doj` date NOT NULL,
 `contact_no` decimal(10,0) DEFAULT NULL,
 `manager` varchar(50) DEFAULT NULL,
 `cost_center` int(11) NOT NULL,
 `designation` varchar(50) NOT NULL,
 `grade` enum('EXT','L0','L1','L2','L3','L4','L5') NOT NULL,
 `department` varchar(25) NOT NULL DEFAULT 'Delivery',
 `active` tinyint(1) NOT NULL DEFAULT '1',
 `is_manager` tinyint(1) NOT NULL DEFAULT '0',
 PRIMARY KEY (`emp_code`),
 UNIQUE KEY `wiw_id` (`wiw_id`),
 UNIQUE KEY `emea_id` (`emea_id`),
 UNIQUE KEY `email_id` (`email_id`),
 KEY `manager` (`manager`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1




