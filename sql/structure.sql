-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Servidor: localhost:8889
-- Tiempo de generación: 18-08-2014 a las 11:52:27
-- Versión del servidor: 5.5.34
-- Versión de PHP: 5.5.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: `royappty`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admins`
--

CREATE TABLE `admins` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `id_brand` int(11) NOT NULL,
  `brand_admin` int(1) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `promo_password` varchar(255) NOT NULL,
  `active` int(1) NOT NULL,
  `verified` int(1) NOT NULL,
  `verification_code` varchar(255) NOT NULL,
  `created` int(11) NOT NULL,
  `last_connection` int(11) NOT NULL,
  `resume_block_1_display` int(1) NOT NULL,
  `resume_block_2_display` int(1) NOT NULL,
  `resume_block_3_display` int(1) NOT NULL,
  `resume_block_4_display` int(1) NOT NULL,
  `resume_block_1_title` varchar(155) NOT NULL,
  `resume_block_2_title` varchar(155) NOT NULL,
  `resume_block_3_title` varchar(155) NOT NULL,
  `resume_block_4_title` varchar(155) NOT NULL,
  `resume_block_1_data` varchar(255) NOT NULL,
  `resume_block_2_data` varchar(255) NOT NULL,
  `resume_block_3_data` varchar(255) NOT NULL,
  `resume_block_4_data` varchar(255) NOT NULL,
  `resume_block_1_link_content` varchar(155) NOT NULL,
  `resume_block_2_link_content` varchar(155) NOT NULL,
  `resume_block_3_link_content` varchar(155) NOT NULL,
  `resume_block_4_link_content` varchar(155) NOT NULL,
  `resume_block_1_link` varchar(255) NOT NULL,
  `resume_block_2_link` varchar(255) NOT NULL,
  `resume_block_3_link` varchar(255) NOT NULL,
  `resume_block_4_link` varchar(255) NOT NULL,
  `can_login` int(1) NOT NULL,
  `can_validate_codes` int(1) NOT NULL,
  `can_manage_campaigns` int(1) NOT NULL,
  `can_manage_admins` int(1) NOT NULL,
  `can_manage_users` int(1) NOT NULL,
  `can_manage_app` int(1) NOT NULL,
  `can_manage_brand` int(1) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apps`
--

CREATE TABLE `apps` (
  `id_app` int(11) NOT NULL AUTO_INCREMENT,
  `id_brand` int(11) NOT NULL,
  `name` varchar(155) NOT NULL,
  `description` text NOT NULL,
  `published_apple_store` int(1) NOT NULL,
  `published_google_play` int(1) NOT NULL,
  `app_title` varchar(255) NOT NULL,
  `app_icon_path` varchar(155) NOT NULL,
  `app_bg_path` varchar(155) NOT NULL,
  `automatic_screenshots` int(1) NOT NULL,
  `app_screenshot_1_path` varchar(155) NOT NULL,
  `app_screenshot_2_path` varchar(155) NOT NULL,
  `app_screenshot_3_path` varchar(155) NOT NULL,
  `app_screenshot_4_path` varchar(155) NOT NULL,
  PRIMARY KEY (`id_app`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `brands`
--

CREATE TABLE `brands` (
  `id_brand` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(155) NOT NULL,
  `cif` varchar(155) NOT NULL,
  `active` int(1) NOT NULL,
  `lock_date` int(11) DEFAULT NULL,
  `resume_block_1_display` int(1) NOT NULL,
  `resume_block_2_display` int(1) NOT NULL,
  `resume_block_3_display` int(1) NOT NULL,
  `resume_block_4_display` int(1) NOT NULL,
  `resume_block_1_title` varchar(155) NOT NULL,
  `resume_block_2_title` varchar(155) NOT NULL,
  `resume_block_3_title` varchar(155) NOT NULL,
  `resume_block_4_title` varchar(155) NOT NULL,
  `resume_block_1_data` varchar(255) NOT NULL,
  `resume_block_2_data` varchar(255) NOT NULL,
  `resume_block_3_data` varchar(255) NOT NULL,
  `resume_block_4_data` varchar(255) NOT NULL,
  `resume_block_1_link_content` varchar(155) NOT NULL,
  `resume_block_2_link_content` varchar(155) NOT NULL,
  `resume_block_3_link_content` varchar(155) NOT NULL,
  `resume_block_4_link_content` varchar(155) NOT NULL,
  `resume_block_1_link` varchar(255) NOT NULL,
  `resume_block_2_link` varchar(255) NOT NULL,
  `resume_block_3_link` varchar(255) NOT NULL,
  `resume_block_4_link` varchar(255) NOT NULL,
  `subscription_type` varchar(155) NOT NULL,
  `contact_name` varchar(255) NOT NULL,
  `contact_email` varchar(255) NOT NULL,
  `contact_phone` varchar(255) NOT NULL,
  `contact_address` varchar(255) NOT NULL,
  `contact_postal_code` varchar(255) NOT NULL,
  `contact_city` varchar(255) NOT NULL,
  `contact_province` varchar(255) NOT NULL,
  `contact_country` varchar(255) NOT NULL,
  `payment_plan` varchar(155) NOT NULL,
  `payment_method` varchar(155) NOT NULL,
  `payment_data` varchar(255) NOT NULL,
  `expiration_date` int(11) NOT NULL,
  PRIMARY KEY (`id_brand`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `brand_user_fields`
--

CREATE TABLE `brand_user_fields` (
  `id_brand_user_field` int(11) NOT NULL AUTO_INCREMENT,
  `id_brand` int(11) NOT NULL,
  `id_user_field` int(11) NOT NULL,
  `main_field` int(1) NOT NULL,
  PRIMARY KEY (`id_brand_user_field`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `campaigns`
--

CREATE TABLE `campaigns` (
  `id_campaign` int(11) NOT NULL AUTO_INCREMENT,
  `id_brand` int(11) NOT NULL,
  `id_group` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `title` varchar(155) NOT NULL,
  `content` varchar(500) NOT NULL,
  `button_title` varchar(155) NOT NULL,
  `type` int(1) NOT NULL,
  `group_name` varchar(75) NOT NULL,
  `status` int(1) NOT NULL,
  `coupons_number` int(11) NOT NULL,
  `usage_limit` int(1) NOT NULL,
  `cost` float NOT NULL,
  `profit` float NOT NULL,
  `campaign_icon_path` varchar(255) NOT NULL,
  `campaign_image_path` varchar(255) NOT NULL,
  `campaign_usage` int(11) NOT NULL,
  `campaign_usage_last_month` int(11) NOT NULL,
  `resume_block_1_display` int(1) NOT NULL,
  `resume_block_2_display` int(1) NOT NULL,
  `resume_block_3_display` int(1) NOT NULL,
  `resume_block_4_display` int(1) NOT NULL,
  `resume_block_1_title` varchar(155) NOT NULL,
  `resume_block_2_title` varchar(155) NOT NULL,
  `resume_block_3_title` varchar(155) NOT NULL,
  `resume_block_4_title` varchar(155) NOT NULL,
  `resume_block_1_data` varchar(255) NOT NULL,
  `resume_block_2_data` varchar(255) NOT NULL,
  `resume_block_3_data` varchar(255) NOT NULL,
  `resume_block_4_data` varchar(255) NOT NULL,
  `resume_block_1_link_content` varchar(155) NOT NULL,
  `resume_block_2_link_content` varchar(155) NOT NULL,
  `resume_block_3_link_content` varchar(155) NOT NULL,
  `resume_block_4_link_content` varchar(155) NOT NULL,
  `resume_block_1_link` varchar(255) NOT NULL,
  `resume_block_2_link` varchar(255) NOT NULL,
  `resume_block_3_link` varchar(255) NOT NULL,
  `resume_block_4_link` varchar(255) NOT NULL,
  PRIMARY KEY (`id_campaign`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `campaign_notes`
--

CREATE TABLE `campaign_notes` (
  `id_campaign_note` int(11) NOT NULL AUTO_INCREMENT,
  `id_campaign` int(11) NOT NULL,
  `id_brand` int(11) NOT NULL,
  `title` varchar(155) NOT NULL,
  `content` text NOT NULL,
  `created` int(11) NOT NULL,
  PRIMARY KEY (`id_campaign_note`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config`
--

CREATE TABLE `config` (
  `id_config` int(11) NOT NULL AUTO_INCREMENT,
  `used` int(1) NOT NULL,
  `close` int(1) NOT NULL,
  `launch` int(1) NOT NULL,
  `company_logo_path` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_street` varchar(255) NOT NULL,
  `company_town` varchar(255) NOT NULL,
  `company_country` varchar(255) NOT NULL,
  `company_phone` varchar(255) NOT NULL,
  `company_info_mail` varchar(255) NOT NULL,
  `mail_header_email` varchar(255) NOT NULL,
  `footer_mail` varchar(255) NOT NULL,
  `debug_mode` int(1) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `bank_swift` varchar(255) NOT NULL,
  `bank_iban` varchar(255) NOT NULL,
  `bank_account_number` varchar(255) NOT NULL,
  `bank_transfer_beneficiary` varchar(255) NOT NULL,
  PRIMARY KEY (`id_config`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `groups`
--

CREATE TABLE `groups` (
  `id_group` int(11) NOT NULL AUTO_INCREMENT,
  `id_brand` int(11) NOT NULL,
  `name` varchar(155) NOT NULL,
  `created` int(11) NOT NULL,
  `resume_block_1_display` int(1) NOT NULL,
  `resume_block_2_display` int(1) NOT NULL,
  `resume_block_3_display` int(1) NOT NULL,
  `resume_block_4_display` int(1) NOT NULL,
  `resume_block_1_title` varchar(155) NOT NULL,
  `resume_block_2_title` varchar(155) NOT NULL,
  `resume_block_3_title` varchar(155) NOT NULL,
  `resume_block_4_title` varchar(155) NOT NULL,
  `resume_block_1_data` varchar(255) NOT NULL,
  `resume_block_2_data` varchar(255) NOT NULL,
  `resume_block_3_data` varchar(255) NOT NULL,
  `resume_block_4_data` varchar(255) NOT NULL,
  `resume_block_1_link_content` varchar(155) NOT NULL,
  `resume_block_2_link_content` varchar(155) NOT NULL,
  `resume_block_3_link_content` varchar(155) NOT NULL,
  `resume_block_4_link_content` varchar(155) NOT NULL,
  `resume_block_1_link` varchar(255) NOT NULL,
  `resume_block_2_link` varchar(255) NOT NULL,
  `resume_block_3_link` varchar(255) NOT NULL,
  `resume_block_4_link` varchar(255) NOT NULL,
  PRIMARY KEY (`id_group`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `group_notes`
--

CREATE TABLE `group_notes` (
  `id_group_note` int(11) NOT NULL AUTO_INCREMENT,
  `id_group` int(11) NOT NULL,
  `id_brand` int(11) NOT NULL,
  `title` varchar(155) NOT NULL,
  `content` text NOT NULL,
  `created` int(11) NOT NULL,
  PRIMARY KEY (`id_group_note`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notifications`
--

CREATE TABLE `notifications` (
  `id_notification` int(11) NOT NULL AUTO_INCREMENT,
  `id_brand` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `id_group` int(11) NOT NULL,
  `group_name` varchar(75) NOT NULL,
  `created` int(11) NOT NULL,
  PRIMARY KEY (`id_notification`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL AUTO_INCREMENT,
  `id_brand` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `subscription_type` varchar(155) NOT NULL,
  `payment_plan` varchar(255) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `amount` float NOT NULL,
  PRIMARY KEY (`id_order`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `receipts`
--

CREATE TABLE `receipts` (
  `id_receipt` int(11) NOT NULL AUTO_INCREMENT,
  `id_brand` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `payment_method` int(1) NOT NULL,
  `distributor_name` varchar(255) NOT NULL,
  `distributor_id` varchar(255) NOT NULL,
  `distributor_address` varchar(255) NOT NULL,
  `distributor_postal_code` varchar(255) NOT NULL,
  `distributor_city` varchar(255) NOT NULL,
  `distributor_country` varchar(255) NOT NULL,
  `price` float(11,2) NOT NULL,
  `vat` float(11,2) NOT NULL,
  `price_vat` float(11,2) NOT NULL,
  PRIMARY KEY (`id_receipt`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `receipt_lines`
--

CREATE TABLE `receipt_lines` (
  `id_receipt_line` int(11) NOT NULL AUTO_INCREMENT,
  `id_receipt` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `amount` float(4,2) NOT NULL,
  `price` float(4,2) NOT NULL,
  `vat` float(4,2) NOT NULL,
  `price_vat` float(4,2) NOT NULL,
  PRIMARY KEY (`id_receipt_line`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recovery_codes`
--

CREATE TABLE `recovery_codes` (
  `id_recovery_code` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `code` varchar(255) NOT NULL,
  PRIMARY KEY (`id_recovery_code`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `requests`
--

CREATE TABLE `requests` (
  `id_request` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `id_brand` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created` int(11) NOT NULL,
  `data` text NOT NULL,
  PRIMARY KEY (`id_request`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `software_news`
--

CREATE TABLE `software_news` (
  `id_software_new` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(75) NOT NULL,
  `created` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  PRIMARY KEY (`id_software_new`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subscription_method_plans`
--

CREATE TABLE `subscription_method_plans` (
  `id_subscription_method_plan` int(11) NOT NULL AUTO_INCREMENT,
  `subscription_type` varchar(255) NOT NULL,
  `payment_plan` varchar(255) NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`id_subscription_method_plan`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `used_codes`
--

CREATE TABLE `used_codes` (
  `id_used_codes` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_campaign` int(11) NOT NULL,
  `id_brand` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  PRIMARY KEY (`id_used_codes`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `used_codes_day_summaries`
--

CREATE TABLE `used_codes_day_summaries` (
  `id_used_codes_day_summary` int(11) NOT NULL AUTO_INCREMENT,
  `id_campaign` int(11) NOT NULL,
  `id_brand` int(11) NOT NULL,
  `used_codes_amount` int(11) NOT NULL,
  `start` int(11) NOT NULL,
  PRIMARY KEY (`id_used_codes_day_summary`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `used_codes_month_summaries`
--

CREATE TABLE `used_codes_month_summaries` (
  `id_used_codes_month_summary` int(11) NOT NULL AUTO_INCREMENT,
  `id_campaign` int(11) NOT NULL,
  `id_brand` int(11) NOT NULL,
  `used_codes_amount` int(11) NOT NULL,
  `start` int(11) NOT NULL,
  PRIMARY KEY (`id_used_codes_month_summary`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `used_codes_summaries`
--

CREATE TABLE `used_codes_summaries` (
  `id_used_codes_summary` int(11) NOT NULL AUTO_INCREMENT,
  `id_brand` int(11) NOT NULL,
  `id_campaign` int(11) NOT NULL,
  `used_codes_amount` int(11) NOT NULL,
  PRIMARY KEY (`id_used_codes_summary`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `used_codes_user_day_summaries`
--

CREATE TABLE `used_codes_user_day_summaries` (
  `id_used_codes_user_day_summary` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_brand` int(11) NOT NULL,
  `used_codes_amount` int(11) NOT NULL,
  `start` int(11) NOT NULL,
  PRIMARY KEY (`id_used_codes_user_day_summary`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `used_codes_user_summaries`
--

CREATE TABLE `used_codes_user_summaries` (
  `id_used_codes_user_summary` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_brand` int(11) NOT NULL,
  `id_campaign` int(11) NOT NULL,
  `used_codes_amount` int(11) NOT NULL,
  PRIMARY KEY (`id_used_codes_user_summary`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `id_brand` int(11) NOT NULL,
  `active` int(1) NOT NULL,
  `created` int(11) NOT NULL,
  `last_connection` int(11) NOT NULL,
  `resume_block_1_display` int(1) NOT NULL,
  `resume_block_2_display` int(1) NOT NULL,
  `resume_block_3_display` int(1) NOT NULL,
  `resume_block_4_display` int(1) NOT NULL,
  `resume_block_1_title` varchar(155) NOT NULL,
  `resume_block_2_title` varchar(155) NOT NULL,
  `resume_block_3_title` varchar(155) NOT NULL,
  `resume_block_4_title` varchar(155) NOT NULL,
  `resume_block_1_data` varchar(255) NOT NULL,
  `resume_block_2_data` varchar(255) NOT NULL,
  `resume_block_3_data` varchar(255) NOT NULL,
  `resume_block_4_data` varchar(255) NOT NULL,
  `resume_block_1_link_content` varchar(155) NOT NULL,
  `resume_block_2_link_content` varchar(155) NOT NULL,
  `resume_block_3_link_content` varchar(155) NOT NULL,
  `resume_block_4_link_content` varchar(155) NOT NULL,
  `resume_block_1_link` varchar(255) NOT NULL,
  `resume_block_2_link` varchar(255) NOT NULL,
  `resume_block_3_link` varchar(255) NOT NULL,
  `resume_block_4_link` varchar(255) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_fields`
--

CREATE TABLE `user_fields` (
  `id_user_field` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `field_type` varchar(255) NOT NULL,
  PRIMARY KEY (`id_user_field`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_field_data`
--

CREATE TABLE `user_field_data` (
  `id_user_field_data` int(11) NOT NULL AUTO_INCREMENT,
  `id_brand` int(11) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `id_user_field` int(11) NOT NULL,
  `field_value` varchar(255) NOT NULL,
  PRIMARY KEY (`id_user_field_data`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_groups`
--

CREATE TABLE `user_groups` (
  `id_user_group` int(11) NOT NULL AUTO_INCREMENT,
  `id_brand` varchar(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_group` int(11) NOT NULL,
  PRIMARY KEY (`id_user_group`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_notes`
--

CREATE TABLE `user_notes` (
  `id_user_note` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_brand` int(11) NOT NULL,
  `title` varchar(155) NOT NULL,
  `content` text NOT NULL,
  `created` int(11) NOT NULL,
  PRIMARY KEY (`id_user_note`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `validated_codes_day_summaries`
--

CREATE TABLE `validated_codes_day_summaries` (
  `id_validated_codes_day_summary` int(11) NOT NULL AUTO_INCREMENT,
  `id_brand` varchar(11) DEFAULT NULL,
  `id_admin` int(11) NOT NULL,
  `validated_codes_amount` int(11) NOT NULL,
  `start` int(11) NOT NULL,
  PRIMARY KEY (`id_validated_codes_day_summary`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `validated_codes_month_summaries`
--

CREATE TABLE `validated_codes_month_summaries` (
  `id_validated_codes_month_summary` int(11) NOT NULL AUTO_INCREMENT,
  `id_brand` varchar(11) DEFAULT NULL,
  `id_admin` int(11) NOT NULL,
  `validated_codes_amount` int(11) NOT NULL,
  `start` int(11) NOT NULL,
  PRIMARY KEY (`id_validated_codes_month_summary`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;



INSERT INTO `config` (`id_config`, `used`, `close`, `launch`, `company_logo_path`, `company_name`, `company_street`, `company_town`, `company_country`, `company_phone`, `company_info_mail`, `mail_header_email`, `footer_mail`, `debug_mode`, `bank_name`, `bank_swift`, `bank_iban`, `bank_account_number`, `bank_transfer_beneficiary`) VALUES
(1, 1, 0, 1, 'server/app/assets/img/royappty-logo.png', 'Royappty', 'Menendez Pelayo 3', 'Vigo', 'Spain', '886131361', 'info@royappty.com', 'Royappty<noreply@royappty.com>', 'La Aplicación de Fidelización para tu Negocio', 1, '0000', '0000', '0000', '0000', '0000');

INSERT INTO `user_fields` (`id_user_field`, `title`, `field_type`) VALUES
(1, 'name', 'text');
