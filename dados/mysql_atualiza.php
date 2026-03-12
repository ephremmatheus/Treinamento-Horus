<?php 
require '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$host = $_ENV['host'];
$usuario = $_ENV['usuario'];
$senha = $_ENV['senha'];
$tabela = 'treinamento';

$conn = mysqli_connect($host, $usuario, $senha, $tabela);

$queryAtualiza = 'UPDATE pessoa SET nome = endereco = "4" WHERE id = 2';

$resultAtualiza = mysqli_query($conn, $queryAtualiza);

if($resultAtualiza) {
    echo 'Usuario atualizado com sucesso';
} else {
    echo 'Não foi possivel atualizar o usuario';
} 
?>