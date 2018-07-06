USE vibe16;

SET NAMES utf8;

--
-- Table TagQuestion
--
DROP TABLE IF EXISTS ramverk1_TagQuestion;
CREATE TABLE ramverk1_TagQuestion (
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `tagId` INTEGER NOT NULL,
    `postId` INTEGER NOT NULL,

    FOREIGN KEY (tagId) REFERENCES ramverk1_Tag(id) ON DELETE CASCADE,
    FOREIGN KEY (postId) REFERENCES ramverk1_Post(id) ON DELETE CASCADE

) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

INSERT INTO ramverk1_TagQuestion (id, tagId, postId)
    VALUES
    (1, 1, 1),
    (2, 2, 2),
    (3, 1, 4);
