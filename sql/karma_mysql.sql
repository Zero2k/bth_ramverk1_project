USE vibe16;

SET NAMES utf8;

--
-- Table Karma
--
DROP TABLE IF EXISTS ramverk1_Karma;
CREATE TABLE ramverk1_Karma (
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `userId` INTEGER NOT NULL,
    `karma` INTEGER,
    `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (userId) REFERENCES ramverk1_User(id) ON DELETE CASCADE

) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

INSERT INTO ramverk1_Karma (id, userId, karma)
    VALUES
    (1, 1, 5);
