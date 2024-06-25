-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 25 2024 г., 03:58
-- Версия сервера: 8.0.19
-- Версия PHP: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `online_store`
--

-- --------------------------------------------------------

--
-- Структура таблицы `app`
--

CREATE TABLE `app` (
  `id` bigint NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `path` varchar(300) NOT NULL,
  `description` varchar(5000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `img_path` varchar(1000) NOT NULL,
  `path_rar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `app`
--

INSERT INTO `app` (`id`, `name`, `path`, `description`, `img_path`, `path_rar`) VALUES
(1, 'Шарики', 'Мои_экзешники\\Baloons.exe', 'Шары летают по панели со случайными радиусами, случайными цветами и исчезают по определенному количеству ударов с границами панели. Также можно изменить их скорость, посмотреть кол-во живых.', 'img\\Baloons.png', 'rar-файлы\\Baloons.rar'),
(2, 'Графический редактор', 'Мои_экзешники\\MyPaint.exe', 'Если Вы устали пользоваться устаревшим и никому не нужным Paint-ом, то эта карточка для Вас! Вы сможете рисовать карандашом, стирать написанное и еще много чего! Покупайте, пока не раскупили!', 'img\\MyPaint.png', 'rar-файлы\\lec3.rar'),
(3, 'Наглядная визуализация понятия поставщик-потребитель', 'Мои_экзешники\\ProdConsBoom.exe', 'Программа запускается по клику на панели. В рандомно заспавнившуюся область летят три шарика. Как только ее достигает первый шарик, для него появляются новая область, куда он летит. А достигнутая область взрывается, как только туда прилетят шарики трех разных цветов', 'img\\ProdConsBoom.png', 'rar-файлы\\ProdConsBoom.rar'),
(4, 'Настольный теннис', 'Мои_Экзешники\\Rocket.exe', 'Игра в настольный теннис с двумя ракетками', 'img\\Rocket.png', 'rar-файлы\\Rocket.rar');

-- --------------------------------------------------------

--
-- Структура таблицы `purchase`
--

CREATE TABLE `purchase` (
  `id` int UNSIGNED NOT NULL,
  `login` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `purchase`
--

INSERT INTO `purchase` (`id`, `login`) VALUES
(2, 'wildbine'),
(3, 'wildbine'),
(2, '123456789'),
(3, '123456789'),
(1, '123456789'),
(2, 'devilishgait'),
(3, 'devilishgait'),
(1, 'devilishgait'),
(2, 'supersuser'),
(3, 'supersuser'),
(1, 'supersuser'),
(4, 'supersuser');

-- --------------------------------------------------------

--
-- Структура таблицы `user_data`
--

CREATE TABLE `user_data` (
  `login` varchar(30) NOT NULL,
  `psw` varchar(256) NOT NULL,
  `email` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `user_data`
--

INSERT INTO `user_data` (`login`, `psw`, `email`) VALUES
('123456789', '9530e3153c730513a3b1f0e22eae7489', ''),
('2142141', '1af06d3b651a4d9fa253856f4cd1f1e3', ''),
('321312', 'ac070a0e5f9109f808ca1bc43deac357', ''),
('devilishgait', 'b7e39b7ce602f764045e30d328ff56cb', 'wildbine@yandex.ru'),
('qwerty123', '2893c6b4d40269198123bcd4cf6e46d6', ''),
('ssssss', 'f016d85dee8f3c93deaa55c1c3f92c5a', ''),
('supersuser', 'cc599e2d3b9f0bbec37b1be148966ac0', 'supersuser@gmail.com'),
('test2', '3f0d4216cdb745bcb05465963be4ad65', ''),
('tester01pass', 'a15c805199f67742a52990d56507caf1', ''),
('tester1', '808eb83905d3035d015ce69967c6641e', ''),
('tester11', '9088fb626a660d287f90cd86282a6db7', ''),
('varvar', '8228ae4f2eb1b296db731d3c38408031', ''),
('wildbine', 'cc599e2d3b9f0bbec37b1be148966ac0', 'wildbine@yandex.ru'),
('wxrldbine', '641246e35bdcfafd6eefe3171c5ac815', '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `app`
--
ALTER TABLE `app`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `app`
--
ALTER TABLE `app`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
