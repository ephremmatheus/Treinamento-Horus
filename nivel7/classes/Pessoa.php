<?php 
class Pessoa{
    private static $conn;

    public static function getConnection(){
        if(empty(self::$conn)){
            $conexao = parse_ini_file('config/livro.ini'); //le o arquivo .ini e retorna como vetor
            $host = $conexao['host'];
            $name = $conexao['name'];
            $user = $conexao['user'];
            $pass = $conexao['pass'];

            self::$conn = new PDO("mysql:dbname={$name};host={$host};user={$user};password={$pass}");
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //detecta erros
        }
        return self::$conn;
    }

    public static function save($pessoa){
        $conn = self::getConnection();

        if(empty($pessoa['id'])){
            $result = $conn->query("SELECT max(id) as next FROM pessoa");
            $row = $result->fetch();
            $pessoa['id'] = (int) $row['next'] + 1;

            //:exemplo são marcações 
            $sql = "INSERT INTO pessoa (id, nome, endereco, bairro, telefone, email, cidade) VALUES 
            (:id,
            :nome, 
            :endereco,
            :bairro,
            :telefone,
            :email,
            :cidade) ";

        } else {
            $sql = "UPDATE pessoa SET 
            nome = :nome,
            endereco= :endereco,
            bairro= :bairro,
            telefone = :telefone,
            email = :email,
            cidade =:cidade
            WHERE id = :id";
        } 

        $result = $conn->prepare($sql);
        $result->execute([':id' => $pessoa['id'], //passa um array associativo
        ':nome' => $pessoa['nome'],
        ':endereco' => $pessoa['endereco'],
        ':bairro' => $pessoa['bairro'],
        ':telefone' => $pessoa['telefone'],
        ':email' => $pessoa['email'],
        ':cidade' => $pessoa['cidade'],
        ]);
        
    }

    public static function find($id){
        $conn = new PDO("mysql:dbname=treinamento;user=root;host=localhost:3306");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $result = $conn->query("SELECT * FROM pessoa WHERE id='{$id}'");
        return $result->fetch();
    }

    public static function delete($id){
        $conn = new PDO("mysql:dbname=treinamento;user=root;host=localhost:3306");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = ("DELETE FROM pessoa WHERE id='{$id}'");
        return $conn->query($sql);
    }

    public static function all(){
        $conn = new PDO("mysql:dbname=treinamento;user=root;host=localhost:3306");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM pessoa";
        $result = $conn->query($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>