CREATE TABLE student(
       student_id INT PRIMARY KEY AUTO_INCREMENT,
       student_name VARCHAR(60),
       student_age INT
);
INSERT INTO student(
       student_name,
       student_age)
VALUES(
       "Shubham verma",
        21
);
INSERT INTO student(
       student_name,
       student_age)
VALUES(
       "Utkarsh verma",
        23
);

CREATE TABLE users(
id INT PRIMARY KEY AUTO_INCREMENT,
email VARCHAR(255) NOT NULL UNIQUE,
password VARCHAR(255) NOT NULL,
name VARCHAR(60) NOT NULL,
surname VARCHAR(60) NOT NULL,
status ENUM('ACTIVE', 'PASSIVE') NOT NULL DEFAULT 'ACTIVE'
);

ALTER USER 'root' IDENTIFIED WITH mysql_native_password BY 'password'; flush privileges;