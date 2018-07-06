USE vibe16;

SET NAMES utf8;

--
-- Table Comment
--
DROP TABLE IF EXISTS ramverk1_Comment;
CREATE TABLE ramverk1_Comment
(
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
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

) ENGINE INNODB CHARACTER SET utf8;

INSERT INTO ramverk1_Comment (id, userId, postId, text)
    VALUES
    (1, 1, 1, '<p>First comment in Learn how to trade Bitcoin</p>'),
    (2, 1, 1, '<p>Second comment in Learn how to trade Bitcoin</p>');
