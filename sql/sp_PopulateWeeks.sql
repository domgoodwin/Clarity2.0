CREATE DEFINER=`root`@`localhost` PROCEDURE `PopulateWeeks`()
BEGIN
	SET @i = 0;
    SET @amountToAdd = 10;
	SET @startDate = (SELECT Monday_Date FROM clarity2.weeks ORDER BY Monday_Date DESC LIMIT 1);

	WHILE @i < @amountToAdd DO
		INSERT INTO clarity2.weeks (Monday_Date)
		VALUES (@startDate);
		SET @i = @i + 1;
		SET @startDate = DATE_ADD(@startDate, INTERVAL 7 DAY);
	END WHILE;
END