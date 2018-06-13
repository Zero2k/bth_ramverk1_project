<?php
/**
 * Routes for coin controller.
 */
return [
    "routes" => [
        [
            "info" => "All coins.",
            "requestMethod" => "get",
            "path" => "coin",
            "callable" => ["coinController", "getIndex"],
        ],
        [
            "info" => "Single coin.",
            "requestMethod" => "get",
            "path" => "coin/{name}",
            "callable" => ["coinController", "getSingleCoin"],
        ],
    ]
];
