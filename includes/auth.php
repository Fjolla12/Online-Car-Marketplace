<?php
    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }

    function isLoggedIn(){
        return isset($_SESSION['user']);
    }

    function checkLogin(){
        if(!isLoggedIn()){
            header("Location: login.php");
            exit();
        }
    }

    function checkAdmin(){
        if(!isLoggedIn() || ($_SESSION['user']['role'] ?? null) !== 'admin'){
            header("Location: index.php");
            exit();
        }
    }

    function requireRole($role){
        if(!isLoggedIn() || ($_SESSION['user']['role'] ?? null) !== $role){
            header("Location: index.php");
            exit();
        }
    }

    function currentUser(){
        return $_SESSION['user'] ?? null;
    }

?>