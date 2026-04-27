<?php
    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }

    define("USERS",[
        [
            "username" => "user",
            "password" => "1234",
            "role" => "user"
        ],
        [
            "username" => "admin",
            "password" => "admin123",
            "role" => "admin"
        ]

    ]);

?>