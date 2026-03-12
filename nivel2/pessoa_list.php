<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem</title>
    <link rel="stylesheet" href="css/form.css">
</head>
<body>
    <?php 
        require '../vendor/autoload.php';

        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();

        $host = $_ENV['host'];
        $usuario = $_ENV['usuario'];
        $senha = $_ENV['senha'];
        $tabela = 'treinamento';

        $conn = mysqli_connect($host, $usuario, $senha, $tabela);
        if(!empty($_GET['action']) AND $_GET['action'] == 'delete'){
            $id = $_GET['id'];
            $query = "DELETE FROM pessoa WHERE id='$id'";
            $result = mysqli_query($conn, $query);
        }
        $query = 'SELECT * FROM pessoa';
        $result = mysqli_query($conn, $query);

        print '<table border=1>';
        print '<thead>';
        print '<tr>';
        print "<th> </th>";
        print "<th> </th>";
        print "<th> Id </th>";
        print "<th> Nome </th>";
        print "<th> Endereço </th>";
        print "<th> Bairro </th>";
        print "<th> Telefone </th>";
        print "<th> Cidade </th>";
        print '</tr>';
        print '</thead>';
        print '<tbody>';

        while($row = mysqli_fetch_assoc($result)){
            $id = $row['id'];
            $nome = $row['nome'];
            $endereco = $row['endereco'];
            $bairro = $row['bairro'];
            $telefone = $row['telefone'];
            $cidade = $row['cidade'];

            print '<tr>';
            print "<td align='center'>
                <a href='pessoa_form.php?action=edit&id={$id}'>
                <span width='17px'>Editar</span>
                </a></td>";
            print "<td align='center'>
            <a href='pessoa_list.php?action=delete&id={$id}'>
            <span width='17px'>Apagar</span>
            </a></td>";
            print "<td> {$id} </td>";
            print "<td> {$nome} </td>";
            print "<td> {$endereco} </td>";
            print "<td> {$bairro} </td>";
            print "<td> {$telefone} </td>";
            print "<td> {$cidade} </td>";
            print '</tr>';
        }
        print '</tbody>';
        print '</table>';
    ?>
    <button onclick="window.location='pessoa_form.php'">
    <span class="button">Inserir</span>
    </button>

</body>
</html>