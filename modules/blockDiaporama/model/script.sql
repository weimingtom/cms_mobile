-- DROP TABLE IF EXISTS module_blockdiaporama;
CREATE TABLE module_blockdiaporama (
	id int(2) unsigned primary key auto_increment,
	fk_module_item int(5) unsigned
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE module_blockdiaporama_element (
	id int(3) unsigned primary key auto_increment,
	fk_module_blockdiaporama int(2) unsigned,
	img varchar(150),
	infos text,
	`order` tinyint(9),
	status tinyint(1) UNSIGNED default 1,
	key status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE module_blockdiaporama
	ADD CONSTRAINT module_blockdiaporama_ibfk_1 FOREIGN KEY (fk_module_item) REFERENCES module_item(id) ON DELETE CASCADE;
ALTER TABLE module_blockdiaporama_element
	ADD CONSTRAINT module_blockdiaporama_element_ibfk_1 FOREIGN KEY (fk_module_blockdiaporama) REFERENCES module_blockdiaporama(id) ON DELETE CASCADE;