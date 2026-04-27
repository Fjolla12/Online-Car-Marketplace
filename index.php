<?php
session_start();

/* =========================
   COOKIES (Theme)
========================= */
if (!isset($_COOKIE['theme'])) {
    setcookie('theme', 'light', time() + (86400 * 30), '/');
    $theme = 'light';
} else {
    $theme = $_COOKIE['theme'];
}

/* =========================
   SESSION (Last visit)
========================= */
if (isset($_SESSION['user'])) {
    $_SESSION['last_visit'] = date('Y-m-d H:i:s');
}

/* =========================
   INCLUDES
========================= */
require_once 'includes/auth.php';
require_once 'includes/header.php';
require_once 'classes/Car.php';
require_once 'classes/LuxuryCar.php';
require_once 'includes/data.php';

/* =========================
   SORTIM + FEATURED
========================= */
usort($cars, function($a, $b) {
    return $a->getPrice() - $b->getPrice();
});

$featuredCars = array_slice($cars, 0, 6);
?>

<main class="container">

    <!-- HERO -->
    <section class="hero">
        <div class="hero-text">
            <h1>Gjej Makinën <span class="accent">Tënde</span> të Ëndrrave</h1>
            <p>Mbi 500 makina të verifikuara nga shitës të besuar në të gjithë Kosovën.</p>

            <a href="pages/listings.php" class="btn btn-primary">Shfleto Makinat</a>

            <!-- LOGIN / DASHBOARD -->
            <?php if (isset($_SESSION['user']) && isAdmin()): ?>
                <a href="pages/dashboard.php" class="btn btn-outline">Dashboard</a>

            <?php elseif (!isset($_SESSION['user'])): ?>
                <a href="pages/login.php" class="btn btn-outline">Kyçu</a>
            <?php endif; ?>

        </div>

        <div class="hero-stats">
            <div class="stat-box">
                <span class="stat-num">500+</span>
                <span class="stat-label">Makina</span>
            </div>
            <div class="stat-box">
                <span class="stat-num">120+</span>
                <span class="stat-label">Shitës</span>
            </div>
            <div class="stat-box">
                <span class="stat-num">99%</span>
                <span class="stat-label">Kënaqësi</span>
            </div>
        </div>
    </section>

    <!-- FEATURED CARS -->
    <section class="section">
        <h2 class="section-title">Makinat e Featuara</h2>

        <div class="cars-grid">
            <?php foreach ($featuredCars as $car): ?>
                <div class="car-card <?php echo $car->isLuxury() ? 'luxury' : ''; ?>">

                    <?php if ($car->isLuxury()): ?>
                        <span class="badge-luxury">LUXURY</span>
                    <?php endif; ?>

                    <div class="car-img-placeholder">
                        <span class="car-icon">🚗</span>
                    </div>

                    <div class="car-info">
                        <h3>
                            <?php echo htmlspecialchars($car->getBrand() . ' ' . $car->getModel()); ?>
                        </h3>

                        <p class="car-year">
                            📅 <?php echo $car->getYear(); ?>
                            &nbsp;|&nbsp;
                            🛣️ <?php echo number_format($car->getMileage()); ?> km
                        </p>

                        <p class="car-fuel">
                            ⛽ <?php echo htmlspecialchars($car->getFuelType()); ?>
                        </p>

                        <?php if ($car->isLuxury()): ?>
                            <p class="car-features">
                                ✨ <?php echo htmlspecialchars($car->getFeatures()); ?>
                            </p>
                        <?php endif; ?>

                        <div class="car-footer">
                            <span class="car-price">
                                €<?php echo number_format($car->getPrice()); ?>
                            </span>

                            <a href="pages/car-detail.php?id=<?php echo $car->getId(); ?>" class="btn btn-sm">
                                Detajet
                            </a>
                        </div>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>

        <div style="text-align:center; margin-top:2rem;">
            <a href="pages/listings.php" class="btn btn-outline">Shiko të gjitha →</a>
        </div>
    </section>

</main>

<?php require_once 'includes/footer.php'; ?>