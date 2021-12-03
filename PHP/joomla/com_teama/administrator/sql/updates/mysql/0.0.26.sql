create table if not exists `#__teama_departments` (
    id int(11) NOT NULL AUTO_INCREMENT,
    department_number varchar(10) NOT NULL,
    name varchar(255) NOT NULL,
    path longtext NOT NULL,
    primary key (`id`)
);

create table if not exists `#__teama_offshoots` (
   id int(11) NOT NULL AUTO_INCREMENT,
   name varchar(255) NOT NULL,
   address TEXT NOT NULL,
   phone_number varchar(255) NOT NULL,
   mail varchar(255) NOT NULL,
   contact_id int(11) NOT NULL,
   primary key(`id`)
);

create table if not exists `#__teama_offshoots_departments` (
    id int(11) NOT NULL AUTO_INCREMENT,
    department_id int(11),
    offshoots_id int(11),
    primary key(`id`),
    unique(`department_id`,`offshoots_id`),
    constraint `fk_departments`
        FOREIGN KEY (department_id) REFERENCES `#__teama_departments` (id)
            ON DELETE CASCADE
            ON UPDATE RESTRICT,
    constraint `fk_offshoots`
        FOREIGN KEY (offshoots_id) REFERENCES `#__teama_offshoots` (id)
            ON DELETE CASCADE
            ON UPDATE RESTRICT
);