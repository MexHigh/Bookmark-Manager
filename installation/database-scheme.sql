CREATE DATABASE bookmarks;
USE bookmarks;

CREATE TABLE Category (
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name varchar(255) NOT NULL
);
INSERT INTO Category (name) VALUES ("example-category");

CREATE TABLE Link (
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    category int NOT NULL,
    url text NOT NULL,
    fav tinyint(1) NOT NULL,
    FOREIGN KEY (category) REFERENCES Category(id)
);