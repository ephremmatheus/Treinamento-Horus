<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
    <link rel="stylesheet" href="css/form.css">
</head>
<?php 
    if (!empty($_GET['id'])){
        require '../vendor/autoload.php';

        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();

        $host = $_ENV['host'];
        $usuario = $_ENV['usuario'];
        $senha = $_ENV['senha'];
        $tabela = 'treinamento';

        $id = $_GET['id'];
        $conn = mysqli_connect($host, $usuario, $senha, $tabela);
        $query = "SELECT * FROM pessoa WHERE id='$id'";
        $result = mysqli_query($conn, $query);

        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];
        $nome = $row['nome'];
        $email = $row['email'];
        $endereco = $row['endereco'];
        $bairro = $row['bairro'];
        $telefone = $row['telefone'];
        $cidade = $row['cidade'];
    }
?>  
<body>
      <form enctype="multipart/form-data" method="post" action="pessoa_save_update.php">
        <label>id</label>
        <input name="id" type="text" style="width: 30%" value="<?=$id?>">
        <label>Nome</label>
        <input name="nome" type="text" style="width: 50%" value="<?=$nome?>">
        <label>Endereço</label>
        <input name="endereco" type="text" style="width: 50%" value="<?=$endereco?>">
        <label>Bairro</label>
        <input name="bairro" type="text" style="width: 25%" value="<?=$bairro?>">
        <label>Telefone</label>
        <input name="telefone" type="text" style="width: 25%" value="<?=$telefone?>">
        <label>Email</label>
        <input name="email" type="text" style="width: 25%" value="<?=$email?>">
        <label>Cidade</label>
        <input type="text" name="cidade" style="width: 25%" value="<?=$cidade?>">
        <input type="submit">
        </form>
</body>
</html>
