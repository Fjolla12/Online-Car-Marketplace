<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$theme = $_COOKIE['theme'] ?? 'light';

$isSubPage = strpos($_SERVER['PHP_SELF'], '/pages/') !== false;
$basePath  = $isSubPage ? '../' : '';
?>
<!DOCTYPE html>
<html lang="sq" data-theme="<?php echo htmlspecialchars($theme); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) . ' | ' : ''; ?>AutoMarket Kosovo</title>
    <link rel="stylesheet" href="<?php echo $basePath; ?>assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
</head>
<body>

<header class="site-header">
    <div class="container header-inner">
        <a href="<?php echo $basePath; ?>index.php" class="logo">
            🏎️ <span>AutoMarket</span> <em>Kosovo</em>
        </a>

        <nav class="main-nav">
            <a href="<?php echo $basePath; ?>index.php">Kryefaqja</a>
            <a href="<?php echo $basePath; ?>pages/listings.php">Makina</a>
            <a href="<?php echo $basePath; ?>pages/contact.php">Kontakt</a>

            <?php if (isAdmin()): ?>
                <a href="<?php echo $basePath; ?>pages/admin.php" class="nav-admin">⚙️ Admin</a>
            <?php endif; ?>
        </nav>

        <div class="header-actions">
            <button class="btn-theme" id="themeToggle" title="Ndrysho temën">
                <?php echo $theme === 'dark' ? '☀️' : '🌙'; ?>
            </button>

            <?php if (isLoggedIn()): ?>
            <span class="user-badge">
        👤 <?php echo htmlspecialchars($_SESSION['user']['name']); ?>
        <?php if (isAdmin()): ?>
            <small class="role-badge">admin</small>
        <?php endif; ?>
    </span>

    <a href="<?php echo $basePath; ?>pages/profile.php" class="btn btn-sm">
        Profili
    </a>

    <a href="<?php echo $basePath; ?>pages/logout.php" class="btn btn-sm btn-danger">
        Dil
    </a>
<?php else: ?>
                <a href="<?php echo $basePath; ?>pages/login.php" class="btn btn-sm btn-primary">Kyçu</a>
            <?php endif; ?>
        </div>
    </div>
</header>
