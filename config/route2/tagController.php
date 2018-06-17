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
        ]
    ]
];
