-- MySQL schema for BAC Lab
DROP DATABASE IF EXISTS bac_lab;
CREATE DATABASE bac_lab;
USE bac_lab;

-- Users (plaintext password for teaching only!)
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) UNIQUE NOT NULL,
  password VARCHAR(100) NOT NULL,
  email VARCHAR(120) NOT NULL,
  role ENUM('user','admin') NOT NULL DEFAULT 'user'
);

INSERT INTO users (username, password, email, role) VALUES
('alice', 'password123', 'alice@example.com', 'user'),
('bob',   'password123', 'bob@example.com',   'user'),
('admin', 'admin123',    'admin@example.com', 'admin');

-- Posts (owned content)
CREATE TABLE posts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  content TEXT NOT NULL,
  is_private TINYINT(1) NOT NULL DEFAULT 0,
  FOREIGN KEY (user_id) REFERENCES users(id)
);

INSERT INTO posts (user_id, content, is_private) VALUES
(1, 'Alice public note', 0),
(1, 'Alice private diary', 1),
(2, 'Bob public note', 0);

-- Files (owned by users)
CREATE TABLE files (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  filename VARCHAR(120) NOT NULL,
  path VARCHAR(255) NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Sample files (create actual files in ./uploads/)
INSERT INTO files (user_id, filename, path) VALUES
(1, 'alice_report.txt', 'uploads/alice_report.txt'),
(2, 'bob_notes.txt',    'uploads/bob_notes.txt');
