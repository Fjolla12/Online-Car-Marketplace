<?php
session_start();
require_once '../includes/auth.php';
require_once '../classes/Car.php';
require_once '../classes/LuxuryCar.php';
require_once '../classes/Validator.php';
require_once '../includes/data.php';

requireLogin();
requireAdmin();

$pageTitle = 'Panel Admin';

$totalCars   = count($cars);
$luxuryCars  = count(array_filter($cars, fn($c) => $c->isLuxury()));
$newCars     = count(array_filter($cars, fn($c) => $c->getCondition() === 'new'));
$avgPrice    = array_sum(array_map(fn($c) => $c->getPrice(), $cars)) / $totalCars;

$sortedCars = $cars;
usort($sortedCars, fn($a, $b) => $b->getPrice() - $a->getPrice());

$byFuel = [];
foreach ($cars as $car) {
    $fuel = $car->getFuelType();
    if (!isset($byFuel[$fuel])) $byFuel[$fuel] = 0;
    $byFuel[$fuel]++;
}
arsort($byFuel);

require_once '../includes/header.php';
?>

<main class="container">
    <h1 class="page-title">⚙️ Panel Admin</h1>
    <p>Mirë se vini, <strong><?php echo htmlspecialchars($_SESSION['user']['name']); ?></strong>!
       Kyçja juaj: <?php echo $_SESSION['login_time'] ?? '—'; ?></p>

    <div class="stats-grid">
        <div class="stat-card">
            <span class="stat-big"><?php echo $totalCars; ?></span>
            <span class="stat-lbl">Gjithsej Makina</span>
        </div>
        <div class="stat-card luxury-card">
            <span class="stat-big"><?php echo $luxuryCars; ?></span>
            <span class="stat-lbl">Makina Luksoze</span>
        </div>
        <div class="stat-card">
            <span class="stat-big"><?php echo $newCars; ?></span>
            <span class="stat-lbl">Makina të Reja</span>
        </div>
        <div class="stat-card">
            <span class="stat-big">€<?php echo number_format($avgPrice, 0); ?></span>
            <span class="stat-lbl">Çmimi Mesatar</span>
        </div>
    </div>

    <section class="section">
        <h2>📊 Karburanti (sipas llojit)</h2>
        <div class="fuel-bars">
            <?php foreach ($byFuel as $fuel => $count): ?>
                <div class="fuel-row">
                    <span class="fuel-name"><?php echo htmlspecialchars($fuel); ?></span>
                    <div class="fuel-bar-bg">
                        <div class="fuel-bar-fill" style="width: <?php echo ($count / $totalCars * 100); ?>%"></div>
                    </div>
                    <span class="fuel-count"><?php echo $count; ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="section">
        <h2>📋 Të gjitha Makinat (sipas çmimit)</h2>
        <div class="table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Brand/Model</th>
                        <th>Viti</th>
                        <th>Çmimi</th>
                        <th>Km</th>
                        <th>Karburanti</th>
                        <th>Lloji</th>
                        <th>Shitësi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sortedCars as $car): ?>
                        <tr class="<?php echo $car->isLuxury() ? 'row-luxury' : ''; ?>">
                            <td><?php echo $car->getId(); ?></td>
                            <td><strong><?php echo htmlspecialchars($car->getBrand() . ' ' . $car->getModel()); ?></strong></td>
                            <td><?php echo $car->getYear(); ?></td>
                            <td>€<?php echo number_format($car->getPrice()); ?></td>
                            <td><?php echo number_format($car->getMileage()); ?></td>
                            <td><?php echo htmlspecialchars($car->getFuelType()); ?></td>
                            <td><?php echo $car->isLuxury() ? '🏎️ Luxury' : '🚗 Standard'; ?></td>
                            <td><?php echo htmlspecialchars($car->getSellerName()); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>

    <section class="section">
        <h2>👥 Shitësit</h2>
        <div class="sellers-grid">
            <?php foreach ($sellers as $seller): ?>
                <div class="seller-card">
                    <h3><?php echo htmlspecialchars($seller['name']); ?></h3>
                    <p>📍 <?php echo htmlspecialchars($seller['city']); ?></p>
                    <p>⭐ <?php echo $seller['rating']; ?>/5.0</p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<?php require_once '../includes/footer.php'; ?>
