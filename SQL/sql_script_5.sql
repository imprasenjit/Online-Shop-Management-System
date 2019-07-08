ALTER TABLE `invoice_details_from_supplier` ADD `driver_name` VARCHAR(100) NULL DEFAULT NULL AFTER `lorry_date`, ADD `driver_contact` VARCHAR(11) NULL DEFAULT NULL AFTER `driver_name`;
