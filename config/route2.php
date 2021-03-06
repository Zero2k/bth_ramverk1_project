<?php

use \Anax\Route\Router;

/**
 * Configuration file for routes.
 */
return [
    //"mode" => Router::DEVELOPMENT, // default, verbose execeptions
    //"mode" => Router::PRODUCTION,  // exceptions turn into 500

    // Load these routefiles in order specified and optionally mount them
    // onto a base route.
    "routeFiles" => [
        [
            "mount" => null,
            "file" => __DIR__ . "/route2/routes.php",
        ],
        [
            // Add routes from userController and mount on user/
            "mount" => null,
            "file" => __DIR__ . "/route2/userController.php",
        ],
        [
            // Add routes from coinController and mount on coin/
            "mount" => null,
            "file" => __DIR__ . "/route2/coinController.php",
        ],
        [
            // Add routes from postController and mount on post/
            "mount" => null,
            "file" => __DIR__ . "/route2/postController.php",
        ],
        [
            // Add routes from tagController and mount on tags/
            "mount" => null,
            "file" => __DIR__ . "/route2/tagController.php",
        ],
        [
            // These are for internal error handling and exceptions
            "mount" => null,
            "file" => __DIR__ . "/route2/internal.php",
        ],
        [
            // For debugging and development details on Anax
            "mount" => "debug",
            "file" => __DIR__ . "/route2/debug.php",
        ],
        [
            // To read flat file content in Markdown from content/
            "mount" => null,
            "file" => __DIR__ . "/route2/flat-file-content.php",
        ],
        [
            // Keep this last since its a catch all
            "mount" => null,
            "sort" => 999,
            "file" => __DIR__ . "/route2/404.php",
        ],
    ],

];
