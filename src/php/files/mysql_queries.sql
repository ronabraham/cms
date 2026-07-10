insert into blog_articles(id,title,created_datetime,summary,detailed) 
values (uuid(),"test title",current_timestamp(),"test summary message","test detailed message");

select * from blog_articles where summary like '% message';
select database();
select uuid();