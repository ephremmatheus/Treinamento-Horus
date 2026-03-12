<?php 
require '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$host = $_ENV['host'];
$usuario = $_ENV['usuario'];
$senha = $_ENV['senha'];
$tabela = 'treinamento';

$conn = mysqli_connect($host, $usuario, $senha, $tabela);

$queryDelete = 'DELETE FROM pessoa WHERE id = 1';

$resultDelete = mysqli_query($conn, $queryDelete);

if($resultDelete){
    echo 'Usuario deletado com sucesso';
} else {
    echo 'Não foi possivel deletar o usuario';
}
?>