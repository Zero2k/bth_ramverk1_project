USE anax_project;

SET NAMES utf8;

--
-- Table Post
--
DROP TABLE IF EXISTS ramverk1_Topic;
CREATE TABLE ramverk1_Topic (
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `userId` INTEGER NOT NULL,
    `threadId` INTEGER NOT NULL,
    `title` VARCHAR(100) NOT NULL,
    `text` TEXT NOT NULL,
    `votes` INTEGER DEFAULT 0,
    `answers` INTEGER DEFAULT 0,
    `published` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `deleted` BOOLEAN DEFAULT 0,
    
    FOREIGN KEY (userId) REFERENCES ramverk1_User(id),
    FOREIGN KEY (threadId) REFERENCES ramverk1_Thread(id) ON DELETE CASCADE

) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

INSERT INTO ramverk1_Topic (id, userId, threadId, title, text)
    VALUES
    (1, 1, 1, 'Learn how to trade bitcoin', 'test'),
    (2, 1, 2, 'Learn how to ethereum', 'test');
