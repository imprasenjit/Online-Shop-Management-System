ALTER TABLE `products` ADD `show_description` TINYINT(1) NOT NULL DEFAULT '0' AFTER `description`;
ALTER TABLE `products` ADD `show_weight_chart` TINYINT(1) NOT NULL DEFAULT '0' AFTER `weight_chart`;
