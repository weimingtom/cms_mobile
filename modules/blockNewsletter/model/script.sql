-- DROP TABLE IF EXISTS newsletter;
CREATE TABLE newsletter (
	id int(5) unsigned primary key auto_increment,
	culture char(2),
	email varchar(150),
	date_inscription datetime,
	status tinyint(1) default 1,
	key status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;