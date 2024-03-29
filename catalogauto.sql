-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 04 2022 г., 23:52
-- Версия сервера: 8.0.24
-- Версия PHP: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `catalogauto`
--

-- --------------------------------------------------------

--
-- Структура таблицы `automobile`
--

CREATE TABLE `automobile` (
  `id` int NOT NULL,
  `full_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` int NOT NULL,
  `year` bigint NOT NULL,
  `id_brand` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `img_preview` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` tinyint NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `on_top` tinyint DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `automobile`
--

INSERT INTO `automobile` (`id`, `full_name`, `price`, `year`, `id_brand`, `img_preview`, `status`, `created_date`, `on_top`) VALUES
(5, 'Mercedes-Benz S580 4MATIC W223', 15900000, 2021, '637b4199ef3f2', '1669022383_1668957924_car-mers-catalog.jpg', 1, '2022-11-21 09:19:43', 0),
(6, 'Jaguar F-Type 3.0 S/C F-Type British Design Edition AWD Coupe 2016', 7960000, 2016, '637b47eea1e19', '1669023770_1668943529_car-admin.jpg', 1, '2022-11-21 09:42:50', 0),
(7, 'AUDI A7 рестайлинг 2.0 TFSI quattro S tronic', 3000000, 2012, '638cfd0d8fd11', '1670184284_img_prev_audi.jpg', 1, '2022-12-04 20:04:44', 0),
(8, 'BMW G11 750d xDrive', 2670000, 2018, '638cfcdd79a34', '1670184345_img_prev.jpg', 1, '2022-12-04 20:05:45', 0),
(9, 'HUMMER H2 I Рестайлинг', 5000000, 2005, '638cfcfacec52', '1670184409_img_prev.jpg', 1, '2022-12-04 20:06:49', 0),
(10, 'HUMMER H1 I Рестайлинг', 3200000, 2005, '-1', '', 0, '2022-12-04 20:07:17', 0),
(11, 'Audi q5', 2200000, 2014, '638cfd0d8fd11', '1670184595_img_prev_audi.jpg', 1, '2022-12-04 20:09:55', 0),
(12, 'HUMMER M1', 6000000, 2020, '638cfcfacec52', '1670184681_img_prev.jpg', 1, '2022-12-04 20:11:21', 0),
(13, 'Mercedes-Benz E 200 W238', 7000000, 2022, '637b4199ef3f2', '1670184752_1668957924_mers-5.jpg', 1, '2022-12-04 20:12:32', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `auto_comments`
--

CREATE TABLE `auto_comments` (
  `id` int NOT NULL,
  `id_auto` int NOT NULL,
  `id_user` int NOT NULL,
  `review_positiv_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `review_negative_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `score_scope` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `auto_comments`
--

INSERT INTO `auto_comments` (`id`, `id_auto`, `id_user`, `review_positiv_text`, `review_negative_text`, `score_scope`) VALUES
(2, 5, 1, 'gfdsg', 'gsfdd', 1),
(7, 5, 5, 'gfdsg', 'gsdfg', 1),
(8, 5, 5, 'gfdsgdg', 'sdgdg', 1),
(9, 5, 4, 'fdasfsadsf gfds g gf sgfd', 'fadsfsfffdfs fsda gg', 1),
(10, 5, 5, 'fdgfsd gfds gdfs fds dgf sd', 'gsfd g gsdf gd gsdg dg dg sdg', 3),
(15, 6, 4, 'Тестовый коммент', 'Тестовый коммент', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `brand`
--

CREATE TABLE `brand` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `brand`
--

INSERT INTO `brand` (`id`, `name`, `country`) VALUES
('637b4199ef3f2', 'Mercedes-Benz', 'Europe'),
('637b47eea1e19', 'Jaguar', 'Europe'),
('638cfcdd79a34', 'BMW', 'Europe'),
('638cfcfacec52', 'HUMMER', 'America'),
('638cfd0d8fd11', 'AUDI', 'Europe');

-- --------------------------------------------------------

--
-- Структура таблицы `cart_order`
--

CREATE TABLE `cart_order` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_status` int NOT NULL,
  `telephone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_auto` int NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status_cancel` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `cart_order`
--

INSERT INTO `cart_order` (`id`, `id_user`, `username`, `id_status`, `telephone`, `address`, `id_auto`, `created_date`, `status_cancel`) VALUES
(2, 4, 'fdsfdsaf', 4, '54354354335', 'gfdsf dfsg gds gsdg d', 6, '2022-11-25 20:38:37', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `cart_status`
--

CREATE TABLE `cart_status` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `cart_status`
--

INSERT INTO `cart_status` (`id`, `name`, `description`) VALUES
(1, 'В работе', NULL),
(2, 'Доставляется', NULL),
(3, 'Доставлено', NULL),
(4, 'Отменена', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `specifications`
--

CREATE TABLE `specifications` (
  `id` int NOT NULL,
  `engine_power` int DEFAULT NULL,
  `engine` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `privod` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `id_auto` int NOT NULL,
  `transmission` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `specifications`
--

INSERT INTO `specifications` (`id`, `engine_power`, `engine`, `privod`, `description`, `id_auto`, `transmission`) VALUES
(4, 380, 'Бензин-турбо', 'Полный', 'Цвет: чёрный обсидиан металлик Салон: натуральная кожа \"Эксклюзив\"- бежевая ⠀ Комплектация: светодиодная система освещения, адаптивный ассистент дальнего света плюс, спортивный пакет AMG, DISTRONIC PLUS, проекционный дисплей мультимедийной системы MBUX с использованием технологии дополненной реальности, видеосистема с дополненной реальностью, мультиконтурные передние и задние сидения с функцией массажа, вентиляции, подогрева и памяти, сиденье с функцией спального места, панорама, камеры кругового обзора, ассистент распознавания дорожных знаков, 4-х зонный климат-контроль, keyless-go, акустическая система Burmester®️ 4D класса High End, суперспортивное рулевое колесо с кожаной отделкой глубокого тиснения с подогревом, magic vision control c обогревом, доводчики, ТВ-тюнер, элементы декоративной отделки из древесины ореха с алюминием, ветровое стекло с электрообогревом, расширенная отделка деревом, расширенная подсветка салона Ambient lighting, пакет \"личный водитель\", пакет Эксклюзив, комфорт-пакет задних сиден', 5, 'Автоматическая'),
(5, 380, 'Бензин-турбо', 'Полный', 'Цвет: Ultra Blue Салон: Кожаная отделка черного цвета премиум класса с контрастной прошивкой Reims Blue ⠀ Комплектация: Design Edition, биксеноновые фары, система адаптивного освещения дороги, 2-х зонный климат-контроль, 14-позиционная регулировка передних сидений с электроприводом и подогревом, наружние зеркала с памятью настроек, подогревом, складыванием, лобовое стекло с подогревом, система бесключевого доступа, 5\" цветной TFT дисплей на приборной панели, система мониторинга слепых зон, многофункциональное рулевое колесо с подогревом, передние и задние парктроники, включая камеру заднего вида, переключатель режимов движения, переключатель заслонки выхлопной системы, конфигурируемая комфортная подсветка салона, фиксированная панорамная крыша, фиксированный задний спойлер, передняя панель в стиле «R», отделанная кожей премиум-класса, кожаная дверная отделочная панель премиум-класса, аудиосистема премиум-класса Meridian , 20\" легкосплавные диски Cyclone и многое другое.  Дополнительно: автомобиль полностью заклеен в защитную пленку, шумоизоляция салона, охранная система.  Два комплекта резины зима / лето ⠀ Обслуживание у Официального дилера. Пройдена диагностика в lrbro_ru', 6, 'Автоматическая'),
(6, 250, 'Бензин', 'Полный', 'В продаже AUDI A7 рестайлинг 2.0 TFSI quattro S tronic 2017 года ‼️  - 4-х цилиндровый рядный турбированный бензиновый двигатель 2.0 (CYP), 7-ст РКПП DSG7 (DL501), полный привод - 249л.с. 370 *м, 6.5 сек до 100 км/ч - выпуск – март 2017 год - пробег - 69.533 км - 2 владельца, оригинал ПТС ⠀ Цвет: Белый металлик (Glacier white) Салон: комбинированная обивка сидений материалом Alcantara/кожей, с оттиском S line на спинках передних сидений, черный black/silver ⠀ Комплектация: внешний и внутренний s-line, Keyless-Entry без функции Safelock, светодиодные фары Audi Matrix, активный дальний свет, акустически комфортное остекление, навигация, камера заднего вида, наружные зеркала заднего вида с электрорегулировкой и функцией складывания, электрическая регулировка передних сидений: включая опору поясничного отдела в спинках передних сидений с электрической регулировкой (Ergomatic), обогрев передних сидений, функция запоминания параметров сиденья водителя, рулевая колонка с электрической регулировкой по вылету и углу наклона, многофункциональный руль подогревом и функцией переключения передач, 4-х зонный климат-контроль, люк, акустическая система BOSE Surround Sound, круиз-контроль, спортивные передние сиденья, 20\" легкосплавные диски, внешний черный стайлинг и многое другое.  Кузов в родной краске!  Резина зима / лето  ⠀  Обслуживание у Официального дилера и в профильном сервисе. Пройдена диагностика в audi_quattro_ru  Возможна покупка автомобиля в кредит!', 7, 'Автоматическая'),
(7, 300, 'Бензин', 'Полный', '- дизельный двигатель 3.0 (B57D30S0), 8-ст АКПП (8HP75 ZF), полный̆ привод xDrive - 400 л.с. 760 H*м, 4.6 сек до 100 км/ч - выпуск – март 2017 - пробег 49.257 км - 2 владельца, электронный ПТС. ⠀ Цвет: CARBONSCHWARZ METALLIC Салон: кожа Nappa Erweitert/zagora-beige - NAFZ ⠀ Комплектация: пневмоподвеска передней и задней оси, адаптивные светодиодные фары, 4-х зонный климат-контроль, система управления жестами BMW, аудиосистема Harman / Kardon Surround Sound, спортивное кожаное рулевое колесо, спортивные тормоза M, комфортный доступ, доводчики, расширенная отделка кожей, аэродинамический М пакет, M Sportpaket Inkl.int.design Pure Exc., Climate Comfort Laminated Glass (двойные стекла), лобовое стекло Klimakomfort, камеры кругового обзора 360, BMW ключ с дисплеем, люк электрорегулируемый с прозрачной крышкой, передние сидения повышенного комфорта с вентиляцией и памятью, задние сидения с обогревом, расширенная отделка кожей, пакет Ambient Air, парковочный помощник, парковка с дистанционным управлением, навигация Professional, проекция, отделка кожей приборной панели, потолок Alcantara, Shadow-Line с зеркальным блеском, connected Drive Services Paket, беспроводная зарядка, электропривод крышки багажника, диски 20” двойные спицы 648 стиль, пакет освещения, система управления дальним светом и многое другое. ⠀ Обслуживание у официального дилера и в профильном сервисе.  Пройдена диагностика в @highperformancecentre ⠀ Кузов в родной краске!  Передняя часть и зоны риска оклеены бронепленкой. ⠀ Автомобиль находится на крытой освещенной парковке AutoLab по адресу: г. Москва, ул. Киевская, д.8 (метро Киевская) ⠀ Для дополнительной информации по автомобилю +7-985-770-60-01 (есть мессенджеры) ⠀ Возможна покупка автомобиля в кредит!', 8, 'Автоматическая'),
(8, 280, 'Бензин', 'Полный', 'Это крутая тачка ((', 10, 'Автоматическая'),
(9, 200, 'Бензин', 'Передний', 'Тачка на каждый день', 11, 'Автоматическая'),
(10, 300, 'Бензин', 'Задний', 'Тачка для понтов', 12, 'Ручная'),
(11, 340, 'Бензин', 'Задний', 'Тачка для бизнеса', 13, 'Ручная');

-- --------------------------------------------------------

--
-- Структура таблицы `upload_table`
--

CREATE TABLE `upload_table` (
  `id` int NOT NULL,
  `id_auto` int NOT NULL,
  `img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `video` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `upload_table`
--

INSERT INTO `upload_table` (`id`, `id_auto`, `img`, `video`) VALUES
(6, 5, '1669022383_1668957924_mers-1.jpg', NULL),
(7, 5, '1669022383_1668957924_mers-2.jpg', NULL),
(8, 5, '1669022383_1668957924_mers-3.jpg', NULL),
(9, 5, '1669022383_1668957924_mers-4.jpg', NULL),
(10, 5, '1669022383_1668957924_mers-5.jpg', NULL),
(11, 6, '1669023770_1668943529_1.jpg', NULL),
(12, 6, '1669023770_1668943529_2.jpg', NULL),
(13, 6, '1669023770_1668943529_3.jpg', NULL),
(14, 6, '1669023770_1668943529_4.jpg', NULL),
(15, 7, '1670184284_1.jpg', NULL),
(16, 7, '1670184284_2.jpg', NULL),
(17, 7, '1670184284_3.jpg', NULL),
(18, 7, '1670184284_4.jpg', NULL),
(19, 7, '1670184284_5.jpg', NULL),
(20, 8, '1670184345_1.jpg', NULL),
(21, 8, '1670184345_2.jpg', NULL),
(22, 8, '1670184345_3.jpg', NULL),
(23, 8, '1670184345_4.jpg', NULL),
(24, 8, '1670184345_5.jpg', NULL),
(25, 8, '1670184345_6.jpg', NULL),
(31, 10, '1670184462_', NULL),
(32, 11, '1670184595_1.jpg', NULL),
(33, 11, '1670184595_2.jpg', NULL),
(34, 11, '1670184595_3.jpg', NULL),
(35, 12, '1670184681_1.jpg', NULL),
(36, 12, '1670184681_2.jpg', NULL),
(37, 12, '1670184681_3.jpg', NULL),
(38, 13, '1670184752_1668957924_car-mers-catalog.jpg', NULL),
(39, 13, '1670184752_1668957924_mers-1.jpg', NULL),
(40, 13, '1670184752_1668957924_mers-2.jpg', NULL),
(41, 13, '1670184752_1668957924_mers-3.jpg', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `login` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `admin` tinyint NOT NULL DEFAULT '0',
  `change_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `email`, `password`, `created_date`, `admin`, `change_key`) VALUES
(4, 'admin', 'admin@mail.ru', '$2y$10$awP00.WJZBrhgo/udkAh1uf9eTnr2tDvsK5FC4LYdXcN2aDGceb9e', '2022-11-21 09:33:08', 1, NULL),
(5, 'test-man', 'test-man@mail.ru', '$2y$10$vpuYpQNjFMnOHhOvJ6HSr.37ht3cEiVZa23Z/CRwQVeq5FoK0lNx6', '2022-11-21 09:37:32', 0, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `automobile`
--
ALTER TABLE `automobile`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `auto_comments`
--
ALTER TABLE `auto_comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `cart_order`
--
ALTER TABLE `cart_order`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `cart_status`
--
ALTER TABLE `cart_status`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `specifications`
--
ALTER TABLE `specifications`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `upload_table`
--
ALTER TABLE `upload_table`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `automobile`
--
ALTER TABLE `automobile`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `auto_comments`
--
ALTER TABLE `auto_comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `cart_order`
--
ALTER TABLE `cart_order`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `cart_status`
--
ALTER TABLE `cart_status`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `specifications`
--
ALTER TABLE `specifications`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `upload_table`
--
ALTER TABLE `upload_table`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
