SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `bogen` (
  `ID` int(11) NOT NULL,
  `bogenID` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `plz` int(5) NOT NULL,
  `ort` varchar(255) NOT NULL,
  `drucker` int(1) NOT NULL DEFAULT 0,
  `optin` int(1) NOT NULL DEFAULT 1,
  `nosig` int(11) NOT NULL,
  `returned` int(11) NOT NULL DEFAULT 0,
  `notreturned` int(11) NOT NULL,
  `done` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DELIMITER $$
CREATE TRIGGER `calcDONE` BEFORE UPDATE ON `bogen` FOR EACH ROW BEGIN
      IF (NEW.returned >= NEW.nosig) THEN
            SET NEW.done = 1;
      ELSE
      	SET NEW.done = 0;
      END IF;
    END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `calcINSERT` BEFORE INSERT ON `bogen` FOR EACH ROW SET NEW.notreturned=NEW.nosig-NEW.returned
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `calcUPDATE` BEFORE UPDATE ON `bogen` FOR EACH ROW IF (NEW.nosig-NEW.returned>=0) THEN
	SET NEW.notreturned=NEW.nosig-NEW.returned;
ELSE
	SET NEW.notreturned=0;
END IF
$$
DELIMITER ;

ALTER TABLE `bogen`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `BogenIDKey` (`bogenID`);

ALTER TABLE `bogen`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;