-- MySQL dump 10.13  Distrib 5.7.18, for Linux (x86_64)
--
-- Host: localhost    Database: slsr
-- ------------------------------------------------------
-- Server version	5.7.18-0ubuntu0.16.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `caption` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES (1,'Amaterasu Omikami Shrine Little Yoshiwara','Amaterasu_Omikami_Grand_Shinto_Shrine_Little_Yoshiwara.jpg','Amaterasu, Susano-o & Uzume Shinto Shrines. Shinto school and RP group, priest, priestess, miko. Shinto weddings & rituals performed. Join Yoshiwara Jingu Association group for updates  (Shrine Builders - Utayo Yengawa & Anika Deschanel).','Ribush/78/255/44'),(2,'Okami Inari Shrine','Okami_Inari_Shrine.jpg','Inari is the Japanese kami of foxes, of fertility, rice, tea and Sake, of agriculture and industry, of general prosperity and worldly success, and one of the principal kami of Shinto.','Sallow/130/155/32'),(3,'Little Yoshiwara Inari Shrine','Little_Yoshiwara_Inari_Shrine.jpg','Shinto Miko Priest Priestess Rice Goddess Religion Japan Worship Rituals School','Milarepa/186/143/44'),(4,'AMAKUNI Shrine','AMAKUNI_INARI.jpg','Inari is a popular deity with shrines and Buddhist temples located throughout most of Japan. Here is the Inari shrine in SL (Publius/AMAKUNI).','Publius/112/251/40'),(5,'Hinomoto','Hinomoto.jpg','Japan, Jinja (Shinto shrine), Inari, Onsen (Hot spring), Ryokan (Inn), Sushi, Chaya (Cafe), Free Gift','Monarch/224/192/23'),(6,'Inari Shrine Kyoto Kagai Hanafusa Okiya','Inari_Shrine_Kyoto_Kagai_Hanafusa_Okiya.jpg','Come join us in modern day Kyoto for an alternative day out.\r\nWe have all the five districts that educate Geiko/maiko/minarai/shikomi/geisha.rentals,geisha,kyoto,japan,okiya,ochaya,nippon,Nihon,Japanese,Karyukai,Okaasan,shrine, Hanafusa,Gion, shopping','Midnight Sun/202/63/25'),(7,'Crash City Shrine','Crash_City_Shrine.jpg','<span lang=\"ja\">クラッシュスタイル</span> Cash styles, Waffles\' , & Digital DeZines \r\nShopping, clothing, omega, mesh, shirts, dresses, outfits, jeans, shoes, skirts, mens, womens, pajama, fashion, lucky chairs, Gacha, shop rental, Japanese, Shinto shrine, babygirl','Vico/10/102/953'),(8,'Ahiru Shrine','Ahiru_Shrine.jpg','A Japanese themed Sim. All are welcome to come explore and enjoy our wonderful village.\r\nEdo Meiji Japan Asian Geisha Samurai Okiya Kimono Katana Japanese Onsen Sento Sentou Hot Spring Japanese Garden Shinto Shrine Farm','Ahiru/164/129/26'),(9,'Gion Kobu Hanamachi Karyukai Okiya Shrine','Gion_Kobu_Hanamachi_Karyukai_Okiya_Shrine.jpg','First Second Life Hanamachi established in August 2006.\r\nLate Edo period sim circa 1867. geisha, hanamachi, ochaya, okiya, theater, chashitsu, school, shinto shrine,  Japan, Japanese, Nippon, Asian, park, nature, fishing, entertainment, art gallery, dojo','Gion Kobu/129/95/22'),(10,'Inaba no Shirousagi Shrine','Inaba_no_Shirousagi_Shrine.jpg','A small, peaceful shrine for Inaba no Shirousagi, or the Hare of Inaba. \r\nMaintained by the Yasashi Akuma No Jinja group.','Kouhun/162/169/50'),(11,'Benzaiten Shrine UUtopia','Benzaiten_Shrine_UUtopia.jpg','A Bonsai Garden with Benzaiten Shinto Shrine, In UUtopia','UUtopia/15/162/22'),(12,'Yasaka Shrine Kyoto','Yasaka_Shrine_Kyoto.jpg','We are the first sim to Host all 5 of Kyoto\'s Geisha Disticts with different okiya.\r\nKabuki Theater; Yasaka Shrine; Gion Corner; Maruyama Park\r\nAll are welcomed to RP here.\r\n*Rentals available* \r\nShops & Residential.','Sweet Serenity Estate/95/143/23'),(13,'Kusanagi Shrine','Kusanagi_Shrine.jpg','Shinto shrines at the mountaintop, and Japanese garden which features an wooden five-story pagoda. Feel free to visit to see cherry blossoms in the garden. FTL Mainstore is in the sky over the garden so use the teleporter to go.','Kusanagi/120/110/61'),(14,'Mari-Jingu Shrine','Mari-Jingu_Shrine.jpg','Mari Jingu (Mari-Schrein), vertraut wie Mari Sama (Ehrwuerdige Mari) bekannt, ist eines der groessten Zentren der Anbetung in Second Life aus alten Zeiten.','Maritime/128/76/23'),(15,'Moai Shrine','Moai_Shrine.jpg','Japanese shrine,SLRR private stations\r\n<span lang=\"ja\">モアイ神社へようこそ。\r\n本殿で写真撮影すると時々何かが写り込むとの噂が・・・・</span>','Lapara/160/114/100'),(16,'Ouse Shrine','Ouse_Shrine.jpg','<span lang=\"ja\">逢瀬神社</span>','Apoda/80/125/44'),(17,'Tenjin Shrine','Tenjin_Shrine.jpg','SL adaptation of Shinto shrine. Purification, prayer, bow, clap, prayer, fortune, meditation. SL Public Land Preserve. Below is Buryat Mongolian ovoo shrine to ancestors..','Tethys/226/198/115'),(18,'Majistral Shrine','Majistral_Shrine.jpg','1 PRIM and LOW Prim Staircase , Stairs, Steps,  Stairways \r\nONLY $25Ls CURVED stairs NOW too! (only 2 prims) Spiral \r\nTori gate (1 Prim), Bridges (1 Prim)\r\nsteps, stone, bridge, staircase, stairs,\r\nShinto is A fundamental connection. ','Majistral/238/205/99'),(19,'HIROBA Inari Shrine','HIROBA_Inari_Shrine.jpg','We will comply with the \"Community Standards\" and \"Maturity \"..\r\n<span lang=\"ja\">「自由ひろば」の施設。日本言語によるサポート広場のすぐ横にある神社です。誰でも自由に使うことができます。</span>','Davros/58/81/24');
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `articles_to_pages`
--

DROP TABLE IF EXISTS `articles_to_pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articles_to_pages` (
  `page_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles_to_pages`
--

LOCK TABLES `articles_to_pages` WRITE;
/*!40000 ALTER TABLE `articles_to_pages` DISABLE KEYS */;
INSERT INTO `articles_to_pages` VALUES (2,1),(3,2),(3,3),(3,4),(3,5),(3,6),(1,7),(1,8),(1,9),(1,10),(7,11),(4,12),(5,12),(1,13),(1,14),(4,1),(6,1),(1,15),(1,16),(1,17),(1,18),(3,19);
/*!40000 ALTER TABLE `articles_to_pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (1,'Demo','Vivien Lyne',1),(2,'Amaterasu Shrine Little Yoshiwara','Xuemei Yiyuan',1),(3,'Inari Shrine Little Yoshiwara','Xuemei Yiyuan',1),(4,'Benzaiten Shrine UUtopia','Pomona Writer',1),(5,'Okami Inari Shrine','Barren Huszar',1),(6,'Inaba no Shirousagi Public Shrine','Aucenille',1),(7,'Gion Kobu Hanamachi Karyukai Okiya Shrine','April Cordeaux',1),(8,'Starting point','Vivien Lyne',1);
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `caption` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8mb4,
  `type` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,'other','Other shrines','Other shrines | SLSR',NULL,3),(2,'amaterasu','Amaterasu shrines','Amaterasu shrines | SLSR',NULL,3),(3,'inari','Inari shrines','Inari shrines | SLSR',NULL,3),(4,'susanoo','Susanoo shrines','Susanoo shrines | SLSR',NULL,3),(5,'inada','Inada shrines','Inada shrines | SLSR',NULL,3),(6,'uzume','Uzume shrines','Uzume shrines | SLSR',NULL,3),(7,'benzaiten','Benzaiten shrines','Benzaiten shrines | SLSR',NULL,3),(8,'not-found','Not found','Page not found | SLSR','Page not found. <a href=\"/\">Go to the homepage.</a>',1),(9,'access-denied','Access denied','Access denied | SLSR','<a href=\"/\">Go to the homepage.</a>',1),(10,'about','About','About the SL Shinto shrine register','<p>The <em>S</em>econd <em>L</em>ife Shinto <em>S</em>hrine <em>R</em>egister (<em>SLSR</em>) is a association of Shinto shrines in Second Life.</p>\n<h3>The SLSR consists of the following parts:</h3>\n<ul>\n <li>Shinto shrine register group (<em class=\"marker_green\">for free</em>)</li>\n <li>Shrine database (<em class=\"marker_green\">entry for free</em>)</li>\n <li>Shrine register board beside every shrine for the visitors of a shrine to browse for other shrines (<em class=\"marker_red\">50L$/Month for every shrine</em>)\n</ul>\n<a id=\"join-group\" href=\"secondlife:///app/group/1e87fa6c-7a9f-5a54-602c-149606623147/about\"><img src=\"/img/group-symbol.png\" alt=\"\"/>Join the group</a>',2),(11,'imprint','Imprint','Imprint of the SL Shinto shrine register','<h3>Provider</h3>\n<table id=\"table-provider\">\n <tr>\n  <th>Name:</th>\n  <td>Vivien Richter</td>\n </tr>\n <tr>\n  <th>Second Life Name:</th>\n  <td><a href=\"secondlife:///app/agent/3729f60f-73a4-4b6d-ae59-06136d1eade1/about\">Vivien Lyne</a></td>\n <tr>\n  <th>Address:</th>\n  <td>Städtelner Straße 28a\nD-04416 Markkleeberg, Germany\n </tr>\n <tr>\n  <th>Phone:</th>\n  <td>+49 163 7037245</td>\n </tr>\n <tr>\n  <th>E-Mail:</th>\n  <td><a href=\"mailto:webmaster@slsr.org\">webmaster@slsr.org</a></td>\n </tr>\n</table>\n<h3>Image sources</h3>\n<table id=\"table-sources\">\n <tr>\n  <th>URL</th>\n  <th>Last access</th>\n </tr>\n <tr>\n  <td><a href=\"http://www.texturex.com/Wood-Textures/kempas+wood+texture+floor+panel+stock+photo.jpg.php\">http://www.texturex.com/Wood-Textures/kempas+wood+texture+floor+panel+stock+photo.jpg.php</a></td>\n  <td>07. June 2017 17:25</td>\n </tr>\n <tr>\n  <td><a href=\"https://www.textures.com/download/wicker0011/15203\">https://www.textures.com/download/wicker0011/15203</a></td>\n  <td>07. June 2017 17:27</td>\n </tr>\n <tr>\n  <td><a href=\"https://commons.wikimedia.org/wiki/File:Tatami.jpg\">https://commons.wikimedia.org/wiki/File:Tatami.jpg</a></td>\n  <td>07. June 2017 17:27</td>\n </tr>\n <tr>\n  <td><a href=\"http://www.texturex.com/Wood-Textures/red+wood+texture+grain+natural+wooden+paneling+surface+photo+wallpaper.jpg.php\">http://www.texturex.com/Wood-Textures/red+wood+texture+grain+natural+wooden+paneling+surface+photo+wallpaper.jpg.php</a></td>\n  <td>07. June 2017 17:28</td>\n </tr>\n <tr>\n  <td><a href=\"https://pixabay.com/en/members-group-people-651819/\">https://pixabay.com/en/members-group-people-651819/</a></td>\n  <td>07. June 2017 17:28</td>\n </tr>\n <tr>\n  <td><a href=\"https://commons.wikimedia.org/wiki/File:W3C%C2%AE_Icon.svg\">https://commons.wikimedia.org/wiki/File:W3C%C2%AE_Icon.svg</a></td>\n  <td>09. June 2017 16:52</td>\n </tr>\n</table>\n<h3>Standards</h3>\n<a href=\"https://validator.w3.org/nu/?doc=http%3A%2F%2Fslsr.org\"><img class=\"badge\" src=\"/img/w3c_valid_html.gif\" alt=\"W3C Valid HTML\"/></a>\n<a href=\"http://jigsaw.w3.org/css-validator/validator?uri=slsr.org\"><img class=\"badge\" src=\"/img/w3c_valid_css.gif\" alt=\"W3C Valid CSS\"/></a>\n<h3>Hoster</h3>\n<a href=\"http://www.bplaced.net\"><img class=\"badge\" src=\"/img/bplaced_logo.gif\" alt=\"bplaced.net\"/></a>',2);
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-06-10  4:05:48
