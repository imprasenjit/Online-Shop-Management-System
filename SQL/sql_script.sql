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
