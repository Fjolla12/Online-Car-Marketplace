<?php
require_once __DIR__ . '/User.php';

/**
 * Klasa Admin – extends User
 * Ka të drejta shtesë
 */
class Admin extends User {
    private array $permissions;

    public function __construct(string $username, string $password, string $name, string $email) {
        parent::__construct($username, $password, $name, $email, 'admin');
        $this->permissions = ['view_admin', 'manage_cars', 'view_users'];
    }

    public function isAdmin(): bool { return true; }

    public function getPermissions(): array { return $this->permissions; }

    public function hasPermission(string $permission): bool {
        return in_array($permission, $this->permissions);
    }
}
