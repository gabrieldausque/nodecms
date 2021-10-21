alter table #__teama_news
    add column if not exists summary varchar(2096) not null default '',
    add column if not exists header_media varchar(1024) NOT NULL DEFAULT '';