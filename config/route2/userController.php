<?php
/**
 * Routes for user controller.
 */
return [
    "routes" => [
        [
            "info" => "User profile.",
            "requestMethod" => "get",
            "path" => "profile",
            "callable" => ["userController", "viewUserProfile"],
        ],
        [
            "info" => "User profile.",
            "requestMethod" => "get",
            "path" => "profile/{id:digit}",
            "callable" => ["userController", "viewUserProfile"],
        ],
        [
            "info" => "User settings.",
            "requestMethod" => "get|post",
            "path" => "profile/settings",
            "callable" => ["userController", "viewUserSettings"],
        ],
        [
            "info" => "User settings.",
            "requestMethod" => "get",
            "path" => "users",
            "callable" => ["userController", "viewAllUsers"],
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
        [
            "info" => "Logout user.",
            "requestMethod" => "get|post",
            "path" => "logout",
            "callable" => ["userController", "logoutUser"],
        ],
    ]
];
