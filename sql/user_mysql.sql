USE anax_project;

SET NAMES utf8;

--
-- Table User
--
DROP TABLE IF EXISTS ramverk1_User;
CREATE TABLE ramverk1_User (
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `username` VARCHAR(80) UNIQUE NOT NULL,
    `email` VARCHAR(255) UNIQUE NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `country` VARCHAR(255),
    `city` VARCHAR(255),
    `website` VARCHAR(255),
    `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `deleted` DATETIME,
    `admin` BOOLEAN DEFAULT 0

) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

INSERT INTO ramverk1_User (id, username, email, password, admin)
    VALUES
    (1, 'test', 'test@test.com', 'test', 0),
    (2, 'admin', 'admin@test.com', 'admin', 1);
