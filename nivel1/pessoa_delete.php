<?php
$dados = $_GET;

if (!empty($dados['id'])) {

    require '../vendor/autoload.php';

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();

    $host = $_ENV['host'];
    $usuario = $_ENV['usuario'];
    $senha = $_ENV['senha'];
    $tabela = 'treinamento';

    $conn = mysqli_connect($host, $usuario, $senha, $tabela);

    $sql = "DELETE FROM pessoa WHERE id = '{$dados['id']}'";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "Registro excluído com sucesso";
    } else {
        echo mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>