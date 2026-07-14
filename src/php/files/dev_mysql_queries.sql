show databases;
select * from blog_articles;
alter table blog_articles rename blog_articles_bkp;
use cmsdb_mysql;
create table blog_articles (uid char(36) primary key,id serial,title varchar(255),
created_datetime datetime, summary varchar(1000), detailed text);

create table blog_images (uid char(36) primary key,image_id serial,
image_type enum('header','section','footer','icon','post','other'),
article_id bigint unsigned not null,description varchar(255),data blob,
foreign key (article_id) references blog_articles(id)
);