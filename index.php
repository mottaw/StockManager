<?php
include "php/init.php";

if(isset($_GET["type"])){
    $selectedType = !empty($_GET["type"]) ? $_GET["type"] : null;
} else {
    $selectedType = null;
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
    <title>Sistema de Estoque | ConstruTech</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/home.css">
</head>
<body>
    <?php require_once "php/partials/sidebar.php";
    ?>
    <main>
        <section class="overall_container">
            <h1>Situação do Estoque</h1>
            <div class="indicators_container">
                <div class="indicator">
                </div>
                <div class="indicator">
                </div>
                <div class="indicator">
                </div>
            </div>
        </section>
        <section class="table_container">
            <form class="filter_container">
                <label for="type">Filtrar por tipo</label>
                <select name="type" id="type" onchange="this.form.submit()">
                    <option value="none" selected disabled hidden>Selecione uma opção</option>
                    <option value="">Tudo</option>
                    <?php
                        foreach ($types as $ktype => $valor){
                            echo "<option value='$ktype'" . ($selectedType == $ktype ? 'selected' : '') . ">$valor</option>";
                        }
                    ?>
                </select>
            </form>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Tipo</th>
                        <th>Preço</th>
                        <th>Estoque</th>
                        <th>Soma</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $products_sum = 0;
                        foreach($_SESSION["products"] as $product){
                            if($selectedType == $product["type"] || $selectedType == null){
                                $yellowAlert = $product["stock"] <= 10 ? true : false;
                                $redAlert = $product["stock"] <= 5 ? true : false;

                                echo "<tr>
                                    <td>$product[id]</td>
                                    <td>$product[name]</td>
                                    <td>$product[type]</td>
                                    <td>R$ ". number_format($product["price"], 2) . "</td>
                                    <td " . ($redAlert ? "class='red_alert'" : ($yellowAlert ? "class='yellow_alert'" : '')) . ">$product[stock] " . ($yellowAlert ? "<i class='fa-solid fa-triangle-exclamation'></i>" : '') . "</td>
                                    <td>R$ " . number_format($product["price"] * $product["stock"], 2) . "</td>
                                    <td>
                                        <div>
                                            <i class='fa-solid fa-pen-to-square'></i>
                                            <i class='fa-solid fa-trash'></i>
                                        </div>
                                    </td>
                                </tr>";

                                $products_sum += $product["price"] * $product["stock"];
                            }
                        }
                    ?>
                </tbody>
            </table>
            <div>
                <h1>Resumo Financeiro: R$ <?php echo number_format($products_sum, 2); ?></h1>
            </div>
        </section>
    </main>
</body>
</html>