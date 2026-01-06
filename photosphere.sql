CREATE DATABASE IF NOT EXISTS photosphere;
USE photosphere;

CREATE TABLE users (
    _id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE,
    email VARCHAR(50) UNIQUE,
    password VARCHAR(200),
    bio VARCHAR(1000),
    adresse VARCHAR(50),
    role ENUM('Admin','Moderator','BasicUser','ProUser'),
    uploadCount INT DEFAULT NULL,
    created_at DATE DEFAULT (CURRENT_DATE),
    last_login DATE DEFAULT NULL,
    isSuperAdmin BOOLEAN DEFAULT NULL,
    heirarchical_level ENUM('junior', 'senior', 'lead') DEFAULT NULL,
    date_debut_abonnement DATE DEFAULT NULL,
    date_fin_abonnement DATE DEFAULT NULL
);

CREATE TABLE image (
    name VARCHAR(200) PRIMARY KEY,
    url VARCHAR(200) NOT NULL,
    size INT NOT NULL,
    type ENUM('png', 'jpg', 'gif') NOT NULL,
    dimension VARCHAR(20) NOT NULL
);

CREATE TABLE tag (
    _id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    postCount INT
);

CREATE TABLE album (
    _id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description VARCHAR(100),
    status ENUM('public', 'private'),
    photo VARCHAR(100),
    created_at DATE DEFAULT (CURRENT_DATE),
    last_updated DATE DEFAULT (CURRENT_DATE)
);

CREATE TABLE post (
    _id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200),
    description VARCHAR(2000),
    status ENUM('draft', 'published', 'upload', 'archive'),
    views INT,
    imgName VARCHAR(200),
    FOREIGN KEY (imgName) REFERENCES image(name)
);
ALTER TABLE `post`
ADD COLUMN `user_id` INT NOT NULL;

CREATE TABLE post_tag (
    tag_id INT,
    post_id INT,
    FOREIGN KEY (tag_id) REFERENCES tag(_id),
    FOREIGN KEY (post_id) REFERENCES post(_id),
    PRIMARY KEY (tag_id, post_id)
);

CREATE TABLE album_post (
    album_id INT,
    post_id INT,
    FOREIGN KEY (album_id) REFERENCES album(_id),
    FOREIGN KEY (post_id) REFERENCES post(_id),
    PRIMARY KEY (album_id, post_id)
);

CREATE TABLE comments (
    _id INT AUTO_INCREMENT PRIMARY KEY,
    content VARCHAR(200) NOT NULL,
    status ENUM('archive', 'public'),
    created_at DATE DEFAULT (CURRENT_DATE),
    user_id INT,
    post_id INT,
    FOREIGN KEY (post_id) REFERENCES post(_id),
    FOREIGN KEY (user_id) REFERENCES users(_id)
);

CREATE TABLE likes (
    _id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    post_id INT,
    FOREIGN KEY (post_id) REFERENCES post(_id),
    FOREIGN KEY (user_id) REFERENCES users(_id)
);
