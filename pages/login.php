<?php
session_start();
require_once '../includes/auth.php';
require_once '../classes/Car.php';
require_once '../classes/LuxuryCar.php';
require_once '../includes/data.php';

if (isLoggedIn()) {
    header('Location: ../index.php');
    exit;
}

$error   = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($username) || empty($password)) {
        $error = 'Ju lutem plotësoni të gjitha fushat.';
    } else {
        $user = authenticateUser($username, $password, $users);
        if ($user) {
            $_SESSION['user']       = $user->toArray();
            $_SESSION['login_time'] = date('Y-m-d H:i:s');
            $_SESSION['last_visit'] = date('Y-m-d H:i:s');

            setcookie('last_username', $username, time() + (86400 * 7), '/');

            header('Location: ../index.php');
            exit;
        } else {
            $error = 'Kredencialet janë të gabuara. Provoni përsëri.';
        }
    }
}

$savedUsername = $_COOKIE['last_username'] ?? '';

$pageTitle = 'Kyçu';
require_once '../includes/header.php';
?>

    <main class="container">
        <div class="auth-wrap">
            <div class="auth-box">
                <h1>🔐 Kyçu</h1>
                <p class="auth-sub">Mirë se vini në AutoMarket Kosovo</p>

                <?php if ($error): ?>
                    <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>

                <form method="POST" action="">
                    <div class="form-group">
                        <label for="username">Emri i përdoruesit</label>
                        <input
                                type="text"
                                id="username"
                                name="username"
                                value="<?php echo htmlspecialchars($savedUsername); ?>"
                                placeholder="p.sh. admin ose user1"
                                required
                        >
                    </div>
                    <div class="form-group">
                        <label for="password">Fjalëkalimi</label>
                        <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="Fjalëkalimi juaj"
                                required
                        >
                    </div>
                    <button type="submit" class="btn btn-primary btn-full">Kyçu →</button>
                </form>

                <div class="auth-hints">
                    <p>📌 Llogaritë demo:</p>
                    <code>admin / admin123</code> — rol: Admin<br>
                    <code>user1 / user123</code> — rol: Përdorues
                </div>
            </div>
        </div>
    </main>

<?php require_once '../includes/footer.php'; ?>