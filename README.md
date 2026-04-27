# Online Car Marketplace — Phase I

Academic project built with PHP, OOP, RegEx validation, Sessions and Cookies.
No database is used in this phase — all data is simulated.

---

## Project Structure

```
car-marketplace/
├── index.php
├── includes/
│   ├── header.php          # Global header, navigation, session/cookie checks
│   ├── footer.php          # Global footer, last_visit session output
│   ├── auth.php            # Hardcoded credentials, authentication functions, role guards
│   └── data.php            # Simulated data: arrays, global variables, Car/LuxuryCar objects
├── classes/
│   ├── Car.php             # Base class: encapsulation, constructor, getters/setters
│   ├── LuxuryCar.php       # Extends Car: inheritance, method overriding
│   ├── User.php            # Base user class: role, authentication logic
│   ├── Admin.php           # Extends User: permissions, isAdmin() override
│   └── Validator.php       # Server-side RegEx validation methods
├── pages/
│   ├── listings.php        # Car listing with filtering and sorting
│   ├── car-detail.php      # Single car view, role-based action buttons
│   ├── contact.php         # Contact form with RegEx-validated fields
│   ├── login.php           # Login form, session initialization, cookie write
│   ├── logout.php          # Session destruction, redirect
│   └── admin.php           # Admin-only panel: statistics, car table, seller list
└── assets/
    ├── css/style.css
    └── js/main.js          # Theme toggle, active nav highlight
```

---

## Requirements

- PHP 8.0 or higher
- No database required
- No external dependencies

---

## Running Locally

### Option 1 — PHP Built-in Server (recommended)

```bash
cd path/to/car-marketplace
php -S localhost:8000
```

Open `http://localhost:8000` in a browser.

### Option 2 — PhpStorm Built-in Server

1. Open the `car-marketplace` folder in PhpStorm
2. Go to **Run > Edit Configurations**
3. Click **+** and select **PHP Built-in Web Server**
4. Set Document Root to the `car-marketplace` directory
5. Click **Run**

### Option 3 — XAMPP

Copy the `car-marketplace` folder to `C:\xampp\htdocs\` and open:
`http://localhost/car-marketplace/`

---

## Demo Accounts

| Username | Password  | Role  |
|----------|-----------|-------|
| admin    | admin123  | admin |
| user1    | user123   | user  |
| user2    | pass456   | user  |

Role differences:
- **admin** — access to `/pages/admin.php`, admin badge in navigation, full statistics panel
- **user** — access to listings and car detail, contact form, no admin panel

---

## Phase I Requirements Coverage

### 1. Application Structure
Four or more functional pages built around the car marketplace domain.
Header, footer and navigation loaded via `require_once` from `includes/`.
Folder architecture separates concerns: `pages/`, `includes/`, `classes/`, `assets/`.

### 2. Login / Logout with Static Credentials
Credentials are hardcoded in `includes/auth.php` as `User` and `Admin` objects.
No database is used.
User state is persisted via `$_SESSION['user']` (stored as array via `toArray()`).
Two roles are enforced with `requireLogin()` and `requireAdmin()` guard functions.

### 3. Core PHP Concepts
Variables, functions, conditionals and loops used throughout.
Global variables declared in `data.php` via `$GLOBALS[]` and accessed with `getSiteName()`.
Array types demonstrated in `data.php`:
- Numeric array: `$brands`
- Associative array: `$fuelTypes`
- Multidimensional array: `$sellers`

Sorting demonstrated in `listings.php` via `usort()` with multiple sort keys,
and in `admin.php` via `arsort()` for fuel type grouping.

### 4. OOP in PHP
Four classes across two inheritance chains:

```
Car
└── LuxuryCar       (overrides isLuxury(), getSummary())

User
└── Admin           (overrides isAdmin(), adds permissions[])
```

All classes use private or protected properties with public getters and setters.
`LuxuryCar` and `Admin` call `parent::__construct()` explicitly.

### 5. RegEx Validation
All validation is server-side in `Validator.php`, called from `contact.php`.

| Method            | Pattern                                      | Purpose                  |
|-------------------|----------------------------------------------|--------------------------|
| validateEmail()   | `/^[a-zA-Z0-9._%+\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,}$/` | Email format  |
| validatePhone()   | `/^(\+3836[0-9]{7}\|0[0-9]{8,9})$/`          | Kosovo phone numbers     |
| validatePrice()   | `/^\d{1,7}(\.\d{1,2})?$/`                    | Positive decimal price   |
| validateYear()    | `/^(19[0-9]{2}\|20[0-2][0-9]\|2025)$/`       | Year between 1900–2025   |

### 6. Sessions and Cookies

Cookies:
- `theme` — stores `light` or `dark`, expires in 30 days, used for UI personalization
- `last_username` — stores the last logged-in username, pre-fills the login form

Sessions:
- `$_SESSION['user']` — associative array with username, name, email, role
- `$_SESSION['login_time']` — timestamp of login, displayed in admin panel
- `$_SESSION['last_visit']` — updated on each page load, shown in footer
