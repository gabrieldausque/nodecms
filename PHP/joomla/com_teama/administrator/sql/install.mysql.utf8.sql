create table if not exists `#__teama_news` (
    id int(11) NOT NULL AUTO_INCREMENT,
    header_media varchar(1024) NOT NULL DEFAULT '',
    title varchar(255) NOT NULL,
    body longtext not null,
    author int(11) Not null,
    creation_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modification_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    publication_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    current_stage INT NOT NULL DEFAULT 0,
    publication_status INT NOT NULL DEFAULT 0,
    last_modifier INT,
    summary VARCHAR(2096) NOT NULL DEFAULT '',
    catid INT(11) NOT NULL DEFAULT 0,
    primary key (`id`)
);

create table if not exists `#__teama_tags` (
   id int(11) NOT NULL AUTO_INCREMENT,
   tag varchar(255) NOT NULL,
   primary key (`id`),
   unique key (tag)
);

create table if not exists `#__teama_news_tags` (
    id int(11) NOT NULL AUTO_INCREMENT,
    news_id int(11) NOT NULL,
    tags_id int(11) NOT NULL,
    primary key (`id`),
    CONSTRAINT `fk_news`
        FOREIGN KEY (news_id) REFERENCES `#__teama_news` (id)
            ON DELETE CASCADE
            ON UPDATE RESTRICT,
    CONSTRAINT `fk_tags`
        FOREIGN KEY (tags_id) REFERENCES `#__teama_tags` (id)
            ON DELETE CASCADE
            ON UPDATE RESTRICT
);

create table if not exists `#__teama_france_departments` (

);

create table if not exists `#__teama_offshoots`(
    id int(11) NOT NULL AUTO_INCREMENT,

);