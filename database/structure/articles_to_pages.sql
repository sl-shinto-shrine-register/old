DROP TABLE IF EXISTS `articles_to_pages`;
CREATE TABLE `articles_to_pages` (
  `page_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  KEY `page_id` (`page_id`),
  KEY `article_id` (`article_id`),
  CONSTRAINT `article` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `page` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
