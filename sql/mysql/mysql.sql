DROP TABLE IF EXISTS `dps_payment_express_transactions`;
CREATE TABLE `dps_payment_express_transactions` (

  `id` tinyint(2) unsigned NOT NULL auto_increment,
  `status` int(11) unsigned NOT NULL,
  `order_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `created` int(11) unsigned NOT NULL,
  `updated` int(11) unsigned NOT NULL,

  `px_pay_user_id` char(32) NOT NULL,
  `px_pay_key` char(64) NOT NULL,
  `amount_input` float(13,2) NOT NULL,
  `billing_id` varchar(32) default NULL,
  `currency_input` char(4) NOT NULL,
  `email_address` varchar(255) default NULL,
  `enable_add_bill_card` bit(1) default 0,
  `merchant_reference` varchar(64) NOT NULL,
  `txn_data_1` varchar(255) default NULL,
  `txn_data_2` varchar(255) default NULL,
  `txn_data_3` varchar(255) default NULL,
  `txn_type` tinyint(1) unsigned NOT NULL,
  `txn_id` varchar(16) default NULL,

  `auth_code` varchar(32) default NULL,
  `card_name` varchar(16) default NULL,
  `card_number` varchar(255) default NULL,
  `date_expiry` int(4) unsigned default NULL,
  `dps_txn_ref` varchar(16) default NULL,
  `success` bit(1) default NULL,
  `response_text` varchar(32) default NULL,
  `dps_billing_id` varchar(16) default NULL,
  `card_holder_name` varchar(64) default NULL,
  `client_info` VARBINARY(16) default NULL,
  `txn_mac` varchar(255) default NULL,
  `card_number_2` varchar(16) default NULL,
  `cvc2_result_code` char(1) default NULL,

  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
