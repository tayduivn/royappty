--
-- Royappty
-- Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
-- Last Modification: 10-02-2014
-- Version: 1.0
-- licensed through CC BY-NC 4.0
--

CREATE TABLE `admins` (
   `id_admin` int(11) not null auto_increment,
   `id_brand` int(11) not null,
   `brand_admin` int(1) not null,
   `email` varchar(255) not null,
   `name` varchar(255) not null,
   `password` varchar(255) not null,
   `promo_password` varchar(255) not null,
   `active` int(1) not null,
   `verified` int(1) not null,
   `verification_code` varchar(255) not null,
   `created` int(11) not null,
   `last_connection` int(11) not null,
   `resume_block_1_display` int(1) not null,
   `resume_block_2_display` int(1) not null,
   `resume_block_3_display` int(1) not null,
   `resume_block_4_display` int(1) not null,
   `resume_block_1_title` varchar(155) not null,
   `resume_block_2_title` varchar(155) not null,
   `resume_block_3_title` varchar(155) not null,
   `resume_block_4_title` varchar(155) not null,
   `resume_block_1_data` varchar(255) not null,
   `resume_block_2_data` varchar(255) not null,
   `resume_block_3_data` varchar(255) not null,
   `resume_block_4_data` varchar(255) not null,
   `resume_block_1_link_content` varchar(155) not null,
   `resume_block_2_link_content` varchar(155) not null,
   `resume_block_3_link_content` varchar(155) not null,
   `resume_block_4_link_content` varchar(155) not null,
   `resume_block_1_link` varchar(255) not null,
   `resume_block_2_link` varchar(255) not null,
   `resume_block_3_link` varchar(255) not null,
   `resume_block_4_link` varchar(255) not null,
   `can_login` int(1) not null,
   `can_validate_codes` int(1) not null,
   `can_manage_campaigns` int(1) not null,
   `can_manage_admins` int(1) not null,
   `can_manage_users` int(1) not null,
   `can_manage_app` int(1) not null,
   `can_manage_brand` int(1) not null,
   PRIMARY KEY (`id_admin`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE `apps` (
   `id_app` int(11) not null auto_increment,
   `id_brand` int(11) not null,
   `name` varchar(155) not null,
   `project_codename` varchar(75),
   `package_address` varchar(255),
   `project_id` varchar(75),
   `apk_name` varchar(75),
   `description` text not null,
   `published_apple_store` int(1) not null,
   `published_google_play` int(1) not null,
   `app_title` varchar(255) not null,
   `app_icon_path` varchar(155) not null,
   `app_bg_path` varchar(155) not null,
   `automatic_screenshots` int(1) not null,
   `app_screenshot_1_path` varchar(155) not null,
   `app_screenshot_2_path` varchar(155) not null,
   `app_screenshot_3_path` varchar(155) not null,
   `app_screenshot_4_path` varchar(155) not null,
   PRIMARY KEY (`id_app`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

INSERT INTO `apps` (`id_app`, `id_brand`, `name`, `project_codename`, `package_address`, `project_id`, `apk_name`, `description`, `published_apple_store`, `published_google_play`, `app_title`, `app_icon_path`, `app_bg_path`, `automatic_screenshots`, `app_screenshot_1_path`, `app_screenshot_2_path`, `app_screenshot_3_path`, `app_screenshot_4_path`) VALUES

CREATE TABLE `brand_user_fields` (
   `id_brand_user_field` int(11) not null auto_increment,
   `id_brand` int(11) not null,
   `id_user_field` int(11) not null,
   `main_field` int(1) not null,
   PRIMARY KEY (`id_brand_user_field`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

INSERT INTO `brand_user_fields` (`id_brand_user_field`, `id_brand`, `id_user_field`, `main_field`) VALUES

CREATE TABLE `brands` (
   `id_brand` int(11) not null auto_increment,
   `name` varchar(155) not null,
   `cif` varchar(155) not null,
   `active` int(1) not null,
   `created` int(11) not null,
   `lock_date` int(11),
   `android_project_name` varchar(255) not null,
   `android_project_id` varchar(255) not null,
   `android_project_number` varchar(255) not null,
   `android_server_key` varchar(255) not null,
   `resume_block_1_display` int(1) not null,
   `resume_block_2_display` int(1) not null,
   `resume_block_3_display` int(1) not null,
   `resume_block_4_display` int(1) not null,
   `resume_block_1_title` varchar(155) not null,
   `resume_block_2_title` varchar(155) not null,
   `resume_block_3_title` varchar(155) not null,
   `resume_block_4_title` varchar(155) not null,
   `resume_block_1_data` varchar(255) not null,
   `resume_block_2_data` varchar(255) not null,
   `resume_block_3_data` varchar(255) not null,
   `resume_block_4_data` varchar(255) not null,
   `resume_block_1_link_content` varchar(155) not null,
   `resume_block_2_link_content` varchar(155) not null,
   `resume_block_3_link_content` varchar(155) not null,
   `resume_block_4_link_content` varchar(155) not null,
   `resume_block_1_link` varchar(255) not null,
   `resume_block_2_link` varchar(255) not null,
   `resume_block_3_link` varchar(255) not null,
   `resume_block_4_link` varchar(255) not null,
   `subscription_type` varchar(155) not null,
   `contact_name` varchar(255) not null,
   `contact_email` varchar(255) not null,
   `contact_phone` varchar(255) not null,
   `contact_address` varchar(255) not null,
   `contact_postal_code` varchar(255) not null,
   `contact_city` varchar(255) not null,
   `contact_province` varchar(255) not null,
   `contact_country` varchar(255) not null,
   `payment_plan` varchar(155) not null,
   `payment_method` varchar(155) not null,
   `payment_data` varchar(255) not null,
   `expiration_date` int(11) not null,
   PRIMARY KEY (`id_brand`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

INSERT INTO `brands` (`id_brand`, `name`, `cif`, `active`, `created`, `lock_date`, `android_project_name`, `android_project_id`, `android_project_number`, `android_server_key`, `resume_block_1_display`, `resume_block_2_display`, `resume_block_3_display`, `resume_block_4_display`, `resume_block_1_title`, `resume_block_2_title`, `resume_block_3_title`, `resume_block_4_title`, `resume_block_1_data`, `resume_block_2_data`, `resume_block_3_data`, `resume_block_4_data`, `resume_block_1_link_content`, `resume_block_2_link_content`, `resume_block_3_link_content`, `resume_block_4_link_content`, `resume_block_1_link`, `resume_block_2_link`, `resume_block_3_link`, `resume_block_4_link`, `subscription_type`, `contact_name`, `contact_email`, `contact_phone`, `contact_address`, `contact_postal_code`, `contact_city`, `contact_province`, `contact_country`, `payment_plan`, `payment_method`, `payment_data`, `expiration_date`) VALUES

CREATE TABLE `campaign_notes` (
   `id_campaign_note` int(11) not null auto_increment,
   `id_campaign` int(11) not null,
   `id_brand` int(11) not null,
   `title` varchar(155) not null,
   `content` text not null,
   `created` int(11) not null,
   PRIMARY KEY (`id_campaign_note`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- [Table `campaign_notes` is empty]

CREATE TABLE `campaigns` (
   `id_campaign` int(11) not null auto_increment,
   `id_brand` int(11) not null,
   `id_group` int(11) not null,
   `name` varchar(255) not null,
   `description` text not null,
   `title` varchar(155) not null,
   `content` varchar(500) not null,
   `button_title` varchar(155) not null,
   `type` int(1) not null,
   `group_name` varchar(75) not null,
   `status` int(1) not null,
   `coupons_number` int(11) not null,
   `usage_limit` int(1) not null,
   `cost` float not null,
   `profit` float not null,
   `created` int(11),
   `campaign_icon_path` varchar(255) not null,
   `campaign_image_path` varchar(255) not null,
   `campaign_usage` int(11) not null,
   `campaign_usage_last_month` int(11) not null,
   `resume_block_1_display` int(1) not null,
   `resume_block_2_display` int(1) not null,
   `resume_block_3_display` int(1) not null,
   `resume_block_4_display` int(1) not null,
   `resume_block_1_title` varchar(155) not null,
   `resume_block_2_title` varchar(155) not null,
   `resume_block_3_title` varchar(155) not null,
   `resume_block_4_title` varchar(155) not null,
   `resume_block_1_data` varchar(255) not null,
   `resume_block_2_data` varchar(255) not null,
   `resume_block_3_data` varchar(255) not null,
   `resume_block_4_data` varchar(255) not null,
   `resume_block_1_link_content` varchar(155) not null,
   `resume_block_2_link_content` varchar(155) not null,
   `resume_block_3_link_content` varchar(155) not null,
   `resume_block_4_link_content` varchar(155) not null,
   `resume_block_1_link` varchar(255) not null,
   `resume_block_2_link` varchar(255) not null,
   `resume_block_3_link` varchar(255) not null,
   `resume_block_4_link` varchar(255) not null,
   PRIMARY KEY (`id_campaign`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

INSERT INTO `campaigns` (`id_campaign`, `id_brand`, `id_group`, `name`, `description`, `title`, `content`, `button_title`, `type`, `group_name`, `status`, `coupons_number`, `usage_limit`, `cost`, `profit`, `created`, `campaign_icon_path`, `campaign_image_path`, `campaign_usage`, `campaign_usage_last_month`, `resume_block_1_display`, `resume_block_2_display`, `resume_block_3_display`, `resume_block_4_display`, `resume_block_1_title`, `resume_block_2_title`, `resume_block_3_title`, `resume_block_4_title`, `resume_block_1_data`, `resume_block_2_data`, `resume_block_3_data`, `resume_block_4_data`, `resume_block_1_link_content`, `resume_block_2_link_content`, `resume_block_3_link_content`, `resume_block_4_link_content`, `resume_block_1_link`, `resume_block_2_link`, `resume_block_3_link`, `resume_block_4_link`) VALUES

CREATE TABLE `config` (
   `id_config` int(11) not null auto_increment,
   `used` int(1) not null,
   `close` int(1) not null,
   `launch` int(1) not null,
   `company_logo_path` varchar(255) not null,
   `company_name` varchar(255) not null,
   `company_street` varchar(255) not null,
   `company_town` varchar(255) not null,
   `company_country` varchar(255) not null,
   `company_phone` varchar(255) not null,
   `company_url` varchar(255),
   `company_info_mail` varchar(255) not null,
   `mail_header_email` varchar(255) not null,
   `component_url_prefix` varchar(255),
   `footer_mail` varchar(255) not null,
   `debug_mode` int(1) not null,
   `bank_name` varchar(255) not null,
   `bank_swift` varchar(255) not null,
   `bank_iban` varchar(255) not null,
   `bank_account_number` varchar(255) not null,
   `bank_transfer_beneficiary` varchar(255) not null,
   PRIMARY KEY (`id_config`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;

INSERT INTO `config` (`id_config`, `used`, `close`, `launch`, `company_logo_path`, `company_name`, `company_street`, `company_town`, `company_country`, `company_phone`, `company_url`, `company_info_mail`, `mail_header_email`, `component_url_prefix`, `footer_mail`, `debug_mode`, `bank_name`, `bank_swift`, `bank_iban`, `bank_account_number`, `bank_transfer_beneficiary`) VALUES
('1', '1', '0', '0', 'server/app/assets/img/royappty-logo.png', 'Royappty', 'Menendez Pelayo 3', 'Vigo', 'Spain', '886131361', 'www.royappty.com', 'info@royappty.com', 'Royappty<noreply@royappty.com>', 'com.royappty', 'La Aplicación de Fidelización para tu Negocio', '1', '0000', '0000', '0000', '0000', '0000');

CREATE TABLE `group_notes` (
   `id_group_note` int(11) not null auto_increment,
   `id_group` int(11) not null,
   `id_brand` int(11) not null,
   `title` varchar(155) not null,
   `content` text not null,
   `created` int(11) not null,
   PRIMARY KEY (`id_group_note`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- [Table `group_notes` is empty]

CREATE TABLE `groups` (
   `id_group` int(11) not null auto_increment,
   `id_brand` int(11) not null,
   `name` varchar(155) not null,
   `created` int(11) not null,
   `resume_block_1_display` int(1) not null,
   `resume_block_2_display` int(1) not null,
   `resume_block_3_display` int(1) not null,
   `resume_block_4_display` int(1) not null,
   `resume_block_1_title` varchar(155) not null,
   `resume_block_2_title` varchar(155) not null,
   `resume_block_3_title` varchar(155) not null,
   `resume_block_4_title` varchar(155) not null,
   `resume_block_1_data` varchar(255) not null,
   `resume_block_2_data` varchar(255) not null,
   `resume_block_3_data` varchar(255) not null,
   `resume_block_4_data` varchar(255) not null,
   `resume_block_1_link_content` varchar(155) not null,
   `resume_block_2_link_content` varchar(155) not null,
   `resume_block_3_link_content` varchar(155) not null,
   `resume_block_4_link_content` varchar(155) not null,
   `resume_block_1_link` varchar(255) not null,
   `resume_block_2_link` varchar(255) not null,
   `resume_block_3_link` varchar(255) not null,
   `resume_block_4_link` varchar(255) not null,
   PRIMARY KEY (`id_group`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- [Table `groups` is empty]

CREATE TABLE `notifications` (
   `id_notification` int(11) not null auto_increment,
   `id_brand` int(11) not null,
   `content` varchar(255) not null,
   `id_group` int(11) not null,
   `group_name` varchar(75) not null,
   `created` int(11) not null,
   PRIMARY KEY (`id_notification`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

INSERT INTO `notifications` (`id_notification`, `id_brand`, `content`, `id_group`, `group_name`, `created`) VALUES

CREATE TABLE `orders` (
   `id_order` int(11) not null auto_increment,
   `id_brand` int(11) not null,
   `created` int(11) not null,
   `subscription_type` varchar(155) not null,
   `payment_plan` varchar(255) not null,
   `payment_method` varchar(255) not null,
   `amount` float not null,
   PRIMARY KEY (`id_order`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- [Table `orders` is empty]

CREATE TABLE `receipt_lines` (
   `id_receipt_line` int(11) not null auto_increment,
   `id_receipt` int(11) not null,
   `content` varchar(255) not null,
   `amount` float(4,2) not null,
   `price` float(4,2) not null,
   `vat` float(4,2) not null,
   `price_vat` float(4,2) not null,
   PRIMARY KEY (`id_receipt_line`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- [Table `receipt_lines` is empty]

CREATE TABLE `receipts` (
   `id_receipt` int(11) not null auto_increment,
   `id_brand` int(11) not null,
   `created` int(11) not null,
   `payment_method` int(1) not null,
   `distributor_name` varchar(255) not null,
   `distributor_id` varchar(255) not null,
   `distributor_address` varchar(255) not null,
   `distributor_postal_code` varchar(255) not null,
   `distributor_city` varchar(255) not null,
   `distributor_country` varchar(255) not null,
   `price` float(11,2) not null,
   `vat` float(11,2) not null,
   `price_vat` float(11,2) not null,
   PRIMARY KEY (`id_receipt`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- [Table `receipts` is empty]

CREATE TABLE `recovery_codes` (
   `id_recovery_code` int(11) not null auto_increment,
   `email` varchar(255),
   `code` varchar(255) not null,
   PRIMARY KEY (`id_recovery_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- [Table `recovery_codes` is empty]

CREATE TABLE `requests` (
   `id_request` int(11) not null auto_increment,
   `code` varchar(255) not null,
   `id_brand` int(11) not null,
   `type` varchar(255) not null,
   `status` varchar(255) not null,
   `created` int(11) not null,
   `data` text not null,
   PRIMARY KEY (`id_request`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

INSERT INTO `requests` (`id_request`, `code`, `id_brand`, `type`, `status`, `created`, `data`) VALUES

CREATE TABLE `ryadmins` (
   `id_ryadmin` int(11) not null auto_increment,
   `name` varchar(255) CHARSET latin1 not null,
   `email` varchar(255) CHARSET latin1 not null,
   `password` varchar(255) CHARSET latin1 not null,
   `active` int(1) not null,
   `created` int(1) not null,
   `last_login` int(1) not null,
   `last_activity` int(1) not null,
   `resume_block_1_display` int(1) not null,
   `resume_block_1_title` varchar(255) CHARSET latin1 not null,
   `resume_block_2_display` int(1) not null,
   `resume_block_2_title` varchar(255) CHARSET latin1 not null,
   `resume_block_3_display` int(1) not null,
   `resume_block_3_title` varchar(255) CHARSET latin1 not null,
   `resume_block_4_display` int(1) not null,
   `resume_block_4_title` varchar(255) CHARSET latin1 not null,
   PRIMARY KEY (`id_ryadmin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;

INSERT INTO `ryadmins` (`id_ryadmin`, `name`, `email`, `password`, `active`, `created`, `last_login`, `last_activity`, `resume_block_1_display`, `resume_block_1_title`, `resume_block_2_display`, `resume_block_2_title`, `resume_block_3_display`, `resume_block_3_title`, `resume_block_4_display`, `resume_block_4_title`) VALUES
('1', 'Pablo Gutierrez', 'pablo@royappty.com', 'dd4b21e9ef71e1291183a46b913ae6f2', '1', '1408435200', '1408532580', '1412184420', '1', 'total_campaigns', '1', 'total_brands', '1', 'total_users', '1', 'total_monthly_revenue');

CREATE TABLE `software_news` (
   `id_software_new` int(11) not null auto_increment,
   `title` varchar(75) not null,
   `created` int(11) not null,
   `content` text not null,
   `link` varchar(255) not null,
   PRIMARY KEY (`id_software_new`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- [Table `software_news` is empty]

CREATE TABLE `subscription_method_plans` (
   `id_subscription_method_plan` int(11) not null auto_increment,
   `subscription_type` varchar(255) not null,
   `payment_plan` varchar(255) not null,
   `price` float not null,
   PRIMARY KEY (`id_subscription_method_plan`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- [Table `subscription_method_plans` is empty]

CREATE TABLE `used_codes` (
   `id_used_codes` int(11) not null auto_increment,
   `id_user` int(11) not null,
   `id_campaign` int(11) not null,
   `id_brand` int(11) not null,
   `id_admin` int(11) not null,
   `created` int(11) not null,
   `code` varchar(255) not null,
   PRIMARY KEY (`id_used_codes`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- [Table `used_codes` is empty]

CREATE TABLE `used_codes_day_summaries` (
   `id_used_codes_day_summary` int(11) not null auto_increment,
   `id_campaign` int(11) not null,
   `id_brand` int(11) not null,
   `used_codes_amount` int(11) not null,
   `start` int(11) not null,
   PRIMARY KEY (`id_used_codes_day_summary`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- [Table `used_codes_day_summaries` is empty]

CREATE TABLE `used_codes_month_summaries` (
   `id_used_codes_month_summary` int(11) not null auto_increment,
   `id_campaign` int(11) not null,
   `id_brand` int(11) not null,
   `used_codes_amount` int(11) not null,
   `start` int(11) not null,
   PRIMARY KEY (`id_used_codes_month_summary`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- [Table `used_codes_month_summaries` is empty]

CREATE TABLE `used_codes_summaries` (
   `id_used_codes_summary` int(11) not null auto_increment,
   `id_brand` int(11) not null,
   `id_campaign` int(11) not null,
   `used_codes_amount` int(11) not null,
   PRIMARY KEY (`id_used_codes_summary`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- [Table `used_codes_summaries` is empty]

CREATE TABLE `used_codes_user_day_summaries` (
   `id_used_codes_user_day_summary` int(11) not null auto_increment,
   `id_user` int(11) not null,
   `id_brand` int(11) not null,
   `used_codes_amount` int(11) not null,
   `start` int(11) not null,
   PRIMARY KEY (`id_used_codes_user_day_summary`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- [Table `used_codes_user_day_summaries` is empty]

CREATE TABLE `used_codes_user_summaries` (
   `id_used_codes_user_summary` int(11) not null auto_increment,
   `id_user` int(11) not null,
   `id_brand` int(11) not null,
   `id_campaign` int(11) not null,
   `used_codes_amount` int(11) not null,
   PRIMARY KEY (`id_used_codes_user_summary`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- [Table `used_codes_user_summaries` is empty]

CREATE TABLE `user_field_data` (
   `id_user_field_data` int(11) not null auto_increment,
   `id_brand` int(11),
   `id_user` int(11) not null,
   `id_user_field` int(11) not null,
   `field_value` varchar(255) not null,
   PRIMARY KEY (`id_user_field_data`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

INSERT INTO `user_field_data` (`id_user_field_data`, `id_brand`, `id_user`, `id_user_field`, `field_value`) VALUES


CREATE TABLE `user_fields` (
   `id_user_field` int(11) not null auto_increment,
   `title` varchar(255) not null,
   `field_type` varchar(255) not null,
   `default_field` int(1),
   PRIMARY KEY (`id_user_field`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=3;

INSERT INTO `user_fields` (`id_user_field`, `title`, `field_type`, `default_field`) VALUES
('1', 'email', 'email', '1'),
('2', 'password', 'password', '1');

CREATE TABLE `user_groups` (
   `id_user_group` int(11) not null auto_increment,
   `id_brand` varchar(11) not null,
   `id_user` int(11) not null,
   `id_group` int(11) not null,
   PRIMARY KEY (`id_user_group`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- [Table `user_groups` is empty]

CREATE TABLE `user_notes` (
   `id_user_note` int(11) not null auto_increment,
   `id_user` int(11) not null,
   `id_brand` int(11) not null,
   `title` varchar(155) not null,
   `content` text not null,
   `created` int(11) not null,
   PRIMARY KEY (`id_user_note`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- [Table `user_notes` is empty]

CREATE TABLE `users` (
   `id_user` int(11) not null auto_increment,
   `id_brand` int(11) not null,
   `active` int(1) not null,
   `platform` varchar(155),
   `phone_key` varchar(255),
   `created` int(11) not null,
   `last_connection` int(11) not null,
   `resume_block_1_display` int(1) not null,
   `resume_block_2_display` int(1) not null,
   `resume_block_3_display` int(1) not null,
   `resume_block_4_display` int(1) not null,
   `resume_block_1_title` varchar(155) not null,
   `resume_block_2_title` varchar(155) not null,
   `resume_block_3_title` varchar(155) not null,
   `resume_block_4_title` varchar(155) not null,
   `resume_block_1_data` varchar(255) not null,
   `resume_block_2_data` varchar(255) not null,
   `resume_block_3_data` varchar(255) not null,
   `resume_block_4_data` varchar(255) not null,
   `resume_block_1_link_content` varchar(155) not null,
   `resume_block_2_link_content` varchar(155) not null,
   `resume_block_3_link_content` varchar(155) not null,
   `resume_block_4_link_content` varchar(155) not null,
   `resume_block_1_link` varchar(255) not null,
   `resume_block_2_link` varchar(255) not null,
   `resume_block_3_link` varchar(255) not null,
   `resume_block_4_link` varchar(255) not null,
   PRIMARY KEY (`id_user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

INSERT INTO `users` (`id_user`, `id_brand`, `active`, `platform`, `phone_key`, `created`, `last_connection`, `resume_block_1_display`, `resume_block_2_display`, `resume_block_3_display`, `resume_block_4_display`, `resume_block_1_title`, `resume_block_2_title`, `resume_block_3_title`, `resume_block_4_title`, `resume_block_1_data`, `resume_block_2_data`, `resume_block_3_data`, `resume_block_4_data`, `resume_block_1_link_content`, `resume_block_2_link_content`, `resume_block_3_link_content`, `resume_block_4_link_content`, `resume_block_1_link`, `resume_block_2_link`, `resume_block_3_link`, `resume_block_4_link`) VALUES

CREATE TABLE `validated_codes_day_summaries` (
   `id_validated_codes_day_summary` int(11) not null auto_increment,
   `id_brand` varchar(11),
   `id_admin` int(11) not null,
   `validated_codes_amount` int(11) not null,
   `start` int(11) not null,
   PRIMARY KEY (`id_validated_codes_day_summary`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- [Table `validated_codes_day_summaries` is empty]

CREATE TABLE `validated_codes_month_summaries` (
   `id_validated_codes_month_summary` int(11) not null auto_increment,
   `id_brand` varchar(11),
   `id_admin` int(11) not null,
   `validated_codes_amount` int(11) not null,
   `start` int(11) not null,
   PRIMARY KEY (`id_validated_codes_month_summary`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- [Table `validated_codes_month_summaries` is empty]
