create datababase if not exist photosphere;
use photosphere;
create table users (
    _id int AUTO_INCREMENT primary key,
    username varchar(50) unique ,
    email varchar(50) unique ,
    password varchar(200),
    bio varchar(1000),
    adresse varchar(50),
    role enum('Admin','Moderator','BasicUser','ProUser'),
    uploadCount int default null,
    created_at date default (current_date),
    last_login date default null,
    isSuperAdmin boolean dafault null, 
    heirarchical_level enum('junior', 'senior', 'load') default null,
    deta_debut_abonnement date default null,
    deta_fin_abonnement date default null
) 

create table image (
    name varchar(200) primary key,
    url varchar(200) not null,
    size int not null,
    type enum('png', 'jpg', 'gif') not null,
    dimention varchar(20) not null
)

create table tag (
    _id int AUTO_INCREMENT primary key,
    name varchar(50),
    postCount int 
)

create table album (
    _id int AUTO_INCREMENT primary key,
    name varchar(100) not null,
    desription varchar(100),
    status enum('public', 'private'),
    photo varchar(100),
    created_at date default (current_date),
    last_updated date default (current_date)
)

create table post (
    _id int AUTO_INCREMENT primary key,
    title varchar(200),
    description varchar(2000),
    status enum('draft', 'published', 'ulpoad', 'archive'),
    views int ,
    imgName varchar(200),
    foreign key imgName references image(name)
)

create table post_tag (
    tag_id int,
    post_id int,
    foreign key tag_id references tag(_id),
    foreign key post_id references post(_id),
    primary key(tag_id,post_id)
)

create table album_post (
    album_id int,
    post_id int,
    foreign key album_id references album(_id),
    foreign key post_id references post(_id),
    primary key(album_id,post_id)
)

create table comment(
    _id int AUTO_INCREMENT primary key,
    content varchar(200) not null,
    status anum('archive', 'public'),
    create_at date dafault (current_date) ,
    user_id int,
    post_id int,
    foreign key post_id references post(_id),
    foreign key user_id references user(_id)
)

create table like (
    _id int AUTO_INCREMENT primary key,
    user_id int,
    post_id int,
    foreign key post_id references post(_id),
    foreign key user_id references user(_id)
)

























