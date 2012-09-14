-- DROP TABLE IF EXISTS module_blockslider;
CREATE TABLE module_blockslider (
	id int(2) unsigned primary key auto_increment,
	fk_module_item int(5) unsigned,
	control tinyint(1) UNSIGNED default 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE module_blockslider_element (
	id int(3) unsigned primary key auto_increment,
	fk_module_blockslider int(2) unsigned,
	img varchar(150),
	infos text,
	`order` tinyint(9),
	status tinyint(1) UNSIGNED default 1,
	key status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE module_blockslider
	ADD CONSTRAINT module_blockslider_ibfk_1 FOREIGN KEY (fk_module_item) REFERENCES module_item(id) ON DELETE CASCADE;
ALTER TABLE module_blockslider_element
	ADD CONSTRAINT module_blockslider_element_ibfk_1 FOREIGN KEY (fk_module_blockslider) REFERENCES module_blockslider(id) ON DELETE CASCADE;