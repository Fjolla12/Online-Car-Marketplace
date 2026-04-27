<?php
$isSubPage = strpos($_SERVER['PHP_SELF'], '/pages/') !== false;
$basePath  = $isSubPage ? '../' : '';
?>

<footer class="site-footer">
    <div class="container footer-inner">
        <div class="footer-brand">
            <span class="logo">🏎️ AutoMarket Kosovo</span>
            <p>Platforma #1 për blerje dhe shitje makinash në Kosovë.</p>
        </div>
        <div class="footer-links">
            <a href="<?php echo $basePath; ?>index.php">Kryefaqja</a>
            <a href="<?php echo $basePath; ?>pages/listings.php">Makina</a>
            <a href="<?php echo $basePath; ?>pages/contact.php">Kontakt</a>
        </div>
        <div class="footer-copy">
            <small>&copy; <?php echo date('Y'); ?> AutoMarket Kosovo. Të gjitha të drejtat e rezervuara.</small>
            <?php if (isset($_SESSION['last_visit'])): ?>
                <small>Vizita juaj e fundit: <?php echo $_SESSION['last_visit']; ?></small>
            <?php endif; ?>
        </div>
    </div>
</footer>

<script src="<?php echo $basePath; ?>assets/js/main.js"></script>
</body>
</html>
