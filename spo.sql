-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u9
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Ноя 30 2020 г., 17:23
-- Версия сервера: 5.5.62-0+deb8u1
-- Версия PHP: 5.6.40-0+deb8u12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `spo`
--

DELIMITER $$
--
-- Процедуры
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_user`(IN `mail` VARCHAR(50), IN `nm` VARCHAR(50), IN `lgn` VARCHAR(50), IN `pwd` VARCHAR(50))
BEGIN
	DECLARE cnt INTEGER DEFAULT 0;
    SELECT COUNT(email) INTO cnt FROM users WHERE email = mail;
    IF NOT cnt = 0 THEN
    	SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'User with such email exists!'; 
    END IF;
    SELECT COUNT(login) INTO cnt FROM users WHERE login = lgn;
    IF NOT cnt = 0 THEN
    	SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'User with such login exists!';
    END IF;
    INSERT INTO users VALUES (mail, nm, lgn, pwd);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getUserByEmailPassword`(IN `lgn` VARCHAR(50), IN `pwd` VARCHAR(50))
BEGIN
DECLARE cnt INTEGER DEFAULT 0;
SELECT COUNT(email) INTO cnt FROM users
WHERE email = lgn;
IF cnt = 0 THEN
	SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'User with such email not found!';
END IF;
SELECT COUNT(email) INTO cnt FROM users
WHERE email = lgn AND passwd = pwd;
IF cnt = 0 THEN
	SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Wrong password!';
END IF;
SELECT * FROM users
WHERE email = lgn AND passwd = pwd;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_salt`(IN `mail` VARCHAR(50))
SELECT SUBSTRING(passwd, 1, 2) AS salt FROM users WHERE email = mail$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `email` varchar(50) CHARACTER SET cp1251 NOT NULL,
  `username` varchar(50) CHARACTER SET cp1251 NOT NULL,
  `login` varchar(50) CHARACTER SET cp1251 NOT NULL,
  `passwd` varchar(50) CHARACTER SET cp1251 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`email`, `username`, `login`, `passwd`) VALUES
('vlad.mihalev.99@mail.ru', 'Vlad', 'vladm', '00S7vcmlY8f1.');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`email`), ADD UNIQUE KEY `login` (`login`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
