CREATE TABLE IF NOT EXISTS brainstorm.Users (
    `UserId` int(11) NOT NULL AUTO_INCREMENT,
    `Username` varchar(255) NOT NULL,
    `Password` char(40) NOT NULL,
    PRIMARY KEY(`UserId`)
) Engine=InnoDB DEFAULT CHARSET=latin1;
