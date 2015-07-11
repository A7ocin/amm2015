-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generato il: Mag 04, 2014 alle 16:39
-- Versione del server: 5.5.35
-- Versione PHP: 5.4.6-1ubuntu1.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `esammi`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `appelli`
--

CREATE TABLE IF NOT EXISTS `appelli` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `data` datetime DEFAULT NULL,
  `insegnamento_id` bigint(20) unsigned DEFAULT NULL,
  `capienza` int(11) DEFAULT NULL,
  UNIQUE KEY `id` (`id`),
  KEY `insegnamento_fk` (`insegnamento_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dump dei dati per la tabella `appelli`
--

INSERT INTO `appelli` (`id`, `data`, `insegnamento_id`, `capienza`) VALUES
(1, '2014-06-17 00:00:00', 3, 4),
(2, '2014-06-13 00:00:00', 2, 4),
(4, '2014-07-04 00:00:00', 4, 6);

-- --------------------------------------------------------

--
-- Struttura della tabella `appelli_studenti`
--

CREATE TABLE IF NOT EXISTS `appelli_studenti` (
  `appello_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `studente_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`appello_id`,`studente_id`),
  KEY `studente_fk` (`studente_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `appelli_studenti`
--

INSERT INTO `appelli_studenti` (`appello_id`, `studente_id`) VALUES
(1, 1),
(2, 1),
(1, 2),
(2, 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `CdL`
--

CREATE TABLE IF NOT EXISTS `CdL` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(128) DEFAULT NULL,
  `codice` varchar(128) DEFAULT NULL,
  `dipartimento_id` bigint(20) unsigned DEFAULT NULL,
  UNIQUE KEY `id` (`id`),
  KEY `dipartimento_fk` (`dipartimento_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dump dei dati per la tabella `CdL`
--

INSERT INTO `CdL` (`id`, `nome`, `codice`, `dipartimento_id`) VALUES
(1, 'Informatica', 'INF', 1),
(2, 'Matematica', 'MAT', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `dipartimenti`
--

CREATE TABLE IF NOT EXISTS `dipartimenti` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(128) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dump dei dati per la tabella `dipartimenti`
--

INSERT INTO `dipartimenti` (`id`, `nome`) VALUES
(1, 'Matematica e Informatica'),
(2, 'Ingegneria'),
(3, 'Architettura'),
(4, 'Lettere');

-- --------------------------------------------------------

--
-- Struttura della tabella `docenti`
--

CREATE TABLE IF NOT EXISTS `docenti` (
  `username` varchar(128) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `nome` varchar(128) DEFAULT NULL,
  `cognome` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `numero_civico` int(11) DEFAULT NULL,
  `citta` varchar(128) DEFAULT NULL,
  `provincia` varchar(128) DEFAULT NULL,
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ricevimento` varchar(255) DEFAULT NULL,
  `dipartimento_id` bigint(20) unsigned DEFAULT NULL,
  `cap` varchar(5) DEFAULT NULL,
  `via` varchar(128) DEFAULT NULL,
  UNIQUE KEY `id` (`id`),
  KEY `dipartimenti_fk` (`dipartimento_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dump dei dati per la tabella `docenti`
--

INSERT INTO `docenti` (`username`, `password`, `nome`, `cognome`, `email`, `numero_civico`, `citta`, `provincia`, `id`, `ricevimento`, `dipartimento_id`, `cap`, `via`) VALUES
('riccardo', 'scateni', 'Riccardo', 'Scateni', 'riccardo@unica.it', 20, 'Cagliari', 'Cagliari', 1, 'lunedi alle 9.00', 1, '09124', 'via di li'),
('gianni', 'fenu', 'Gianni', 'Fenu', 'fenu@unica.it', 30, 'Cagliari', 'Cagliari', 2, 'mercoledi alle 11.00', 1, '09124', 'via di li'),
('docente', 'spano', 'Davide', 'Spano', 'davide.spano@unica.it', 19, 'Cagliari', 'Cagliari', 3, 'giovedi alle 11.00', 1, '09124', 'via di li');

-- --------------------------------------------------------

--
-- Struttura della tabella `esami`
--

CREATE TABLE IF NOT EXISTS `esami` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `studente_id` bigint(20) unsigned DEFAULT NULL,
  `voto` int(11) DEFAULT NULL,
  `insegnamento_id` bigint(20) unsigned DEFAULT NULL,
  `data` datetime DEFAULT NULL,
  UNIQUE KEY `id` (`id`),
  KEY `studenti_fk` (`studente_id`),
  KEY `insegnamento_fk` (`insegnamento_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dump dei dati per la tabella `esami`
--

INSERT INTO `esami` (`id`, `studente_id`, `voto`, `insegnamento_id`, `data`) VALUES
(1, 2, 24, 3, '2014-01-31 00:00:00'),
(2, 2, 25, 4, '2014-01-16 00:00:00'),
(3, 1, 27, 3, '2014-01-31 00:00:00'),
(4, 1, 28, 4, '2014-01-16 00:00:00'),
(8, 1, 19, 4, '2014-05-04 00:00:00'),
(9, 2, 20, 4, '2014-05-04 00:00:00'),
(10, 1, 19, 4, '2014-05-04 00:00:00'),
(11, 2, 20, 4, '2014-05-04 00:00:00'),
(12, 1, 19, 4, '2014-05-04 00:00:00'),
(13, 2, 20, 4, '2014-05-04 00:00:00'),
(14, 1, 19, 4, '2014-05-04 00:00:00'),
(15, 2, 20, 4, '2014-05-04 00:00:00'),
(16, 1, 19, 4, '2014-05-04 00:00:00'),
(17, 2, 20, 4, '2014-05-04 00:00:00'),
(18, 1, 28, 4, '2014-05-04 00:00:00'),
(19, 1, 30, 4, '2014-05-04 00:00:00'),
(20, 1, 31, 3, '2014-05-04 00:00:00'),
(21, 1, 24, 3, '2014-05-04 00:00:00'),
(22, 2, 18, 4, '2014-05-04 00:00:00');

-- --------------------------------------------------------

--
-- Struttura della tabella `esami_docenti`
--

CREATE TABLE IF NOT EXISTS `esami_docenti` (
  `esame_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `docente_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`esame_id`,`docente_id`),
  KEY `docenti_fk` (`docente_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `esami_docenti`
--

INSERT INTO `esami_docenti` (`esame_id`, `docente_id`) VALUES
(4, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(16, 2),
(17, 2),
(18, 2),
(19, 2),
(20, 2),
(21, 2),
(22, 2),
(1, 3),
(2, 3),
(3, 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `insegnamenti`
--

CREATE TABLE IF NOT EXISTS `insegnamenti` (
  `docente_id` bigint(20) unsigned DEFAULT NULL,
  `cdl_id` bigint(20) unsigned DEFAULT NULL,
  `titolo` varchar(128) DEFAULT NULL,
  `codice` varchar(128) DEFAULT NULL,
  `cfu` int(11) DEFAULT NULL,
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  UNIQUE KEY `id` (`id`),
  KEY `docenti_fk` (`docente_id`),
  KEY `cdl_fk` (`cdl_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dump dei dati per la tabella `insegnamenti`
--

INSERT INTO `insegnamenti` (`docente_id`, `cdl_id`, `titolo`, `codice`, `cfu`, `id`) VALUES
(1, 1, 'Programmazione 1', 'PR1', 9, 1),
(2, 1, 'Reti di Calcolatori', 'RC', 6, 2),
(3, 1, 'Amministrazione di Sistema', 'AMM', 6, 3),
(3, 1, 'Iterazione Uomo Macchina', 'IUM', 6, 4);

-- --------------------------------------------------------

--
-- Struttura della tabella `studenti`
--

CREATE TABLE IF NOT EXISTS `studenti` (
  `username` varchar(128) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `nome` varchar(128) DEFAULT NULL,
  `cognome` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `numero_civico` int(11) DEFAULT NULL,
  `citta` varchar(128) DEFAULT NULL,
  `provincia` varchar(128) DEFAULT NULL,
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cdl_id` bigint(20) unsigned DEFAULT NULL,
  `matricola` int(11) DEFAULT NULL,
  `cap` varchar(5) DEFAULT NULL,
  `via` varchar(128) DEFAULT NULL,
  UNIQUE KEY `id` (`id`),
  KEY `cdl_fk` (`cdl_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dump dei dati per la tabella `studenti`
--

INSERT INTO `studenti` (`username`, `password`, `nome`, `cognome`, `email`, `numero_civico`, `citta`, `provincia`, `id`, `cdl_id`, `matricola`, `cap`, `via`) VALUES
('studente', 'spano', 'Davide', 'Spano', 'davide.spano@unica.com', 13, 'Cagliari', 'Cagliari', 1, 1, 253662, '09124', 'via di la'),
('pinco', 'pallino', 'Pinco', 'Pallino', 'pinco.pallino@unica.it', 12, 'Cagliari', 'Cagliari', 2, 2, 657890, '09124', 'via di li');

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `appelli`
--
ALTER TABLE `appelli`
  ADD CONSTRAINT `appelli_ibfk_1` FOREIGN KEY (`insegnamento_id`) REFERENCES `insegnamenti` (`id`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `appelli_studenti`
--
ALTER TABLE `appelli_studenti`
  ADD CONSTRAINT `appelli_studenti_ibfk_2` FOREIGN KEY (`studente_id`) REFERENCES `studenti` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `appelli_studenti_ibfk_1` FOREIGN KEY (`appello_id`) REFERENCES `appelli` (`id`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `CdL`
--
ALTER TABLE `CdL`
  ADD CONSTRAINT `CdL_ibfk_1` FOREIGN KEY (`dipartimento_id`) REFERENCES `dipartimenti` (`id`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `docenti`
--
ALTER TABLE `docenti`
  ADD CONSTRAINT `docenti_ibfk_1` FOREIGN KEY (`dipartimento_id`) REFERENCES `dipartimenti` (`id`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `esami`
--
ALTER TABLE `esami`
  ADD CONSTRAINT `esami_ibfk_2` FOREIGN KEY (`insegnamento_id`) REFERENCES `insegnamenti` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `esami_ibfk_1` FOREIGN KEY (`studente_id`) REFERENCES `studenti` (`id`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `esami_docenti`
--
ALTER TABLE `esami_docenti`
  ADD CONSTRAINT `esami_docenti_ibfk_2` FOREIGN KEY (`docente_id`) REFERENCES `docenti` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `esami_docenti_ibfk_1` FOREIGN KEY (`esame_id`) REFERENCES `esami` (`id`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `insegnamenti`
--
ALTER TABLE `insegnamenti`
  ADD CONSTRAINT `insegnamenti_ibfk_2` FOREIGN KEY (`cdl_id`) REFERENCES `CdL` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `insegnamenti_ibfk_1` FOREIGN KEY (`docente_id`) REFERENCES `docenti` (`id`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `studenti`
--
ALTER TABLE `studenti`
  ADD CONSTRAINT `studenti_ibfk_1` FOREIGN KEY (`cdl_id`) REFERENCES `CdL` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
