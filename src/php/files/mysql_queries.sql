insert into blog_articles(id,title,created_datetime,summary,detailed) 
values (uuid(),"test title",current_timestamp(),"test summary message","test detailed message");
use cms0_1;
select * from blog_articles ;
select database();
select uuid();
show tables;

create table blog_articles (uid char(36) primary key,id serial,title varchar(255),created_datetime datetime, summary varchar(1000), detailed text);
alter table blog_articles rename temp;
alter table temp rename blog_articles;
describe blog_articles;
insert into blog_articles (uid,title,created_datetime,summary,detailed) values (uuid(),'test title',current_timestamp(),'test summary','test detailed');

select * from blog_articles order by id desc;

create table blog_images (uid char(36) primary key,image_id serial,
image_type enum('header','section','footer','icon','post','other'),
article_id bigint unsigned not null,description varchar(255),data blob,
foreign key (article_id) references blog_articles(id)
);

describe blog_images;