CREATE TABLE IF NOT EXISTS `awards` (
  `awardId` int(11) NOT NULL AUTO_INCREMENT,
  `season` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `award` varchar(200) NOT NULL,
  `playerId` int(11) NOT NULL,
  `teamId` int(11) NOT NULL,
  PRIMARY KEY (`awardId`),
  UNIQUE KEY `awardId` (`awardId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

CREATE TABLE IF NOT EXISTS `draftpick` (
  `draftPickId` int(11) NOT NULL AUTO_INCREMENT,
  `year` int(11) NOT NULL,
  `round` int(11) NOT NULL,
  `choiceNumber` int(11) NOT NULL,
  `playerId` int(11) NOT NULL,
  `originalOwnerTeamId` int(11) NOT NULL,
  `currentOwnerTeamId` int(11) NOT NULL,
  PRIMARY KEY (`draftPickId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1639 ;

CREATE TABLE IF NOT EXISTS `game` (
  `gameId` int(11) NOT NULL AUTO_INCREMENT,
  `season` int(11) NOT NULL,
  `date` date NOT NULL,
  `homeTeamId` int(11) NOT NULL,
  `visitorTeamId` int(11) NOT NULL,
  `homeTeamScore` int(11) NOT NULL,
  `visitorTeamScore` int(11) NOT NULL,
  `overtime` int(11) NOT NULL,
  `winnerId` int(11) NOT NULL,
  `loserId` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`gameId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1231 ;

CREATE TABLE IF NOT EXISTS `injury` (
  `injuryId` int(11) NOT NULL AUTO_INCREMENT,
  `playerId` int(11) NOT NULL,
  `injuryDate` date NOT NULL,
  `recoveryDate` date NOT NULL,
  `injurySeverity` varchar(25) NOT NULL,
  PRIMARY KEY (`injuryId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

CREATE TABLE IF NOT EXISTS `nbacurrentdate` (
  `nbaDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `person` (
  `personId` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(25) NOT NULL,
  `name` varchar(25) NOT NULL,
  `birthdate` date NOT NULL,
  `nationality` varchar(25) NOT NULL,
  `formation` varchar(25) NOT NULL,
  `height` float NOT NULL,
  `weight` int(11) NOT NULL,
  PRIMARY KEY (`personId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=918 ;

CREATE TABLE IF NOT EXISTS `player` (
  `playerId` int(11) NOT NULL AUTO_INCREMENT,
  `personId` int(11) NOT NULL,
  `teamId` int(11) NOT NULL,
  `position` varchar(2) NOT NULL,
  `salary` float NOT NULL,
  `guarantedYear` int(11) NOT NULL,
  `optionalYear` int(11) NOT NULL,
  `contractType` varchar(6) NOT NULL,
  `experience` int(11) NOT NULL,
  `draftPromotion` int(11) NOT NULL,
  `draftPosition` int(11) NOT NULL,
  PRIMARY KEY (`playerId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=809 ;

CREATE TABLE IF NOT EXISTS `prospect` (
  `prospectId` int(11) NOT NULL AUTO_INCREMENT,
  `personId` int(11) NOT NULL,
  `position` varchar(2) NOT NULL,
  `ranking` int(11) NOT NULL,
  `predictedDraftYear` int(11) NOT NULL,
  `actualDraftYear` int(11) NOT NULL,
  `cursusType` varchar(25) NOT NULL,
  PRIMARY KEY (`prospectId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=216 ;

CREATE TABLE IF NOT EXISTS `rookiecontract` (
  `pick` int(11) NOT NULL AUTO_INCREMENT,
  `salary` float NOT NULL,
  `guarantedYear` int(11) NOT NULL,
  `optionalYear` int(11) NOT NULL,
  `contractType` varchar(25) NOT NULL,
  PRIMARY KEY (`pick`),
  UNIQUE KEY `pick` (`pick`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;

CREATE TABLE IF NOT EXISTS `season` (
  `year` int(11) NOT NULL AUTO_INCREMENT,
  `champion` int(11) NOT NULL,
  `finalist` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `startDate` date NOT NULL,
  `stopDate` date NOT NULL,
  `tradeLimitDate` date NOT NULL,
  `signatureLimitDate` date NOT NULL,
  `restrictedFreeAgentOptionDate` date NOT NULL,
  `allStarDate` date NOT NULL,
  `regularSeasonAwardsDate` date NOT NULL,
  `draftDate` date NOT NULL,
  `maxPlayersInTeam` int(11) NOT NULL,
  `salaryCap` int(11) NOT NULL,
  `contractMax` int(11) NOT NULL,
  PRIMARY KEY (`year`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2055 ;

CREATE TABLE IF NOT EXISTS `signature` (
  `signatureId` int(11) NOT NULL AUTO_INCREMENT,
  `transactionId` int(11) NOT NULL,
  `teamId` int(11) NOT NULL,
  `personId` int(11) NOT NULL,
  `salary` double NOT NULL,
  `guarantedYear` int(11) NOT NULL,
  `optionalYear` int(11) NOT NULL,
  `contractType` varchar(25) NOT NULL,
  PRIMARY KEY (`signatureId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=139 ;

CREATE TABLE IF NOT EXISTS `statplayer` (
  `statsId` int(11) NOT NULL AUTO_INCREMENT,
  `playerId` int(11) NOT NULL,
  `season` int(11) NOT NULL,
  `teamId` int(11) NOT NULL,
  `games` int(11) NOT NULL,
  `minutes` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `freeThrowsMade` int(11) NOT NULL,
  `freeThrowsAttempt` int(11) NOT NULL,
  `twoPointsMade` int(11) NOT NULL,
  `twoPointsAttempt` int(11) NOT NULL,
  `threePointsMade` int(11) NOT NULL,
  `threePointsAttempt` int(11) NOT NULL,
  `offensiveRebounds` int(11) NOT NULL,
  `defensiveRebounds` int(11) NOT NULL,
  `rebounds` int(11) NOT NULL,
  `assists` int(11) NOT NULL,
  `turnovers` int(11) NOT NULL,
  `steals` int(11) NOT NULL,
  `blocks` int(11) NOT NULL,
  `evaluation` int(11) NOT NULL,
  PRIMARY KEY (`statsId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3114 ;

CREATE TABLE IF NOT EXISTS `statsgame` (
  `statsId` int(11) NOT NULL AUTO_INCREMENT,
  `playerId` int(11) NOT NULL,
  `playerTeamId` int(11) NOT NULL,
  `season` int(11) NOT NULL,
  `gameId` int(11) NOT NULL,
  `minutes` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `freeThrowsMade` int(11) NOT NULL,
  `freeThrowsAttempt` int(11) NOT NULL,
  `twoPointsMade` int(11) NOT NULL,
  `twoPointsAttempt` int(11) NOT NULL,
  `threePointsMade` int(11) NOT NULL,
  `threePointsAttempt` int(11) NOT NULL,
  `offensiveRebounds` int(11) NOT NULL,
  `defensiveRebounds` int(11) NOT NULL,
  `rebounds` int(11) NOT NULL,
  `assists` int(11) NOT NULL,
  `turnovers` int(11) NOT NULL,
  `steals` int(11) NOT NULL,
  `blocks` int(11) NOT NULL,
  `evaluation` int(11) NOT NULL,
  PRIMARY KEY (`statsId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9325 ;

CREATE TABLE IF NOT EXISTS `team` (
  `teamId` int(11) NOT NULL AUTO_INCREMENT,
  `city` varchar(25) NOT NULL,
  `name` varchar(25) NOT NULL,
  `abbreviation` varchar(3) NOT NULL,
  `conference` varchar(4) NOT NULL,
  `division` varchar(25) NOT NULL,
  `mainColor` varchar(255) NOT NULL,
  `secondaryColor` varchar(255) NOT NULL,
  PRIMARY KEY (`teamId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

CREATE TABLE IF NOT EXISTS `tradeelement` (
  `tradeElementId` int(11) NOT NULL AUTO_INCREMENT,
  `transactionId` int(11) NOT NULL,
  `giverTeamId` int(11) NOT NULL,
  `receiverTeamId` int(11) NOT NULL,
  `tradeElement` int(11) NOT NULL,
  `tradeElementType` varchar(25) NOT NULL,
  PRIMARY KEY (`tradeElementId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=80 ;

CREATE TABLE IF NOT EXISTS `transaction` (
  `transactionId` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  PRIMARY KEY (`transactionId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=161 ;