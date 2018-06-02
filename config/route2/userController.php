<?php
/**
 * Routes for user controller.
 */
return [
    "routes" => [
        [
            "info" => "User Controller index.",
            "requestMethod" => "get",
            "path" => "",
            "callable" => ["userController", "getIndex"],
        ],
        [
            "info" => "Login a user.",
            "requestMethod" => "get|post",
            "path" => "login",
            "callable" => ["userController", "getPostLogin"],
        ],
        [
            "info" => "Create a user.",
            "requestMethod" => "get|post",
            "path" => "sign-up",
            "callable" => ["userController", "getPostCreateUser"],
        ],
    ]
];
