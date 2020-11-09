SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `logins` (
  `loginsID` int(11) NOT NULL,
  `loginsUID` varchar(255) NOT NULL,
  `loginsTIME` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `logins`
  ADD PRIMARY KEY (`loginsID`),
  ADD UNIQUE KEY `loginsUID` (`loginsUID`);

ALTER TABLE `logins`
  MODIFY `loginsID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;