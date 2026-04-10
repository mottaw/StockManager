<?php require_once "php/init.php";
$selectedType = $_GET['type'] ?? null;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <title>Sistema de Estoque | ConstruTech</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <aside class="sidebar">
        <a href="index.php" class="logo">ConstruTech</a>
        <nav>
            <ul class="links">
                <li><a href="index.php">Produtos</a></li>
                <li><a href="register_product.php">Cadastrar Produtos</a></li>
            </ul>
        </nav>
    </aside>
    <main>
        <?php
        foreach ($_SESSION['products'] as $product) {

            if ($selectedType && $product['type'] != $selectedType) {
                continue;
            }

        ?>

        <h2><?php echo $product['id']; ?> | <?php echo $product['name']; ?> | <?php echo $product['type']; ?> | <?php echo $product['price']; ?> | <?php echo $product['stock']; ?></h2>

    
        <?php
        }?>

        <table>


            <thead>
                <th>
                    <td></td>
                </th>
            </thead>
        </table>
    </main>
    <footer>

    </footer>
</body>
</html>