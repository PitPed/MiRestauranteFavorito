CREATE DATABASE MRF;
USE MRF;

CREATE TABLE usuarios (
    name VARCHAR(50),
    password VARCHAR(256),
    PRIMARY KEY (name)
);

CREATE TABLE platos (
    name VARCHAR(50),
    price DECIMAL(4,2),
    category ENUM('vegano', 'sin gluten', 'sin lactosa', 'normal'),
    PRIMARY KEY (name)
);