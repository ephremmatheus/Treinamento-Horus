<?php 
require '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$host = $_ENV['host'];
$usuario = $_ENV['usuario'];
$senha = $_ENV['senha'];
$tabela = 'treinamento';

$conn = mysqli_connect($host, $usuario, $senha, $tabela);

$querySelect = 'SELECT * FROM pessoa';

$resultSelect = mysqli_query($conn, $querySelect);

if($resultSelect){
    while($row = mysqli_fetch_assoc($resultSelect)){
        echo $row['id']  . ' - '. $row['nome']  . ' - '. $row['endereco'] . ' - '. $row['bairro']  . ' - '. $row['telefone'] . ' - '. $row['email'] . '<br>';
    }
} else{
    echo 'Erro ao tentar acessar o banco';
}
?> 