USE vibe16;

SET NAMES utf8;

--
-- Table Post
--
DROP TABLE IF EXISTS ramverk1_Post;
CREATE TABLE ramverk1_Post (
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
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

) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

INSERT INTO ramverk1_Post (id, userId, coinId, title, text, html, views, votes, answers)
    VALUES
    (1, 1, 1, 'Learn how to trade bitcoin', 'test', '<p>test</p>', 0, 0, 0),
    (2, 1, 2, 'Learn how to trade ethereum', 'test', '<p>test</p>', 0, 0, 0),
    (3, 1, 1, 'Is bitcoin legal in sweden?', 'test', '<p>test</p>', 0, 0, 0),
    (4, 1, 1, 'What would you do to recover lost Bitcoins?', 'test', '<p>test</p>', 0, 0, 0),
    (5, 1, 2, 'Will ethereum ever see another bull run?', 'test', '<p>test</p>', 0, 0, 0);
