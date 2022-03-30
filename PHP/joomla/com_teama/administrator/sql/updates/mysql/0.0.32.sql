create table if not exists `#__teama_help_requests_weapons`(
                                                               id int(11) NOT NULL AUTO_INCREMENT,
                                                               name varchar(1000) NOT NULL,
                                                               primary key(`id`),
                                                               unique key( `name`)
);

create table if not exists `#__teama_help_requests_objectives`(
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
   request_type int(11) NOT NULL,
   primary key(`id`),
   CONSTRAINT `fk_request_type`
       FOREIGN KEY (request_type) REFERENCES `#__teama_help_request_types` (id)
           ON DELETE CASCADE
           ON UPDATE RESTRICT
);

create table if not exists `#__teama_objectives_by_help_requests`
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

create table if not exists `#__teama_weapons_by_help_requests`
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
