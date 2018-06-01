<?php
/**
 * Routes to pages.
 */
return [
    "routes" => [
        [
            "info" => "Home.",
            "requestMethod" => null,
            "path" => "/",
            "callable" => ["pageController", "getIndex"],
        ],
        [
            "info" => "About.",
            "requestMethod" => null,
            "path" => "about",
            "callable" => ["pageController", "getAbout"],
        ]
    ]
];
