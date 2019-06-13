CREATE TABLE `aboutus` (
  `aboutus_id` int(11) NOT NULL,
  `aboutus_content` text,
  `aboutus_img` varchar(255) DEFAULT NULL,
  `aboutus_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `admin_login` (
  `id` int(11) NOT NULL,
  `role_id` int(5) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `mobile` varchar(12) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(10) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `admin_roles` (
  `role_id` int(10) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `rights` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `associated_brands` (
  `id` int(11) NOT NULL,
  `name` varchar(355) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `picture` varchar(455) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `attribute` (
  `id` int(11) NOT NULL,
  `product_id` varchar(355) DEFAULT NULL,
  `attr1` varchar(1000) DEFAULT NULL,
  `attr2` varchar(1000) DEFAULT NULL,
  `attr3` varchar(1000) DEFAULT NULL,
  `attr4` varchar(1000) DEFAULT NULL,
  `attr5` varchar(1000) DEFAULT NULL,
  `attr6` varchar(1000) DEFAULT NULL,
  `attr7` varchar(1000) DEFAULT NULL,
  `attr8` varchar(1000) DEFAULT NULL,
  `attr9` varchar(1000) DEFAULT NULL,
  `attr10` varchar(1000) DEFAULT NULL,
  `attribute_order` int(55) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `reg_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(355) DEFAULT NULL,
  `contact` varchar(10) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` text NOT NULL,
  `gst_no` varchar(255) DEFAULT NULL,
  `pan_no` varchar(355) DEFAULT NULL,
  `password` varchar(355) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `downloads` (
  `download_id` int(11) NOT NULL,
  `entry_time` timestamp NULL DEFAULT NULL,
  `download_title` varchar(300) DEFAULT NULL,
  `download_description` varchar(500) DEFAULT NULL,
  `download_file` varchar(255) DEFAULT NULL,
  `download_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `emails` (
  `id` int(11) NOT NULL,
  `email` varchar(300) DEFAULT NULL,
  `email_verify_code` varchar(355) DEFAULT NULL,
  `entry_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `enquires` (
  `enquiry_id` int(11) NOT NULL,
  `enquiry_placed_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `customerid` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(355) DEFAULT NULL,
  `address` varchar(355) DEFAULT NULL,
  `state` varchar(55) NOT NULL,
  `contact` varchar(11) DEFAULT NULL,
  `unique_id` varchar(300) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1' COMMENT '1- exist , 0 -deleted'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `enquiry_detail` (
  `enquiry_detail_id` int(11) NOT NULL,
  `enquiry_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `enquiry_id` int(11) DEFAULT NULL,
  `productid` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `product_unit` varchar(255) DEFAULT NULL,
  `others` varchar(500) NOT NULL,
  `attributes` varchar(1000) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `events` (
  `events_id` int(11) NOT NULL,
  `event_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `event_name` varchar(355) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `name` varchar(355) DEFAULT NULL,
  `email` varchar(355) DEFAULT NULL,
  `contact` varchar(11) DEFAULT NULL,
  `address` varchar(455) DEFAULT NULL,
  `message` varchar(1000) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `activation_status` int(55) NOT NULL DEFAULT '0' COMMENT '0-Deactivated,1-Activated',
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `home_page_slider` (
  `slider_id` int(10) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `file_path` varchar(500) NOT NULL,
  `display_order` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `invoice_details_from_supplier` (
  `invoice_details_from_supplier_id` int(11) NOT NULL,
  `purchase_order_to_supplier_id` int(55) NOT NULL,
  `company_name` varchar(500) NOT NULL,
  `invoice_no` varchar(500) NOT NULL,
  `invoice_date` date DEFAULT NULL,
  `lorry_no` varchar(500) NOT NULL,
  `lorry_date` date DEFAULT NULL,
  `invoice_doc` varchar(500) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(55) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `send_from` varchar(355) DEFAULT NULL,
  `send_to` varchar(355) DEFAULT NULL,
  `subject` varchar(355) DEFAULT NULL,
  `message` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_category` varchar(255) DEFAULT NULL,
  `product_sub_category` varchar(255) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `weight_chart` longtext NOT NULL,
  `tax_rate` int(55) DEFAULT '18',
  `hsn_code` varchar(255) DEFAULT NULL,
  `attributes` varchar(1000) DEFAULT NULL,
  `picture` varchar(1000) DEFAULT NULL,
  `specification` varchar(1000) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1' COMMENT '0-out of stock, 1 -In stock'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `products_new` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_category` varchar(255) DEFAULT NULL,
  `product_sub_category` varchar(255) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `tax_rate` int(55) DEFAULT NULL,
  `attributes` varchar(1000) DEFAULT NULL,
  `picture` varchar(1000) DEFAULT NULL,
  `specification` varchar(1000) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1' COMMENT '0-out of stock, 1 -In stock'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `product_category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(455) DEFAULT NULL,
  `description` varchar(455) DEFAULT NULL,
  `picture` varchar(1000) DEFAULT NULL,
  `status` enum('0','1') DEFAULT NULL COMMENT '1-exist,0-not exist'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `product_sub_category` (
  `id` int(11) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `sub_category` varchar(355) DEFAULT NULL,
  `description` varchar(455) DEFAULT NULL,
  `picture` varchar(1000) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1' COMMENT '0-does not-exist,1-exist'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `proforma_invoice` (
  `porforma_invoice_id` int(11) NOT NULL,
  `purchase_order_id` int(55) DEFAULT NULL,
  `customer_id` int(55) DEFAULT NULL,
  `pro_inv_no` int(12) DEFAULT NULL,
  `products` varchar(2000) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `product_unit` varchar(500) NOT NULL,
  `attributes` varchar(1000) DEFAULT NULL,
  `others` varchar(1000) NOT NULL,
  `product_price` varchar(500) DEFAULT NULL,
  `tax_rate` varchar(500) NOT NULL,
  `cgst` varchar(355) DEFAULT NULL,
  `sgst` varchar(355) DEFAULT NULL,
  `igst` varchar(355) DEFAULT NULL,
  `exyard` varchar(355) DEFAULT NULL,
  `frieght` varchar(355) DEFAULT NULL,
  `total` varchar(500) NOT NULL,
  `editordata` longtext NOT NULL,
  `editordata2` longtext NOT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `purchase_order_to_admin` (
  `potoadmin_id` int(11) NOT NULL,
  `customer_id` int(55) NOT NULL,
  `quotation_id` int(55) NOT NULL,
  `billing_address` text,
  `billing_state` varchar(50) NOT NULL,
  `delivery_address` varchar(1000) NOT NULL,
  `contact_person_name` varchar(255) NOT NULL,
  `contact_person_mobile` varchar(255) NOT NULL,
  `product` varchar(500) NOT NULL,
  `attributes` varchar(1000) NOT NULL,
  `others` varchar(1000) NOT NULL,
  `quantity` varchar(500) NOT NULL,
  `unit` varchar(500) NOT NULL,
  `price` varchar(500) NOT NULL,
  `tax_rate` varchar(255) NOT NULL,
  `cgst` varchar(500) NOT NULL,
  `sgst` varchar(500) NOT NULL,
  `igst` varchar(500) NOT NULL,
  `exyard` varchar(500) NOT NULL,
  `frieght` varchar(500) NOT NULL,
  `total` varchar(500) NOT NULL,
  `status` int(5) NOT NULL DEFAULT '1',
  `order_status` int(55) NOT NULL DEFAULT '1' COMMENT 'This field for getting the status of po either it is canceled by admin',
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `purchase_order_to_supplier` (
  `purchase_order_supplier_id` int(11) NOT NULL,
  `supplier_id` int(55) DEFAULT NULL,
  `purchase_order_from_customer_id` int(55) DEFAULT NULL,
  `customer_id` int(55) DEFAULT NULL,
  `invoice_status` int(5) DEFAULT NULL COMMENT 'null=new,1=invoice_sent',
  `invoice_id` int(55) DEFAULT NULL,
  `warehouse_user_id` int(55) DEFAULT NULL,
  `send_to_warehouse_status` int(55) DEFAULT NULL COMMENT 'null=not sent,1=sent',
  `send_to_warehouse_time` timestamp NULL DEFAULT NULL,
  `goods_dispatch_status` int(55) DEFAULT NULL COMMENT 'null=not dispatched,1=dispatched',
  `goods_dispatch_time` timestamp NULL DEFAULT NULL,
  `products` varchar(2000) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `product_unit` varchar(500) NOT NULL,
  `attributes` varchar(1000) DEFAULT NULL,
  `others` varchar(1000) NOT NULL,
  `product_price` varchar(500) DEFAULT NULL,
  `tax_rate` varchar(1000) NOT NULL,
  `cgst` varchar(355) DEFAULT NULL,
  `sgst` varchar(355) DEFAULT NULL,
  `igst` varchar(355) DEFAULT NULL,
  `exyard` varchar(355) DEFAULT NULL,
  `frieght` varchar(355) DEFAULT NULL,
  `total` varchar(500) NOT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `quotation` (
  `quotation_id` int(11) NOT NULL,
  `quotation_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `enquiry_id` int(11) DEFAULT NULL,
  `customer_id` int(255) DEFAULT NULL,
  `productid` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `product_unit` varchar(255) DEFAULT NULL,
  `attributes` varchar(1000) DEFAULT NULL,
  `others` varchar(500) DEFAULT NULL,
  `editordata` varchar(2000) DEFAULT NULL,
  `editordata2` varchar(2000) DEFAULT NULL,
  `product_price` varchar(1000) DEFAULT NULL,
  `tax_rate` varchar(500) NOT NULL,
  `cgst` varchar(255) DEFAULT NULL,
  `sgst` varchar(255) DEFAULT NULL,
  `igst` varchar(255) DEFAULT NULL,
  `exyard` varchar(255) DEFAULT NULL,
  `frieght` varchar(255) DEFAULT NULL,
  `total` varchar(500) NOT NULL,
  `status` enum('0','1') DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `services` (
  `service_id` int(11) NOT NULL,
  `name` varchar(355) DEFAULT NULL,
  `email` varchar(355) DEFAULT NULL,
  `contact` int(11) DEFAULT NULL,
  `company` varchar(355) DEFAULT NULL,
  `message` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `settings` (
  `settings_id` int(10) NOT NULL,
  `key` enum('PDF_HEADER','PDF_FOOTER','COLOR') DEFAULT NULL,
  `values` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `smes` (
  `sme_id` int(11) NOT NULL,
  `entry_time` timestamp NULL DEFAULT NULL,
  `sme_name` varchar(255) DEFAULT NULL,
  `sme_mobile` bigint(10) DEFAULT NULL,
  `sme_email` varchar(100) DEFAULT NULL,
  `sme_state` varchar(200) DEFAULT NULL,
  `sme_district` varchar(255) DEFAULT NULL,
  `sme_msg` text,
  `sme_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `states` (
  `state_id` int(11) NOT NULL,
  `state_name` varchar(300) DEFAULT NULL,
  `state_code` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `suppliers` (
  `supplier_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `status` int(55) DEFAULT '1',
  `state` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `transporters` (
  `transporter_id` int(11) NOT NULL,
  `transporter_name` varchar(255) DEFAULT NULL,
  `transporter_mobile` bigint(10) DEFAULT NULL,
  `transporter_email` varchar(100) DEFAULT NULL,
  `transporter_address` varchar(300) DEFAULT NULL,
  `transporter_gst` float DEFAULT NULL,
  `transporter_pass` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `transporter_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `useractivities` (
  `activity_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `activity_time` timestamp NULL DEFAULT NULL,
  `activity` varchar(255) DEFAULT NULL,
  `utype` enum('admin','supplier','warehouse') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `warehouse_user` (
  `warehouse_user_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `status` int(55) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


ALTER TABLE `aboutus`
  ADD PRIMARY KEY (`aboutus_id`);

ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `admin_roles`
  ADD PRIMARY KEY (`role_id`);

ALTER TABLE `associated_brands`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `attribute`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `downloads`
  ADD PRIMARY KEY (`download_id`);

ALTER TABLE `emails`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `enquires`
  ADD PRIMARY KEY (`enquiry_id`);

ALTER TABLE `enquiry_detail`
  ADD PRIMARY KEY (`enquiry_detail_id`);

ALTER TABLE `events`
  ADD PRIMARY KEY (`events_id`);

ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`);

ALTER TABLE `home_page_slider`
  ADD PRIMARY KEY (`slider_id`);

ALTER TABLE `invoice_details_from_supplier`
  ADD PRIMARY KEY (`invoice_details_from_supplier_id`);

ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `products_new`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `product_category`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `product_sub_category`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `proforma_invoice`
  ADD PRIMARY KEY (`porforma_invoice_id`);

ALTER TABLE `purchase_order_to_admin`
  ADD PRIMARY KEY (`potoadmin_id`);

ALTER TABLE `purchase_order_to_supplier`
  ADD PRIMARY KEY (`purchase_order_supplier_id`);

ALTER TABLE `quotation`
  ADD PRIMARY KEY (`quotation_id`);

ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

ALTER TABLE `settings`
  ADD PRIMARY KEY (`settings_id`);

ALTER TABLE `smes`
  ADD PRIMARY KEY (`sme_id`);

ALTER TABLE `states`
  ADD PRIMARY KEY (`state_id`);

ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplier_id`);

ALTER TABLE `transporters`
  ADD PRIMARY KEY (`transporter_id`);

ALTER TABLE `useractivities`
  ADD PRIMARY KEY (`activity_id`);

ALTER TABLE `warehouse_user`
  ADD PRIMARY KEY (`warehouse_user_id`);


ALTER TABLE `aboutus`
  MODIFY `aboutus_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `admin_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `admin_roles`
  MODIFY `role_id` int(10) NOT NULL AUTO_INCREMENT;

ALTER TABLE `associated_brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `attribute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `downloads`
  MODIFY `download_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `enquires`
  MODIFY `enquiry_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `enquiry_detail`
  MODIFY `enquiry_detail_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `events`
  MODIFY `events_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `home_page_slider`
  MODIFY `slider_id` int(10) NOT NULL AUTO_INCREMENT;

ALTER TABLE `invoice_details_from_supplier`
  MODIFY `invoice_details_from_supplier_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `products_new`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `product_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `product_sub_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `proforma_invoice`
  MODIFY `porforma_invoice_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `purchase_order_to_admin`
  MODIFY `potoadmin_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `purchase_order_to_supplier`
  MODIFY `purchase_order_supplier_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `quotation`
  MODIFY `quotation_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `settings`
  MODIFY `settings_id` int(10) NOT NULL AUTO_INCREMENT;

ALTER TABLE `smes`
  MODIFY `sme_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `states`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `suppliers`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `transporters`
  MODIFY `transporter_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `useractivities`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `warehouse_user`
  MODIFY `warehouse_user_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

CREATE TABLE `home_page_slider`(
  `slider_id` int(10) AUTO_INCREMENT,
  `description` VARCHAR(255) DEFAULT NULL,
  `name` VARCHAR(100) DEFAULT NULL,
  `file_path` TEXT NOT NULL,
  `created_at`  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` INT(11) NOT NULL,
  `updated_at` TIMESTAMP DEFAULT 0,
  `updated_by` INT(11) DEFAULT NULL,
  `status` TINYINT(1) DEFAULT '1',
   primary key(`slider_id`)
);
CREATE TABLE `admin_roles`(
  `role_id` int(10) AUTO_INCREMENT,
  `name` VARCHAR(100) DEFAULT NULL,
  `rights` TEXT NOT NULL,
  `created_at`  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` INT(11) NOT NULL,
  `updated_at` TIMESTAMP DEFAULT 0,
  `updated_by` INT(11) DEFAULT NULL,
  `status` TINYINT(1) DEFAULT '1',
   primary key(`role_id`)
);
CREATE TABLE `settings`(
  `settings_id` int(10) AUTO_INCREMENT,
  `key` enum ('PDF_HEADER','PDF_FOOTER',"COLOR"),
  `values` TEXT NOT NULL,
  `created_at`  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` INT(11) NOT NULL,
  `updated_at` TIMESTAMP DEFAULT 0,
  `updated_by` INT(11) DEFAULT NULL,
  `status` TINYINT(1) DEFAULT '1',
   primary key(`settings_id`)
);
CREATE TABLE `blogs`(
  `blogs_id` int(10) AUTO_INCREMENT,
  `blog_title` TEXT NOT NULL,
  `short_description` TEXT NOT NULL,
  `blog` TEXT NOT NULL,
  `image` TEXT DEFAULT NULL,
  `created_at`  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` INT(11) NOT NULL,
  `updated_at` TIMESTAMP DEFAULT 0,
  `updated_by` INT(11) DEFAULT NULL,
  `status` TINYINT(1) DEFAULT '1',
   primary key(`blogs_id`)
);
ALTER TABLE `blogs` ADD `is_published` TINYINT(1) NOT NULL DEFAULT '0' AFTER `image`;
ALTER TABLE `blogs` ADD `tags` TEXT NULL DEFAULT NULL AFTER `is_published`;
CREATE TABLE `rights`(
  `rights_id` int(10) AUTO_INCREMENT,
  `controller_name` VARCHAR(30) NOT NULL,
  `method_name` VARCHAR(30) NOT NULL,
  `display_name` VARCHAR(30) NOT NULL,
  `created_at`  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT 0,
  `status` TINYINT(1) DEFAULT '1',
   primary key(`rights_id`)
);
