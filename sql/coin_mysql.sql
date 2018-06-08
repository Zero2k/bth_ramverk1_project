USE anax_project;

SET NAMES utf8;

--
-- Table Thread
--
DROP TABLE IF EXISTS ramverk1_Coin;
CREATE TABLE ramverk1_Coin (
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `description` TEXT NOT NULL,
    `published` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `deleted` BOOLEAN DEFAULT 0

) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

INSERT INTO ramverk1_Coin (id, name, description)
    VALUES
    (1, 'bitcoin', 'About bitcoin'),
    (2, 'ethereum', 'About ethereum'),
    (3, 'ripple', 'About ripple'),
    (4, 'bitcoin cash', 'About bitcoin cash'),
    (5, 'eos', 'About eos'),
    (6, 'litecoin', 'About litecoin'),
    (7, 'stellar', 'About stellar'),
    (8, 'cardano', 'About cardano'),
    (9, 'iota', 'About iota'),
    (10, 'tron', 'About tron'),
    (11, 'neo', 'About neo'),
    (12, 'monero', 'About monero'),
    (13, 'tether', 'About tether'),
    (14, 'dash', 'About dash'),
    (15, 'nem', 'About nem');
