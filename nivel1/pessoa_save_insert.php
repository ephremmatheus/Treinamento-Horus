<?php  

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

$queryInsert = "INSERT INTO pessoa (id, nome, endereco, bairro, telefone, email, cidade) VALUES ($id, '$nome', '$endereco' , '$bairro', '$telefone' , '$email', '$cidade')";

$result = mysqli_query($conn, $queryInsert);
if($result){
    echo "Usuario adicionado com sucesso";
} else {
    echo "Não foi possivel adicionar o usuario";
}
?>