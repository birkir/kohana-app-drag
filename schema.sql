--
-- MySQL schema for drag project
--

--
-- Table structure for table `activities`
--

CREATE TABLE IF NOT EXISTS `activities` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) unsigned DEFAULT NULL,
  `ref_type` varchar(32) COLLATE utf8_icelandic_ci DEFAULT NULL,
  `ref_id` int(11) unsigned DEFAULT NULL,
  `message` varchar(128) COLLATE utf8_icelandic_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `ref_user_id` (`ref_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_icelandic_ci AUTO_INCREMENT=20 ;

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE IF NOT EXISTS `cars` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT NULL,
  `year` int(4) unsigned NOT NULL,
  `make` varchar(32) COLLATE utf8_icelandic_ci NOT NULL,
  `model` varchar(64) COLLATE utf8_icelandic_ci NOT NULL,
  `licence_plate` varchar(6) COLLATE utf8_icelandic_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_icelandic_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `car_modification`
--

CREATE TABLE IF NOT EXISTS `car_modification` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `car_id` int(11) unsigned NOT NULL,
  `description` text COLLATE utf8_icelandic_ci NOT NULL,
  `date_added` datetime NOT NULL,
  `date_removed` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `car_id` (`car_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_icelandic_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `competitions`
--

CREATE TABLE IF NOT EXISTS `competitions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_icelandic_ci NOT NULL,
  `description` text COLLATE utf8_icelandic_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_icelandic_ci AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `competition_classes`
--

CREATE TABLE IF NOT EXISTS `competition_classes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `competition_id` int(11) unsigned NOT NULL,
  `name` varchar(128) COLLATE utf8_icelandic_ci NOT NULL,
  `description` varchar(128) COLLATE utf8_icelandic_ci NOT NULL,
  `rules` text COLLATE utf8_icelandic_ci,
  PRIMARY KEY (`id`),
  KEY `competition_id` (`competition_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_icelandic_ci AUTO_INCREMENT=52 ;

-- --------------------------------------------------------

--
-- Table structure for table `competition_rounds`
--

CREATE TABLE IF NOT EXISTS `competition_rounds` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `competition_id` int(11) unsigned NOT NULL,
  `track_id` int(11) unsigned NOT NULL,
  `datetime` datetime NOT NULL,
  `name` varchar(128) COLLATE utf8_icelandic_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `competition_id` (`competition_id`),
  KEY `track_id` (`track_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_icelandic_ci AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `competition_round_competitors`
--

CREATE TABLE IF NOT EXISTS `competition_round_competitors` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `competition_round_id` int(11) unsigned NOT NULL,
  `competition_class_id` int(11) unsigned NOT NULL,
  `car_id` int(11) unsigned DEFAULT NULL,
  `user_id` int(11) unsigned DEFAULT NULL,
  `driver` varchar(128) COLLATE utf8_icelandic_ci NOT NULL,
  `car` varchar(32) COLLATE utf8_icelandic_ci NOT NULL,
  `identity` varchar(16) COLLATE utf8_icelandic_ci NOT NULL,
  `position` tinyint(2) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `competition_round_id` (`competition_round_id`),
  KEY `competition_class_id` (`competition_class_id`),
  KEY `car_id` (`car_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_icelandic_ci AUTO_INCREMENT=298 ;

-- --------------------------------------------------------

--
-- Table structure for table `competition_round_matches`
--

CREATE TABLE IF NOT EXISTS `competition_round_matches` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `competition_round_id` int(11) unsigned DEFAULT NULL,
  `time_a` int(11) unsigned DEFAULT NULL,
  `time_b` int(11) unsigned DEFAULT NULL,
  `competitor_a` int(11) unsigned DEFAULT NULL,
  `competitor_b` int(11) unsigned DEFAULT NULL,
  `carnumber_a` varchar(8) COLLATE utf8_icelandic_ci DEFAULT NULL,
  `carnumber_b` varchar(8) COLLATE utf8_icelandic_ci DEFAULT NULL,
  `won` enum('a','b') COLLATE utf8_icelandic_ci DEFAULT NULL,
  `comment` varchar(64) COLLATE utf8_icelandic_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `time_a` (`time_a`),
  KEY `time_b` (`time_b`),
  KEY `competitor_a` (`competitor_a`),
  KEY `competitor_b` (`competitor_b`),
  KEY `competition_round_id` (`competition_round_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_icelandic_ci AUTO_INCREMENT=2565 ;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_icelandic_ci NOT NULL,
  `description` text COLLATE utf8_icelandic_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_icelandic_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `roles_users`
--

CREATE TABLE IF NOT EXISTS `roles_users` (
  `role_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  KEY `role_id` (`role_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_icelandic_ci;

-- --------------------------------------------------------

--
-- Table structure for table `times`
--

CREATE TABLE IF NOT EXISTS `times` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `car_id` int(11) unsigned DEFAULT NULL,
  `track_id` int(11) unsigned NOT NULL,
  `identity` varchar(16) COLLATE utf8_icelandic_ci NOT NULL,
  `lane` enum('l','r') CHARACTER SET latin1 DEFAULT NULL,
  `won` tinyint(1) DEFAULT NULL,
  `index` decimal(6,3) DEFAULT NULL,
  `rt` decimal(6,3) NOT NULL,
  `60ft` decimal(6,3) NOT NULL,
  `660ft` decimal(6,3) NOT NULL,
  `660mph` decimal(6,3) NOT NULL,
  `1320ft` decimal(6,3) NOT NULL,
  `1320mph` decimal(6,3) NOT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `car_id` (`car_id`),
  KEY `track_id` (`track_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_icelandic_ci AUTO_INCREMENT=5276 ;

-- --------------------------------------------------------

--
-- Table structure for table `tracks`
--

CREATE TABLE IF NOT EXISTS `tracks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_icelandic_ci NOT NULL,
  `description` text COLLATE utf8_icelandic_ci NOT NULL,
  `altitude` int(5) unsigned NOT NULL,
  `latitude` decimal(8,6) NOT NULL,
  `longitude` decimal(8,6) NOT NULL,
  `weather_station_id` int(11) unsigned NOT NULL,
  `direction` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_icelandic_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(128) COLLATE utf8_icelandic_ci NOT NULL,
  `username` varchar(128) COLLATE utf8_icelandic_ci NOT NULL,
  `password` varbinary(64) NOT NULL,
  `language` varchar(8) COLLATE utf8_icelandic_ci NOT NULL,
  `theme` varchar(32) COLLATE utf8_icelandic_ci NOT NULL,
  `logins` int(6) unsigned DEFAULT NULL,
  `ip` varbinary(16) DEFAULT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_icelandic_ci AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_oauth`
--

CREATE TABLE IF NOT EXISTS `user_oauth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `type` varchar(64) COLLATE utf8_icelandic_ci NOT NULL,
  `oauth_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_icelandic_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_tokens`
--

CREATE TABLE IF NOT EXISTS `user_tokens` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `user_agent` varchar(64) COLLATE utf8_icelandic_ci NOT NULL,
  `token` varchar(32) COLLATE utf8_icelandic_ci NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `expires` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_icelandic_ci AUTO_INCREMENT=15 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activities`
--
ALTER TABLE `activities`
  ADD CONSTRAINT `activities_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `cars_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `car_modification`
--
ALTER TABLE `car_modification`
  ADD CONSTRAINT `car_modification_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`);

--
-- Constraints for table `competition_classes`
--
ALTER TABLE `competition_classes`
  ADD CONSTRAINT `competition_classes_ibfk_1` FOREIGN KEY (`competition_id`) REFERENCES `competitions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `competition_rounds`
--
ALTER TABLE `competition_rounds`
  ADD CONSTRAINT `competition_rounds_ibfk_1` FOREIGN KEY (`competition_id`) REFERENCES `competitions` (`id`),
  ADD CONSTRAINT `competition_rounds_ibfk_2` FOREIGN KEY (`track_id`) REFERENCES `tracks` (`id`);

--
-- Constraints for table `competition_round_competitors`
--
ALTER TABLE `competition_round_competitors`
  ADD CONSTRAINT `competition_round_competitors_ibfk_1` FOREIGN KEY (`competition_round_id`) REFERENCES `competition_rounds` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `competition_round_competitors_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `competition_round_competitors_ibfk_3` FOREIGN KEY (`competition_class_id`) REFERENCES `competition_classes` (`id`),
  ADD CONSTRAINT `competition_round_competitors_ibfk_4` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`);

--
-- Constraints for table `competition_round_matches`
--
ALTER TABLE `competition_round_matches`
  ADD CONSTRAINT `competition_round_matches_ibfk_7` FOREIGN KEY (`competition_round_id`) REFERENCES `competition_rounds` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `competition_round_matches_ibfk_3` FOREIGN KEY (`time_a`) REFERENCES `times` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `competition_round_matches_ibfk_4` FOREIGN KEY (`time_b`) REFERENCES `times` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `competition_round_matches_ibfk_5` FOREIGN KEY (`competitor_a`) REFERENCES `competition_round_competitors` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `competition_round_matches_ibfk_6` FOREIGN KEY (`competitor_b`) REFERENCES `competition_round_competitors` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `roles_users`
--
ALTER TABLE `roles_users`
  ADD CONSTRAINT `roles_users_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `roles_users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `times`
--
ALTER TABLE `times`
  ADD CONSTRAINT `times_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`),
  ADD CONSTRAINT `times_ibfk_2` FOREIGN KEY (`track_id`) REFERENCES `tracks` (`id`);

--
-- Constraints for table `user_oauth`
--
ALTER TABLE `user_oauth`
  ADD CONSTRAINT `user_oauth_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_tokens`
--
ALTER TABLE `user_tokens`
  ADD CONSTRAINT `user_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
