--
-- MySQL 5.5.5
-- Sat, 28 Jun 2014 20:44:36 +0000
--

CREATE TABLE `admins` (
   `id_admin` int(11) not null auto_increment,
   `id_brand` int(11) not null,
   `brand_admin` int(1) not null,
   `email` varchar(255) CHARSET utf8 not null,
   `name` varchar(255) CHARSET utf8 not null,
   `password` varchar(255) CHARSET utf8 not null,
   `promo_password` varchar(255) CHARSET utf8 not null,
   `active` int(1) not null,
   `created` int(11) not null,
   `last_connection` int(11) not null,
   `resume_block_1_display` int(1) not null,
   `resume_block_2_display` int(1) not null,
   `resume_block_3_display` int(1) not null,
   `resume_block_4_display` int(1) not null,
   `resume_block_1_title` varchar(155) CHARSET utf8 not null,
   `resume_block_2_title` varchar(155) CHARSET utf8 not null,
   `resume_block_3_title` varchar(155) CHARSET utf8 not null,
   `resume_block_4_title` varchar(155) CHARSET utf8 not null,
   `resume_block_1_data` varchar(255) CHARSET utf8 not null,
   `resume_block_2_data` varchar(255) CHARSET utf8 not null,
   `resume_block_3_data` varchar(255) CHARSET utf8 not null,
   `resume_block_4_data` varchar(255) CHARSET utf8 not null,
   `resume_block_1_link_content` varchar(155) CHARSET utf8 not null,
   `resume_block_2_link_content` varchar(155) CHARSET utf8 not null,
   `resume_block_3_link_content` varchar(155) CHARSET utf8 not null,
   `resume_block_4_link_content` varchar(155) CHARSET utf8 not null,
   `resume_block_1_link` varchar(255) CHARSET utf8 not null,
   `resume_block_2_link` varchar(255) CHARSET utf8 not null,
   `resume_block_3_link` varchar(255) CHARSET utf8 not null,
   `resume_block_4_link` varchar(255) CHARSET utf8 not null,
   `can_login` int(1) not null,
   `can_validate_codes` int(1) not null,
   `can_manage_campaigns` int(1) not null,
   `can_manage_admins` int(1) not null,
   `can_manage_users` int(1) not null,
   `can_manage_app` int(1) not null,
   `can_manage_brand` int(1) not null,
   PRIMARY KEY (`id_admin`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=28;


CREATE TABLE `apps` (
   `id_app` int(11) not null auto_increment,
   `id_brand` int(11) not null,
   `name` varchar(155) CHARSET utf8 not null,
   `description` text not null,
   `published_apple_store` int(1) not null,
   `published_google_play` int(1) not null,
   `app_icon_path` varchar(155) CHARSET utf8 not null,
   `app_bg_path` varchar(155) CHARSET utf8 not null,
   `automatic_screenshots` int(1) not null,
   `app_screenshot_1_path` varchar(155) CHARSET utf8 not null,
   `app_screenshot_2_path` varchar(155) CHARSET utf8 not null,
   `app_screenshot_3_path` varchar(155) CHARSET utf8 not null,
   `app_screenshot_4_path` varchar(155) CHARSET utf8 not null,
   PRIMARY KEY (`id_app`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=3;


CREATE TABLE `brand_user_fields` (
   `id_brand_user_field` int(11) not null auto_increment,
   `id_brand` int(11) not null,
   `id_user_field` int(11) not null,
   `main_field` int(1) not null,
   PRIMARY KEY (`id_brand_user_field`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=4;


CREATE TABLE `brands` (
   `id_brand` int(11) not null auto_increment,
   `name` varchar(155) CHARSET utf8 not null,
   `cif` varchar(155) CHARSET utf8 not null,
   `active` int(1) not null,
   `lock_date` int(11),
   `app_name` varchar(155) CHARSET utf8 not null,
   `app_title` varchar(155) CHARSET utf8 not null,
   `resume_block_1_display` int(1) not null,
   `resume_block_2_display` int(1) not null,
   `resume_block_3_display` int(1) not null,
   `resume_block_4_display` int(1) not null,
   `resume_block_1_title` varchar(155) CHARSET utf8 not null,
   `resume_block_2_title` varchar(155) CHARSET utf8 not null,
   `resume_block_3_title` varchar(155) CHARSET utf8 not null,
   `resume_block_4_title` varchar(155) CHARSET utf8 not null,
   `resume_block_1_data` varchar(255) CHARSET utf8 not null,
   `resume_block_2_data` varchar(255) CHARSET utf8 not null,
   `resume_block_3_data` varchar(255) CHARSET utf8 not null,
   `resume_block_4_data` varchar(255) CHARSET utf8 not null,
   `resume_block_1_link_content` varchar(155) CHARSET utf8 not null,
   `resume_block_2_link_content` varchar(155) CHARSET utf8 not null,
   `resume_block_3_link_content` varchar(155) CHARSET utf8 not null,
   `resume_block_4_link_content` varchar(155) CHARSET utf8 not null,
   `resume_block_1_link` varchar(255) CHARSET utf8 not null,
   `resume_block_2_link` varchar(255) CHARSET utf8 not null,
   `resume_block_3_link` varchar(255) CHARSET utf8 not null,
   `resume_block_4_link` varchar(255) CHARSET utf8 not null,
   `subscription_type` varchar(155) CHARSET utf8 not null,
   `contact_name` varchar(255) CHARSET utf8 not null,
   `contact_email` varchar(255) CHARSET utf8 not null,
   `contact_phone` varchar(255) CHARSET utf8 not null,
   `contact_address` varchar(255) CHARSET utf8 not null,
   `contact_postal_code` varchar(255) CHARSET utf8 not null,
   `contact_city` varchar(255) CHARSET utf8 not null,
   `contact_country` varchar(255) CHARSET utf8 not null,
   `payment_plan` varchar(155) CHARSET utf8 not null,
   `payment_method` varchar(155) CHARSET utf8 not null,
   `payment_data` varchar(255) CHARSET utf8 not null,
   `expiration_date` int(11) not null,
   PRIMARY KEY (`id_brand`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=5;


CREATE TABLE `campaign_notes` (
   `id_campaign_note` int(11) not null auto_increment,
   `id_campaign` int(11) not null,
   `id_brand` int(11) not null,
   `title` varchar(155) CHARSET utf8 not null,
   `content` text CHARSET utf8 not null,
   `created` int(11) not null,
   PRIMARY KEY (`id_campaign_note`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;


CREATE TABLE `campaigns` (
   `id_campaign` int(11) not null auto_increment,
   `id_brand` int(11) not null,
   `name` varchar(255) CHARSET utf8 not null,
   `description` text CHARSET utf8 not null,
   `title` varchar(155) CHARSET utf8 not null,
   `content` varchar(500) CHARSET utf8 not null,
   `button_title` varchar(155) CHARSET utf8 not null,
   `type` int(1) not null,
   `status` int(1) not null,
   `coupons_number` int(11) not null,
   `usage_limit` int(1) not null,
   `cost` float not null,
   `profit` float not null,
   `campaign_icon_path` varchar(255) CHARSET utf8 not null,
   `campaign_image_path` varchar(255) CHARSET utf8 not null,
   `campaign_usage` int(11) not null,
   `campaign_usage_last_month` int(11) not null,
   `resume_block_1_display` int(1) not null,
   `resume_block_2_display` int(1) not null,
   `resume_block_3_display` int(1) not null,
   `resume_block_4_display` int(1) not null,
   `resume_block_1_title` varchar(155) CHARSET utf8 not null,
   `resume_block_2_title` varchar(155) CHARSET utf8 not null,
   `resume_block_3_title` varchar(155) CHARSET utf8 not null,
   `resume_block_4_title` varchar(155) CHARSET utf8 not null,
   `resume_block_1_data` varchar(255) CHARSET utf8 not null,
   `resume_block_2_data` varchar(255) CHARSET utf8 not null,
   `resume_block_3_data` varchar(255) CHARSET utf8 not null,
   `resume_block_4_data` varchar(255) CHARSET utf8 not null,
   `resume_block_1_link_content` varchar(155) CHARSET utf8 not null,
   `resume_block_2_link_content` varchar(155) CHARSET utf8 not null,
   `resume_block_3_link_content` varchar(155) CHARSET utf8 not null,
   `resume_block_4_link_content` varchar(155) CHARSET utf8 not null,
   `resume_block_1_link` varchar(255) CHARSET utf8 not null,
   `resume_block_2_link` varchar(255) CHARSET utf8 not null,
   `resume_block_3_link` varchar(255) CHARSET utf8 not null,
   `resume_block_4_link` varchar(255) CHARSET utf8 not null,
   PRIMARY KEY (`id_campaign`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=92;


CREATE TABLE `config` (
   `id_config` int(11) not null auto_increment,
   `used` int(1) not null,
   `debug_mode` int(1) not null,
   `bank_name` varchar(255) CHARSET utf8 not null,
   `bank_swift` varchar(255) CHARSET utf8 not null,
   `bank_iban` varchar(255) CHARSET utf8 not null,
   `bank_account_number` varchar(255) CHARSET utf8 not null,
   `bank_transfer_beneficiary` varchar(255) CHARSET utf8 not null,
   PRIMARY KEY (`id_config`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;


CREATE TABLE `group_notes` (
   `id_group_note` int(11) not null auto_increment,
   `id_group` int(11) not null,
   `id_brand` int(11) not null,
   `title` varchar(155) CHARSET utf8 not null,
   `content` text not null,
   `created` int(11) not null,
   PRIMARY KEY (`id_group_note`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;


CREATE TABLE `groups` (
   `id_group` int(11) not null auto_increment,
   `id_brand` int(11) not null,
   `name` varchar(155) CHARSET utf8 not null,
   `created` int(11) not null,
   `resume_block_1_display` int(1) not null,
   `resume_block_2_display` int(1) not null,
   `resume_block_3_display` int(1) not null,
   `resume_block_4_display` int(1) not null,
   `resume_block_1_title` varchar(155) CHARSET utf8 not null,
   `resume_block_2_title` varchar(155) CHARSET utf8 not null,
   `resume_block_3_title` varchar(155) CHARSET utf8 not null,
   `resume_block_4_title` varchar(155) CHARSET utf8 not null,
   `resume_block_1_data` varchar(255) CHARSET utf8 not null,
   `resume_block_2_data` varchar(255) CHARSET utf8 not null,
   `resume_block_3_data` varchar(255) CHARSET utf8 not null,
   `resume_block_4_data` varchar(255) CHARSET utf8 not null,
   `resume_block_1_link_content` varchar(155) CHARSET utf8 not null,
   `resume_block_2_link_content` varchar(155) CHARSET utf8 not null,
   `resume_block_3_link_content` varchar(155) CHARSET utf8 not null,
   `resume_block_4_link_content` varchar(155) CHARSET utf8 not null,
   `resume_block_1_link` varchar(255) CHARSET utf8 not null,
   `resume_block_2_link` varchar(255) CHARSET utf8 not null,
   `resume_block_3_link` varchar(255) CHARSET utf8 not null,
   `resume_block_4_link` varchar(255) CHARSET utf8 not null,
   PRIMARY KEY (`id_group`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;


CREATE TABLE `orders` (
   `id_order` int(11) not null auto_increment,
   `id_brand` int(11) not null,
   `created` int(11) not null,
   `subscription_type` varchar(155) CHARSET utf8 not null,
   `payment_plan` varchar(255) CHARSET utf8 not null,
   `payment_method` varchar(255) CHARSET utf8 not null,
   `amount` float not null,
   PRIMARY KEY (`id_order`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=230;


CREATE TABLE `receipt_lines` (
   `id_receipt_line` int(11) not null auto_increment,
   `id_receipt` int(11) not null,
   `content` varchar(255) CHARSET utf8 not null,
   `amount` float(4,2) not null,
   `price` float(4,2) not null,
   `vat` float(4,2) not null,
   `price_vat` float(4,2) not null,
   PRIMARY KEY (`id_receipt_line`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;


CREATE TABLE `receipts` (
   `id_receipt` int(11) not null auto_increment,
   `id_brand` int(11) not null,
   `created` int(11) not null,
   `payment_method` int(1) not null,
   `distributor_name` varchar(255) CHARSET utf8 not null,
   `distributor_id` varchar(255) CHARSET utf8 not null,
   `distributor_address` varchar(255) CHARSET utf8 not null,
   `distributor_postal_code` varchar(255) CHARSET utf8 not null,
   `distributor_city` varchar(255) CHARSET utf8 not null,
   `distributor_country` varchar(255) CHARSET utf8 not null,
   `price` float(11,2) not null,
   `vat` float(11,2) not null,
   `price_vat` float(11,2) not null,
   PRIMARY KEY (`id_receipt`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;


CREATE TABLE `requests` (
   `id_request` int(11) not null auto_increment,
   `code` varchar(255) CHARSET utf8 not null,
   `id_brand` int(11) not null,
   `type` varchar(255) CHARSET utf8 not null,
   `status` varchar(255) CHARSET utf8 not null,
   `created` int(11) not null,
   `data` text not null,
   PRIMARY KEY (`id_request`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=177;


CREATE TABLE `software_news` (
   `id_software_new` int(11) not null auto_increment,
   `title` varchar(75) CHARSET utf8 not null,
   `created` int(11) not null,
   `content` varchar(255) CHARSET utf8 not null,
   `link` varchar(255) CHARSET utf8 not null,
   PRIMARY KEY (`id_software_new`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;


CREATE TABLE `subscription_method_plans` (
   `id_subscription_method_plan` int(11) not null auto_increment,
   `subscription_type` varchar(255) CHARSET utf8 not null,
   `payment_plan` varchar(255) CHARSET utf8 not null,
   `price` float not null,
   PRIMARY KEY (`id_subscription_method_plan`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=8;


CREATE TABLE `used_codes` (
   `id_used_codes` int(11) not null auto_increment,
   `id_user` int(11) not null,
   `id_campaign` int(11) not null,
   `id_brand` int(11) not null,
   `id_admin` int(11) not null,
   `created` int(11) not null,
   `code` varchar(255) CHARSET utf8 not null,
   PRIMARY KEY (`id_used_codes`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=15;


CREATE TABLE `used_codes_day_summaries` (
   `id_used_codes_day_summary` int(11) not null auto_increment,
   `id_campaign` int(11) not null,
   `id_brand` int(11) not null,
   `used_codes_amount` int(11) not null,
   `start` int(11) not null,
   PRIMARY KEY (`id_used_codes_day_summary`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=6;


CREATE TABLE `used_codes_month_summaries` (
   `id_used_codes_month_summary` int(11) not null auto_increment,
   `id_campaign` int(11) not null,
   `id_brand` int(11) not null,
   `used_codes_amount` int(11) not null,
   `start` int(11) not null,
   PRIMARY KEY (`id_used_codes_month_summary`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=3;


CREATE TABLE `used_codes_summaries` (
   `id_used_codes_summary` int(11) not null auto_increment,
   `id_brand` int(11) not null,
   `id_campaign` int(11) not null,
   `used_codes_amount` int(11) not null,
   PRIMARY KEY (`id_used_codes_summary`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=3;


CREATE TABLE `used_codes_user_day_summaries` (
   `id_used_codes_user_day_summary` int(11) not null auto_increment,
   `id_user` int(11) not null,
   `id_brand` int(11) not null,
   `used_codes_amount` int(11) not null,
   `start` int(11) not null,
   PRIMARY KEY (`id_used_codes_user_day_summary`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=6;


CREATE TABLE `used_codes_user_summaries` (
   `id_used_codes_user_summary` int(11) not null auto_increment,
   `id_user` int(11) not null,
   `id_brand` int(11) not null,
   `id_campaign` int(11) not null,
   `used_codes_amount` int(11) not null,
   PRIMARY KEY (`id_used_codes_user_summary`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=5;


CREATE TABLE `user_field_data` (
   `id_user_field_data` int(11) not null auto_increment,
   `id_brand` int(11),
   `id_user` int(11) not null,
   `id_user_field` int(11) not null,
   `field_value` varchar(255) CHARSET utf8 not null,
   PRIMARY KEY (`id_user_field_data`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=6;


CREATE TABLE `user_fields` (
   `id_user_field` int(11) not null auto_increment,
   `title` varchar(255) CHARSET utf8 not null,
   `field_type` varchar(255) CHARSET utf8 not null,
   PRIMARY KEY (`id_user_field`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;


CREATE TABLE `user_groups` (
   `id_user_group` int(11) not null auto_increment,
   `id_brand` varchar(11) not null,
   `id_user` int(11) not null,
   `id_group` int(11) not null,
   PRIMARY KEY (`id_user_group`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;


CREATE TABLE `user_notes` (
   `id_user_note` int(11) not null auto_increment,
   `id_user` int(11) not null,
   `id_brand` int(11) not null,
   `title` varchar(155) CHARSET utf8 not null,
   `content` text not null,
   `created` int(11) not null,
   PRIMARY KEY (`id_user_note`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;


CREATE TABLE `users` (
   `id_user` int(11) not null auto_increment,
   `id_brand` int(11) not null,
   `active` int(1) not null,
   `name` varchar(255) CHARSET utf8 not null,
   `phone` varchar(20) CHARSET utf8 not null,
   `created` int(11) not null,
   `last_connection` int(11) not null,
   `resume_block_1_display` int(1) not null,
   `resume_block_2_display` int(1) not null,
   `resume_block_3_display` int(1) not null,
   `resume_block_4_display` int(1) not null,
   `resume_block_1_title` varchar(155) CHARSET utf8 not null,
   `resume_block_2_title` varchar(155) CHARSET utf8 not null,
   `resume_block_3_title` varchar(155) CHARSET utf8 not null,
   `resume_block_4_title` varchar(155) CHARSET utf8 not null,
   `resume_block_1_data` varchar(255) CHARSET utf8 not null,
   `resume_block_2_data` varchar(255) CHARSET utf8 not null,
   `resume_block_3_data` varchar(255) CHARSET utf8 not null,
   `resume_block_4_data` varchar(255) CHARSET utf8 not null,
   `resume_block_1_link_content` varchar(155) CHARSET utf8 not null,
   `resume_block_2_link_content` varchar(155) CHARSET utf8 not null,
   `resume_block_3_link_content` varchar(155) CHARSET utf8 not null,
   `resume_block_4_link_content` varchar(155) CHARSET utf8 not null,
   `resume_block_1_link` varchar(255) CHARSET utf8 not null,
   `resume_block_2_link` varchar(255) CHARSET utf8 not null,
   `resume_block_3_link` varchar(255) CHARSET utf8 not null,
   `resume_block_4_link` varchar(255) CHARSET utf8 not null,
   PRIMARY KEY (`id_user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=6;


CREATE TABLE `validated_codes_day_summaries` (
   `id_validated_codes_day_summary` int(11) not null auto_increment,
   `id_brand` varchar(11),
   `id_admin` int(11) not null,
   `validated_codes_amount` int(11) not null,
   `start` int(11) not null,
   PRIMARY KEY (`id_validated_codes_day_summary`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=6;


CREATE TABLE `validated_codes_month_summaries` (
   `id_validated_codes_month_summary` int(11) not null auto_increment,
   `id_brand` varchar(11),
   `id_admin` int(11) not null,
   `validated_codes_amount` int(11) not null,
   `start` int(11) not null,
   PRIMARY KEY (`id_validated_codes_month_summary`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=3;

CREATE TABLE `recovery_codes` (
   `id_recovery_code` int(11) not null auto_increment,
   `email` varchar(255),
   `code` varchar(255) not null,
   PRIMARY KEY (`id_recovery_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
