CREATE TABLE IF NOT EXISTS brainstorm.Stories (
    `StoryId` int(11) NOT NULL AUTO_INCREMENT,
    `Title` varchar(255),
    `NumRounds` int(11),
    `TimeStart` datetime NOT NULL,
    `TimeEnd` datetime,
    PRIMARY KEY(`StoryId`)
) Engine=InnoDB DEFAULT CHARSET=latin1;
