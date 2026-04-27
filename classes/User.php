<?php
/**
 * Klasa bazë User
 */
class User {
    protected string $username;
    protected string $password;
    protected string $name;
    protected string $email;
    protected string $role;

    public function __construct(string $username, string $password, string $name, string $email, string $role = 'user') {
        $this->username = $username;
        $this->password = $password;
        $this->name     = $name;
        $this->email    = $email;
        $this->role     = $role;
    }

    public function getUsername(): string { return $this->username; }
    public function getName(): string     { return $this->name; }
    public function getEmail(): string    { return $this->email; }
    public function getRole(): string     { return $this->role; }

    public function checkPassword(string $password): bool {
        return $this->password === $password;
    }

    public function isAdmin(): bool {
        return false;
    }

    public function toArray(): array {
        return [
            'username' => $this->username,
            'name'     => $this->name,
            'email'    => $this->email,
            'role'     => $this->role,
        ];
    }
}
