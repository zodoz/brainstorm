CREATE TABLE IF NOT EXISTS brainstorm.Entries (
    `StoryId` int(11) NOT NULL,
    `UserId` int(11) NOT NULL,
    `Entry` text,
    `EntryTime` datetime,
    `Position` int(11) NOT NULL,
    PRIMARY KEY(`StoryId`, `Position`),
    CONSTRAINT FOREIGN KEY (`UserId`)
        REFERENCES `Users`(`UserId`)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    CONSTRAINT FOREIGN KEY (`StoryId`)
        REFERENCES `Stories`(`StoryId`)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) Engine=InnoDB DEFAULT CHARSET=latin1;
