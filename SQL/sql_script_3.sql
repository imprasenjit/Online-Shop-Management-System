CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `entry_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `company_name` varchar(255) DEFAULT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `designation` varchar(50) DEFAULT NULL,
  `conatct_no` varchar(12) DEFAULT NULL,
  `contact_email` varchar(50) DEFAULT NULL,
  `product_manufactured` varchar(255) DEFAULT NULL,
  `office_address` varchar(255) DEFAULT NULL,
  `factory_address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
