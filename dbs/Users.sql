CREATE TABLE IF NOT EXISTS Users (
    `UserId` int(11) NOT NULL AUTO_INCREMENT,
    `Username` varchar(45) NOT NULL,
    `Password` char(40) NOT NULL,
    PRIMARY KEY(`UserId`)
) Engine=InnoDB DEFAULT CHARSET=latin1;
