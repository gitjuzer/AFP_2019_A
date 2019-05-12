-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Gép: mysql.omega:3306
-- Létrehozás ideje: 2019. Máj 12. 22:38
-- Kiszolgáló verziója: 5.6.44-log
-- PHP verzió: 7.0.33-0+deb9u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `afp2019a`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `answer`
--

CREATE TABLE `answer` (
  `id` int(11) NOT NULL,
  `text` varchar(250) NOT NULL,
  `correct` tinyint(3) UNSIGNED DEFAULT NULL,
  `pair_id` int(11) DEFAULT NULL,
  `question` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `answer`
--

INSERT INTO `answer` (`id`, `text`, `correct`, `pair_id`, `question`) VALUES
(1, '5', 0, NULL, 2),
(2, '3', 0, NULL, 2),
(3, '4', 1, NULL, 2),
(4, '10', 1, NULL, 1),
(5, '20', 0, NULL, 1),
(6, '11', 0, NULL, 1),
(7, '6', 0, NULL, 3),
(8, '5', 1, NULL, 3),
(9, '7', 0, NULL, 3),
(13, '6', 0, NULL, 4),
(14, '4', 0, NULL, 4),
(15, '5', 1, NULL, 4),
(16, '80 km/h', 1, NULL, 5),
(17, '70 km/h', 0, NULL, 5),
(18, '90 km/h', 0, NULL, 5),
(19, '60 km/h', 0, NULL, 5),
(20, '0', 1, NULL, 6),
(21, '8', 0, NULL, 6),
(22, '12', 0, NULL, 6),
(23, '16', 0, NULL, 6),
(24, 'Háromujjú lajhár', 1, NULL, 7),
(25, 'Koala', 0, NULL, 7),
(26, 'Panda', 0, NULL, 7),
(27, 'Oroszlán', 0, NULL, 7),
(28, 'Sáskarák', 1, NULL, 8),
(29, 'Kaméleon', 0, NULL, 8),
(30, 'Hangya', 0, NULL, 8),
(31, 'Légy', 0, NULL, 8),
(32, '1', 1, NULL, 9),
(33, '2', 0, NULL, 9),
(34, '3', 0, NULL, 9),
(35, '4', 0, NULL, 9),
(36, 'Ázsia', 1, NULL, 11),
(37, 'Dél-Amerika', 0, NULL, 11),
(38, 'Afrika', 0, NULL, 11),
(39, 'Mariana-árok', 1, NULL, 10),
(40, 'Belize-i Nagy Kék Lyuk', 0, NULL, 10),
(41, 'Tonga-árok', 0, NULL, 10);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `permission`
--

CREATE TABLE `permission` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `question` varchar(250) NOT NULL,
  `test` int(11) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `question`
--

INSERT INTO `question` (`id`, `question`, `test`, `type`) VALUES
(1, '5+5=?', 1, 1),
(2, '2*2=?', 1, 1),
(3, '10-5=?', 1, 1),
(4, '25/5=?', 1, 1),
(5, 'Milyen gyorsan képes futni az oroszlán?', 2, 1),
(6, 'Hány foga van a struccnak?', 2, 1),
(7, 'Melyik a leglassabb eml?s?', 2, 1),
(8, 'Melyik állat látja a legtöbb színt?', 2, 1),
(9, 'Mennyi tojást rak le egyszerre egy császárpingvin?', 2, 1),
(10, 'Mi a föld legmélyebb pontja?', 2, 1),
(11, 'Melyik a legnagyobb kontinens?', 2, 1),
(12, 'Melyik országot választja el Spanyolországtól a Gibraltári-szoros?', 2, 1),
(13, 'Melyik városban helyezkedik el a Föld legmagasabb épülete?', 2, 1),
(14, 'Hány tó alkotja a Nagy-tavakat?', 2, 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `question_type`
--

CREATE TABLE `question_type` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `question_type`
--

INSERT INTO `question_type` (`id`, `name`) VALUES
(1, 'Felelet választós');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'User');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `role_permission`
--

CREATE TABLE `role_permission` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `score`
--

CREATE TABLE `score` (
  `id` int(11) NOT NULL,
  `score` int(10) UNSIGNED NOT NULL,
  `test_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `test`
--

INSERT INTO `test` (`id`, `name`) VALUES
(1, 'Matematika'),
(2, 'Földrajz');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `email` varchar(250) DEFAULT NULL,
  `token` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `token`) VALUES
(1, 'teszt', '1234', 'teszt@teszt', '5cb42bed7d5a5'),
(2, 'TesztElek', '57fe8e85295eb6ef13ce6943e862a36c51895759255c046d0a4346116a9a55', 'tesztelek@teszt.com', '5cc5c6000e209'),
(3, 'admin1', 'admin1', 'asd123@freemail.hu', '5cc5ef368ac3c'),
(4, 'asdfgasdgf', 'asdfgasdgf', 'asd123@freemail.hu', '5cc698e393625'),
(5, 'aaaaaa', 'aaaaaa', 'asd123@freemail.hu', '5cc6a6d6e8a3f'),
(6, 'Teszt3', '53a94765f152d4b32849a6a6a5af6635c7a1f8adcf719d085a52e365eacde8', 'tesztelek@teszt.com', '5cc6a9f208529'),
(7, 'SerPenyő', 'c2b39cd5261f79419e964a4ca3ca34f6175ccf6266841befe1eb8273b56b69f4', 'tesztelek@teszt.com', '5cc99c0a8cb45'),
(8, 'asdfasdfasdf', 'asdfasdfasdf', 'asd123@freemail.hu', '5ccf20e99367e'),
(9, 'Valami', '4fec1c7f3c269734399879fa9ee2eb5fef2558feb49e32196b84e9c6ffc8ef2e', 'valami@teszt.com', '5ccfcf65b43b0'),
(10, 'qwertzqwertz', 'qwertzqwertz', 'asd123@freemail.hu', '5ccfd17e64636'),
(11, 'asdfgasdfg', 'asdfgasdfg', 'asd123@freemail.hu', '5cd067607abaf'),
(12, 'matemate', 'matemate', 'asd123@freemail.hu', '5cd6f2a989b4e'),
(13, 'asdfgasdfgasdfg', 'asdfgasdfgasdfg', 'asdfgasdfgasdfg@gamil.com', '5cd7e631c563a'),
(14, 'asdfgasdfgasdfg', 'asdfgasdfgasdfg', 'asdfgasdfgasdfg@gamil.com', '5cd7e631c5647'),
(16, 'asdfgasdfgasdfg', 'asdfgasdfgasdfg', 'asdfgasdfgasdfg@gamil.com', '5cd7e631c58d8'),
(17, 'asdfgasdfgasdfg', 'asdfgasdfgasdfg', 'asdfgasdfgasdfg@gamil.com', '5cd7e631c58e9'),
(18, 'asdfgasdfgasdfg', 'asdfgasdfgasdfg', 'asdfgasdfgasdfg@gamil.com', '5cd7e631c58c4'),
(19, 'asdfgasdfgasdfg', 'asdfgasdfgasdfg', 'asdfgasdfgasdfg@gamil.com', '5cd7e631c58d4'),
(20, 'asdfgasdfgasdfg', 'asdfgasdfgasdfg', 'asdfgasdfgasdfg@gamil.com', '5cd7e631c563b'),
(22, 'qwerqwert', 'qwerqwert', 'qwerqwert@asdfg.hu', '5cd7e73f1b2db'),
(23, 'fghjfghjfghj', 'fghjfghjfghj', 'fghjfghjfghj@asdfg.hu', '5cd7e82baa9a4');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `user_role`
--

CREATE TABLE `user_role` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `user_role`
--

INSERT INTO `user_role` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(22, 1),
(23, 1);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_answer_question_idx` (`question`);

--
-- A tábla indexei `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_question_test_idx` (`test`),
  ADD KEY `FK_question_question_type_idx` (`type`);

--
-- A tábla indexei `question_type`
--
ALTER TABLE `question_type`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `role_permission`
--
ALTER TABLE `role_permission`
  ADD PRIMARY KEY (`role_id`,`permission_id`),
  ADD KEY `FK_role_permission_permission_idx` (`permission_id`);

--
-- A tábla indexei `score`
--
ALTER TABLE `score`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_score_user_idx` (`user_id`),
  ADD KEY `FK_score_test_idx` (`test_id`);

--
-- A tábla indexei `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token_UNIQUE` (`token`);

--
-- A tábla indexei `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `FK_user_role_role_idx` (`role_id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `answer`
--
ALTER TABLE `answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT a táblához `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT a táblához `question_type`
--
ALTER TABLE `question_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT a táblához `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT a táblához `score`
--
ALTER TABLE `score`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `answer`
--
ALTER TABLE `answer`
  ADD CONSTRAINT `FK_answer_question` FOREIGN KEY (`question`) REFERENCES `question` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Megkötések a táblához `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `FK_question_question_type` FOREIGN KEY (`type`) REFERENCES `question_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_question_test` FOREIGN KEY (`test`) REFERENCES `test` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Megkötések a táblához `role_permission`
--
ALTER TABLE `role_permission`
  ADD CONSTRAINT `FK_role_permission_permission` FOREIGN KEY (`permission_id`) REFERENCES `permission` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_role_permission_role` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Megkötések a táblához `score`
--
ALTER TABLE `score`
  ADD CONSTRAINT `FK_score_test` FOREIGN KEY (`test_id`) REFERENCES `test` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_score_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Megkötések a táblához `user_role`
--
ALTER TABLE `user_role`
  ADD CONSTRAINT `FK_user_role_role` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_user_role_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
