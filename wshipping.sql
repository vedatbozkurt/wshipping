-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 08 Tem 2020, 15:36:33
-- Sunucu sürümü: 5.7.26
-- PHP Sürümü: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `wshipping`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `activity_log`
--

DROP TABLE IF EXISTS `activity_log`;
CREATE TABLE IF NOT EXISTS `activity_log` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `log_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `subject_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `causer_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `properties` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activity_log_log_name_index` (`log_name`),
  KEY `subject` (`subject_id`,`subject_type`),
  KEY `causer` (`causer_id`,`causer_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `addresses`
--

DROP TABLE IF EXISTS `addresses`;
CREATE TABLE IF NOT EXISTS `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `city_id` int(11) NOT NULL DEFAULT '0',
  `district_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `default` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `addresses_user_id_foreign` (`user_id`),
  KEY `addresses_city_id_foreign` (`city_id`),
  KEY `addresses_district_id_foreign` (`district_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `addresses`
--

INSERT INTO `addresses` (`id`, `user_id`, `city_id`, `district_id`, `name`, `description`, `default`, `created_at`, `updated_at`) VALUES
(1, 1, 34, 110, 'address1', '1. user 1.adres', 0, '2020-07-06 13:25:43', '2020-07-06 13:25:43'),
(2, 1, 35, 184, 'address2', '1. user 2.adres', 0, '2020-07-06 13:25:43', '2020-07-06 13:25:43'),
(3, 1, 6, 359, 'address3', '1. user 3.adres', 0, '2020-07-06 13:25:43', '2020-07-06 13:25:43'),
(4, 2, 6, 216, 'address1', '2. user 1.adres', 0, '2020-07-06 13:25:43', '2020-07-06 13:25:43'),
(5, 2, 34, 509, 'address2', '2. user 2.adres', 0, '2020-07-06 13:25:43', '2020-07-06 13:25:43'),
(6, 2, 35, 551, 'address3', '2. user 3.adres', 0, '2020-07-06 13:25:43', '2020-07-06 13:25:43'),
(7, 3, 6, 646, 'address1', '3. user 1.adres', 0, '2020-07-06 13:25:43', '2020-07-06 13:25:43'),
(8, 3, 35, 173, 'address2', '3. user 2.adres', 0, '2020-07-06 13:25:43', '2020-07-06 13:25:43'),
(9, 3, 35, 375, 'address3', '3. user 3.adres', 0, '2020-07-06 13:25:43', '2020-07-06 13:25:43'),
(10, 3, 34, 155, 'address4', '3. user 4.adres', 0, '2020-07-06 13:25:43', '2020-07-06 13:25:43'),
(11, 15001, 34, 155, 'wwdwd', 'ssads asd', 0, '2020-07-06 20:26:23', '2020-07-06 20:26:23');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `status`, `created_at`, `updated_at`) VALUES
(1, 'aJohn Doe', 'a@a.com', '$2y$10$1Y9WnckzWKSxC1lAtQDpC.McE5cU/GWBav7N52x3iwZJP2/.IRwUO', 1, '2020-07-06 13:25:42', '2020-07-08 11:22:04');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `branches`
--

DROP TABLE IF EXISTS `branches`;
CREATE TABLE IF NOT EXISTS `branches` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `branches_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `branches`
--

INSERT INTO `branches` (`id`, `name`, `phone`, `email`, `password`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Ankara Şubesi', '02322758575', 'b1@b.com', '$2y$10$SnzB5C5Pqp/PkaCC1oBc6O/MAU1ijkAKh8aRKsn0rMp5q07eEdK8e', 1, NULL, '2020-07-06 13:25:42', '2020-07-06 13:25:42'),
(2, 'İstanbul Şubesi', '02322758575', 'b2@b.com', '$2y$10$NJBDQDB5WNR.dPDydVCrQeaVVtY6F3p1WlZUvFpyz.Wxvd6QtZIky', 1, NULL, '2020-07-06 13:25:42', '2020-07-06 13:25:42'),
(3, 'İzmir Şubesi', '02322758575', 'b3@b.com', '$2y$10$FkdiSruaDpwlAzsU4IYpUO2Rp1Hsy3B5NlsOXSGJKdoZFEMH/aO4O', 1, NULL, '2020-07-06 13:25:42', '2020-07-06 13:25:42'),
(4, 'İstanbul İzmir Şubesi', '02322758575', 'b4@b.com', '$2y$10$8Ssn1Qk2huyVplBadx66TeMhNHHvhiCIBUJy9GDhWZAlubRqGg8pm', 1, NULL, '2020-07-06 13:25:42', '2020-07-06 13:25:42'),
(5, 'wedat', '123', 'a@a.com', '$2y$10$QdyOHesbSRuJXejgxymtIeh5QCYS2cvv216IizC.n5Xb8NQukxUtm', 1, NULL, '2020-07-07 15:28:46', '2020-07-07 15:30:51');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `branch_city`
--

DROP TABLE IF EXISTS `branch_city`;
CREATE TABLE IF NOT EXISTS `branch_city` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `city_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `branch_city_city_id_foreign` (`city_id`),
  KEY `branch_city_branch_id_foreign` (`branch_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `branch_city`
--

INSERT INTO `branch_city` (`id`, `city_id`, `branch_id`, `created_at`, `updated_at`) VALUES
(1, 6, 1, NULL, NULL),
(2, 34, 2, NULL, NULL),
(3, 35, 3, NULL, NULL),
(4, 34, 4, NULL, NULL),
(5, 35, 4, NULL, NULL),
(6, 6, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `branch_district`
--

DROP TABLE IF EXISTS `branch_district`;
CREATE TABLE IF NOT EXISTS `branch_district` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `district_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `branch_district_district_id_foreign` (`district_id`),
  KEY `branch_district_branch_id_foreign` (`branch_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `branch_district`
--

INSERT INTO `branch_district` (`id`, `district_id`, `branch_id`, `created_at`, `updated_at`) VALUES
(1, 216, 1, NULL, NULL),
(2, 359, 1, NULL, NULL),
(3, 646, 1, NULL, NULL),
(4, 110, 2, NULL, NULL),
(5, 155, 2, NULL, NULL),
(6, 509, 2, NULL, NULL),
(7, 184, 3, NULL, NULL),
(8, 173, 3, NULL, NULL),
(9, 375, 3, NULL, NULL),
(10, 551, 3, NULL, NULL),
(11, 110, 4, NULL, NULL),
(12, 155, 4, NULL, NULL),
(13, 173, 4, NULL, NULL),
(14, 184, 4, NULL, NULL),
(15, 375, 4, NULL, NULL),
(16, 509, 4, NULL, NULL),
(17, 551, 4, NULL, NULL),
(18, 216, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `cities`
--

DROP TABLE IF EXISTS `cities`;
CREATE TABLE IF NOT EXISTS `cities` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `cities`
--

INSERT INTO `cities` (`id`, `name`) VALUES
(6, 'Ankara'),
(34, 'İstanbul'),
(35, 'İzmir');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `city_courier`
--

DROP TABLE IF EXISTS `city_courier`;
CREATE TABLE IF NOT EXISTS `city_courier` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `city_id` int(10) UNSIGNED NOT NULL,
  `courier_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `city_courier_city_id_foreign` (`city_id`),
  KEY `city_courier_courier_id_foreign` (`courier_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `city_courier`
--

INSERT INTO `city_courier` (`id`, `city_id`, `courier_id`, `created_at`, `updated_at`) VALUES
(1, 6, 1, NULL, NULL),
(2, 34, 2, NULL, NULL),
(3, 34, 3, NULL, NULL),
(4, 35, 3, NULL, NULL),
(5, 35, 10024, NULL, NULL),
(9, 34, 10031, NULL, NULL),
(8, 35, 10031, NULL, NULL),
(10, 34, 10030, NULL, NULL),
(11, 35, 10030, NULL, NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `couriers`
--

DROP TABLE IF EXISTS `couriers`;
CREATE TABLE IF NOT EXISTS `couriers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plate` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `couriers_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=10032 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `couriers`
--

INSERT INTO `couriers` (`id`, `name`, `image`, `phone`, `email`, `password`, `vehicle`, `plate`, `color`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'courier one', '63874361.jpg', '02125871212', 'c1@c.com', '$2y$10$IkedWMCfkgQOI7fQZNdyOe6CNYV6pPmb2o4wwICDnT4cnTDZ2YJ/W', 'car', '35 cc 135', 'red', 1, NULL, '2020-07-06 13:25:42', '2020-07-06 13:25:42'),
(2, 'courier two', '62399645.jpg', '02125871212', 'c2@c.com', '$2y$10$lYMfPiCFf2Hvy3Xb1qRNcOfslJlLtTjR12VdnYK1Hs37MyDb8iMhy', 'car', '35 cc 135', 'red', 1, NULL, '2020-07-06 13:25:42', '2020-07-06 13:25:42'),
(3, 'courier three', '23060636.jpg', '02125871212', 'c3@c.com', '$2y$10$4Jc5i3XSQgt4xh9cpT5pLOK.eOP/0AHvVtBdq7e2FTHwiD19/1pzi', 'car', '35 cc 135', 'red', 1, NULL, '2020-07-06 13:25:42', '2020-07-06 13:25:42'),
(10000, 'wedat', 'no-image.png', '123', '1asd@a.com', '$2y$10$9EqBmoz.uXeTUF01ZpOADO0u1AuxvWINdKPcpgV40icP.WrbEhwZe', 'aaa', '231 13', 'red', 1, NULL, '2020-01-06 15:16:44', '2020-07-06 15:16:44'),
(10001, 'wedat', 'no-image.png', '123', '21asd@a.com', '$2y$10$9EqBmoz.uXeTUF01ZpOADO0u1AuxvWINdKPcpgV40icP.WrbEhwZe', 'aaa', '231 13', 'red', 1, NULL, '2020-02-06 15:16:44', '2020-07-06 15:16:44'),
(10002, 'wedat', 'no-image.png', '123', '321asd@a.com', '$2y$10$9EqBmoz.uXeTUF01ZpOADO0u1AuxvWINdKPcpgV40icP.WrbEhwZe', 'aaa', '231 13', 'red', 1, NULL, '2020-02-06 15:16:44', '2020-07-06 15:16:44'),
(10003, 'wedat', 'no-image.png', '123', '4321asd@a.com', '$2y$10$9EqBmoz.uXeTUF01ZpOADO0u1AuxvWINdKPcpgV40icP.WrbEhwZe', 'aaa', '231 13', 'red', 1, NULL, '2020-03-06 15:16:44', '2020-07-06 15:16:44'),
(10004, 'wedat', 'no-image.png', '123', '54321asd@a.com', '$2y$10$9EqBmoz.uXeTUF01ZpOADO0u1AuxvWINdKPcpgV40icP.WrbEhwZe', 'aaa', '231 13', 'red', 1, NULL, '2020-03-06 15:16:44', '2020-07-06 15:16:44'),
(10005, 'wedat', 'no-image.png', '123', '654321asd@a.com', '$2y$10$9EqBmoz.uXeTUF01ZpOADO0u1AuxvWINdKPcpgV40icP.WrbEhwZe', 'aaa', '231 13', 'red', 1, NULL, '2020-03-06 15:16:44', '2020-07-06 15:16:44'),
(10006, 'wedat', 'no-image.png', '123', '7654321asd@a.com', '$2y$10$9EqBmoz.uXeTUF01ZpOADO0u1AuxvWINdKPcpgV40icP.WrbEhwZe', 'aaa', '231 13', 'red', 1, NULL, '2020-04-06 15:16:44', '2020-07-06 15:16:44'),
(10007, 'wedat', 'no-image.png', '123', '87654321asd@a.com', '$2y$10$9EqBmoz.uXeTUF01ZpOADO0u1AuxvWINdKPcpgV40icP.WrbEhwZe', 'aaa', '231 13', 'red', 1, NULL, '2020-04-06 15:16:44', '2020-07-06 15:16:44'),
(10008, 'wedat', 'no-image.png', '123', '987654321asd@a.com', '$2y$10$9EqBmoz.uXeTUF01ZpOADO0u1AuxvWINdKPcpgV40icP.WrbEhwZe', 'aaa', '231 13', 'red', 1, NULL, '2020-04-06 15:16:44', '2020-07-06 15:16:44'),
(10009, 'wedat', 'no-image.png', '123', '10987654321asd@a.com', '$2y$10$9EqBmoz.uXeTUF01ZpOADO0u1AuxvWINdKPcpgV40icP.WrbEhwZe', 'aaa', '231 13', 'red', 1, NULL, '2020-04-06 15:16:44', '2020-07-06 15:16:44'),
(10010, 'wedat', 'no-image.png', '123', '1110987654321asd@a.com', '$2y$10$9EqBmoz.uXeTUF01ZpOADO0u1AuxvWINdKPcpgV40icP.WrbEhwZe', 'aaa', '231 13', 'red', 1, NULL, '2020-05-06 15:16:44', '2020-07-06 15:16:44'),
(10011, 'wedat', 'no-image.png', '123', '121110987654321asd@a.com', '$2y$10$9EqBmoz.uXeTUF01ZpOADO0u1AuxvWINdKPcpgV40icP.WrbEhwZe', 'aaa', '231 13', 'red', 1, NULL, '2020-06-06 15:16:44', '2020-07-06 15:16:44'),
(10031, 'sdasd', '2036949650.jpg', '111', 'adsd@a.com', '$2y$10$zk/dUFDQOTFCMX/d48OOYOfNsUsH5ghPijXMaWx1iauTly9TF.6tu', 'araba', '123', 'sdsdred', 1, NULL, '2020-07-07 21:34:30', '2020-07-08 11:18:15'),
(10030, 'ddf', '22847756.jpg', '34234', 'afddddfsdf@a.com', '$2y$10$dAm.jAMfRE0..UzpTW.6d.mefwZ/Xq9jC6VFmddvrTkClF0l9GZlW', 'dfsd', '34few423', 'red', 1, NULL, '2020-07-07 21:12:03', '2020-07-07 21:12:03'),
(10029, 'ddf', '14102362.jpg', '34234', 'afddfsdf@a.com', '$2y$10$Kv7/05kGKtnirFWWhlQJNuMH1RxRHUlLhKMqBrjVjZ6GFCvpPJZJW', 'dfsd', '34few423', 'red', 1, NULL, '2020-07-07 21:10:51', '2020-07-07 21:10:51'),
(10022, 'wedat', 'no-image.png', '123', '2322212019181716151413121110987654321asd@a.com', '$2y$10$9EqBmoz.uXeTUF01ZpOADO0u1AuxvWINdKPcpgV40icP.WrbEhwZe', 'aaa', '231 13', 'red', 1, NULL, '2020-11-06 15:16:44', '2020-07-06 15:16:44'),
(10023, 'wedat', '281128446.jpg', '123', '242322212019181716151413121110987654321asd@a.com', '$2y$10$HoGYCRynbduf/9aB.vKaRel/nUg23cQtJz0VRfk7vYfmdJIZ0T4cG', 'aaa', '231 13', 'red', 1, NULL, '2020-11-06 15:16:44', '2020-07-08 08:17:06'),
(10024, 'swedat', '287260658.jpg', 's123', '0987654321asd@a.com', '$2y$10$DkljkNUFkKVsEUDuaYWozu850VSA47JlhHRnhyYf4KFg7GAuVElre', 'aaa', '231 13', 'red', 1, NULL, '2020-12-06 15:16:44', '2020-07-07 22:14:02'),
(10026, 'wedat', '63874361.jpg', '123', '123@a.com', '$2y$10$1jGxmiOMdGnYn2uIo/oNrOAxs3O.okWFPgjKmfiyikth2GKy14GEK', 'araba', '21a123', 'red', 1, NULL, '2020-07-07 21:07:19', '2020-07-07 21:07:19'),
(10027, 'sdas', '62399645.jpg', '34234', 'a@a.com', '$2y$10$NG.AuKOfJCJHkYRcjF49SeE4kdoSYNSr67rnU7WUe/M90Ls0T6lzC', 'asdas', 'sadd', 'asda', 1, NULL, '2020-07-07 21:08:02', '2020-07-07 21:08:02'),
(10028, 'ddf', '23060636.jpg', '34234', 'afdf@a.com', '$2y$10$wC/GqmOCqess4H8Z8vdCJ.rbkEpfTtto65k.OL8snQBxUOy0FowIy', 'dfsd', '34few423', 'red', 1, NULL, '2020-07-07 21:09:25', '2020-07-07 21:09:25');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `courier_district`
--

DROP TABLE IF EXISTS `courier_district`;
CREATE TABLE IF NOT EXISTS `courier_district` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `district_id` int(10) UNSIGNED NOT NULL,
  `courier_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `courier_district_district_id_foreign` (`district_id`),
  KEY `courier_district_courier_id_foreign` (`courier_id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `courier_district`
--

INSERT INTO `courier_district` (`id`, `district_id`, `courier_id`, `created_at`, `updated_at`) VALUES
(1, 216, 1, NULL, NULL),
(2, 359, 1, NULL, NULL),
(3, 646, 1, NULL, NULL),
(4, 110, 2, NULL, NULL),
(5, 155, 2, NULL, NULL),
(6, 509, 2, NULL, NULL),
(7, 110, 3, NULL, NULL),
(8, 155, 3, NULL, NULL),
(9, 173, 3, NULL, NULL),
(10, 184, 3, NULL, NULL),
(11, 375, 3, NULL, NULL),
(12, 509, 3, NULL, NULL),
(13, 551, 3, NULL, NULL),
(14, 375, 10024, NULL, NULL),
(23, 110, 10030, NULL, NULL),
(22, 155, 10031, NULL, NULL),
(21, 509, 10031, NULL, NULL),
(20, 551, 10031, NULL, NULL),
(24, 184, 10030, NULL, NULL),
(25, 173, 10030, NULL, NULL),
(26, 375, 10030, NULL, NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `districts`
--

DROP TABLE IF EXISTS `districts`;
CREATE TABLE IF NOT EXISTS `districts` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `districts_city_id_foreign` (`city_id`)
) ENGINE=MyISAM AUTO_INCREMENT=649 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `districts`
--

INSERT INTO `districts` (`id`, `name`, `city_id`) VALUES
(216, 'Çankaya', 6),
(359, 'Etimesgut', 6),
(646, 'Mamak', 6),
(110, 'Bağcılar', 34),
(155, 'Beyoğlu', 34),
(509, 'Kadıköy', 34),
(184, 'Buca', 35),
(173, 'Bornova', 35),
(375, 'Gaziemir', 35),
(551, 'Karşıyaka', 35),
(647, 'Karabağlar', 35);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=581 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(560, '2014_10_12_000000_create_users_table', 5),
(561, '2014_10_12_100000_create_password_resets_table', 5),
(562, '2016_06_01_000001_create_oauth_auth_codes_table', 5),
(563, '2016_06_01_000002_create_oauth_access_tokens_table', 5),
(564, '2016_06_01_000003_create_oauth_refresh_tokens_table', 5),
(565, '2016_06_01_000004_create_oauth_clients_table', 5),
(566, '2016_06_01_000005_create_oauth_personal_access_clients_table', 5),
(567, '2019_08_19_000000_create_failed_jobs_table', 5),
(18, '2020_06_16_100305_create_branch_table', 1),
(568, '2020_06_16_095937_create_admins_table', 5),
(569, '2020_06_16_101527_create_branches_table', 5),
(570, '2020_06_16_144802_create_couriers_table', 5),
(32, '2020_06_16_151934_create_settings_table', 4),
(33, '2020_06_16_152018_create_status_table', 4),
(571, '2020_06_16_151111_create_tasks_table', 5),
(572, '2020_06_16_200403_create_cities_table', 5),
(573, '2020_06_16_200450_create_districts_table', 5),
(574, '2020_06_16_200905_create_addresses_table', 5),
(575, '2020_06_17_115320_create_activity_log_table', 5),
(576, '2020_06_18_145114_create_branch_city_table', 5),
(577, '2020_06_18_145615_create_branch_district_table', 5),
(578, '2020_06_19_223354_create_city_courier_table', 5),
(579, '2020_06_19_223413_create_courier_district_table', 5),
(580, '2020_06_26_093843_create_settings_table', 5);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `oauth_access_tokens`
--

DROP TABLE IF EXISTS `oauth_access_tokens`;
CREATE TABLE IF NOT EXISTS `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('f4a3f8b602ebd7f5e63ab85e83fffb04e09885fdb0ee0c90df140f0b3c8f826cb723f901b7f71319', 1, 1, 'MyApp', '[\"admin\"]', 1, '2020-07-06 13:36:34', '2020-07-06 13:36:34', '2021-07-06 16:36:34'),
('6e7c4327d5d286d9806f26ba3c1938c8c992cd85e8223cb9f13db51597ab0d6313ba0fe3fa21e483', 1, 1, 'MyApp', '[\"admin\"]', 1, '2020-07-06 13:49:07', '2020-07-06 13:49:07', '2021-07-06 16:49:07'),
('3362f000971b8702d35b011502884917c108386554fe2d610188ac72334e82c71d3b5cea274c36d6', 1, 1, 'MyApp', '[\"admin\"]', 1, '2020-07-06 13:49:41', '2020-07-06 13:49:41', '2021-07-06 16:49:41'),
('1b6bca726d695c27803cd54487f9194e79189071ae15d7b92da1122161faafd8ccee2e183a5176e5', 1, 1, 'MyApp', '[\"admin\"]', 1, '2020-07-06 13:50:06', '2020-07-06 13:50:06', '2021-07-06 16:50:06'),
('ebb37ef99e06ef8401de4847001f02e596d07795053273d3e493293efe4130eb4be13fbe7c53c6d7', 1, 1, 'MyApp', '[\"admin\"]', 1, '2020-07-06 13:51:20', '2020-07-06 13:51:20', '2021-07-06 16:51:20'),
('4636e7b17f52ebc7b61a17227f3cfb9b55cab31810b71bff42a7c24113d4a7ac12be5d15e9f6f378', 1, 1, 'MyApp', '[\"admin\"]', 0, '2020-07-06 15:37:23', '2020-07-06 15:37:23', '2021-07-06 18:37:23'),
('45580ca64e0321d44d75ea407549298c08ebf374ed25fcb051a4d6588cfcbe518bb2c71ab4029d3d', 1, 1, 'MyApp', '[\"admin\"]', 1, '2020-07-06 17:31:59', '2020-07-06 17:31:59', '2021-07-06 20:31:59'),
('8a5fb55c00c7b2064a491af81e07dfabc69426056affd2178995cfede96a5c5f32af1ecb60b1ef9a', 1, 1, 'MyApp', '[\"admin\"]', 1, '2020-07-06 17:54:58', '2020-07-06 17:54:58', '2021-07-06 20:54:58'),
('2ea48eb1298351adbf0e787cec5b553bda74b4b7032efa1d528ef2c790087af2bda8bbfb1a2e115e', 1, 1, 'MyApp', '[\"admin\"]', 1, '2020-07-06 18:20:54', '2020-07-06 18:20:54', '2021-07-06 21:20:54'),
('6f973f0eb55bea08f70a17974bc3a2e592d0589d15a872580f34bf5efa53f6631863b1cb6cc50e1c', 1, 1, 'MyApp', '[\"admin\"]', 1, '2020-07-06 18:21:08', '2020-07-06 18:21:08', '2021-07-06 21:21:08'),
('ecef7a5d309c76489ab7f3db9cbbcf962ded009ef01ab90beea66550c23c7e6bd8b6066d0d85b3f6', 1, 1, 'MyApp', '[\"admin\"]', 1, '2020-07-06 21:37:59', '2020-07-06 21:37:59', '2021-07-07 00:37:59'),
('6a625e0ee437c43b2587375a12f989df46ce8b7272b87e544acc89ee4cb56f1ee7e31340a2efdc2f', 1, 1, 'MyApp', '[\"admin\"]', 1, '2020-07-07 16:16:41', '2020-07-07 16:16:41', '2021-07-07 19:16:41'),
('817e59b11b527d5f50e5afb15f7a1baf2981a94bf75a78f2f5092a7ace6ea1082b02bc6cf2ea3ae2', 1, 1, 'MyApp', '[\"admin\"]', 1, '2020-07-08 10:33:42', '2020-07-08 10:33:42', '2021-07-08 13:33:42'),
('05b9d72f60d4797a34af6a6a3021087e088772854c58a63c43cf2ffa169098ae3da8817b165f858f', 1, 1, 'MyApp', '[\"admin\"]', 1, '2020-07-08 11:00:09', '2020-07-08 11:00:09', '2021-07-08 14:00:09'),
('c82a2f97db95544481e0383cde49fe1a57ff3fb2e83e7c216ad49d28b8f48dd32e6503d17d31364f', 1, 1, 'MyApp', '[\"admin\"]', 0, '2020-07-08 11:00:55', '2020-07-08 11:00:55', '2021-07-08 14:00:55');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `oauth_auth_codes`
--

DROP TABLE IF EXISTS `oauth_auth_codes`;
CREATE TABLE IF NOT EXISTS `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_auth_codes_user_id_index` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `oauth_clients`
--

DROP TABLE IF EXISTS `oauth_clients`;
CREATE TABLE IF NOT EXISTS `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'uLfJCIbN2MlHryNh8X3tsH5mdvp0shzkmFTifuJQ', NULL, 'http://localhost', 1, 0, 0, '2020-07-06 13:36:29', '2020-07-06 13:36:29'),
(2, NULL, 'Laravel Password Grant Client', 'EwXolcPhfAQUE8EUHjcoQOVYiCIsmtYErulqXdmk', 'users', 'http://localhost', 0, 1, 0, '2020-07-06 13:36:29', '2020-07-06 13:36:29');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `oauth_personal_access_clients`
--

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
CREATE TABLE IF NOT EXISTS `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-07-06 13:36:29', '2020-07-06 13:36:29');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `oauth_refresh_tokens`
--

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
CREATE TABLE IF NOT EXISTS `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keywords` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `settings`
--

INSERT INTO `settings` (`id`, `logo`, `company_name`, `phone`, `description`, `keywords`, `address`, `email`, `currency`) VALUES
(1, '1509137175.jpg', 'aMy Company', '4534534453', 'Best company on the world', 'my,company', 'Deneme sokak No:23 Denem MAh.', 'my@compony.com', 'tl');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tasks`
--

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `courier_id` int(11) DEFAULT '0',
  `sender_id` int(11) NOT NULL DEFAULT '0',
  `receiver_id` int(11) NOT NULL DEFAULT '0',
  `sender_address_id` int(11) NOT NULL DEFAULT '0',
  `receiver_address_id` int(11) NOT NULL DEFAULT '0',
  `price` int(11) NOT NULL DEFAULT '0',
  `description` char(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tasks_courier_id_foreign` (`courier_id`),
  KEY `tasks_sender_id_foreign` (`sender_id`),
  KEY `tasks_receiver_id_foreign` (`receiver_id`),
  KEY `tasks_sender_address_id_foreign` (`sender_address_id`),
  KEY `tasks_receiver_address_id_foreign` (`receiver_address_id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `tasks`
--

INSERT INTO `tasks` (`id`, `courier_id`, `sender_id`, `receiver_id`, `sender_address_id`, `receiver_address_id`, `price`, `description`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 2, 5, 5, 3423, 'dsf', '1', NULL, '2020-01-26 01:07:31', '2020-07-06 14:31:32'),
(2, 2, 2, 2, 5, 5, 3423, 'dsf', '1', NULL, '2020-01-26 01:07:31', '2020-07-06 14:31:32'),
(3, 2, 2, 2, 5, 5, 3423, 'dsf', '1', NULL, '2020-02-26 01:07:31', '2020-07-06 14:31:32'),
(4, 2, 2, 2, 5, 5, 3423, 'dsf', '1', NULL, '2020-03-26 01:07:31', '2020-07-06 14:31:32'),
(5, 2, 2, 2, 5, 5, 3423, 'dsf', '1', NULL, '2020-03-26 01:07:31', '2020-07-06 14:31:32'),
(6, 2, 2, 2, 5, 5, 3423, 'dsf', '1', NULL, '2020-03-26 01:07:31', '2020-07-06 14:31:32'),
(7, 2, 2, 2, 5, 5, 3423, 'dsf', '1', NULL, '2020-03-26 01:07:31', '2020-07-06 14:31:32'),
(8, 2, 2, 2, 5, 5, 3423, 'dsf', '1', NULL, '2020-04-26 01:07:31', '2020-07-06 14:31:32'),
(9, 2, 2, 2, 5, 5, 3423, 'dsf', '1', NULL, '2020-04-26 01:07:31', '2020-07-06 14:31:32'),
(10, 2, 2, 2, 5, 5, 3423, 'dsf', '1', NULL, '2020-05-26 01:07:31', '2020-07-06 14:31:32'),
(11, 2, 3, 1, 8, 3, 125, 'hgj', '6', NULL, '2020-06-06 14:32:34', '2020-07-06 14:32:34'),
(12, 2, 3, 1, 8, 3, 125, 'hgj', '6', NULL, '2020-06-06 14:32:34', '2020-07-06 14:32:34'),
(13, 2, 3, 1, 8, 3, 125, 'hgj', '6', NULL, '2020-06-06 14:32:34', '2020-07-06 14:32:34'),
(14, 2, 3, 1, 8, 3, 125, 'hgj', '6', NULL, '2020-06-06 14:32:34', '2020-07-06 14:32:34'),
(15, 2, 3, 1, 8, 3, 125, 'hgj', '6', NULL, '2020-06-06 14:32:34', '2020-07-06 14:32:34'),
(16, 2, 3, 1, 8, 3, 125, 'hgj', '6', NULL, '2020-07-06 14:32:34', '2020-07-06 14:32:34'),
(17, 2, 3, 1, 8, 3, 125, 'hgj', '6', NULL, '2020-07-06 14:32:34', '2020-07-06 14:32:34'),
(18, 2, 3, 1, 8, 3, 125, 'hgj', '6', NULL, '2020-07-06 14:32:34', '2020-07-06 14:32:34'),
(19, 2, 3, 1, 8, 3, 125, 'hgj', '6', NULL, '2020-08-06 14:32:34', '2020-07-06 14:32:34'),
(20, 2, 3, 1, 8, 3, 125, 'hgj', '6', NULL, '2020-08-06 14:32:34', '2020-07-06 14:32:34'),
(21, 2, 3, 1, 8, 3, 125, 'hgj', '6', NULL, '2020-08-06 14:32:34', '2020-07-06 14:32:34'),
(22, 2, 3, 1, 8, 3, 125, 'hgj', '6', NULL, '2020-08-06 14:32:34', '2020-07-06 14:32:34'),
(23, 2, 3, 1, 8, 3, 125, 'hgj', '6', NULL, '2020-09-06 14:32:34', '2020-07-06 14:32:34'),
(24, 2, 3, 1, 8, 3, 125, 'hgj', '6', NULL, '2020-09-06 14:32:34', '2020-07-06 14:32:34'),
(25, 2, 3, 1, 8, 3, 125, 'hgj', '6', NULL, '2020-09-06 14:32:34', '2020-07-06 14:32:34'),
(26, 2, 3, 1, 8, 3, 125, 'hgj', '6', NULL, '2020-10-06 14:32:34', '2020-07-06 14:32:34'),
(27, 2, 3, 1, 8, 3, 125, 'hgj', '6', NULL, '2020-11-06 14:32:34', '2020-07-06 14:32:34'),
(28, 2, 3, 1, 8, 3, 125, 'hgj', '6', NULL, '2020-12-06 14:32:34', '2020-07-06 14:32:34'),
(29, 2, 3, 1, 8, 3, 125, 'hgj', '6', NULL, '2020-12-06 14:32:34', '2020-07-06 14:32:34'),
(30, 2, 3, 1, 8, 3, 125, 'hgj', '6', NULL, '2020-12-06 14:32:34', '2020-07-06 14:32:34');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=15028 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `name`, `image`, `phone`, `email`, `email_verified_at`, `password`, `status`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Joe Doe', '1861347638.jpg', '05511254152', 'u1@u.com', NULL, '$2y$10$7tpKWoGOgFpzWQtq3OlDKuZV5qpl/y0.DbEaMiabeQ8L7lpPKAaN6', 1, NULL, NULL, '2020-01-06 13:25:42', '2020-07-06 13:25:42'),
(2, 'Jane Doe', '67110662.jpg', '05553214433', 'u2@u.com', NULL, '$2y$10$.i07Ppy5JaWEf7IDP7o6NOyAXIQQcP.tuhlWv8zzkdgOkutPSStpq', 1, NULL, NULL, '2020-01-06 13:25:42', '2020-07-06 13:25:42'),
(3, 'Jack Doe', '1751132982.jpg', '05511254152', 'u3@u.com', NULL, '$2y$10$PktxjBsVY2x0.vG3cBkhjuU0pNifdfGHs3lBhJQ0M6qY.GMTgEyw6', 1, NULL, NULL, '2020-02-06 13:25:43', '2020-07-06 13:25:43'),
(4, 'Michale Doe', '1959320881.jpg', '05553214433', 'u4@u.com', NULL, '$2y$10$wdrDLJhov/HXhKbrFJ8b7u9zX8dMQTJQ3xopJQuKQv/0czXDECP0.', 1, NULL, NULL, '2020-03-06 13:25:43', '2020-07-06 13:25:43'),
(15000, 'vedat', 'no-image.png', '123', '1q@a.com', NULL, '$2y$10$ncIat7WVQKV7yczuuq1Vx.lHMXg7Fk9E5G6wNFEzuCbrTsLrGCFMa', 1, NULL, NULL, '2020-03-06 15:15:23', '2020-07-06 15:15:23'),
(15001, 'vedat', 'no-image.png', '123', '21q@a.com', NULL, '$2y$10$ncIat7WVQKV7yczuuq1Vx.lHMXg7Fk9E5G6wNFEzuCbrTsLrGCFMa', 1, NULL, NULL, '2020-03-06 15:15:23', '2020-07-06 15:15:23'),
(15002, 'vedat', 'no-image.png', '123', '321q@a.com', NULL, '$2y$10$ncIat7WVQKV7yczuuq1Vx.lHMXg7Fk9E5G6wNFEzuCbrTsLrGCFMa', 1, NULL, NULL, '2020-04-06 15:15:23', '2020-07-06 15:15:23'),
(15003, 'vedat', 'no-image.png', '123', '4321q@a.com', NULL, '$2y$10$ncIat7WVQKV7yczuuq1Vx.lHMXg7Fk9E5G6wNFEzuCbrTsLrGCFMa', 1, NULL, NULL, '2020-04-06 15:15:23', '2020-07-06 15:15:23'),
(15004, 'vedat', 'no-image.png', '123', '54321q@a.com', NULL, '$2y$10$ncIat7WVQKV7yczuuq1Vx.lHMXg7Fk9E5G6wNFEzuCbrTsLrGCFMa', 1, NULL, NULL, '2020-05-06 15:15:23', '2020-07-06 15:15:23'),
(15005, 'vedat', 'no-image.png', '123', '654321q@a.com', NULL, '$2y$10$ncIat7WVQKV7yczuuq1Vx.lHMXg7Fk9E5G6wNFEzuCbrTsLrGCFMa', 1, NULL, NULL, '2020-05-06 15:15:23', '2020-07-06 15:15:23'),
(15006, 'vedat', 'no-image.png', '123', '7654321q@a.com', NULL, '$2y$10$ncIat7WVQKV7yczuuq1Vx.lHMXg7Fk9E5G6wNFEzuCbrTsLrGCFMa', 1, NULL, NULL, '2020-06-06 15:15:23', '2020-07-06 15:15:23'),
(15007, 'vedat', 'no-image.png', '123', '87654321q@a.com', NULL, '$2y$10$ncIat7WVQKV7yczuuq1Vx.lHMXg7Fk9E5G6wNFEzuCbrTsLrGCFMa', 1, NULL, NULL, '2020-07-06 15:15:23', '2020-07-06 15:15:23'),
(15008, 'vedat', 'no-image.png', '123', '987654321q@a.com', NULL, '$2y$10$ncIat7WVQKV7yczuuq1Vx.lHMXg7Fk9E5G6wNFEzuCbrTsLrGCFMa', 1, NULL, NULL, '2020-07-06 15:15:23', '2020-07-06 15:15:23'),
(15009, 'vedat', 'no-image.png', '123', '10987654321q@a.com', NULL, '$2y$10$ncIat7WVQKV7yczuuq1Vx.lHMXg7Fk9E5G6wNFEzuCbrTsLrGCFMa', 1, NULL, NULL, '2020-07-06 15:15:23', '2020-07-06 15:15:23'),
(15010, 'vedat', 'no-image.png', '123', '1110987654321q@a.com', NULL, '$2y$10$ncIat7WVQKV7yczuuq1Vx.lHMXg7Fk9E5G6wNFEzuCbrTsLrGCFMa', 1, NULL, NULL, '2020-07-06 15:15:23', '2020-07-06 15:15:23'),
(15011, 'vedat', 'no-image.png', '123', '121110987654321q@a.com', NULL, '$2y$10$ncIat7WVQKV7yczuuq1Vx.lHMXg7Fk9E5G6wNFEzuCbrTsLrGCFMa', 1, NULL, NULL, '2020-07-06 15:15:23', '2020-07-06 15:15:23'),
(15012, 'vedat', 'no-image.png', '123', '13121110987654321q@a.com', NULL, '$2y$10$ncIat7WVQKV7yczuuq1Vx.lHMXg7Fk9E5G6wNFEzuCbrTsLrGCFMa', 1, NULL, NULL, '2020-07-06 15:15:23', '2020-07-06 15:15:23'),
(15013, 'vedat', 'no-image.png', '123', '1413121110987654321q@a.com', NULL, '$2y$10$ncIat7WVQKV7yczuuq1Vx.lHMXg7Fk9E5G6wNFEzuCbrTsLrGCFMa', 1, NULL, NULL, '2020-08-06 15:15:23', '2020-07-06 15:15:23'),
(15014, 'vedat', 'no-image.png', '123', '151413121110987654321q@a.com', NULL, '$2y$10$ncIat7WVQKV7yczuuq1Vx.lHMXg7Fk9E5G6wNFEzuCbrTsLrGCFMa', 1, NULL, NULL, '2020-08-06 15:15:23', '2020-07-06 15:15:23'),
(15015, 'vedat', 'no-image.png', '123', '16151413121110987654321q@a.com', NULL, '$2y$10$ncIat7WVQKV7yczuuq1Vx.lHMXg7Fk9E5G6wNFEzuCbrTsLrGCFMa', 1, NULL, NULL, '2020-09-06 15:15:23', '2020-07-06 15:15:23'),
(15016, 'vedat', 'no-image.png', '123', '1716151413121110987654321q@a.com', NULL, '$2y$10$ncIat7WVQKV7yczuuq1Vx.lHMXg7Fk9E5G6wNFEzuCbrTsLrGCFMa', 1, NULL, NULL, '2020-09-06 15:15:23', '2020-07-06 15:15:23'),
(15017, 'vedat', 'no-image.png', '123', '181716151413121110987654321q@a.com', NULL, '$2y$10$UOKvtf0i15hzXP5bj5ly6uL9X0EXLRIyp6YIBTRkg7LCQoO5W8A9S', 1, NULL, NULL, '2020-09-06 15:15:23', '2020-07-08 11:02:40'),
(15018, 'vedat', 'no-image.png', '123', '19181716151413121110987654321q@a.com', NULL, '$2y$10$ncIat7WVQKV7yczuuq1Vx.lHMXg7Fk9E5G6wNFEzuCbrTsLrGCFMa', 1, NULL, NULL, '2020-10-06 15:15:23', '2020-07-06 15:15:23'),
(15019, 'vedat', 'no-image.png', '123', '2019181716151413121110987654321q@a.com', NULL, '$2y$10$ncIat7WVQKV7yczuuq1Vx.lHMXg7Fk9E5G6wNFEzuCbrTsLrGCFMa', 1, NULL, NULL, '2020-10-06 15:15:23', '2020-07-06 15:15:23'),
(15020, 'vedat', '2054459811.jpg', '123', '212019181716151413121110987654321q@a.com', NULL, '$2y$10$HKHFbWKCWZG9v8cDtG5uIOucu40IFfsFXECawIW9SL4rWqr1LuboC', 1, NULL, NULL, '2020-11-06 15:15:23', '2020-07-08 08:15:25'),
(15021, 'vedat', '1751132982.jpg', '123', '22212019181716151413121110987654321q@a.com', NULL, '$2y$10$c6fS6nsHHxYXHlvCHJbO2uqXro71S.WAsoxjMiGXffZI/5CbiCqw2', 1, NULL, NULL, '2020-11-06 15:15:23', '2020-07-08 11:03:51'),
(15022, 'vedat', '1959320881.jpg', '123', '2322212019181716151413121110987654321q@a.com', NULL, '$2y$10$F5LE1RtuDkkADxLwPDdwy.TrQBfK423ClIyp.kKCvkRe3loi2lKHK', 1, NULL, NULL, '2020-11-06 15:15:23', '2020-07-08 08:14:19'),
(15023, 'vedat', '686674765.jpg', '123', '242322212019181716151413121110987654321q@a.com', NULL, '$2y$10$4LYEps6tJWWxrZ9OAW6Dk.YwFm0MbI3Y6LyT7Ed/WFFwCi4fz/Eem', 1, NULL, NULL, '2020-12-06 15:15:23', '2020-07-08 08:13:19'),
(15024, 'vedat', '67110662.jpg', '123', '25242322212019181716151413121110987654321q@a.com', NULL, '$2y$10$dY9njt.ZcxVmMDpMuYURN.Vy4YahazpeLlYdAQdmzOOu4xmE8b/.S', 1, NULL, NULL, '2020-12-06 15:15:23', '2020-07-07 22:04:50'),
(15026, 'dfsdsd', '1861347638.jpg', '123', 'avdd@a.com', NULL, '$2y$10$RTXuq9QRb95dIHYxINeLMOPrHXhrWn1bh6CtobTJpqSOoqRea18eW', 1, NULL, NULL, '2020-07-07 18:48:31', '2020-07-08 11:16:21'),
(15027, 'sdasd1', '41888866.jpg', '13123', 'nmmddöame@a.com', NULL, '$2y$10$sgTWaXHcGm0Rj63kxZ71kukVjNIr.ih3n8rQi6IVU6Co/Aeir/PsC', 1, NULL, NULL, '2020-07-07 18:48:57', '2020-07-08 11:13:07');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
