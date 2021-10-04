create table if not exists `#__teama_news` (
    id int(11) NOT NULL AUTO_INCREMENT,
    header_media varchar(1024) NOT NULL DEFAULT '',
    title varchar(255) NOT NULL,
    body longtext not null default '',
    author int(11) Not null,
    creation_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modification_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    publication_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    current_stage INT NOT NULL DEFAULT 0,
    publication_status INT NOT NULL DEFAULT 0,
    last_modifier INT,
    primary key (`id`)
);

