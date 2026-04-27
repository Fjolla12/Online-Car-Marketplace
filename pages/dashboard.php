<?php
session_start();

require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../classes/Car.php';
require_once __DIR__ . '/../classes/LuxuryCar.php';
require_once __DIR__ . '/../includes/data.php';

requireLogin();
requireAdmin();

$totalCars = count($cars);
$luxuryCars = 0;
$totalPrice = 0;
$totalMileage = 0;

foreach ($cars as $car) {
    $totalPrice += $car->getPrice();
    $totalMileage += $car->getMileage();

    if ($car->isLuxury()) {
        $luxuryCars++;
    }
}

$averagePrice = $totalCars > 0 ? $totalPrice / $totalCars : 0;
$averageMileage = $totalCars > 0 ? $totalMileage / $totalCars : 0;

usort($cars, function ($a, $b) {
    return $b->getPrice() - $a->getPrice();
});

$topCars = array_slice($cars, 0, 6);

require_once __DIR__ . '/../includes/header.php';
?>

<main class="container">

    <section class="section">
        <h1 class="section-title">Admin Dashboard</h1>
        <p>Panel për menaxhimin dhe analizimin e makinave në platformë.</p>

        <a href="admin.php" class="btn btn-primary">Admin Panel</a>
        <a href="listings.php" class="btn btn-outline">Shiko Makinat</a>
    </section>

    <section class="section">
        <h2 class="section-title">Statistikat Kryesore</h2>

        <div class="hero-stats">
            <div class="stat-box">
                <span class="stat-num"><?php echo $totalCars; ?></span>
                <span class="stat-label">Makina gjithsej</span>
            </div>

            <div class="stat-box">
                <span class="stat-num"><?php echo $luxuryCars; ?></span>
                <span class="stat-label">Makina luksoze</span>
            </div>

            <div class="stat-box">
                <span class="stat-num">€<?php echo number_format($averagePrice); ?></span>
                <span class="stat-label">Çmimi mesatar</span>
            </div>

            <div class="stat-box">
                <span class="stat-num"><?php echo number_format($averageMileage); ?> km</span>
                <span class="stat-label">Kilometrazha mesatare</span>
            </div>
        </div>
    </section>

    <section class="section">
        <h2 class="section-title">Makinat me Çmimin më të Lartë</h2>

        <div class="cars-grid">
            <?php foreach ($topCars as $car): ?>
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

                            <a href="car-detail.php?id=<?php echo $car->getId(); ?>" class="btn btn-sm">
                                Detajet
                            </a>
                        </div>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="section">
        <h2 class="section-title">Menaxhimi i Makinave</h2>

        <table border="1" cellpadding="10" cellspacing="0" style="width:100%;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Marka</th>
                    <th>Modeli</th>
                    <th>Viti</th>
                    <th>Karburanti</th>
                    <th>Kilometrazha</th>
                    <th>Çmimi</th>
                    <th>Tipi</th>
                    <th>Veprime</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($cars as $car): ?>
                    <tr>
                        <td><?php echo $car->getId(); ?></td>
                        <td><?php echo htmlspecialchars($car->getBrand()); ?></td>
                        <td><?php echo htmlspecialchars($car->getModel()); ?></td>
                        <td><?php echo $car->getYear(); ?></td>
                        <td><?php echo htmlspecialchars($car->getFuelType()); ?></td>
                        <td><?php echo number_format($car->getMileage()); ?> km</td>
                        <td>€<?php echo number_format($car->getPrice()); ?></td>
                        <td>
                            <?php echo $car->isLuxury() ? 'Luxury' : 'Standard'; ?>
                        </td>
                        <td>
                            <a href="car-detail.php?id=<?php echo $car->getId(); ?>" class="btn btn-sm">
                                Shiko
                            </a>
                            <button class="btn btn-sm" disabled>Edit</button>
                            <button class="btn btn-sm" disabled>Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <p style="margin-top:1rem;">
            <strong>Shënim:</strong>
            Në Fazën I të dhënat janë dummy, prandaj Edit/Delete janë vetëm të shfaqura.
            Në Fazën II lidhen me databazë dhe bëhen funksionale me CRUD.
        </p>
    </section>

</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>