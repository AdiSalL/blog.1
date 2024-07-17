<?php

function getDatabaseConfig():array {
    return [
        "database" => [
            "host" => "mysql:host=localhost:3306;dbname=blog_db",
            "user" => "root",
            "password" => ""
        ]
    ];
}