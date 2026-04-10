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

        <h2><?php echo $product['name']; ?> | <?php echo $product['type']; ?> | <?php echo $product['price']; ?> | <?php echo $product['stock']; ?></h2>

    
        <?php
        }?> -->
        <section class="overall_container">
            <h1>Situação do Estoque</h1>
            <div class="indicators_container">
                <div class="indicator">
                    
                </div>
            </div>
        </section>
        <section class="table_container">
            <div class="filter_container">
                <label for="filter">Filtrar por tipo</label>
                <select name="filter" id="filter">
                    <option selected>Tudo</option>
                    <option value="Bruto">Bruto</option>
                    <option value="Ferramenta">Ferramenta</option>
                    <option value="Acabamento">Acabamento</option>
                </select>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Tipo</th>
                        <th>Preço</th>
                        <th>Estoque</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($_SESSION["products"] as $product){
                            echo "<tr>
                                    <td>$product[id]</td>
                                    <td>$product[name]</td>
                                    <td>$product[type]</td>
                                    <td>$product[price]</td>
                                    <td>$product[stock]</td>
                                    <td>
                                        <div>
                                            <i class='fa-solid fa-pen-to-square'></i>
                                            <i class='fa-solid fa-trash'></i>
                                        </div>
                                    </td>
                                </tr>";
                        }
                    ?>
                </tbody>
            </table>
        </section>
    </main>
    <footer>

    </footer>
</body>
</html>