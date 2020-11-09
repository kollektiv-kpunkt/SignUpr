SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `sheet` (
  `ID` int(11) NOT NULL,
  `sheetTimestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `sheetID` varchar(255) NOT NULL,
  `sheetBogenID` varchar(255) NOT NULL DEFAULT '0',
  `sheetType` varchar(255) NOT NULL,
  `sheetPLZ` int(11) NOT NULL,
  `sheetNosig` int(11) NOT NULL,
  `sheetUser` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DELIMITER $$
CREATE TRIGGER `deleteNosig` AFTER DELETE ON `sheet` FOR EACH ROW IF (OLD.sheetBogenID IS NOT NULL AND OLD.sheetBogenID != '') THEN
	UPDATE bogen SET returned = (bogen.returned - OLD.sheetNosig) WHERE bogen.bogenID = OLD.sheetBogenID;
END IF
$$
DELIMITER ;

ALTER TABLE `sheet`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `BogenIDIndex` (`sheetBogenID`);

ALTER TABLE `sheet`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;