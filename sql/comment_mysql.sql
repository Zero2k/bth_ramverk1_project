USE anax_project;

SET NAMES utf8;

--
-- Table Comment
--
DROP TABLE IF EXISTS ramverk1_Comment;
CREATE TABLE ramverk1_Comment
(
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `userId` INTEGER NOT NULL,
    `postId` INTEGER NOT NULL,
    `score` INTEGER DEFAULT 0,
    `text` VARCHAR(120),
    `published` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated` DATETIME ON UPDATE CURRENT_TIMESTAMP, --  ON UPDATE CURRENT_TIMESTAMP,
    `deleted` BOOLEAN DEFAULT 0,

    FOREIGN KEY (userId) REFERENCES ramverk1_User(id),
    FOREIGN KEY (postId) REFERENCES ramverk1_Post(id) ON DELETE CASCADE

) ENGINE INNODB CHARACTER SET utf8;

INSERT INTO ramverk1_Comment (id, userId, postId, text)
    VALUES
    (1, 1, 1, 'First comment in Learn how to trade Bitcoin'),
    (2, 1, 1, 'Second comment in Learn how to trade Bitcoin');
