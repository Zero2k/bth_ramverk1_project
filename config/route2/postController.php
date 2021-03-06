<?php
/**
 * Routes for Post / Questions controller.
 */
return [
    "routes" => [
        [
            "info" => "All Posts / Questions.",
            "requestMethod" => "get",
            "path" => "questions",
            "callable" => ["postController", "getIndex"],
        ],
        [
            "info" => "Single Post / Question.",
            "requestMethod" => "get|post",
            "path" => "questions/{id:digit}",
            "callable" => ["postController", "getSinglePost"],
        ],
        [
            "info" => "Add Post / Question.",
            "requestMethod" => "get|post",
            "path" => "questions/new",
            "callable" => ["postController", "addPost"],
        ],
        [
            "info" => "Edit Post / Question.",
            "requestMethod" => "get|post",
            "path" => "questions/edit/{id:digit}",
            "callable" => ["postController", "editPost"],
        ]
    ]
];
