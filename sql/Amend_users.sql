ALTER TABLE `clarity2`.`users` 
CHANGE COLUMN `Password` `Password` VARCHAR(45) NULL ,
ADD COLUMN `Passwd` CHAR(128) NOT NULL AFTER `Role`;
