<?php
/**
 * Routes for Tag controller.
 */
return [
    "routes" => [
        [
            "info" => "All Tags.",
            "requestMethod" => "get",
            "path" => "tags",
            "callable" => ["tagController", "getIndex"],
        ],
        [
            "info" => "View Single",
            "requestMethod" => "get",
            "path" => "tags/{name}",
            "callable" => ["tagController", "getSingleTag"],
        ],
    ]
];
