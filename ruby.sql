-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 26 2020 г., 17:37
-- Версия сервера: 10.3.13-MariaDB
-- Версия PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `ruby`
--

-- --------------------------------------------------------

--
-- Структура таблицы `task_list`
--

CREATE TABLE `task_list` (
  `task_list_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `task_details` text NOT NULL,
  `task_status` enum('no','yes') NOT NULL,
  `checkbox` tinyint(1) NOT NULL DEFAULT 0,
  `position_order` int(11) NOT NULL,
  `title_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `task_list`
--

INSERT INTO `task_list` (`task_list_id`, `user_id`, `task_details`, `task_status`, `checkbox`, `position_order`, `title_id`) VALUES
(241, 1, 'Помыть посуду', 'yes', 0, 4, NULL),
(242, 1, 'Сделать уроки', 'yes', 0, 3, NULL),
(274, 1, 'Поцеловать Катю', 'yes', 0, 1, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `task_title`
--

CREATE TABLE `task_title` (
  `title_id` int(11) NOT NULL,
  `title_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `task_title`
--

INSERT INTO `task_title` (`title_id`, `title_text`) VALUES
(1422, ''),
(1423, 'делы');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `task_list`
--
ALTER TABLE `task_list`
  ADD PRIMARY KEY (`task_list_id`) USING BTREE,
  ADD KEY `title_id` (`title_id`);

--
-- Индексы таблицы `task_title`
--
ALTER TABLE `task_title`
  ADD PRIMARY KEY (`title_id`),
  ADD KEY `title_id` (`title_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `task_list`
--
ALTER TABLE `task_list`
  MODIFY `task_list_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=287;

--
-- AUTO_INCREMENT для таблицы `task_title`
--
ALTER TABLE `task_title`
  MODIFY `title_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1424;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `task_list`
--
ALTER TABLE `task_list`
  ADD CONSTRAINT `task_list_ibfk_1` FOREIGN KEY (`title_id`) REFERENCES `task_title` (`title_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
