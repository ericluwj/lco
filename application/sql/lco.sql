CREATE TABLE `meta` (
  `key` varchar(140) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB CHARSET=utf8;

CREATE TABLE `pages` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `slug` varchar(150) NOT NULL,
  `name` varchar(64) NOT NULL,
  `title` varchar(150) NOT NULL,
  `content` text NOT NULL,
  `redirect` text NOT NULL,
  `show_in_menu` tinyint(1) NOT NULL,
  `menu_order` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `slug` (`slug`)
) ENGINE=InnoDB CHARSET=utf8;

CREATE TABLE `posts` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `html` text NOT NULL,
  `css` text NOT NULL,
  `js` text NOT NULL,
  `created` datetime NOT NULL,
  `author` int(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `slug` (`slug`)
) ENGINE=InnoDB CHARSET=utf8;

CREATE TABLE `sessions` (
  `id` char(32) NOT NULL,
  `expire` int(10) NOT NULL,
  `data` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB CHARSET=utf8;

CREATE TABLE `users` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(140) NOT NULL,
  `real_name` varchar(140) NOT NULL,
  `bio` text NOT NULL,
  `status` enum('inactive','active') NOT NULL,
  `role` enum('administrator','editor','user') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB CHARSET=utf8;

INSERT INTO `meta` (`key`, `value`) VALUES
('auto_published_comments', '0'),
('comment_moderation_keys', ''),
('comment_notifications', '0'),
('current_migration', '0'),
('date_format', 'jS M, Y'),
('description', 'LCO Blog'),
('home_page', '1'),
('posts_page', '1'),
('posts_per_page', '6'),
('sitename', 'LCO Blog'),
('theme', 'default');

INSERT INTO `pages` (`slug`, `name`, `title`, `content`, `redirect`, `show_in_menu`, `menu_order`) VALUES
('posts', 'Posts', 'My thoughts and rants', 'Welcome!', '', '1', '0');

INSERT INTO `posts` (`title`, `slug`, `description`, `html`, `css`, `js`, `created`, `author`) VALUES
('Hello LCO', 'hello-lco', 'LCO Blog', 'Hello LCO!', '', '', '2015-10-28 00:08:34', '1');

INSERT INTO `posts` (`title`, `slug`, `description`, `html`, `css`, `js`, `created`, `author`) VALUES
('Hello Eric', 'hello-eric', 'Eric Blog', 'Hello Eric!', '', '', '2015-10-28 01:02:46', '1');

INSERT INTO `users` (`id`, `username`, `password`, `email`, `real_name`, `bio`, `status`, `role`) VALUES
(1, 'admin', '$2a$10$B7mqftyEj1vYTGHfgrClaOuF38shJdt0HPmE4STxAYuVAh6DhDbVq', 'admin@admin.com', 'Administrator', 'The bouse', 'active', 'administrator');