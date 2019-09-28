DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Incrementing ID',
  `caption_en` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Name (english)',
  `caption_ja` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Name (japanese)',
  `caption_de` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Name (german)',
  `description_en` text COLLATE utf8mb4_unicode_ci COMMENT 'Description (english)',
  `description_ja` text COLLATE utf8mb4_unicode_ci COMMENT 'Description (japanese)',
  `description_de` text COLLATE utf8mb4_unicode_ci COMMENT 'Description (german)',
  `link` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Link',
  `founded_at` timestamp NULL DEFAULT NULL COMMENT 'Foundation date',
  `owner_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Owner',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Creation timestamp',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Update timestamp',
  PRIMARY KEY (`id`),
  KEY `owner_id` (`owner_id`),
  CONSTRAINT `owner` FOREIGN KEY (`owner_id`) REFERENCES `owners` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
