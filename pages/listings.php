<?php
global $cars;
session_start();
require_once '../includes/auth.php';
require_once '../classes/Car.php';
require_once '../classes/LuxuryCar.php';
require_once '../includes/data.php';

$pageTitle = 'Makina';

$sortBy     = $_GET['sort']      ?? 'price_asc';
$filterFuel = $_GET['fuel']      ?? '';
$filterType = $_GET['type']      ?? '';
$search     = trim($_GET['search'] ?? '');

$filtered = $cars;

if ($search !== '') {
    $filtered = array_filter($filtered, function($car) use ($search) {
        return stripos($car->getBrand() . ' ' . $car->getModel(), $search) !== false;
    });
}

if ($filterFuel !== '') {
    $filtered = array_filter($filtered, function($car) use ($filterFuel) {
        return $car->getFuelType() === $filterFuel;
    });
}

if ($filterType === 'luxury') {
    $filtered = array_filter($filtered, fn($car) => $car->isLuxury());
} elseif ($filterType === 'standard') {
    $filtered = array_filter($filtered, fn($car) => !$car->isLuxury());
}

switch ($sortBy) {
    case 'price_asc':
        usort($filtered, fn($a, $b) => $a->getPrice() - $b->getPrice());
        break;
    case 'price_desc':
        usort($filtered, fn($a, $b) => $b->getPrice() - $a->getPrice());
        break;
    case 'year_desc':
        usort($filtered, fn($a, $b) => $b->getYear() - $a->getYear());
        break;
    case 'year_asc':
        usort($filtered, fn($a, $b) => $a->getYear() - $b->getYear());
        break;
    case 'mileage_asc':
        usort($filtered, fn($a, $b) => $a->getMileage() - $b->getMileage());
        break;
}

require_once '../includes/header.php';
?>

<main class="container">
    <h1 class="page-title">🚗 Të gjitha Makinat</h1>

    <!-- Filtra -->
    <form method="GET" action="" class="filter-bar">
        <input
            type="text"
            name="search"
            placeholder="Kërko brand ose model..."
            value="<?php echo htmlspecialchars($search); ?>"
            class="filter-input"
        >

        <select name="fuel" class="filter-select">
            <option value="">Të gjitha karburantet</option>
            <?php foreach (['Benzinë','Naftë','Hibrid','Elektrik'] as $f): ?>
                <option value="<?php echo $f; ?>" <?php echo $filterFuel === $f ? 'selected' : ''; ?>>
                    <?php echo $f; ?>
                </option>
            <?php endforeach; ?>
        </select>

        <select name="type" class="filter-select">
            <option value="">Të gjitha llojet</option>
            <option value="luxury"   <?php echo $filterType === 'luxury'   ? 'selected' : ''; ?>>Luxury</option>
            <option value="standard" <?php echo $filterType === 'standard' ? 'selected' : ''; ?>>Standard</option>
        </select>

        <select name="sort" class="filter-select">
            <option value="price_asc"   <?php echo $sortBy === 'price_asc'   ? 'selected' : ''; ?>>Çmimi ↑</option>
            <option value="price_desc"  <?php echo $sortBy === 'price_desc'  ? 'selected' : ''; ?>>Çmimi ↓</option>
            <option value="year_desc"   <?php echo $sortBy === 'year_desc'   ? 'selected' : ''; ?>>Viti (ri)</option>
            <option value="year_asc"    <?php echo $sortBy === 'year_asc'    ? 'selected' : ''; ?>>Viti (vjetër)</option>
            <option value="mileage_asc" <?php echo $sortBy === 'mileage_asc' ? 'selected' : ''; ?>>Kilometrazh ↑</option>
        </select>

        <button type="submit" class="btn btn-primary">Kërko</button>
        <a href="listings.php" class="btn btn-outline">Pastro</a>
    </form>

    <p class="results-count">
        Gjendur: <strong><?php echo count($filtered); ?></strong> makina
    </p>

    <?php if (empty($filtered)): ?>
        <div class="empty-state">
            <p>😕 Nuk u gjet asnjë makinë me këto kritere.</p>
            <a href="listings.php" class="btn btn-outline">Shiko të gjitha</a>
        </div>
    <?php else: ?>
        <div class="cars-grid">
            <?php foreach ($filtered as $car): ?>
                <div class="car-card <?php echo $car->isLuxury() ? 'luxury' : ''; ?>">
                    <?php if ($car->isLuxury()): ?>
                        <span class="badge-luxury">LUXURY</span>
                    <?php endif; ?>
                    <div class="car-img-placeholder">
                        <span class="car-icon"><?php echo $car->isLuxury() ? '🏎️' : '🚗'; ?></span>
                    </div>
                    <div class="car-info">
                        <h3><?php echo htmlspecialchars($car->getBrand() . ' ' . $car->getModel()); ?></h3>
                        <p class="car-year">📅 <?php echo $car->getYear(); ?> &nbsp;|&nbsp; 🛣️ <?php echo number_format($car->getMileage()); ?> km</p>
                        <p class="car-fuel">⛽ <?php echo htmlspecialchars($car->getFuelType()); ?></p>
                        <p class="car-condition">
                            <?php echo $car->getCondition() === 'new' ? '🟢 I ri' : '🔵 I përdorur'; ?>
                        </p>
                        <div class="car-footer">
                            <span class="car-price">€<?php echo number_format($car->getPrice()); ?></span>
                            <a href="car-detail.php?id=<?php echo $car->getId(); ?>" class="btn btn-sm">Detajet</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</main>

<?php require_once '../includes/footer.php'; ?>
