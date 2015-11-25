CREATE TABLE IF NOT EXISTS `#__history_change` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `change` int(11) NOT NULL,
  `field` varchar(127) COLLATE utf8_unicode_ci NOT NULL,
  `pre` text COLLATE utf8_unicode_ci NOT NULL,
  `post` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `history_id` (`change`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;
