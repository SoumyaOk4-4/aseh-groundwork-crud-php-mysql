CREATE DATABASE IF NOT EXISTS aseh_crud;
USE aseh_crud;

CREATE TABLE IF NOT EXISTS students (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    course VARCHAR(50) NOT NULL
);

INSERT INTO students (name, course) VALUES 
    ('Alice Sharma', 'Web Security'),
    ('Rahul Das', 'Linux & Bash'),
    ('Priya Roy', 'MySQL & PHP');
