<?php 
if(!empty($_REQUEST['action'])){ //se action estiver vazio, retorna true, dai nega e vai pro else
    require '../vendor/autoload.php';

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();

    $host = $_ENV['host'];
    $usuario = $_ENV['usuario'];
    $senha = $_ENV['senha'];
    $tabela = 'treinamento';

    $conn = mysqli_connect($host, $usuario, $senha, $tabela);

    if($_REQUEST['action'] == 'edit'){
        $id = (int) $_GET['id'];
        $query = "SELECT * FROM pessoa WHERE id = '$id'";
        $result = mysqli_query($conn, $query);
        $pessoa = mysqli_fetch_assoc($result);
    }
    else if($_REQUEST['action'] == 'save'){
        $pessoa = $_POST;
        
        if(empty($_POST['id'])){ // se id tiver vazio, vai dar true e entrar na condição
            $queryNext = "SELECT max(id) AS next FROM pessoa";
            $result = mysqli_query($conn, $queryNext);
            $next = mysqli_fetch_assoc($result)['next'] + 1;

            //'{exemplo['']}'
            $sql = "INSERT INTO pessoa (id, nome, endereco, bairro, telefone, email, cidade) VALUES 
            ('{$next}', '{$pessoa['nome']}', '{$pessoa['endereco']}', '{$pessoa['bairro']}', '{$pessoa['telefone']}', '{$pessoa['email']}', '{$pessoa['cidade']}') ";

            $result = mysqli_query($conn, $sql);
        } else {
            $sql = "UPDATE pessoa SET 
                nome='{$pessoa['nome']}',
                endereco='{$pessoa['endereco']}',
                bairro='{$pessoa['bairro']}',
                telefone='{$pessoa['telefone']}',
                email='{$pessoa['email']}',
                cidade='{$pessoa['cidade']}'
                WHERE id = '{$pessoa['id']}'";
            $result = mysqli_query($conn, $sql);
            var_dump($result);
        }
        print ($result) ? "Sucesso" : mysqli_error($conn);
    }
} else {
    $pessoa = [];
    $pessoa['id'] = '';
    $pessoa['nome'] = '';
    $pessoa['endereco'] = '';
    $pessoa['bairro'] = '';
    $pessoa['telefone'] = '';
    $pessoa['email'] = '';
    $pessoa['cidade'] = '';
}

  $form = file_get_contents('html/form.html');
    $form = str_replace('{id}', $pessoa['id'], $form);
    $form = str_replace('{nome}', $pessoa['nome'], $form);
    $form = str_replace('{endereco}', $pessoa['endereco'], $form);
    $form = str_replace('{bairro}', $pessoa['bairro'], $form);
    $form = str_replace('{telefone}', $pessoa['telefone'], $form);
    $form = str_replace('{email}', $pessoa['email'], $form);
    $form = str_replace('{cidade}', $pessoa['cidade'], $form);
    print $form;
?>