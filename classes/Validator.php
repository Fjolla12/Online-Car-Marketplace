<?php

class Validator {
    private array $errors = [];

    public function validateEmail(string $email): bool {
        $pattern = '/^[a-zA-Z0-9._%+\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,}$/';
        if (!preg_match($pattern, $email)) {
            $this->errors[] = "Email adresa nuk është e vlefshme.";
            return false;
        }
        return true;
    }

    public function validatePhone(string $phone): bool {
        $pattern = '/^(\+3836[0-9]{7}|0[0-9]{8,9})$/';
        if (!preg_match($pattern, $phone)) {
            $this->errors[] = "Numri i telefonit nuk është i vlefshëm. (Shembull: +38344123456 ose 044123456)";
            return false;
        }
        return true;
    }

    public function validatePrice(string $price): bool {
        $pattern = '/^\d{1,7}(\.\d{1,2})?$/';
        if (!preg_match($pattern, $price) || (float)$price <= 0) {
            $this->errors[] = "Çmimi duhet të jetë numër pozitiv (p.sh. 15000 ose 9500.50).";
            return false;
        }
        return true;
    }

    public function validateYear(string $year): bool {
        $pattern = '/^(19[0-9]{2}|20[0-2][0-9]|2025)$/';
        if (!preg_match($pattern, $year)) {
            $this->errors[] = "Viti duhet të jetë ndërmjet 1900 dhe 2025.";
            return false;
        }
        return true;
    }

    public function getErrors(): array { return $this->errors; }
    public function hasErrors(): bool  { return count($this->errors) > 0; }
    public function clearErrors(): void { $this->errors = []; }
}
