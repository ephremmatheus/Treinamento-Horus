<?php
$dados = $_POST;

if($dados) {

    require '../vendor/autoload.php';

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();

    $host = $_ENV['host'];
    $usuario = $_ENV['usuario'];
    $senha = $_ENV['senha'];
    $tabela = 'treinamento';

    $conn = mysqli_connect($host, $usuario, $senha, $tabela);

    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $endereco = $_POST['endereco'];
    $bairro = $_POST['bairro'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $cidade = $_POST['cidade'];

    $query = "UPDATE pessoa SET 
        nome = '$nome',
        endereco = '$endereco',
        bairro = '$bairro',
        telefone = '$telefone',
        email = '$email',
        cidade = '$cidade'
    WHERE id = '$id'";

    $result = mysqli_query($conn, $query);

    if($result){
        echo "Registro atualizado com sucesso";
    } else {
        echo "Não foi possivel atualizar o registro";
    }
}
?>