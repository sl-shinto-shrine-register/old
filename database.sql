-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: May 22, 2017 at 07:02 PM
-- Server version: 5.5.33a-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `slsr`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `caption` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=20 ;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `caption`, `image`, `description`, `link`) VALUES
(1, 'Amaterasu Omikami Shrine Little Yoshiwara', 'Amaterasu_Omikami_Grand_Shinto_Shrine_Little_Yoshiwara.jpg', 'Amaterasu, Susano-o & Uzume Shinto Shrines. Shinto school and RP group, priest, priestess, miko. Shinto weddings & rituals performed. Join Yoshiwara Jingu Association group for updates  (Shrine Builders - Utayo Yengawa & Anika Deschanel).', 'Ribush/78/255/44'),
(2, 'Okami Inari Shrine', 'Okami_Inari_Shrine.jpg', 'Inari is the Japanese kami of foxes, of fertility, rice, tea and Sake, of agriculture and industry, of general prosperity and worldly success, and one of the principal kami of Shinto.', 'Sallow/130/155/32'),
(3, 'Little Yoshiwara Inari Shrine', 'Little_Yoshiwara_Inari_Shrine.jpg', 'Shinto Miko Priest Priestess Rice Goddess Religion Japan Worship Rituals School', 'Milarepa/186/143/44'),
(4, 'AMAKUNI Shrine', 'AMAKUNI_INARI.jpg', 'Inari is a popular deity with shrines and Buddhist temples located throughout most of Japan. Here is the Inari shrine in SL (Publius/AMAKUNI).', 'Publius/112/251/40'),
(5, 'Hinomoto', 'Hinomoto.jpg', 'Japan, Jinja (Shinto shrine), Inari, Onsen (Hot spring), Ryokan (Inn), Sushi, Chaya (Cafe), Free Gift', 'Monarch/224/192/23'),
(6, 'Inari Shrine Kyoto Kagai Hanafusa Okiya', 'Inari_Shrine_Kyoto_Kagai_Hanafusa_Okiya.jpg', 'Come join us in modern day Kyoto for an alternative day out.\r\nWe have all the five districts that educate Geiko/maiko/minarai/shikomi/geisha.rentals,geisha,kyoto,japan,okiya,ochaya,nippon,Nihon,Japanese,Karyukai,Okaasan,shrine, Hanafusa,Gion, shopping', 'Midnight Sun/202/63/25'),
(7, 'Crash City Shrine', 'Crash_City_Shrine.jpg', '<span lang="ja">クラッシュスタイル</span> Cash styles, Waffles'' , & Digital DeZines \r\nShopping, clothing, omega, mesh, shirts, dresses, outfits, jeans, shoes, skirts, mens, womens, pajama, fashion, lucky chairs, Gacha, shop rental, Japanese, Shinto shrine, babygirl', 'Vico/10/102/953'),
(8, 'Ahiru Shrine', 'Ahiru_Shrine.jpg', 'A Japanese themed Sim. All are welcome to come explore and enjoy our wonderful village.\r\nEdo Meiji Japan Asian Geisha Samurai Okiya Kimono Katana Japanese Onsen Sento Sentou Hot Spring Japanese Garden Shinto Shrine Farm', 'Ahiru/164/129/26'),
(9, 'Gion Kobu Hanamachi Karyukai Okiya Shrine', 'Gion_Kobu_Hanamachi_Karyukai_Okiya_Shrine.jpg', 'First Second Life Hanamachi established in August 2006.\r\nLate Edo period sim circa 1867. geisha, hanamachi, ochaya, okiya, theater, chashitsu, school, shinto shrine,  Japan, Japanese, Nippon, Asian, park, nature, fishing, entertainment, art gallery, dojo', 'Gion Kobu/129/95/22'),
(10, 'Inaba no Shirousagi Shrine', 'Inaba_no_Shirousagi_Shrine.jpg', 'A small, peaceful shrine for Inaba no Shirousagi, or the Hare of Inaba. \r\nMaintained by the Yasashi Akuma No Jinja group.', 'Kouhun/162/169/50'),
(11, 'Benzaiten Shrine UUtopia', 'Benzaiten_Shrine_UUtopia.jpg', 'A Bonsai Garden with Benzaiten Shinto Shrine, In UUtopia', 'UUtopia/15/162/22'),
(12, 'Yasaka Shrine Kyoto', 'Yasaka_Shrine_Kyoto.jpg', 'We are the first sim to Host all 5 of Kyoto''s Geisha Disticts with different okiya.\r\nKabuki Theater; Yasaka Shrine; Gion Corner; Maruyama Park\r\nAll are welcomed to RP here.\r\n*Rentals available* \r\nShops & Residential.', 'Sweet Serenity Estate/95/143/23'),
(13, 'Kusanagi Shrine', 'Kusanagi_Shrine.jpg', 'Shinto shrines at the mountaintop, and Japanese garden which features an wooden five-story pagoda. Feel free to visit to see cherry blossoms in the garden. FTL Mainstore is in the sky over the garden so use the teleporter to go.', 'Kusanagi/120/110/61'),
(14, 'Mari-Jingu Shrine', 'Mari-Jingu_Shrine.jpg', 'Mari Jingu (Mari-Schrein), vertraut wie Mari Sama (Ehrwuerdige Mari) bekannt, ist eines der groessten Zentren der Anbetung in Second Life aus alten Zeiten.', 'Maritime/128/76/23'),
(15, 'Moai Shrine', 'Moai_Shrine.jpg', 'Japanese shrine,SLRR private stations\r\n<span lang="ja">モアイ神社へようこそ。\r\n本殿で写真撮影すると時々何かが写り込むとの噂が・・・・</span>', 'Lapara/160/114/100'),
(16, 'Ouse Shrine', 'Ouse_Shrine.jpg', '<span lang="ja">逢瀬神社</span>', 'Apoda/80/125/44'),
(17, 'Tenjin Shrine', 'Tenjin_Shrine.jpg', 'SL adaptation of Shinto shrine. Purification, prayer, bow, clap, prayer, fortune, meditation. SL Public Land Preserve. Below is Buryat Mongolian ovoo shrine to ancestors..', 'Tethys/226/198/115'),
(18, 'Majistral Shrine', 'Majistral_Shrine.jpg', '1 PRIM and LOW Prim Staircase , Stairs, Steps,  Stairways \r\nONLY $25Ls CURVED stairs NOW too! (only 2 prims) Spiral \r\nTori gate (1 Prim), Bridges (1 Prim)\r\nsteps, stone, bridge, staircase, stairs,\r\nShinto is A fundamental connection. ', 'Majistral/238/205/99'),
(19, 'HIROBA Inari Shrine', 'HIROBA_Inari_Shrine.jpg', 'We will comply with the "Community Standards" and "Maturity "..\r\n<span lang="ja">「自由ひろば」の施設。日本言語によるサポート広場のすぐ横にある神社です。誰でも自由に使うことができます。</span>', 'Davros/58/81/24');

-- --------------------------------------------------------

--
-- Table structure for table `articles_to_pages`
--

CREATE TABLE IF NOT EXISTS `articles_to_pages` (
  `page_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `articles_to_pages`
--

INSERT INTO `articles_to_pages` (`page_id`, `article_id`) VALUES
(2, 1),
(3, 2),
(3, 3),
(3, 4),
(3, 5),
(3, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(7, 11),
(4, 12),
(5, 12),
(1, 13),
(1, 14),
(4, 1),
(6, 1),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(3, 19);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `owner`, `access`) VALUES
(1, 'Demo', 'Vivien Lyne', 1),
(2, 'Amaterasu Shrine Little Yoshiwara', 'Xuemei Yiyuan', 1),
(3, 'Inari Shrine Little Yoshiwara', 'Xuemei Yiyuan', 1),
(4, 'Benzaiten Shrine UUtopia', 'Pomona Writer', 1),
(5, 'Okami Inari Shrine', 'Barren Huszar', 1),
(6, 'Inaba no Shirousagi Public Shrine', 'Aucenille', 1),
(7, 'Gion Kobu Hanamachi Karyukai Okiya Shrine', 'April Cordeaux', 1),
(8, 'Starting point', 'Vivien Lyne', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `caption` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `caption`) VALUES
(1, 'other', 'Other shrines'),
(2, 'amaterasu', 'Amaterasu shrines'),
(3, 'inari', 'Inari shrines'),
(4, 'susanoo', 'Susanoo shrines'),
(5, 'inada', 'Inada shrines'),
(6, 'uzume', 'Uzume shrines'),
(7, 'benzaiten', 'Benzaiten shrines'),
(8, 'not-found', 'Not found'),
(9, 'access-denied', 'Access denied');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
