USE vibe16;

SET NAMES utf8;

--
-- Table Thread
--
DROP TABLE IF EXISTS ramverk1_Coin;
CREATE TABLE ramverk1_Coin (
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `slug` VARCHAR(255) NOT NULL,
    `description` TEXT NOT NULL,
    `published` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `deleted` BOOLEAN DEFAULT 0

) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

INSERT INTO ramverk1_Coin (id, name, slug, description)
    VALUES
    (1, 'bitcoin', 'bitcoin', 'About bitcoin'),
    (2, 'ethereum', 'ethereum', 'About ethereum'),
    (3, 'ripple', 'ripple', 'About ripple'),
    (4, 'bitcoin cash', 'bitcoin-cash', 'About bitcoin cash'),
    (5, 'eos', 'eos', 'About eos'),
    (6, 'litecoin', 'litecoin', 'About litecoin'),
    (7, 'stellar', 'stellar', 'About stellar'),
    (8, 'cardano', 'cardano', 'About cardano'),
    (9, 'iota', 'iota', 'About iota'),
    (10, 'tron', 'tron', 'About tron'),
    (11, 'neo', 'neo', 'About neo'),
    (12, 'monero', 'monero', 'About monero'),
    (13, 'tether', 'tether', 'About tether'),
    (14, 'dash', 'dash', 'About dash'),
    (15, 'nem', 'nem', 'About nem');
