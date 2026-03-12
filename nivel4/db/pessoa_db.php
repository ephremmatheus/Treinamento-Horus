<?php 
function lista_pessoas() {
    require '../vendor/autoload.php';

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
    $dotenv->load();

    $host = $_ENV['host'];
    $usuario = $_ENV['usuario'];
    $senha = $_ENV['senha'];
    $tabela = 'treinamento';

    $conn = mysqli_connect($host, $usuario, $senha, $tabela);
    $result = mysqli_query($conn, "SELECT * FROM pessoa ORDER BY id");
    $list = mysqli_fetch_all($result, MYSQLI_ASSOC);
return $list;
}

function exclui_pessoa($id) {
    require '../vendor/autoload.php';

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
    $dotenv->load();

    $host = $_ENV['host'];
    $usuario = $_ENV['usuario'];
    $senha = $_ENV['senha'];
    $tabela = 'treinamento';

    $conn = mysqli_connect($host, $usuario, $senha, $tabela);
    $result = mysqli_query($conn, "DELETE FROM pessoa WHERE id='{$id}'");
    return $result;
}

function get_pessoa($id) {
    require '../vendor/autoload.php';

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
    $dotenv->load();

    $host = $_ENV['host'];
    $usuario = $_ENV['usuario'];
    $senha = $_ENV['senha'];
    $tabela = 'treinamento';

    $conn = mysqli_connect($host, $usuario, $senha, $tabela);
    $result = mysqli_query($conn, "SELECT * FROM pessoa WHERE id='{$id}'");
    $pessoa = mysqli_fetch_assoc($result);
    return $pessoa;
}

function get_next_pessoa() {
    require '../vendor/autoload.php';

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
    $dotenv->load();

    $host = $_ENV['host'];
    $usuario = $_ENV['usuario'];
    $senha = $_ENV['senha'];
    $tabela = 'treinamento';

    $conn = mysqli_connect($host, $usuario, $senha, $tabela);
    $result = mysqli_query($conn, "SELECT max(id) as next FROM pessoa");
    $next = (int) mysqli_fetch_assoc($result)['next'] +1;
    return $next;
}

function insert_pessoa($pessoa){
    require '../vendor/autoload.php';

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
    $dotenv->load();

    $host = $_ENV['host'];
    $usuario = $_ENV['usuario'];
    $senha = $_ENV['senha'];
    $tabela = 'treinamento';

    $conn = mysqli_connect($host, $usuario, $senha, $tabela);
    $queryNext = "SELECT max(id) AS next FROM pessoa";
    $result = mysqli_query($conn, $queryNext);
    $next = mysqli_fetch_assoc($result)['next'] + 1;

    //'{exemplo['']}'
    $sql = "INSERT INTO pessoa (id, nome, endereco, bairro, telefone, email, cidade) VALUES 
    ('{$pessoa['id']}', '{$pessoa['nome']}', '{$pessoa['endereco']}', '{$pessoa['bairro']}', '{$pessoa['telefone']}', '{$pessoa['email']}', '{$pessoa['cidade']}') ";

    $result = mysqli_query($conn, $sql);
    return $result;
}

function update_pessoa($pessoa){
    require '../vendor/autoload.php';

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
    $dotenv->load();

    $host = $_ENV['host'];
    $usuario = $_ENV['usuario'];
    $senha = $_ENV['senha'];
    $tabela = 'treinamento';

    $conn = mysqli_connect($host, $usuario, $senha, $tabela);
    $queryNext = "SELECT max(id) AS next FROM pessoa";
    $result = mysqli_query($conn, $queryNext);
    $next = mysqli_fetch_assoc($result)['next'] + 1;

    $sql = "UPDATE pessoa SET 
            nome='{$pessoa['nome']}',
            endereco='{$pessoa['endereco']}',
            bairro='{$pessoa['bairro']}',
            telefone='{$pessoa['telefone']}',
            email='{$pessoa['email']}',
            cidade='{$pessoa['cidade']}'
            WHERE id = '{$pessoa['id']}'";
    $result = mysqli_query($conn, $sql);
    return $result;
}
?>