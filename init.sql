CREATE DATABASE IF NOT EXISTS `LinkExtender`;

USE `LinkExtender`;

CREATE TABLE IF NOT EXISTS Links (
    url VARCHAR(255) NOT NULL,
    path VARCHAR(32) NOT NULL
);

INSERT INTO Links (url, path) VALUES ('https://www.google.com', 'google'); -- test

