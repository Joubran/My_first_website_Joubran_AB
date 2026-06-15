<?php
require_once('db.php');

if (isset($_COOKIE['User'])) {
    header("Location: /profile.php");
    exit();
}

$link = mysqli_connect('127.0.0.1', 'root', 'Qq123456', 'first');

if (!$link) {
    die("Ошибка подключения: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $login = $_POST['login'];
    $pass = $_POST['password'];

    if (!$login || !$pass) {
        die("input all parameters");
    }

    $sql = "SELECT * FROM users WHERE username='$login' AND pass='$pass'";
    $result = mysqli_query($link, $sql);

    if (mysqli_num_rows($result) > 0) {
        setcookie("User", $login, time() + 3600, "/");
        header("Location: /profile.php");
        exit();
    } else {
        echo "Неверный логин или пароль";
    }
}

mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alboni Joubran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="mb-4">Login</h1>

                <form action="/login.php" method="POST" class="d-flex flex-column gap-3">
                    <input type="text" name="login" class="form-control-hacker-input" placeholder="login">
                    <input type="password" name="password" class="form-control-hacker-input" placeholder="password">

                    <button class="btn btn-primary" type="submit" name="submit">Login</button>

                    <p class="mt-3">Don't have an account?<a href="/registration.php">Register</a></p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>