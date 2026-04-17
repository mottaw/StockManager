<?php
include "php/init.php";

if(isset($_GET["type"])){
    $selectedType = !empty($_GET["type"]) ? $_GET["type"] : null;
} else {
    $selectedType = null;
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])){
    $id = $_POST['delete_id'];

    foreach ($_SESSION['products'] as $key => $product){
        if ($product['id'] == $id){
            unset($_SESSION['products'][$key]);
            break;
        }
    }

    $_SESSION['products'] = array_values($_SESSION['products']);

    header("Location: home.php?delete");
    exit();
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_stock'])){
    $id = $_POST['edit_id'];
    $newStock = $_POST['edit_stock'];

    foreach ($_SESSION['products'] as $key => $product){
        if ($product['id'] == $id){
            $_SESSION['products'][$key]['stock'] = $newStock;
            break;
        }
    }

    header("Location: home.php?edit");
    exit();
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
    <link rel="shortcut icon" href="img/light_logo.png" type="image/png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/home.css">
    <script src="script/script.js" defer></script>
    <script src="js/index.js" defer></script>
</head>
<body>
    <?php require_once "php/partials/sidebar.php"; ?>
    <main>
        <?php
            function notification($text){
                return "<div class='notification'>
                            <i class='fa-solid fa-check'></i>
                            <p>$text</p>
                            <i class='fa-regular fa-circle-xmark' id='remove_notification'></i>
                        </div>";
            }

            if(isset($_GET["add"])){
                echo notification("Produto cadastrado com sucesso!");
            } else if(isset($_GET["delete"])){
                echo notification("Produto excluído com sucesso!");
            } else if(isset($_GET["edit"])){
                echo notification("Produto editado com sucesso!");
            }
        ?>
        <section class="overall_container">
            <h1>Situação do Estoque</h1>
            <div class="indicators_container">
                <?php
                    $yellowAlertCount = 0;
                    $redAlertCount = 0;

                    $i = 0;
                    foreach($_SESSION["products"] as $product){
                        $product["yellow_alert"] = $product["stock"] <= 10 ? true : false;
                        $product["red_alert"] = $product["stock"] <= 5 ? true : false;

                        $_SESSION["products"][$i]["yellow_alert"] = $product["yellow_alert"];
                        $_SESSION["products"][$i]["red_alert"] = $product["red_alert"];

                        if($product["red_alert"] == true){
                            $redAlertCount++;
                        } else if($product["yellow_alert"] == true) {
                            $yellowAlertCount++;
                        }

                        $i++;
                    }
                ?>
                <div class="indicator">
                    <?php
                        if($yellowAlertCount > 0) {
                            echo "<h2>$yellowAlertCount " . ($yellowAlertCount > 1 ? "Alertas Amarelos" : "Alerta Amarelo") . "</h2>
                                <p>Aviso! Estoque baixo!</p>";
                        } else {
                            echo "<h2>Nenhum Alerta Amarelo</h2>
                                <p>Estoque em situação normal</p>";
                        }
                    ?>
                </div>
                <div class="indicator">
                    <?php
                        if($redAlertCount > 0) {
                            echo "<h2>$redAlertCount " . ($redAlertCount > 1 ? "Alertas Vermelhos" : "Alerta Vermelho") . "</h2>
                                <p>Atenção! Estoque próximo do fim!</p>";
                        } else {
                            echo "<h2>Nenhum Alerta Vermelho</h2>
                                <p>Estoque em situação normal</p>";
                        }
                    ?>
                </div>
            </div>
        </section>
        <section class="table_container">
            <form class="filter_container">
                <label for="type">Filtrar por tipo</label>
                <select name="type" id="type" onchange="this.form.submit()">
                    <option value="none" disabled hidden>Selecione uma opção</option>
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

                        foreach($_SESSION["products"] as $product):

                            if($selectedType == $product["type"] || $selectedType == null):

                                $yellowAlert = $product["stock"] <= 10 ? true : false;
                                $redAlert = $product["stock"] <= 5 ? true : false;
                        ?>

                        <tr>  
                            <td><?= $product['id'] ?></td>
                            <td><?= $product['name'] ?></td>
                            <td><?= $product['type'] ?></td>

                            <td>
                                R$ <?= number_format($product["price"], 2) ?>
                            </td>

                            <td class="<?= $redAlert ? 'red_alert' : ($yellowAlert ? 'yellow_alert' : '') ?>">
                                <?= $product['stock'] ?>
                                <?= $yellowAlert ? "<i class='fa-solid fa-triangle-exclamation'></i>" : '' ?>
                            </td>

                            <td>
                                R$ <?= number_format($product["price"] * $product["stock"], 2) ?>
                            </td>

                            <td>
                                <div>
                                    <button class='buttonUpDe'onclick="popEditar(<?= $product['id'] ?>)">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                        <span class='tooltip-box'>Editar</span>
                                    </button>

                                    <button class='buttonUpDe'onclick="popExcluir(<?= $product['id'] ?>)">
                                        <i class="fa-solid fa-trash"></i>
                                        <span class='tooltip-box'>Excluir</span>
                                    </button>
                                </div>

                                <form method="POST" id="popupEditar_<?= $product['id'] ?>" class="modal">
                                <input type="hidden" name="edit_id" value="<?= $product['id'] ?>">
                                    <div class="modal-content">
                                        <span class="close" onclick="fecharPopupEditar(<?= $product['id'] ?>)">&times;</span>
                                        <p>Edite a quantidade de estoques: </p>
                                        <input type="number" name="edit_stock" value="<?= $product['stock']?>">
                                        <div  class='buttons'>
                                        <button type="submit">Ok</button>
                                        </div>
                                    </div>
                                </form>

                                <form method="POST" id="popupExcluir_<?= $product['id'] ?>" class="modal">
                                    <input type="hidden" name="delete_id" value="<?= $product['id'] ?>">
                                    <div class="modal-content">
                                        <span class="close" onclick="fecharPopupExcluir(<?= $product['id'] ?>)">&times;</span>
                                        <p>Aviso: certeza que deseja excluir permanentemente o produto?</p>
                                        <div  class='buttons'>
                                        <button type="submit">Deletar</button>
                                        <button type="button" onclick="fecharPopupExcluir(<?= $product['id'] ?>)">Cancelar</button>
                                        </div>
                                    </div>
                                </form>

                            </td>
                        </tr>

                        <?php
                                $products_sum += $product["price"] * $product["stock"];

                            endif;

                        endforeach;
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