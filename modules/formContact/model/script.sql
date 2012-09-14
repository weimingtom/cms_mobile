-- DROP TABLE IF EXISTS module_contact;
CREATE TABLE module_contact (
	id int(5) unsigned primary key auto_increment,
	culture char(2),
	lastname varchar(100), 
	firstname varchar(100), 
	email varchar(150), 
	phone varchar(15), 
	company varchar(80), 
	object varchar(80), 
	content text,
	date_inscription datetime,
	status tinyint(1) default 1,
	key status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;