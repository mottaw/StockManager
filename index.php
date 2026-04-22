<?php
require_once 'php/init.php';

$user = isset($_POST["user"]) ? $_POST["user"] : null;
$password = isset($_POST["password"]) ? $_POST["password"] : null;

if($user == "admin" && $password == "admin"){
    header("Location: home.php");
} else {

}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Login | ConstruTech</title>
    <link rel="shortcut icon" href="img/light_logo.png" type="image/png">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/index.js" defer></script>
</head>
<body>
    <main>
        <?php
            function notification($text){
                return "<div class='notification'>
                            <i class='fa-solid fa-xmark'></i>
                            <p>$text</p>
                            <i class='fa-regular fa-circle-xmark' id='remove_notification'></i>
                        </div>";
            }

            if($user != null){
                echo notification("Acesso negado!");
            }
        ?>
        <div class="logo_banner">
            <img src="img/dark_logo.png" id="logo">
            <h1>Constru<span>Tech</span></h1>
        </div>
        <form action="index.php" method="POST">
            <h1>Login</h1>
            <div>
                <label for="user">Usuário</label>
                <input type="text" name="user" id="user" placeholder="Digite seu usuário" required>
            </div>
            <div>
                <label for="password">Senha</label>
                <input type="password" name="password" id="password" placeholder="Digite sua senha" required>
            </div>
            <button type="submit">Entrar</button>
        </form>
        <i class="fa-solid fa-circle-half-stroke" id="toggle_theme"></i>
    </main>
</body>
<script src="script/script.js"></script>
</html>