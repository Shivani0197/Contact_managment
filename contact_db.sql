CREATE DATABASE IF NOT EXISTS contact_db;
USE contact_db;

CREATE TABLE IF NOT EXISTS contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    address TEXT,
    email VARCHAR(100) UNIQUE,
    phone VARCHAR(15) UNIQUE
);