<?php
global $cars;
session_start();
require_once '../includes/auth.php';
require_once '../classes/Car.php';
require_once '../classes/LuxuryCar.php';
require_once '../includes/data.php';

$id  = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$car = null;

foreach ($cars as $c) {
    if ($c->getId() === $id) {
        $car = $c;
        break;
    }
}

if (!$car) {
    header('Location: listings.php');
    exit;
}

$pageTitle = $car->getBrand() . ' ' . $car->getModel();
require_once '../includes/header.php';
?>

<main class="container">
    <a href="listings.php" class="back-link">← Kthehu te lista</a>

    <div class="detail-wrap">
       <div class="detail-image">
    <img 
        src="../assets/images/cars/<?php echo htmlspecialchars($car->getImage()); ?>" 
        alt="<?php echo htmlspecialchars($car->getBrand() . ' ' . $car->getModel()); ?>"
        class="car-detail-img"
    >

    <?php if ($car->isLuxury()): ?>
        <span class="badge-luxury">LUXURY</span>
    <?php endif; ?>
</div>

        <div class="detail-info">
            <h1><?php echo htmlspecialchars($car->getBrand() . ' ' . $car->getModel()); ?></h1>

            <div class="detail-grid">
                <div class="detail-item">
                    <span class="label">📅 Viti</span>
                    <span class="value"><?php echo $car->getYear(); ?></span>
                </div>
                <div class="detail-item">
                    <span class="label">🛣️ Kilometrazh</span>
                    <span class="value"><?php echo number_format($car->getMileage()); ?> km</span>
                </div>
                <div class="detail-item">
                    <span class="label">⛽ Karburanti</span>
                    <span class="value"><?php echo htmlspecialchars($car->getFuelType()); ?></span>
                </div>
                <div class="detail-item">
                    <span class="label">🔧 Gjendja</span>
                    <span class="value"><?php echo $car->getCondition() === 'new' ? '🟢 I ri' : '🔵 I përdorur'; ?></span>
                </div>
                <div class="detail-item">
                    <span class="label">👤 Shitësi</span>
                    <span class="value"><?php echo htmlspecialchars($car->getSellerName()); ?></span>
                </div>
                <?php if ($car->isLuxury()): ?>
                <div class="detail-item detail-item-full">
                    <span class="label">✨ Veçoritë Luksoze</span>
                    <span class="value"><?php echo htmlspecialchars($car->getFeatures()); ?></span>
                </div>
                <?php if ($car->isChauffeurAvailable()): ?>
                <div class="detail-item">
                    <span class="label">🤵 Shofer</span>
                    <span class="value">E disponueshme</span>
                </div>
                <?php endif; ?>
                <?php endif; ?>
            </div>

            <div class="detail-price-box">
                <span class="big-price">€<?php echo number_format($car->getPrice()); ?></span>

                <?php if (isLoggedIn()): ?>
                    <button class="btn btn-primary btn-lg">📞 Kontakto Shitësin</button>
                    <button class="btn btn-outline btn-lg">❤️ Shto në Favorite</button>
                <?php else: ?>
                    <p class="login-prompt">
                        <a href="login.php">Kyçu</a> për të kontaktuar shitësin.
                    </p>
                <?php endif; ?>
            </div>

            <!-- getSummary() demo -->
            <p class="summary-demo">
                <small>🔍 Përmbledhje: <em><?php echo htmlspecialchars($car->getSummary()); ?></em></small>
            </p>
        </div>
    </div>
</main>

<?php require_once '../includes/footer.php'; ?>
