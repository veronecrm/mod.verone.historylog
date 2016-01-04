CREATE TABLE IF NOT EXISTS `#__history_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `authorId` int(11) NOT NULL,
  `authorName` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `entityId` int(11) NOT NULL,
  `entityName` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `date` int(11) NOT NULL,
  `object` varchar(127) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `module` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `relatedWith` int(11) DEFAULT NULL,
  `type` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `log` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `entityId` (`entityId`),
  KEY `relatedWith` (`relatedWith`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;
