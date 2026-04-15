<?php
$currentPage = basename($_SERVER["PHP_SELF"]);
?>

<aside class="sidebar">
    <a href="index.php" class="logo">
        <img src="img/logo.png">
        <p>Constru<span>Tech</span></p>
    </a>
    <nav>
        <ul class="links">
            <li class="<?= $currentPage == "index.php" ? 'focus' : '' ?>">
                <a href="index.php">
                    <i class="fa-solid fa-house"></i>
                    <span>Início</span>
                </a>
            </li>
            <li class="<?= $currentPage == "register_product.php" ? 'focus' : '' ?>">
                <a href="register_product.php">
                    <i class="fa-regular fa-pen-to-square"></i>
                    <span>Cadastrar</span>
                </a>
            </li>
        </ul>
    </nav>
</aside>