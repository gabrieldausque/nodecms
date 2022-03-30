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

create table if not exists `#__teama_offshoots`(
   id int(11) NOT NULL AUTO_INCREMENT,
   name varchar(255) NOT NULL,
   address TEXT NOT NULL,
   phone_number varchar(255) NOT NULL,
   mail varchar(255) NOT NULL,
   primary key(`id`)
);

create table if not exists `__teama_help_requests_weapons`(
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(1000) NOT NULL,
  primary key(`id`),
  unique key( `name`)
);

create table if not exists `__teama_help_requests_objectives`(
    id int(11) NOT NULL AUTO_INCREMENT,
    photo varchar(1024) NOT NULL DEFAULT '',
    lastname varchar(1000) NOT NULL,
    firstname varchar(1000) NOT NULL,
    age int(11) NULL,
    sex varchar(25) NULL,
    birthdate DATETIME NULL,
    birthplace varchar(1000) NULL,
    size varchar(25) NULL,
    dangerousness varchar(255) NULL,
    comment text null,
    primary key(`id`)
);

create table if not exists `#__teama_help_request_types`(
   id int(11) NOT NULL AUTO_INCREMENT,
   name varchar(100) NOT NULL,
   primary key (`id`),
   unique key (`name`)
);

create table if not exists `#__teama_help_requests`(
   id int(11) NOT NULL AUTO_INCREMENT,
   creation_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
   requester_service varchar(255) NOT NULL,
   requester varchar(1000) NOT NULL,
   content longtext NOT NULL,
   request_datetime DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
   address text NOT NULL,
   difficulties text NOT NULL,
   request_type int(11) NOT NULL,
   primary key(`id`),
   CONSTRAINT `fk_request_type`
       FOREIGN KEY (request_type) REFERENCES `#__teama_help_request_types` (id)
           ON DELETE CASCADE
           ON UPDATE RESTRICT
);

create table if not exists `#__teama_help_requests_objectives`
(
    id int(11) NOT NULL AUTO_INCREMENT,
    request_id int(11) NOT NULL,
    objective_id int(11) NOT NULL,
    primary key (`id`),
    CONSTRAINT `fk_req_obj_request`
        FOREIGN KEY (request_id) REFERENCES `#__teama_help_requests` (id)
            ON DELETE CASCADE
            ON UPDATE RESTRICT,
    CONSTRAINT `fk_req_obj_objectives`
        FOREIGN KEY (objective_id) REFERENCES `#__teama_help_requests_objectives` (id)
            ON DELETE CASCADE
            ON UPDATE RESTRICT
);

create table if not exists `#__teama_help_requests_weapons`
(
    id int(11) NOT NULL AUTO_INCREMENT,
    request_id int(11) NOT NULL,
    weapon_id int(11) NOT NULL,
    primary key (`id`),
    CONSTRAINT `fk_req_wea_request`
        FOREIGN KEY (request_id) REFERENCES `#__teama_help_requests` (id)
            ON DELETE CASCADE
            ON UPDATE RESTRICT,
    CONSTRAINT `fk_req_wea_weapon`
        FOREIGN KEY (weapon_id) REFERENCES `#__teama_help_requests_weapons` (id)
            ON DELETE CASCADE
            ON UPDATE RESTRICT
)

