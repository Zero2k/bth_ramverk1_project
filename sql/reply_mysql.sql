USE vibe16;

SET NAMES utf8;

--
-- Table Reply
--
DROP TABLE IF EXISTS ramverk1_Reply;
CREATE TABLE ramverk1_Reply
(
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `userId` INTEGER NOT NULL,
    `commentId` INTEGER,
    `text` TEXT,
    `published` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated` DATETIME,
    `deleted` BOOLEAN DEFAULT 0,

    FOREIGN KEY (userId) REFERENCES ramverk1_User(id),
    FOREIGN KEY (commentId) REFERENCES ramverk1_Comment(id) ON DELETE CASCADE

) ENGINE INNODB CHARACTER SET utf8;

INSERT INTO ramverk1_Reply (id, userId, commentId, text)
    VALUES
    (1, 1, 1, '<p>First reply to comment in Bitcoin</p>'),
    (2, 1, 1, '<p>Second reply to comment in Bitcoin</p>');
