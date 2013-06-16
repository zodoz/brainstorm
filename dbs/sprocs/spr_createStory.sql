CREATE PROCEDURE spr_createStory(OUT storyId INT)
BEGIN
    INSERT INTO Stories(TimeStart) SELECT NOW();

    SELECT LAST_INSERT_ID() into storyId;
END
