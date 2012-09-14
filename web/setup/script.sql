-﻿- DROP DATABASE IF EXISTS cms_mobile;
-- CREATE DATABASE cms_mobile;
-- USE cms_mobile;

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
	id tinyint(5) unsigned primary key auto_increment,
	login varchar(15),
	password varchar(50),
	lastname varchar(50),
	firstname varchar(50),
	key login (login),
	key password (password)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
INSERT INTO `user`(login, password) VALUES ('admin', '0c7540eb7e65b553ec1ba6b20de79608');

DROP TABLE IF EXISTS configuration;
CREATE TABLE configuration (
	id tinyint(1) unsigned primary key auto_increment,
	font_family varchar(50),
	font_size varchar(10),
	font_color varchar(7),
	h1_size varchar(10),
	h2_size varchar(10),
	h3_size varchar(10),
	h4_size varchar(10),
	h5_size varchar(10),
	background varchar(50),
	color1 varchar(7),
	color2 varchar(7),
	google_analytics_id varchar(15)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
INSERT INTO configuration VALUES (1, 'Helvetica', '0.9em', '555555', '1.5em', '1.4em', '1.3em', '1.2em', '1.1em', 'dedede', '333333', '888888', '');

DROP TABLE IF EXISTS culture;
CREATE TABLE culture (
	id char(2) primary key,
	label varchar(20),
	status tinyint(1) default 0,
	key status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
INSERT INTO culture VALUES ('fr', 'français', 1), ('en', 'english', 0);

DROP TABLE IF EXISTS configuration_translation;
CREATE TABLE configuration_translation (
	id tinyint(1) unsigned,
	culture char(2),
	title varchar(75),
	meta_description varchar(256),
	meta_keywords varchar(256),
	book_link varchar(256),
	status tinyint(1) default 1,
	primary key (id, culture),
	key status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS page;
CREATE TABLE page (
	id int(3) unsigned primary key auto_increment,
	label varchar(100),
	header tinyint(1) default 1,
	footer tinyint(1) default 1,
	is_home tinyint(1) default 0,
	is_404 tinyint(1) default 0,
	is_header tinyint(1) default 0,
	is_footer tinyint(1) default 0,
	fk_template int(3)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
INSERT INTO page(id, label, header, footer, is_header, is_footer, fk_template) VALUES (1, 'header', 0, 0, 1, 0, 1);
INSERT INTO page(id, label, header, footer, is_header, is_footer, fk_template) VALUES (2, 'footer', 0, 0, 0, 1, 1);
INSERT INTO page VALUES (3, 'home', 1, 1, 1, 1, 0, 0, 1);

DROP TABLE IF EXISTS page_translation;
CREATE TABLE page_translation (
	id int(3) unsigned,
	culture char(2),
	title varchar(75),
	meta_description varchar(256),
	meta_keywords varchar(256),
	creat_date datetime,
	last_modified datetime,
	status tinyint(1) default 1,
	primary key (id, culture),
	key status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
INSERT INTO page_translation(id, culture, title, meta_description, meta_keywords, creat_date, last_modified, status) VALUES (3, 'fr', 'demo', 'meta_description', 'meta_keywords', NOW(), NOW(), 1);

DROP TABLE IF EXISTS template;
CREATE TABLE template (
	id int(3) unsigned primary key auto_increment,
	title varchar(30),
	folder varchar(50),
	status tinyint(1) default 1,
	key status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
INSERT INTO template VALUES (1, 'default', 'default', 1);

DROP TABLE IF EXISTS `module`;
CREATE TABLE `module` (
	id int(5) unsigned primary key auto_increment,
	title varchar(30),
	folder varchar(50),
	manager tinyint(1) default 0,
	status tinyint(1) default 1,
	key status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
INSERT INTO module VALUES (1, 'blockTexte', 'blockText', 0, 1);

DROP TABLE IF EXISTS module_item;
CREATE TABLE module_item (
	id int(5) unsigned primary key auto_increment,
	`order` int(2),
	datas text,
	fk_module int(5) unsigned,
	fk_page_translation int(3) unsigned,
	culture char(2),
	status tinyint(1) default 1,
	key status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
INSERT INTO module_item VALUES (1, 1, "<p>Bienvenue sur votre CMS mobile,<br/>Nous espérons qu'il vous donnera entière satisfaction</p><p>L'équipe MMCreation</p>", 1, 3, 'fr', 1);


DROP TABLE IF EXISTS menu;
CREATE TABLE menu (
	id int(1) unsigned primary key auto_increment,
	title varchar(30) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
INSERT INTO menu VALUES (1, "Primary"), (2, "Secondary"), (3, "Tertiary");

DROP TABLE IF EXISTS menu_item;
CREATE TABLE menu_item (
	id int(4) unsigned primary key auto_increment,
	fk_menu int(1) unsigned,
	culture char(2),
	title varchar(30), 
	img varchar(150),
	blank tinyint(1) default 0,
	url varchar(256),
	external_url tinyint(1) default 0,
	id_page_dest int(3) unsigned,
	`order` int(3) unsigned default 9999,
	status tinyint(1) default 1,
	key status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




-- configuration_translation
ALTER TABLE configuration_translation 
	ADD CONSTRAINT configuration_translation_ibfk_1 FOREIGN KEY (id) REFERENCES configuration(id),
	ADD CONSTRAINT configuration_translation_ibfk_2 FOREIGN KEY (culture) REFERENCES culture(id);
-- page
ALTER TABLE page
	ADD CONSTRAINT page_ibfk_1 FOREIGN KEY (fk_template) REFERENCES template(id);
-- page_translation
ALTER TABLE page_translation 
	ADD CONSTRAINT page_translation_ibfk_1 FOREIGN KEY (id) REFERENCES page(id),
	ADD CONSTRAINT page_translation_ibfk_2 FOREIGN KEY (culture) REFERENCES culture(id);
-- module
ALTER TABLE module_item 
	ADD CONSTRAINT module_item_ibfk_1 FOREIGN KEY (fk_module) REFERENCES module(id),
	ADD CONSTRAINT module_item_ibfk_2 FOREIGN KEY (fk_page_translation) REFERENCES page_translation(id),
	ADD CONSTRAINT module_item_ibfk_2 FOREIGN KEY (culture) REFERENCES page_translation(id);
-- menu
ALTER TABLE menu_item 
	ADD CONSTRAINT menu_item_ibfk_1 FOREIGN KEY (fk_menu) REFERENCES menu(id),
	ADD CONSTRAINT menu_item_ibfk_2 FOREIGN KEY (culture) REFERENCES culture(id);