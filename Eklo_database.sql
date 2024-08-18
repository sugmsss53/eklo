CREATE DATABASE eklo;

USE eklo;

CREATE TABLE users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    first_name VARCHAR(255),
    last_name VARCHAR(255)
);

CREATE TABLE posts (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    user_id INT(11),
    title VARCHAR(255),
    content TEXT,
    image_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE comments (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    post_id INT(11),
    user_id INT(11),
    comment_text TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id) REFERENCES posts(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE votes (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    user_id INT(11),
    post_id INT(11),
    vote_type ENUM('upvote', 'downvote'),
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (post_id) REFERENCES posts(id)
);

CREATE TABLE password_resets (
    email VARCHAR(255),
    token VARCHAR(64),
    expiry DATETIME,
    FOREIGN KEY (email) REFERENCES users(email)
);
