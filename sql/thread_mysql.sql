USE anax_project;

SET NAMES utf8;

--
-- Table Thread
--
DROP TABLE IF EXISTS ramverk1_Thread;
CREATE TABLE ramverk1_Thread (
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `description` TEXT NOT NULL,
    `published` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `deleted` BOOLEAN DEFAULT 0

) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

INSERT INTO ramverk1_Thread (id, name, description)
    VALUES
    (1, 'bitcoin', 'About bitcoin'),
    (2, 'ethereum', 'About ethereum'),
    (3, 'ripple', 'About ripple'),
    (4, 'bitcoin cash', 'About bitcoin cash');
