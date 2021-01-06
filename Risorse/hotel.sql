-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Creato il: Gen 06, 2021 alle 01:05
-- Versione del server: 8.0.22
-- Versione PHP: 7.2.24-0ubuntu0.18.04.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test2`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `clienti`
--

CREATE TABLE `clienti` (
  `nome` varchar(100) NOT NULL,
  `cognome` varchar(100) NOT NULL,
  `data_di_nascita` date NOT NULL,
  `codiceFiscale` varchar(100) NOT NULL,
  `luogoNascita` varchar(100) NOT NULL,
  `sesso` enum('m','f') NOT NULL,
  `numero_telefono` int DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `immagine_documento_scannerizzato` varchar(200) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Struttura della tabella `dipendenti`
--

CREATE TABLE `dipendenti` (
  `stipendio` float(10,2) NOT NULL,
  `id` int NOT NULL,
  `giorno_settimanale_festivo` enum('lunedi','martedi','mercoledi','giovedi','sabato','domenica') NOT NULL,
  `nome` varchar(100) NOT NULL,
  `data_inizio_turno` datetime NOT NULL,
  `cognome` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `data_fine_turno` datetime NOT NULL
) ;

-- --------------------------------------------------------

--
-- Struttura della tabella `piani`
--

CREATE TABLE `piani` (
  `id` int NOT NULL,
  `costo_base_stanza_24h` float(10,3) NOT NULL,
  `giorno_pulizie` enum('lunedi','martedi','mercoledi','giovedi','sabato','domenica') DEFAULT NULL
) ;

-- --------------------------------------------------------

--
-- Struttura della tabella `prenotazioni`
--

CREATE TABLE `prenotazioni` (
  `codicePrenotazione` int NOT NULL,
  `effettuataDa` varchar(100) NOT NULL,
  `codiceStanza` int NOT NULL,
  `data_inizio_prenotazione` datetime NOT NULL,
  `costo_totale_da_pagare` float(10,2) NOT NULL,
  `prenotazionePresaDa` int NOT NULL,
  `data_fine_prenotazione` datetime NOT NULL,
  `mezzo_di_pagamento` enum('carta','contanti') NOT NULL
) ;

-- --------------------------------------------------------

--
-- Struttura della tabella `stanze`
--

CREATE TABLE `stanze` (
  `codiceStanza` int NOT NULL,
  `capienza_massima` int NOT NULL,
  `piano` int NOT NULL
) ;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `clienti`
--
ALTER TABLE `clienti`
  ADD PRIMARY KEY (`codiceFiscale`);

--
-- Indici per le tabelle `dipendenti`
--
ALTER TABLE `dipendenti`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `piani`
--
ALTER TABLE `piani`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `prenotazioni`
--
ALTER TABLE `prenotazioni`
  ADD PRIMARY KEY (`codicePrenotazione`),
  ADD KEY `effettuataDa` (`effettuataDa`),
  ADD KEY `codiceStanza` (`codiceStanza`),
  ADD KEY `prenotazionePresaDa` (`prenotazionePresaDa`);

--
-- Indici per le tabelle `stanze`
--
ALTER TABLE `stanze`
  ADD PRIMARY KEY (`codiceStanza`),
  ADD KEY `piano` (`piano`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `dipendenti`
--
ALTER TABLE `dipendenti`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la tabella `piani`
--
ALTER TABLE `piani`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la tabella `prenotazioni`
--
ALTER TABLE `prenotazioni`
  MODIFY `codicePrenotazione` int NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la tabella `stanze`
--
ALTER TABLE `stanze`
  MODIFY `codiceStanza` int NOT NULL AUTO_INCREMENT;
--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `prenotazioni`
--
ALTER TABLE `prenotazioni`
  ADD CONSTRAINT `prenotazioni_ibfk_1` FOREIGN KEY (`effettuataDa`) REFERENCES `clienti` (`codiceFiscale`),
  ADD CONSTRAINT `prenotazioni_ibfk_2` FOREIGN KEY (`codiceStanza`) REFERENCES `stanze` (`codiceStanza`),
  ADD CONSTRAINT `prenotazioni_ibfk_3` FOREIGN KEY (`prenotazionePresaDa`) REFERENCES `dipendenti` (`id`);

--
-- Limiti per la tabella `stanze`
--
ALTER TABLE `stanze`
  ADD CONSTRAINT `stanze_ibfk_1` FOREIGN KEY (`piano`) REFERENCES `piani` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
