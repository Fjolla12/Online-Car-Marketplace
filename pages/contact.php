<?php
session_start();
require_once '../includes/auth.php';
require_once '../classes/Validator.php';

$pageTitle = 'Kontakt';

$success = '';
$errors  = [];
$values  = ['name' => '', 'email' => '', 'phone' => '', 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $validator = new Validator();

    $name    = trim($_POST['name']    ?? '');
    $email   = trim($_POST['email']   ?? '');
    $phone   = trim($_POST['phone']   ?? '');
    $message = trim($_POST['message'] ?? '');

    $values = compact('name', 'email', 'phone', 'message');

    if (empty($name)) {
        $errors[] = 'Emri është i detyrueshëm.';
    }
    if (empty($message)) {
        $errors[] = 'Mesazhi është i detyrueshëm.';
    }

    $validator->validateEmail($email);
    if (!empty($phone)) {
        $validator->validatePhone($phone);
    }

    $errors = array_merge($errors, $validator->getErrors());

    if (empty($errors)) {
        $success = "✅ Mesazhi u dërgua me sukses! Do t'ju kontaktojmë së shpejti.";
        $values  = ['name' => '', 'email' => '', 'phone' => '', 'message' => ''];
    }
}

require_once '../includes/header.php';
?>

<main class="container">
    <h1 class="page-title">📬 Na Kontaktoni</h1>

    <div class="contact-wrap">
        <div class="contact-info">
            <h2>AutoMarket Kosovo</h2>
            <p>Kemi një ekip të gatshëm t'ju ndihmojë me çdo pyetje lidhur me blerjen ose shitjen e makinës suaj.</p>
            <ul class="contact-list">
                <li>📍 Rruga Nënë Tereza, Prishtinë</li>
                <li>📞 +383 44 123 456</li>
                <li>✉️ info@automarket-ks.com</li>
                <li>🕐 E Hënë – E Premte: 09:00 – 18:00</li>
            </ul>
        </div>

        <div class="contact-form-box">
            <?php if ($success): ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
            <?php endif; ?>

            <?php if (!empty($errors)): ?>
                <div class="alert alert-error">
                    <strong>Gabime:</strong>
                    <ul>
                        <?php foreach ($errors as $err): ?>
                            <li><?php echo htmlspecialchars($err); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="POST" action="">
                <div class="form-group">
                    <label>Emri & Mbiemri *</label>
                    <input type="text" name="name" value="<?php echo htmlspecialchars($values['name']); ?>" placeholder="p.sh. Besnik Krasniqi" required>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Email *</label>
                        <input type="text" name="email" value="<?php echo htmlspecialchars($values['email']); ?>" placeholder="email@shembull.com">
                    </div>
                    <div class="form-group">
                        <label>Telefoni <small>(opsional)</small></label>
                        <input type="text" name="phone" value="<?php echo htmlspecialchars($values['phone']); ?>" placeholder="+38344123456">
                    </div>
                </div>
                <div class="form-group">
                    <label>Mesazhi *</label>
                    <textarea name="message" rows="5" placeholder="Shkruani mesazhin tuaj këtu..."><?php echo htmlspecialchars($values['message']); ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-full">Dërgo Mesazhin →</button>
            </form>
        </div>
    </div>
</main>

<?php require_once '../includes/footer.php'; ?>
