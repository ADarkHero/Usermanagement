-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 12. Jan 2017 um 14:31
-- Server-Version: 10.1.19-MariaDB
-- PHP-Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `project`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `role`
--

CREATE TABLE `role` (
  `RoleID` char(32) NOT NULL,
  `RoleName` text NOT NULL,
  `RoleCreate` int(11) NOT NULL,
  `RoleEdit` int(11) NOT NULL,
  `RoleDelete` int(11) NOT NULL,
  `RoleExport` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `role`
--

INSERT INTO `role` (`RoleID`, `RoleName`, `RoleCreate`, `RoleEdit`, `RoleDelete`, `RoleExport`) VALUES
('9f4021d44dc03680203509b019614f42', 'Administrator', 1, 1, 1, 1),
('b54687f1bed18621cc54d136801a3248', 'User', 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `UserName` text NOT NULL,
  `UserFirstName` text NOT NULL,
  `UserLastName` text NOT NULL,
  `UserMail` text NOT NULL,
  `UserTelephone` text NOT NULL,
  `UserPassword` text NOT NULL,
  `UserRole` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`UserID`, `UserName`, `UserFirstName`, `UserLastName`, `UserMail`, `UserTelephone`, `UserPassword`, `UserRole`) VALUES
(1, 'admin', 'Maik', 'Riedlsperger', 'maik.riedlsperger@gmail.com', '-', '21232f297a57a5a743894a0e4a801fc3', '9f4021d44dc03680203509b019614f42'),
(3, 'user', 'Max', 'Mustermann', 'max.mustermann@muster.mu', '01101010001', 'c96dd568316deb9d8c7dec73b4c27cbb', 'b54687f1bed18621cc54d136801a3248'),
(5, 'heisenberg', 'Walter', 'White', '-', '-', 'f1290186a5d0b1ceab27f4e77c0c5d68', 'b54687f1bed18621cc54d136801a3248'),
(6, 'mario', 'Mario', 'Mario', 'mario@mario.ma', '0188999', '6f8f57715090da2632453988d9a1501b', 'b54687f1bed18621cc54d136801a3248'),
(7, 'luigi', 'Luigi', 'Mario', 'luigi@mario.ma', '881999', '912ec803b2ce49e4a541068d495ab570', 'b54687f1bed18621cc54d136801a3248'),
(8, 'ituser42', 'Max', '42', 'max42@web.de', '1197253', '6a204bd89f3c8348afd5c77c717a097a', 'b54687f1bed18621cc54d136801a3248'),
(9, 'stuniverse', 'Steven', 'Universe', 'steven@universe.edu', '0481221481', '6ed61d4b80bb0f81937b32418e98adca', 'b54687f1bed18621cc54d136801a3248'),
(10, 'elliot', 'Mr.', 'Robot', 'mr@robot.com', '1234567890', 'e807f1fcf82d132f9bb018ca6738a19f', 'b54687f1bed18621cc54d136801a3248'),
(11, 'boing', 'Mr.', 'Saturn', 'saturn@earthbound.com', '101', 'd027eb0ee23c9fcaa2b9ce4f221c5a77', 'b54687f1bed18621cc54d136801a3248');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`RoleID`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
