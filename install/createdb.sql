set names 'utf8';

create database lyb;

use lyb;

create table user_info2(
	id int  unsigned auto_increment primary key,
	username varchar(20) not null,
	password varchar(50) not null,
	power int unsigned not null,
	score int unsigned not null,
	email varchar(25),
	tele varchar(25),
	intro text default ''
)engine=innodb charset=utf8;


insert into user_info values (null,'xfy','123456',1,100,null,null,null);


create table message_board(
	id int unsigned auto_increment primary key,
	usernameid varchar(20) ,
	mess text,
	posttime date
)engine=innodb charset=utf8;


insert into message_board values (null,'xfy','123456',now());

	insert into {$this->db_prefix}_message_board values (null,'xfy','123456',now());

 
		select * from ooo_message_board ;

	