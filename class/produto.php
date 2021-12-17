<?php

class Produto
{

    private static $conn;

    public static function getConnection()
    {

        if (empty(self::$conn)) {

            $conexao = parse_ini_file('config/ConnectDB.ini');
            $host = $conexao['host'];
            $port = $conexao['port'];
            $dbname = $conexao['dbname'];
            $user = $conexao['user'];
            $pass = $conexao['pass'];

            self::$conn = new PDO("mysql:host={$host};port={$port};dbname={$dbname};user={$user};password={$pass}");
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$conn;
    }

    public static function save($produto)
    {
        $conn = self::getConnection();

        if (empty($produto['id'])) { // insert de registro

            $sql = "INSERT INTO produto (descricao, estoque, preco_custo, preco_venda, id_fabricante, id_unidade, id_tipo) 
            VALUES (:descricao, :estoque, :preco_custo, :preco_venda, :id_fabricante, :id_unidade, :id_tipo)";

            $result = $conn->prepare($sql);

            $result->execute([
                ':descricao' => $produto['descricao'],
                ':estoque' => $produto['estoque'],
                ':preco_custo' => $produto['preco_custo'],
                ':preco_venda' => $produto['preco_venda'],
                ':id_fabricante' => $produto['id_fabricante'],
                ':id_unidade' => $produto['id_unidade'],
                ':id_tipo' => $produto['id_tipo']
            ]);
        } else { // update do registro

            $sql =  "UPDATE produto SET descricao = :descricao, 
                                        estoque = :estoque, 
                                        preco_custo = :preco_custo, 
                                        preco_venda = :preco_venda, 
                                        id_fabricante = :id_fabricante, 
                                        id_unidade = :id_unidade, 
                                        id_tipo = :id_tipo
                                        WHERE id = :id";

            $result = $conn->prepare($sql);

            $result->execute([
                ':id' => $produto['id'],
                ':descricao' => $produto['descricao'],
                ':estoque' => $produto['estoque'],
                ':preco_custo' => $produto['preco_custo'],
                ':preco_venda' => $produto['preco_venda'],
                ':id_fabricante' => $produto['id_fabricante'],
                ':id_unidade' => $produto['id_unidade'],
                ':id_tipo' => $produto['id_tipo']
            ]);
        }
    }

    public static function find($id)
    {
        $conn = self::getConnection();

        $result = $conn->prepare("SELECT * FROM produto WHERE id = :id");

        $result->execute([':id' => $id]);

        return $result->fetch();
    }

    public static function delete($id)
    {
        $conn = self::getConnection();

        $result = $conn->prepare("DELETE FROM produto WHERE id = :id");

        $result->execute([':id' => $id]);

        return $result;
    }

    public static function all()
    {
        $conn = self::getConnection();

        $result = $conn->query("SELECT p.id, p.descricao, p.estoque, p.preco_custo, p.preco_venda, t.nome as nome_tipo, u.nome  as nome_unidade, f.nome as nome_fabricante, t.id as id_tipo, u.id as id_unidade, f.id as id_fabricante
        FROM produto p
        INNER JOIN tipo t ON p.id_tipo = t.id
        INNER JOIN unidade u ON p.id_unidade = u.id
        INNER JOIN fabricante f ON p.id_fabricante = f.id
        order by p.id");

        return $result->fetchAll();
    }
}
