<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário</title>
    <link rel="stylesheet" href="css/form.css">
</head>
    <?php 

    $id = $nome = $endereco = $bairro = $telefone = $email = $cidade = '';
    if(!empty($_REQUEST['action'])){
        require '../vendor/autoload.php';

        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();

        $host = $_ENV['host'];
        $usuario = $_ENV['usuario'];
        $senha = $_ENV['senha'];
        $tabela = 'treinamento';

        $conn = mysqli_connect($host, $usuario, $senha, $tabela);

        if($_REQUEST['action'] == 'edit'){
            $id = $_GET['id'];
            $query = "SELECT * FROM pessoa WHERE id = '$id'";
            $result = mysqli_query($conn, $query);   

            if($row = mysqli_fetch_assoc($result)){
                $id = $row['id'];
                $nome = $row['nome'];
                $endereco = $row['endereco'];
                $bairro = $row['bairro'];
                $telefone = $row['telefone'];
                $email = $row['email'];
                $cidade = $row['cidade'];
            }
        }
        else if($_REQUEST['action'] == 'save'){
            $id = (int) $_POST['id'];
            $nome = $_POST['nome'];
            $endereco = $_POST['endereco'];
            $bairro = $_POST['bairro'];
            $telefone = $_POST['telefone'];
            $email = $_POST['email'];
            $cidade = $_POST['cidade'];

            
            //se id tiver vazio ele vai inserir
            if(empty($_POST['id'])){
                $queryNext = "SELECT max(id) as next FROM pessoa";
                $result = mysqli_query($conn, $queryNext);
                $next = mysqli_fetch_assoc($result)['next'] + 1;

                $sql = "INSERT INTO pessoa (id, nome, endereco, bairro, telefone, email, cidade)
                    VALUES ('$next', '$nome', '$endereco', '$bairro', '$telefone', '$email', '$cidade');
                ";
            } else { //se o id já existir
                $sql = "UPDATE pessoa SET nome = '$nome',
                    endereco = '$endereco',
                    bairro = '$bairro',
                    telefone = '$telefone',
                    email = '$email',
                    cidade = '$cidade'
                    WHERE id = '$id'
                ";
            }
            $result = mysqli_query($conn, $sql);
            print ($result ? 'Registro salvo com sucesso' : mysqli_error($conn));
        }
    }
    ?>
<body>

    <form enctype="multipart/form-data" method="post" action="pessoa_form.php?
    action=save">
        <label>ID</label>
        <input name="id" readonly="1" type="text" style="width: 30%" value="<?=$id?>">
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