alter table #__teama_news
    add column if not exists summary varchar(2096) not null default '';