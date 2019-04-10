-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Мар 18 2019 г., 23:21
-- Версия сервера: 5.5.25
-- Версия PHP: 5.2.12

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `pawnshopbase`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `note` varchar(120) NOT NULL DEFAULT 'Без примечаний',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=673 ;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`ID`, `name`, `note`) VALUES
(123, 'Часы', 'Скидка 20%, если часы механические'),
(214, 'Обручальное кольцо', 'Скидка 20%, если вернет деньги в течении недели'),
(433, 'Смартфон', 'Скидка 10% за телефон в коробке и полной комплектации'),
(455, 'Цепочка', 'Без примечаний'),
(531, 'Перстень', 'Скидка 30%, если кольцо из позолоты'),
(606, 'Сережки', 'Скидка 10%, если чистое золото'),
(503, 'Машина', 'Скидка 50%, если машина выпускалась после 2010 года'),
(612, 'Кроссовки', 'Без примечаний'),
(613, 'Очки', 'Без примечаний'),
(615, 'Видеокарта', 'Без примечаний'),
(660, 'Наушники', 'Без примечаний'),
(671, 'Компьютерная мышь', 'Скидка 20%, если в комплекте с клавиатурой');

-- --------------------------------------------------------

--
-- Структура таблицы `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `surname` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `middle_name` varchar(30) NOT NULL,
  `pass_id` int(9) unsigned NOT NULL,
  `pass_ser` varchar(8) NOT NULL DEFAULT 'ID-карта',
  `date` date NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Номер паспорта` (`pass_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Дамп данных таблицы `clients`
--

INSERT INTO `clients` (`ID`, `surname`, `name`, `middle_name`, `pass_id`, `pass_ser`, `date`) VALUES
(11, 'Кущ', 'Данил', 'Андреевич', 1883381, 'ID-карта', '2015-06-08'),
(2, 'Баранов', 'Лев', 'Юрьевич', 2132345, 'AH568419', '2006-12-18'),
(3, 'Соломенный', 'Александр', 'Александрович', 9993200, 'ID-карта', '2016-01-05'),
(4, 'Ефимова', 'Антонина', 'Викторовна', 1990232, 'АН233412', '2010-08-05'),
(5, 'Антоненко', 'Василиса', 'Степановна', 1883232, 'ID-карта', '2015-03-05'),
(6, 'Ежевюк', 'Роберт', 'Альбертович', 1882283, 'ID-карта', '2002-06-04'),
(12, 'Панефимов', 'Сергей', 'Анатольевич', 1843981, 'ID-карта', '2015-03-08'),
(10, 'Кущ', 'Богдан', 'Андреевич', 1883981, 'ID-карта', '2018-09-08'),
(13, 'Ефименко', 'Андрей', 'Валерьевич', 1885630, 'ID-карта', '2018-10-21');

-- --------------------------------------------------------

--
-- Структура таблицы `dropto`
--

CREATE TABLE IF NOT EXISTS `dropto` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `client_ID` int(11) unsigned NOT NULL,
  `product_ID` int(11) unsigned NOT NULL,
  `product_description` varchar(120) NOT NULL,
  `date_to` date NOT NULL,
  `date_undo` date NOT NULL,
  `summ` int(10) unsigned NOT NULL,
  `comission` int(10) unsigned NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Код клиента` (`client_ID`,`product_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Дамп данных таблицы `dropto`
--

INSERT INTO `dropto` (`ID`, `client_ID`, `product_ID`, `product_description`, `date_to`, `date_undo`, `summ`, `comission`) VALUES
(14, 2, 214, 'Кольцо из золота', '2019-03-09', '2019-04-18', 4000, 700),
(19, 6, 503, 'BMW X5', '2019-09-09', '2019-10-18', 50000, 10000),
(20, 11, 660, 'Razer наушники, почти новые', '2018-12-09', '2019-01-18', 3000, 900),
(18, 5, 455, 'Золотая цепочка с кулоном', '2019-07-09', '2019-10-18', 3500, 1000),
(15, 3, 123, 'Casio G-shock', '2019-07-09', '2019-12-18', 10000, 900),
(16, 10, 531, 'Серебряный перстень с черепом', '2019-07-09', '2019-10-18', 7000, 900),
(21, 13, 612, 'Nike AirMax 97 OG metallic gold', '2018-12-09', '2019-02-20', 6000, 1000);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
