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
  PRIMARY KEY (`id`),
  KEY `entityId` (`entityId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;
