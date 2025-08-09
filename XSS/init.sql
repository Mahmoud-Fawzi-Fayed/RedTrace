DROP DATABASE IF EXISTS xss_lab;
CREATE DATABASE xss_lab CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE xss_lab;

CREATE TABLE posts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  content TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE comments (
  id INT AUTO_INCREMENT PRIMARY KEY,
  post_id INT NOT NULL,
  author VARCHAR(100) NOT NULL,
  body TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE
) ENGINE=InnoDB;

INSERT INTO posts (title, content) VALUES
('Welcome', 'Hello! This is a **demo** post. Try comments!'),
('Note', 'You can test stored XSS by adding a comment with <script>alert(1)</script> (vulnerable view).');