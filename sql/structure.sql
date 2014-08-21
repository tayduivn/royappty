-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Servidor: localhost:8889
-- Tiempo de generación: 21-08-2014 a las 18:50:47
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `admins`
--

INSERT INTO `admins` (`id_admin`, `id_brand`, `brand_admin`, `email`, `name`, `password`, `promo_password`, `active`, `verified`, `verification_code`, `created`, `last_connection`, `resume_block_1_display`, `resume_block_2_display`, `resume_block_3_display`, `resume_block_4_display`, `resume_block_1_title`, `resume_block_2_title`, `resume_block_3_title`, `resume_block_4_title`, `resume_block_1_data`, `resume_block_2_data`, `resume_block_3_data`, `resume_block_4_data`, `resume_block_1_link_content`, `resume_block_2_link_content`, `resume_block_3_link_content`, `resume_block_4_link_content`, `resume_block_1_link`, `resume_block_2_link`, `resume_block_3_link`, `resume_block_4_link`, `can_login`, `can_validate_codes`, `can_manage_campaigns`, `can_manage_admins`, `can_manage_users`, `can_manage_app`, `can_manage_brand`) VALUES
(1, 1, 1, 'enrealidadeshotmail@gmail.com', 'Pablo GutiÃ©rrez Alfaro', 'dd4b21e9ef71e1291183a46b913ae6f2', '', 1, 0, '84f84e8cf7d73a8ff0854f39a49486ac', 1404911820, 1408434120, 1, 1, 1, 0, 'admin_validated_this_month', 'admin_validated_this_today', 'admin_validated', '', '0', '0', '0', '', 'view_more', 'view_more', 'view_more', '', '', '', '', '', 1, 1, 1, 1, 1, 1, 1),
(3, 2, 1, '78879897789@789789789.com', '789897879', 'dd4b21e9ef71e1291183a46b913ae6f2', '', 1, 0, '9dd5004508993db9697be85628f6f2fd', 1405083120, 0, 1, 1, 1, 0, 'admin_validated_this_month', 'admin_validated_this_today', 'admin_validated', '', '0', '0', '0', '', 'view_more', 'view_more', 'view_more', '', '', '', '', '', 1, 1, 1, 1, 1, 1, 1),
(4, 1, 0, '', 'Pedrito', 'd41d8cd98f00b204e9800998ecf8427e', '000000', 1, 0, '', 1405364833, 0, 1, 1, 1, 0, 'admin_validated_this_month', 'admin_validated_this_today', 'admin_validated', '', '0', '0', '0', '', 'view_more', 'view_more', 'view_more', '', '', '', '', '', 0, 1, 0, 0, 0, 0, 0),
(5, 7, 1, '879789879@78979878.com', '789798897789', 'dd4b21e9ef71e1291183a46b913ae6f2', '', 1, 0, 'f90b72bb9ba3b3529e2ac4bcb6a35afe', 1405596360, 0, 1, 1, 1, 0, 'admin_validated_this_month', 'admin_validated_this_today', 'admin_validated', '', '0', '0', '0', '', 'view_more', 'view_more', 'view_more', '', '', '', '', '', 1, 1, 1, 1, 1, 1, 1),
(6, 8, 1, 'pablo@vivalacloud.com', '98798789789', 'dd4b21e9ef71e1291183a46b913ae6f2', '', 1, 1, '86cea5c12a8542895ea1fab6b4c994eb', 1405600140, 1405601880, 1, 1, 1, 0, 'admin_validated_this_month', 'admin_validated_this_today', 'admin_validated', '', '0', '0', '0', '', 'view_more', 'view_more', 'view_more', '', '', '', '', '', 1, 1, 1, 1, 1, 1, 1),
(7, 9, 1, 'dsadsadsa@adsdsadas.com', 'sadsda', 'dd4b21e9ef71e1291183a46b913ae6f2', '', 1, 0, '071db8cf93b74efef6a17d6366182cd8', 1407738780, 0, 1, 1, 1, 0, 'admin_validated_this_month', 'admin_validated_this_today', 'admin_validated', '', '0', '0', '0', '', 'view_more', 'view_more', 'view_more', '', '', '', '', '', 1, 1, 1, 1, 1, 1, 1),
(8, 10, 1, 'pablo2@vivalacloud.com', 'Pablo', 'dd4b21e9ef71e1291183a46b913ae6f2', '', 1, 0, '94c4f33e6a5d85468854e6e32115a8a7', 1408345140, 0, 1, 1, 1, 0, 'admin_validated_this_month', 'admin_validated_this_today', 'admin_validated', '', '0', '0', '0', '', 'view_more', 'view_more', 'view_more', '', '', '', '', '', 1, 0, 1, 1, 1, 1, 1),
(9, 11, 1, 'pablo3@vivalacloud.com', 'Pablo', 'dd4b21e9ef71e1291183a46b913ae6f2', '', 1, 0, 'a68f1e313d2e5b342f46e7964b60cb81', 1408345860, 1408345860, 1, 1, 1, 0, 'admin_validated_this_month', 'admin_validated_this_today', 'admin_validated', '', '0', '0', '0', '', 'view_more', 'view_more', 'view_more', '', '', '', '', '', 1, 0, 1, 1, 1, 1, 1),
(10, 12, 1, '000000@000000.com', 'Pablo GutiÃ©rrez Alfaro', 'ff3ad6166a8c3123313a114730444a6e', '', 1, 0, '59f849d60f543ff385b1ab1ed50ff4bc', 1408347000, 0, 1, 1, 1, 0, 'admin_validated_this_month', 'admin_validated_this_today', 'admin_validated', '', '0', '0', '0', '', 'view_more', 'view_more', 'view_more', '', '', '', '', '', 1, 0, 1, 1, 1, 1, 1),
(11, 13, 1, 'pablo4@vivalacloud.com', 'Viva la Cloud', 'dd4b21e9ef71e1291183a46b913ae6f2', '', 1, 0, 'c010f02067173e29bc6012923d9bcd43', 1408556460, 0, 1, 1, 1, 0, 'admin_validated_this_month', 'admin_validated_this_today', 'admin_validated', '', '0', '0', '0', '', 'view_more', 'view_more', 'view_more', '', '', '', '', '', 1, 0, 1, 1, 1, 1, 1);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `apps`
--

INSERT INTO `apps` (`id_app`, `id_brand`, `name`, `description`, `published_apple_store`, `published_google_play`, `app_title`, `app_icon_path`, `app_bg_path`, `automatic_screenshots`, `app_screenshot_1_path`, `app_screenshot_2_path`, `app_screenshot_3_path`, `app_screenshot_4_path`) VALUES
(1, 1, 'Viva la Cloud', 'Descubre todas nuestras Promos en nuestra nueva aplicaciÃ³n!', 1, 1, 'Promociones', '1407493080.jpg', '1407493140.jpg', 0, '', '', '', ''),
(2, 2, '987789', '798789978798789', 0, 0, '789789789789', '1405083120.jpg', '1405083120.jpg', 0, '', '', '', ''),
(3, 7, '97789', '789789789789879\n', 0, 0, '978789789789', '1405596360.jpg', '1405596360.jpg', 0, '', '', '', ''),
(4, 8, '779789789', '789789789789879\n', 0, 0, '789789789879', '1405600140.jpg', '1405600140.jpg', 0, '', '', '', ''),
(5, 9, '789798798789789', '789789879789897', 0, 0, '897897978789', '1407738780.jpg', '1407738780.jpg', 0, '', '', '', ''),
(6, 10, '', '', 0, 0, '', '', '', 0, '', '', '', ''),
(7, 11, '', '', 0, 0, '', '', '', 0, '', '', '', ''),
(8, 12, '', '', 0, 0, '', '', '', 0, '', '', '', ''),
(9, 13, '', '', 0, 0, '', '', '', 0, '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `brands`
--

CREATE TABLE `brands` (
  `id_brand` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(155) NOT NULL,
  `cif` varchar(155) NOT NULL,
  `active` int(1) NOT NULL,
  `created` int(11) NOT NULL,
  `lock_date` int(11) DEFAULT NULL,
  `android_project_name` varchar(255) NOT NULL,
  `android_project_id` varchar(255) NOT NULL,
  `android_project_number` varchar(255) NOT NULL,
  `android_server_key` varchar(255) NOT NULL,
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `brands`
--

INSERT INTO `brands` (`id_brand`, `name`, `cif`, `active`, `created`, `lock_date`, `android_project_name`, `android_project_id`, `android_project_number`, `android_server_key`, `resume_block_1_display`, `resume_block_2_display`, `resume_block_3_display`, `resume_block_4_display`, `resume_block_1_title`, `resume_block_2_title`, `resume_block_3_title`, `resume_block_4_title`, `resume_block_1_data`, `resume_block_2_data`, `resume_block_3_data`, `resume_block_4_data`, `resume_block_1_link_content`, `resume_block_2_link_content`, `resume_block_3_link_content`, `resume_block_4_link_content`, `resume_block_1_link`, `resume_block_2_link`, `resume_block_3_link`, `resume_block_4_link`, `subscription_type`, `contact_name`, `contact_email`, `contact_phone`, `contact_address`, `contact_postal_code`, `contact_city`, `contact_province`, `contact_country`, `payment_plan`, `payment_method`, `payment_data`, `expiration_date`) VALUES
(13, 'Viva la Cloud SL', '53184227Q', 1, 1408556460, NULL, 'RY 0000001 Floristeria', 'ry-0000001-floristeria', '0000', '879789', 1, 1, 1, 1, 'campaigns', 'usage_this_month', 'usage_this_today', 'users', '0', '0', '0', '0', '', '', '', '', '', '', '', '', 'starter', '', '', '', 'Menendez Pelayo 3 Bajo', '36202', 'Vigo', 'Pontevedra', 'EspaÃ±a', 'monthly', 'paypal', '', 1416508860);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Volcado de datos para la tabla `brand_user_fields`
--

INSERT INTO `brand_user_fields` (`id_brand_user_field`, `id_brand`, `id_user_field`, `main_field`) VALUES
(18, 1, 2, 0),
(2, 2, 2, 1),
(3, 7, 0, 1),
(4, 8, 0, 1),
(19, 9, 2, 1),
(20, 10, 0, 1),
(21, 11, 0, 1),
(22, 12, 0, 1),
(23, 13, 0, 1);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=109 ;

--
-- Volcado de datos para la tabla `campaigns`
--

INSERT INTO `campaigns` (`id_campaign`, `id_brand`, `id_group`, `name`, `description`, `title`, `content`, `button_title`, `type`, `group_name`, `status`, `coupons_number`, `usage_limit`, `cost`, `profit`, `campaign_icon_path`, `campaign_image_path`, `campaign_usage`, `campaign_usage_last_month`, `resume_block_1_display`, `resume_block_2_display`, `resume_block_3_display`, `resume_block_4_display`, `resume_block_1_title`, `resume_block_2_title`, `resume_block_3_title`, `resume_block_4_title`, `resume_block_1_data`, `resume_block_2_data`, `resume_block_3_data`, `resume_block_4_data`, `resume_block_1_link_content`, `resume_block_2_link_content`, `resume_block_3_link_content`, `resume_block_4_link_content`, `resume_block_1_link`, `resume_block_2_link`, `resume_block_3_link`, `resume_block_4_link`) VALUES
(105, 1, 7, 'sdadsadsa', 'sdadsadsa', 'dsadasads', 'sadasddsa', 'dsaasdsdadsa', 2, 'asdsadsaadsads', 1, 0, 0, 0, 0, '1407741240.jpg', '1407741240.jpg', 0, 0, 1, 1, 1, 0, 'campaign_usage_this_month', 'campaign_usage_today', 'campaign_usage_total', '', '0', '0', '0', '', '', '', '', '', '', '', '', ''),
(106, 1, 7, 'asddsasda', 'asddsasda', 'saddsaads', 'dsadsadsadsadsa', 'sdaadsdsadsa', 1, 'asdsadsaadsads', 1, 456465, 456465, 4456, 465456, '1407828300.jpg', '1407828300.jpg', 0, 0, 1, 1, 1, 0, 'campaign_usage_this_month', 'campaign_usage_today', 'campaign_usage_total', '', '0', '0', '0', '', '', '', '', '', '', '', '', ''),
(107, 1, 0, '122121', '879789789789897897978789', '2121211212', '21121221', '12212121', 1, 'all_users', 1, 21, 21, 21, 12, '1407828360.jpg', '1407828360.jpg', 0, 0, 1, 1, 1, 0, 'campaign_usage_this_month', 'campaign_usage_today', 'campaign_usage_total', '', '0', '0', '0', '', '', '', '', '', '', '', '', ''),
(108, 1, 7, 'asddsa', 'sadsdadsa', '231231', '231', '213231213', 1, 'asdsadsaadsads', 1, 21, 321, 231, 213, '1407828420.jpg', '1407828420.jpg', 0, 0, 1, 1, 1, 0, 'campaign_usage_this_month', 'campaign_usage_today', 'campaign_usage_total', '', '0', '0', '0', '', '', '', '', '', '', '', '', '');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `campaign_notes`
--

INSERT INTO `campaign_notes` (`id_campaign_note`, `id_campaign`, `id_brand`, `title`, `content`, `created`) VALUES
(1, 93, 1, 'Error en las Promos', 'Existe un error en las promociones', 1404912875),
(2, 93, 1, 'adsadsdasdsadasddasdasadsasdasddasadsads', '', 1405022702),
(3, 93, 1, 'dasdasads', 'adsdasdasdasdsasddas', 1405023310),
(4, 93, 1, 'dsadasadsdas', 'adsadsadsdsa', 1405023315),
(5, 93, 1, 'adsdasads', 'adsdasdasdas', 1405023319),
(6, 93, 1, 'adsdasdasdsadsasddsa', 'dsadasadsdasads', 1405023324),
(7, 93, 1, 'asddasads', 'dsdsadsaadsassda', 1405023328),
(8, 93, 1, 'sdaadsadsdasds', 'adsadsadasdassa', 1405023333),
(9, 93, 1, 'saddsaadsdas', 'adsadsdsadsadsadsadsa', 1405023338),
(10, 93, 1, 'sadadsadsasddsa', 'dsadsadsadsdsadsasdadas', 1405023346),
(11, 93, 1, 'saddasdasdsa', 'dsadsadsaadsadsdsadsadsaasd', 1405023352),
(13, 100, 1, '', '', 1405068029),
(14, 103, 1, '87987987', '78987789789978cxv789cx789789xc789ca789as789adasdsadasdadsadsads', 1405366560);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `config`
--

INSERT INTO `config` (`id_config`, `used`, `close`, `launch`, `company_logo_path`, `company_name`, `company_street`, `company_town`, `company_country`, `company_phone`, `company_info_mail`, `mail_header_email`, `footer_mail`, `debug_mode`, `bank_name`, `bank_swift`, `bank_iban`, `bank_account_number`, `bank_transfer_beneficiary`) VALUES
(2, 1, 0, 1, 'server/app/assets/img/royappty-logo.png', 'Royappty', 'Menendez Pelayo 3', 'Vigo', 'Spain', '886131361', 'info@royappty.com', 'Royappty<noreply@royappty.com>', 'La Aplicación de Fidelización para tu Negocio', 1, '0000', '0000', '0000', '0000', '0000');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `groups`
--

INSERT INTO `groups` (`id_group`, `id_brand`, `name`, `created`, `resume_block_1_display`, `resume_block_2_display`, `resume_block_3_display`, `resume_block_4_display`, `resume_block_1_title`, `resume_block_2_title`, `resume_block_3_title`, `resume_block_4_title`, `resume_block_1_data`, `resume_block_2_data`, `resume_block_3_data`, `resume_block_4_data`, `resume_block_1_link_content`, `resume_block_2_link_content`, `resume_block_3_link_content`, `resume_block_4_link_content`, `resume_block_1_link`, `resume_block_2_link`, `resume_block_3_link`, `resume_block_4_link`) VALUES
(7, 1, 'asdsadsaadsads', 1405076845, 1, 1, 1, 0, 'group_usage_this_month', 'group_usage_today', 'group_users', '', '0', '0', '0', '', '', '', '', '', '', '', '', '');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `group_notes`
--

INSERT INTO `group_notes` (`id_group_note`, `id_group`, `id_brand`, `title`, `content`, `created`) VALUES
(4, 7, 1, 'dfsfdsfdsfdsfdsfdsfdsdfsfdfdsdsfdfsdfsfdsfdsdsfdfsdfsdfsfds', '', 1405077973);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `notifications`
--

INSERT INTO `notifications` (`id_notification`, `id_brand`, `content`, `id_group`, `group_name`, `created`) VALUES
(13, 1, 'saddaadsadsas', 7, 'asdsadsaadsads', 1407779220),
(9, 1, '11111', 0, 'Todos los usuarios', 1407778860),
(10, 1, '222222222', 0, 'Todos los usuarios', 1407778860),
(11, 1, 'dasdassadads', 0, 'Todos los usuarios', 1407779100),
(12, 1, 'ssss', 0, 'Todos los usuarios', 1407779100);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=230 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recovery_codes`
--

CREATE TABLE `recovery_codes` (
  `id_recovery_code` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `code` varchar(255) NOT NULL,
  PRIMARY KEY (`id_recovery_code`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Volcado de datos para la tabla `requests`
--

INSERT INTO `requests` (`id_request`, `code`, `id_brand`, `type`, `status`, `created`, `data`) VALUES
(1, '53BD40ED', 1, 'app_creation', 'in_process', 1404911820, ''),
(2, '3457EABBB', 2, 'app_creation', 'in_process', 1405083120, ''),
(3, '53C7B2D7', 7, 'app_creation', 'in_process', 1405596360, ''),
(4, '53C7C19B', 8, 'app_creation', 'in_process', 1405600140, ''),
(5, '346EDCF95', 1, 'app_update', 'in_process', 1407489180, ''),
(6, '346EE417D', 1, 'app_update', 'in_process', 1407492120, ''),
(7, '346EE50AF', 1, 'app_update', 'in_process', 1407492480, ''),
(8, '346EE54E7', 1, 'app_update', 'in_process', 1407492600, ''),
(9, '346EE59FB', 1, 'app_update', 'in_process', 1407492720, ''),
(10, '346EE5D9D', 1, 'app_update', 'in_process', 1407492840, ''),
(11, '346EE5EB5', 1, 'app_update', 'in_process', 1407492840, ''),
(12, '346EE644B', 1, 'app_update', 'in_process', 1407493020, ''),
(13, '346EE6545', 1, 'app_update', 'in_process', 1407493020, ''),
(14, '346EE6685', 1, 'app_update', 'in_process', 1407493080, ''),
(15, '346EE6829', 1, 'app_update', 'in_process', 1407493080, ''),
(16, '346EE6865', 1, 'app_update', 'in_process', 1407493080, ''),
(17, '346EE69D7', 1, 'app_update', 'in_process', 1407493140, ''),
(18, '346EE6A13', 1, 'app_update', 'in_process', 1407493140, ''),
(19, '34713E5CF', 9, 'app_creation', 'in_process', 1407738780, ''),
(20, '20CA6430DA', 10, 'app_creation', 'in_process', 1408345140, ''),
(21, '20CA65475F', 11, 'app_creation', 'in_process', 1408345860, ''),
(22, '20CA670960', 12, 'app_creation', 'in_process', 1408347000, ''),
(23, '20CBA69AC1', 13, 'account_creation', 'in_process', 1408556460, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ryadmins`
--

CREATE TABLE `ryadmins` (
  `id_ryadmin` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `active` int(1) NOT NULL,
  `created` int(1) NOT NULL,
  `last_login` int(1) NOT NULL,
  `last_activity` int(1) NOT NULL,
  `resume_block_1_display` int(1) NOT NULL,
  `resume_block_1_title` varchar(255) NOT NULL,
  `resume_block_2_display` int(1) NOT NULL,
  `resume_block_2_title` varchar(255) NOT NULL,
  `resume_block_3_display` int(1) NOT NULL,
  `resume_block_3_title` varchar(255) NOT NULL,
  `resume_block_4_display` int(1) NOT NULL,
  `resume_block_4_title` varchar(255) NOT NULL,
  PRIMARY KEY (`id_ryadmin`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `ryadmins`
--

INSERT INTO `ryadmins` (`id_ryadmin`, `name`, `email`, `password`, `active`, `created`, `last_login`, `last_activity`, `resume_block_1_display`, `resume_block_1_title`, `resume_block_2_display`, `resume_block_2_title`, `resume_block_3_display`, `resume_block_3_title`, `resume_block_4_display`, `resume_block_4_title`) VALUES
(4, 'Pablo Gutierrez', 'enrealidadeshotmail@gmail.com', 'dd4b21e9ef71e1291183a46b913ae6f2', 1, 1408435200, 1408532580, 1408629780, 1, 'total_campaigns', 1, 'total_brands', 1, 'total_users', 1, 'total_monthly_revenue');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Volcado de datos para la tabla `used_codes`
--

INSERT INTO `used_codes` (`id_used_codes`, `id_user`, `id_campaign`, `id_brand`, `id_admin`, `created`, `code`) VALUES
(15, 2, 92, 1, 1, 1404976020, '2L0OKSISK'),
(16, 2, 92, 1, 1, 1404976020, '2L0OKSISK'),
(17, 2, 92, 1, 1, 1404976020, '2L0OKSISK'),
(18, 2, 92, 1, 1, 1404976020, '2L0OKSISK'),
(19, 2, 92, 1, 1, 1404976020, '2L0OKSISK'),
(20, 2, 92, 1, 1, 1404976020, '2L0OKSISK'),
(21, 2, 92, 1, 1, 1404976020, '2L0OKSISK');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `used_codes_day_summaries`
--

INSERT INTO `used_codes_day_summaries` (`id_used_codes_day_summary`, `id_campaign`, `id_brand`, `used_codes_amount`, `start`) VALUES
(6, 92, 1, 7, 1404943200);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `used_codes_month_summaries`
--

INSERT INTO `used_codes_month_summaries` (`id_used_codes_month_summary`, `id_campaign`, `id_brand`, `used_codes_amount`, `start`) VALUES
(3, 92, 1, 7, 1404165600);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `used_codes_summaries`
--

INSERT INTO `used_codes_summaries` (`id_used_codes_summary`, `id_brand`, `id_campaign`, `used_codes_amount`) VALUES
(3, 1, 92, 7);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `used_codes_user_day_summaries`
--

INSERT INTO `used_codes_user_day_summaries` (`id_used_codes_user_day_summary`, `id_user`, `id_brand`, `used_codes_amount`, `start`) VALUES
(6, 2, 1, 7, 1404943200);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `used_codes_user_summaries`
--

INSERT INTO `used_codes_user_summaries` (`id_used_codes_user_summary`, `id_user`, `id_brand`, `id_campaign`, `used_codes_amount`) VALUES
(5, 2, 1, 0, 7);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_user`, `id_brand`, `active`, `created`, `last_connection`, `resume_block_1_display`, `resume_block_2_display`, `resume_block_3_display`, `resume_block_4_display`, `resume_block_1_title`, `resume_block_2_title`, `resume_block_3_title`, `resume_block_4_title`, `resume_block_1_data`, `resume_block_2_data`, `resume_block_3_data`, `resume_block_4_data`, `resume_block_1_link_content`, `resume_block_2_link_content`, `resume_block_3_link_content`, `resume_block_4_link_content`, `resume_block_1_link`, `resume_block_2_link`, `resume_block_3_link`, `resume_block_4_link`) VALUES
(1, 1, 1, 1404911820, 1404911820, 0, 0, 0, 0, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(2, 1, 1, 1404911880, 1405346160, 0, 0, 0, 0, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(3, 1, 1, 1404923040, 1404923160, 0, 0, 0, 0, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(4, 1, 1, 1404926280, 1404934920, 0, 0, 0, 0, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_fields`
--

CREATE TABLE `user_fields` (
  `id_user_field` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `field_type` varchar(255) NOT NULL,
  PRIMARY KEY (`id_user_field`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `user_fields`
--

INSERT INTO `user_fields` (`id_user_field`, `title`, `field_type`) VALUES
(2, 'name', 'text');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `user_field_data`
--

INSERT INTO `user_field_data` (`id_user_field_data`, `id_brand`, `id_user`, `id_user_field`, `field_value`) VALUES
(1, NULL, 1, 2, 'Pablo GutiÃ©rrez'),
(2, NULL, 2, 2, 'Pablo'),
(3, NULL, 3, 2, '000000'),
(4, NULL, 4, 2, '000000');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Volcado de datos para la tabla `user_groups`
--

INSERT INTO `user_groups` (`id_user_group`, `id_brand`, `id_user`, `id_group`) VALUES
(19, '1', 2, 7),
(18, '1', 4, 7),
(17, '1', 3, 7);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `user_notes`
--

INSERT INTO `user_notes` (`id_user_note`, `id_user`, `id_brand`, `title`, `content`, `created`) VALUES
(2, 3, 1, 'sdadsadsadsdasadsadsdasdasdasdas', '', 1405022581),
(3, 3, 1, '', '', 1405069094);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `validated_codes_day_summaries`
--

INSERT INTO `validated_codes_day_summaries` (`id_validated_codes_day_summary`, `id_brand`, `id_admin`, `validated_codes_amount`, `start`) VALUES
(6, NULL, 1, 7, 1404943200);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `validated_codes_month_summaries`
--

INSERT INTO `validated_codes_month_summaries` (`id_validated_codes_month_summary`, `id_brand`, `id_admin`, `validated_codes_amount`, `start`) VALUES
(3, NULL, 1, 7, 1404165600);
