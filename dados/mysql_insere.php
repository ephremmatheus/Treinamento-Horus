<?php 
require '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$host = $_ENV['host'];
$usuario = $_ENV['usuario'];
$senha = $_ENV['senha'];
$tabela = 'treinamento';

$conn = mysqli_connect($host, $usuario, $senha, $tabela);

$queryInsert = 'INSERT INTO pessoa (id, nome, endereco, bairro, telefone, email) VALUES(3, "teste" , "rua x", "jatiuca", "0000-0003", "3@gmail.com")';

//Insert
$resultInsert = mysqli_query($conn, $queryInsert);

if($resultInsert){
    echo 'Usuario criado com sucesso';
} else {
    echo 'não foi possivel criar o usuario';
}


?>