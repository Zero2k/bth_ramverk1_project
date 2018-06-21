USE anax_project;

SET NAMES utf8;

--
-- Table Vote
--
DROP TABLE IF EXISTS ramverk1_Vote;
CREATE TABLE ramverk1_Vote (
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `userId` INTEGER NOT NULL,
    `postId` INTEGER,
    `commentId` INTEGER,
    `vote` INT NOT NULL,
    `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (userId) REFERENCES ramverk1_User(id) ON DELETE CASCADE,
    FOREIGN KEY (postId) REFERENCES ramverk1_Post(id) ON DELETE CASCADE,
    FOREIGN KEY (commentId) REFERENCES ramverk1_Comment(id) ON DELETE CASCADE,
    CHECK (vote = 1 OR vote = -1)

) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;
