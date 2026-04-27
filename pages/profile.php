<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . "/../includes/auth.php";
require_once __DIR__ . "/../classes/Validator.php";

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION["user"];

$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"] ?? "");
    $phone = trim($_POST["phone"] ?? "");
    $color = $_POST["color"] ?? "lightblue";

    $validator = new Validator();

    $validator->validateEmail($email);
    $validator->validatePhone($phone);

    if ($validator->hasErrors()) {
        $errors = $validator->getErrors();
    } else {
        $_SESSION["profile_email"] = $email;
        $_SESSION["profile_phone"] = $phone;

        setcookie("favorite_color", $color, time() + (86400 * 30), "/");
        $_COOKIE["favorite_color"] = $color;

        $success = "Profili u përditësua me sukses!";
    }
}

$profileEmail = $_SESSION["profile_email"] ?? "";
$profilePhone = $_SESSION["profile_phone"] ?? "";
$favoriteColor = $_COOKIE["favorite_color"] ?? "lightblue";

require_once __DIR__ . "/../includes/header.php";
?>

<main class="container">

    <section style="
        max-width: 850px;
        margin: 40px auto;
        background: #fff;
        padding: 35px;
        border-radius: 18px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    ">

        <h2 style="font-size: 32px; margin-bottom: 10px;">Profili im</h2>

        <p style="font-size: 17px;">
            Mirë se erdhe, 
            <b><?php echo htmlspecialchars($user["username"]); ?></b>
        </p>

        <p style="font-size: 17px;">
            Roli yt është: 
            <b style="color:#d43d16;">
                <?php echo htmlspecialchars($user["role"]); ?>
            </b>
        </p>

        <?php if (!empty($errors)): ?>
            <div style="
                background: #ffe5e5;
                color: #b00020;
                padding: 15px;
                border-radius: 10px;
                margin: 20px 0;
            ">
                <?php foreach ($errors as $error): ?>
                    <p style="margin: 5px 0;"><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <div style="
                background: #e5ffe9;
                color: #087a20;
                padding: 15px;
                border-radius: 10px;
                margin: 20px 0;
            ">
                <?php echo htmlspecialchars($success); ?>
            </div>
        <?php endif; ?>

        <form method="POST" style="margin-top: 25px;">

            <label style="font-weight: bold;">Email:</label>
            <input 
                type="text" 
                name="email"
                value="<?php echo htmlspecialchars($profileEmail); ?>"
                placeholder="shembull@gmail.com"
                style="
                    width: 100%;
                    padding: 13px;
                    margin: 8px 0 20px;
                    border: 1px solid #ccc;
                    border-radius: 10px;
                    font-size: 16px;
                "
            >

            <label style="font-weight: bold;">Numri i telefonit:</label>
            <input 
                type="text" 
                name="phone"
                value="<?php echo htmlspecialchars($profilePhone); ?>"
                placeholder="044123456 ose +38344123456"
                style="
                    width: 100%;
                    padding: 13px;
                    margin: 8px 0 20px;
                    border: 1px solid #ccc;
                    border-radius: 10px;
                    font-size: 16px;
                "
            >

            <label style="font-weight: bold;">Ngjyra e preferuar:</label>
            <select 
                name="color"
                style="
                    width: 100%;
                    padding: 13px;
                    margin: 8px 0 25px;
                    border: 1px solid #ccc;
                    border-radius: 10px;
                    font-size: 16px;
                "
            >
                <option value="lightblue" <?php if ($favoriteColor === "lightblue") echo "selected"; ?>>
                    E kaltër
                </option>
                <option value="lightgreen" <?php if ($favoriteColor === "lightgreen") echo "selected"; ?>>
                    E gjelbër
                </option>
                <option value="pink" <?php if ($favoriteColor === "pink") echo "selected"; ?>>
                    Rozë
                </option>
            </select>

            <button 
                type="submit"
                style="
                    background: #d43d16;
                    color: white;
                    border: none;
                    padding: 13px 25px;
                    border-radius: 10px;
                    cursor: pointer;
                    font-size: 16px;
                    font-weight: bold;
                "
            >
                Ruaj ndryshimet
            </button>

        </form>

        <hr style="margin: 35px 0;">

        <h3>Të dhënat e ruajtura</h3>

        <div style="
            background: <?php echo htmlspecialchars($favoriteColor); ?>;
            padding: 20px;
            border-radius: 12px;
            margin-top: 15px;
        ">
            <p><b>Email:</b> <?php echo htmlspecialchars($profileEmail); ?></p>
            <p><b>Telefoni:</b> <?php echo htmlspecialchars($profilePhone); ?></p>
            <p><b>Ngjyra nga cookie:</b> <?php echo htmlspecialchars($favoriteColor); ?></p>
        </div>

    </section>

</main>

<?php require_once __DIR__ . "/../includes/footer.php"; ?>