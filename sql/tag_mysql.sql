USE vibe16;

SET NAMES utf8;

--
-- Table Tag
--
DROP TABLE IF EXISTS ramverk1_Tag;
CREATE TABLE ramverk1_Tag (
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `tag` VARCHAR(255) NOT NULL

) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

INSERT INTO ramverk1_Tag (id, tag)
    VALUES
    (1, "bitcoin"),
    (2, "ethereum"),
    (3, "eos");
