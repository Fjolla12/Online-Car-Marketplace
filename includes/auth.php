<?php
require_once __DIR__ . '/../classes/User.php';
require_once __DIR__ . '/../classes/Admin.php';


$users = [
    new Admin('admin',  'admin123', 'Administratori',  'admin@carmarket.com'),
    new User ('user1',  'user123',  'Besnik Krasniqi', 'besnik@email.com'),
    new User ('user2',  'pass456',  'Arjeta Morina',   'arjeta@email.com'),
];

function authenticateUser(string $username, string $password, array $users): ?User {
    foreach ($users as $user) {
        if ($user->getUsername() === $username && $user->checkPassword($password)) {
            return $user;
        }
    }
    return null;
}

function isLoggedIn(): bool {
    return isset($_SESSION['user']);
}


function isAdmin(): bool {
    return isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'admin';
}

function requireLogin(string $redirectTo = '../pages/login.php'): void {
    if (!isLoggedIn()) {
        header("Location: $redirectTo");
        exit;
    }
}


function requireAdmin(string $redirectTo = '../index.php'): void {
    if (!isAdmin()) {
        header("Location: $redirectTo");
        exit;
    }
}