ALTER TABLE `settings` CHANGE `key` `key` ENUM('PDF_HEADER','PDF_FOOTER','COLOR','BANK_DETAILS') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;
INSERT INTO `settings` (`settings_id`, `key`, `values`, `created_at`, `created_by`, `updated_at`, `updated_by`, `status`) VALUES (NULL, 'BANK_DETAILS', 'Bank Details', CURRENT_TIMESTAMP, '', '0000-00-00 00:00:00.000000', NULL, '1');
