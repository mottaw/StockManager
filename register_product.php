<?php
require_once 'php/init.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $ids = array_column($_SESSION['products'], 'id');
    $newId = $ids ? max($ids) + 1 : 1;


    $newProduct = [
        'id' => $newId,
        'name' => $_POST['name'],
        'type' => $_POST['type'],
        'price' => $_POST['price'],
        'stock' => $_POST['stock']
    ];
    
    $_SESSION['products'][] = $newProduct;
    $mensagem = 'Produto Cadastrado!';
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
    <title>Cadastro de Produto | ConstruTech</title>
    <link rel="stylesheet" href="css/register.css">
</head>
<body>
    
    <?php if(isset($mensagem)) { ?>
    <p><?php echo $mensagem; ?></p>
    <?php } ?>
    
    <section class="register-product">
    <h1>Cadastro de Produto</h1>

    <form method="POST" class="register-form">

    <label for="name">Nome</label>
    <input type="text" id="name" name="name" placeholder="Digite aqui" required>

    <label for="prodType">Tipo...</label>
    <select name="type" id="type">
        <option value="Bruto">Bruto</option>
        <option value="Ferramenta">Ferramenta</option>
        <option value="Acabamento">Acabamento</option>
    </select>

    <label for="prodPrice">Preço</label>
    <input type="number" id="price" name="price" step="0.01" placeholder="0.00" required>

    <label for="prodStock">Estoque</label>
    <input type="number" id="stock" name="stock" step="1" placeholder="0" required>

    <button type="submit" class="register-button">Cadastrar</button>
    

    
    </form>

    </section>

</body>
</html>