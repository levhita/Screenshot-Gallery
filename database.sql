-- 
-- Table structure for table `screenshot`
-- 

CREATE TABLE `screenshot` (
  `id_screenshot` int(10) unsigned NOT NULL auto_increment,
  `base_name` varchar(19) collate utf8_unicode_ci NOT NULL,
  `name` varchar(99) collate utf8_unicode_ci default NULL,
  `description` varchar(255) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`id_screenshot`),
  UNIQUE KEY `base_name` (`base_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
