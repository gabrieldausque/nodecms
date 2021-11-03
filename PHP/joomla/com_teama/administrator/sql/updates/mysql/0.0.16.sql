alter table `#__teama_news` DROP COLUMN IF EXISTS tags;
create table if not exists `#__teama_tags` (
    id int(11) NOT NULL AUTO_INCREMENT,
    tag varchar(255) NOT NULL,
    primary key (`id`)
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