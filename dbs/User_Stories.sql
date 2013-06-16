CREATE TABLE IF NOT EXISTS brainstorm.User_Stories (
    `StoryId` int(11) NOT NULL,
    `UserId` int(11) NOT NULL,
    `Creator` tinyint(1) NOT NULL DEFAULT 0,
    PRIMARY KEY(`StoryId`, `UserId`),
    CONSTRAINT FOREIGN KEY (`UserId`)
        REFERENCES `Users`(`UserId`)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    CONSTRAINT FOREIGN KEY (`StoryId`)
        REFERENCES `Stories`(`StoryId`)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) Engine=InnoDB DEFAULT CHARSET=latin1;
