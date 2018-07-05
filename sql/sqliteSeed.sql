DROP TABLE IF EXISTS `ramverk1_User`;
DROP TABLE IF EXISTS `ramverk1_Coin`;
DROP TABLE IF EXISTS `ramverk1_Post`;
DROP TABLE IF EXISTS `ramverk1_Comment`;
DROP TABLE IF EXISTS `ramverk1_Reply`;
DROP TABLE IF EXISTS `ramverk1_Tag`;
DROP TABLE IF EXISTS `ramverk1_TagQuestion`;
DROP TABLE IF EXISTS `ramverk1_Vote`;
DROP TABLE IF EXISTS `ramverk1_Karma`;

/* CREATE USERS */
CREATE TABLE `ramverk1_User` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(80) UNIQUE NOT NULL,
    `email` VARCHAR(255) UNIQUE NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `country` VARCHAR(255),
    `city` VARCHAR(255),
    `website` VARCHAR(255),
    `description` VARCHAR(150),
    `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `deleted` DATETIME,
    `admin` BOOLEAN DEFAULT 0

);

INSERT INTO `ramverk1_User` (id, username, email, password, country, city, website, description, admin)
    VALUES
    (1, 'zero2k', 'test@test.com', '$2y$10$2/YvTXRVIA1eIrts2uteL.qeIswbJH8o8PZJOgCEsZoyM1zwBWRQm', 'sweden', 'lund', 'http://cryp2.com', 'test', 0);


/* CREATE COINS */
CREATE TABLE `ramverk1_Coin` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `slug` VARCHAR(255) NOT NULL,
    `description` TEXT NOT NULL,
    `published` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `deleted` BOOLEAN DEFAULT 0

);

INSERT INTO `ramverk1_Coin` (id, name, slug, description)
    VALUES
    (1, 'bitcoin', 'bitcoin', 'About bitcoin'),
    (2, 'ethereum', 'ethereum', 'About ethereum'),
    (3, 'ripple', 'ripple', 'About ripple'),
    (4, 'bitcoin cash', 'bitcoin-cash', 'About bitcoin cash'),
    (5, 'eos', 'eos', 'About eos'),
    (6, 'litecoin', 'litecoin', 'About litecoin'),
    (7, 'stellar', 'stellar', 'About stellar'),
    (8, 'cardano', 'cardano', 'About cardano'),
    (9, 'iota', 'iota', 'About iota'),
    (10, 'tron', 'tron', 'About tron'),
    (11, 'neo', 'neo', 'About neo'),
    (12, 'monero', 'monero', 'About monero'),
    (13, 'tether', 'tether', 'About tether'),
    (14, 'dash', 'dash', 'About dash'),
    (15, 'nem', 'nem', 'About nem');



/* CREATE POSTS */
CREATE TABLE `ramverk1_Post` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `userId` INTEGER NOT NULL,
    `coinId` INTEGER NOT NULL,
    `title` VARCHAR(100) NOT NULL,
    `text` TEXT NOT NULL,
    `html` TEXT,
    `views` INTEGER DEFAULT 0,
    `votes` INTEGER DEFAULT 0,
    `answers` INTEGER DEFAULT 0,
    `published` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated` DATETIME,
    `deleted` BOOLEAN DEFAULT 0,
    
    FOREIGN KEY (userId) REFERENCES ramverk1_User(id),
    FOREIGN KEY (coinId) REFERENCES ramverk1_Coin(id) ON DELETE CASCADE

);

INSERT INTO `ramverk1_Post` (id, userId, coinId, title, text, html, views, votes, answers)
    VALUES
    (1, 1, 1, 'Learn how to trade bitcoin', 'test', '<p>test</p>', 0, 0, 0),
    (2, 1, 2, 'Learn how to trade ethereum', 'test', '<p>test</p>', 0, 0, 0),
    (3, 1, 1, 'Is bitcoin legal in sweden?', 'test', '<p>test</p>', 0, 0, 0),
    (4, 1, 1, 'What would you do to recover lost Bitcoins?', 'test', '<p>test</p>', 0, 0, 0),
    (5, 1, 2, 'Will ethereum ever see another bull run?', 'test', '<p>test</p>', 0, 0, 0);



/* CREATE COMMENTS */
CREATE TABLE `ramverk1_Comment`
(
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `userId` INTEGER NOT NULL,
    `postId` INTEGER,
    `accepted` BOOLEAN DEFAULT 0,
    `votes` INTEGER DEFAULT 0,
    `text` TEXT,
    `published` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated` DATETIME,
    `deleted` BOOLEAN DEFAULT 0,

    FOREIGN KEY (userId) REFERENCES ramverk1_User(id),
    FOREIGN KEY (postId) REFERENCES ramverk1_Post(id) ON DELETE CASCADE

);

INSERT INTO `ramverk1_Comment` (id, userId, postId, text)
    VALUES
    (1, 1, 1, '<p>First comment in Learn how to trade Bitcoin</p>'),
    (2, 1, 1, '<p>Second comment in Learn how to trade Bitcoin</p>');



/* CREATE REPLY */
CREATE TABLE `ramverk1_Reply`
(
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `userId` INTEGER NOT NULL,
    `commentId` INTEGER,
    `text` VARCHAR(120),
    `published` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated` DATETIME,
    `deleted` BOOLEAN DEFAULT 0,

    FOREIGN KEY (userId) REFERENCES ramverk1_User(id),
    FOREIGN KEY (commentId) REFERENCES ramverk1_Comment(id) ON DELETE CASCADE

);

INSERT INTO `ramverk1_Reply` (id, userId, commentId, text)
    VALUES
    (1, 1, 1, '<p>First reply to comment in Bitcoin</p>'),
    (2, 1, 1, '<p>Second reply to comment in Bitcoin</p>'),
    (3, 1, 2, '<p>First reply to comment in Ethereum</p>');



/* CREATE TAGS */
CREATE TABLE `ramverk1_Tag` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `tag` VARCHAR(255) NOT NULL

);

INSERT INTO `ramverk1_Tag` (id, tag)
    VALUES
    (1, "bitcoin"),
    (2, "ethereum"),
    (3, "eos");



/* CREATE TAG2QUESTIONS */
CREATE TABLE `ramverk1_TagQuestion` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `tagId` INTEGER NOT NULL,
    `postId` INTEGER NOT NULL,

    FOREIGN KEY (tagId) REFERENCES ramverk1_Tag(id) ON DELETE CASCADE,
    FOREIGN KEY (postId) REFERENCES ramverk1_Post(id) ON DELETE CASCADE

);

INSERT INTO `ramverk1_TagQuestion` (id, tagId, postId)
    VALUES
    (1, 1, 1),
    (2, 2, 2),
    (3, 1, 4);



/* CREATE VOTES */
CREATE TABLE `ramverk1_Vote` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `userId` INTEGER NOT NULL,
    `postId` INTEGER,
    `commentId` INTEGER,
    `vote` INT NOT NULL,
    `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (userId) REFERENCES ramverk1_User(id) ON DELETE CASCADE,
    FOREIGN KEY (postId) REFERENCES ramverk1_Post(id) ON DELETE CASCADE,
    FOREIGN KEY (commentId) REFERENCES ramverk1_Comment(id) ON DELETE CASCADE,
    CHECK (vote = 1 OR vote = -1)

);



/* CREATE KARMA */
CREATE TABLE `ramverk1_Karma` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `userId` INTEGER NOT NULL,
    `karma` INTEGER,
    `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (userId) REFERENCES ramverk1_User(id) ON DELETE CASCADE

);
