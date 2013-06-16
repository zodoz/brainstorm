CREATE PROCEDURE spr_linkFriends(IN uid INT, IN fuid INT)
BEGIN
    INSERT INTO Friends(uid, fuid)
    VALUES
        (uid, fuid),
        (fuid, uid)
END
