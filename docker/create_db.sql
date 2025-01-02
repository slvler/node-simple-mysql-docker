CREATE TABLE users(
            id INT PRIMARY KEY AUTO_INCREMENT,
            email VARCHAR(255) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            name VARCHAR(60) NOT NULL,
            surname VARCHAR(60) NOT NULL,
            status ENUM('ACTIVE', 'PASSIVE') NOT NULL DEFAULT 'ACTIVE',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
INSERT INTO users(
            email,
            password,
            name,
            surname,
            status)
VALUES(
            "12@gmail.com",
            "$2b$10$lcye3cNRp1kSGkdrPNs.v.Dq/yKfYkpCJ7NN5RyGeW6luOAu9QiwS",
            "john",
            "doe",
            "ACTIVE"
);

CREATE TABLE categories(
            id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
            name VARCHAR(255) NOT NULL,
            description VARCHAR(255) NOT NULL,
            slug VARCHAR(60) NOT NULL UNIQUE,
            status ENUM('ACTIVE', 'PASSIVE') NOT NULL DEFAULT 'ACTIVE',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
INSERT INTO categories(
            name,
            description,
            slug,
            status)
VALUES(
            "science",
            "Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
            "science",
            "ACTIVE"
);

CREATE TABLE blogs(
            id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
            title VARCHAR(255) NOT NULL,
            content TEXT NOT NULL,
            category_id INT UNSIGNED,
            status ENUM('ACTIVE', 'PASSIVE') NOT NULL DEFAULT 'ACTIVE',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            CONSTRAINT fk_category_id FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
);
INSERT INTO blogs(
            title,
            content,
            category_id,
            status)
VALUES(
            "law of gravity",
            "Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
            1,
            "ACTIVE"
);

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
ALTER USER 'root' IDENTIFIED WITH mysql_native_password BY 'password'; flush privileges;