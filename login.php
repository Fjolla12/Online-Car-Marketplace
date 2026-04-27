<?php
    require_once("config/config.php");

    $error = "";
    $message = "";

    if(isset($_COOKIE['username'])){
        $message = "Mirë se erdhe përsëri " . htmlspecialchars($_COOKIE['username']);
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $username = htmlspecialchars(trim($_POST["username"]));
        $password = htmlspecialchars(trim($_POST["password"]));

        foreach(USERS as $user){
            if($user["username"] === $username && $user["password"] === $password){

                $_SESSION["user"] =[
                    "username" => $user["username"],
                    "role" => $user["role"]
                ];

                setcookie("username", $username, time() + 3600, "/");

                header("Location: index.php");
                exit();
            }
        }
        $error = "Kredencialet gabim!";
    }

?>
<h2>Login</h2>

<?php if($message): ?>
    <p><?= $message ?></p>
<?php endif; ?>    

<form method="POST">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>

<?php if($error): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>