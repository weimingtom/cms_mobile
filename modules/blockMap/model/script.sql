-- DROP TABLE IF EXISTS module_blockmap;
CREATE TABLE module_blockmap (
	id int(2) unsigned primary key auto_increment,
	fk_module_item int(5) unsigned
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS module_blockmap_element;
CREATE TABLE module_blockmap_element (
	id int(3) unsigned primary key auto_increment,
	fk_module_blockmap int(2) unsigned,
	img varchar(150),
	title varchar(50),
	infos text,
	latitude double,
	longitude double,
	status tinyint(1) default 1,
	key status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE module_blockmap
	ADD CONSTRAINT module_blockmap_ibfk_1 FOREIGN KEY (fk_module_item) REFERENCES module_item(id) ON DELETE CASCADE;
ALTER TABLE module_blockmap_element
	ADD CONSTRAINT module_blockmap_element_ibfk_1 FOREIGN KEY (fk_module_blockmap) REFERENCES module_blockmap(id) ON DELETE CASCADE;
