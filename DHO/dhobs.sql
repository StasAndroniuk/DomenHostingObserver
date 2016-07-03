-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Хост: localhost:3306
-- Время создания: Июн 27 2016 г., 10:36
-- Версия сервера: 5.5.45-cll-lve
-- Версия PHP: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `u14171_dhobs`
--

-- --------------------------------------------------------

--
-- Структура таблицы `dhobs_domens`
--

CREATE TABLE IF NOT EXISTS `dhobs_domens` (
  `domen_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `date_of_end` date NOT NULL,
  `status` int(2) NOT NULL,
  `comment` varchar(3000) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `recorder_id` int(11) NOT NULL,
  `hosting_id` int(11) NOT NULL,
  PRIMARY KEY (`domen_id`),
  KEY `owner_id` (`owner_id`),
  KEY `recorder_id` (`recorder_id`),
  KEY `hosting_id` (`hosting_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `dhobs_domens`
--

INSERT INTO `dhobs_domens` (`domen_id`, `name`, `date_of_end`, `status`, `comment`, `owner_id`, `recorder_id`, `hosting_id`) VALUES
(1, 'asdsda', '2016-06-17', 1, '', 1, 1, 1),
(3, 'usaybdpasnd', '2016-06-03', 1, '', 1, 1, 1),
(4, 'test1', '2016-06-20', 1, '', 1, 1, 1),
(5, 'test2', '2016-06-21', 1, '', 1, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `dhobs_emails`
--

CREATE TABLE IF NOT EXISTS `dhobs_emails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `owner_id` (`owner_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Дамп данных таблицы `dhobs_emails`
--

INSERT INTO `dhobs_emails` (`id`, `owner_id`, `email`) VALUES
(1, 1, 'stasss1992@mail.ru'),
(2, 1, ''),
(3, 1, '');

-- --------------------------------------------------------

--
-- Структура таблицы `dhobs_hostings`
--

CREATE TABLE IF NOT EXISTS `dhobs_hostings` (
  `hosting_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `login` varchar(50) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `date_of_end` date NOT NULL,
  `status` int(3) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `comment` varchar(3000) NOT NULL,
  `owner_id` int(11) NOT NULL,
  PRIMARY KEY (`hosting_id`),
  KEY `owner_id` (`owner_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `dhobs_hostings`
--

INSERT INTO `dhobs_hostings` (`hosting_id`, `name`, `login`, `pass`, `date_of_end`, `status`, `user_name`, `comment`, `owner_id`) VALUES
(1, 'name', 'loginasdasdsa', 'sadsadasdasd', '2016-06-30', 1, 'userasdasdasd', 'aaa', 1),
(2, 'sando', 'sadsad', 'sadsad', '2016-06-03', 1, 'sadasd', '', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `dhobs_owners`
--

CREATE TABLE IF NOT EXISTS `dhobs_owners` (
  `owner_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  PRIMARY KEY (`owner_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `dhobs_owners`
--

INSERT INTO `dhobs_owners` (`owner_id`, `firstname`, `lastname`) VALUES
(1, 'Ð’Ð°Ð»ÐµÑ€Ð°', 'Ð¡Ñ‹Ñ‰ÑƒÐº');

-- --------------------------------------------------------

--
-- Структура таблицы `dhobs_phones`
--

CREATE TABLE IF NOT EXISTS `dhobs_phones` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) NOT NULL,
  `phone` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `owner_id` (`owner_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Дамп данных таблицы `dhobs_phones`
--

INSERT INTO `dhobs_phones` (`id`, `owner_id`, `phone`) VALUES
(1, 1, '380979190699'),
(2, 1, ''),
(3, 1, '');

-- --------------------------------------------------------

--
-- Структура таблицы `dhobs_recorders`
--

CREATE TABLE IF NOT EXISTS `dhobs_recorders` (
  `recorder_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `login` varchar(50) NOT NULL,
  `pass` varchar(255) NOT NULL,
  PRIMARY KEY (`recorder_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `dhobs_recorders`
--

INSERT INTO `dhobs_recorders` (`recorder_id`, `name`, `login`, `pass`) VALUES
(1, 'nic.ua', 'login', 'pass');

-- --------------------------------------------------------

--
-- Структура таблицы `dhobs_settings`
--

CREATE TABLE IF NOT EXISTS `dhobs_settings` (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `value` varchar(255) NOT NULL,
  `description` varchar(255) CHARACTER SET utf32 NOT NULL,
  PRIMARY KEY (`setting_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `dhobs_settings`
--

INSERT INTO `dhobs_settings` (`setting_id`, `name`, `value`, `description`) VALUES
(1, 'first_warning', '1', 'Ð¡Ñ€Ð¾Ðº Ð¾Ñ‚Ð¿Ñ€Ð°Ð²ÐºÐ¸ Ð¿ÐµÑ€Ð²Ð¾Ð³Ð¾ Ð¿Ñ€ÐµÐ´ÑƒÐ¿Ñ€ÐµÐ¶Ð´ÐµÐ½Ð¸Ñ'),
(2, 'second_warning', '1', 'Ð¡Ñ€Ð¾Ðº Ð¾Ñ‚Ð¿Ñ€Ð°Ð²ÐºÐ¸ Ð²Ñ‚Ð¾Ñ€Ð¾Ð³Ð¾ Ð¿Ñ€ÐµÐ´ÑƒÐ¿Ñ€ÐµÐ¶Ð´ÐµÐ½Ð¸Ñ'),
(3, 'admin_email', 'stasss1992@gmail.com', 'ÐŸÐ¾Ñ‡Ñ‚Ð¾Ð²Ñ‹Ð¹ Ð°Ð´Ñ€ÐµÑ Ð°Ð´Ð¼Ð¸Ð½Ð¸ÑÑ‚Ñ€Ð°Ñ‚Ð¾Ñ€Ð°');

-- --------------------------------------------------------

--
-- Структура таблицы `dhobs_users`
--

CREATE TABLE IF NOT EXISTS `dhobs_users` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `pass` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `dhobs_users`
--

INSERT INTO `dhobs_users` (`user_id`, `login`, `pass`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
