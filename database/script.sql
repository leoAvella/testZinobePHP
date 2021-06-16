CREATE DATABASE zinobe;

CREATE USER 'zinobe'@'localhost' IDENTIFIED BY 'zinobe';
GRANT ALL PRIVILEGES ON * . * TO 'zinobe'@'localhost';

use zinobe;
SET sql_mode = '';




CREATE TABLE users (
    userid int NOT NULL AUTO_INCREMENT,

    id int,
    job_title varchar(255),
    email varchar(255),
    first_name varchar(255),
    last_name varchar(255),
    document varchar(255),
    phone_number varchar(255),
    country varchar(255),
    state varchar(255),
    city varchar(255),
    birth_date varchar(20),
    password varchar(245),
    created_at timestamp,
    updated_at timestamp,
    PRIMARY KEY (userid)
);