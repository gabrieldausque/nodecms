create table if not exists `#__teama_news` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `title` varchar(255) NOT NULL,
    `body` longtext not null default '',
    `author` int(11) Not null,
    primary key (`id`)
);