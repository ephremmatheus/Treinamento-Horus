<?php 
class Pessoa{
    public static function save($pessoa){
        $conn = new PDO("mysql:dbname=treinamento;user=root;host=localhost:3306");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if(empty($pessoa['id'])){
            $result = $conn->query("SELECT max(id) as next FROM pessoa");
            $row = $result->fetch();
            $pessoa['id'] = (int) $row['next'] + 1;

            $sql = "INSERT INTO pessoa (id, nome, endereco, bairro, telefone, email, cidade) VALUES 
            ('{$pessoa['id']}', '{$pessoa['nome']}', '{$pessoa['endereco']}', '{$pessoa['bairro']}', '{$pessoa['telefone']}', '{$pessoa['email']}', '{$pessoa['cidade']}') ";

        } else {
            $sql = "UPDATE pessoa SET 
            nome='{$pessoa['nome']}',
            endereco='{$pessoa['endereco']}',
            bairro='{$pessoa['bairro']}',
            telefone='{$pessoa['telefone']}',
            email='{$pessoa['email']}',
            cidade='{$pessoa['cidade']}'
            WHERE id = '{$pessoa['id']}'";
        } 
        return $conn->query($sql);
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