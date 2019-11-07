CREATE TABLE `emp_master`(
  `emp_code` int(11) NOT NULL,
  `emp_name` varchar(20) NOT NULL,
  `wiw_id` varchar(20) NOT NULL,
  `emea_id` varchar(20) NOT NULL,
  `email_id` varchar(20) NOT NULL,
  `doj` date NOT NULL,
  `contact_no` decimal(10,0) DEFAULT NULL,
  `manager` varchar(20) DEFAULT NULL,
  `cost_center` int(11) NOT NULL,
  `designation` varchar(25) NOT NULL,
  `grade` enum('L1','L2','L3','L4','L5') NOT NULL,
  `department` varchar(25) NOT NULL DEFAULT 'Delivery',
  `is_manager` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`emp_code`),
  UNIQUE KEY `wiw_id` (`wiw_id`),
  UNIQUE KEY `emea_id` (`emea_id`),
  UNIQUE KEY `email_id` (`email_id`),
  KEY `manager` (`manager`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 

  