<?php

class Fabricante
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

    public static function save($fabricante)
    {
        $conn = self::getConnection();

        if (empty($fabricante['id'])) { // insert de registro
            $sql = "INSERT INTO fabricante (nome, site) 
            VALUES (:nome, :site)";

            $result = $conn->prepare($sql);
            $result->execute([
                ':nome' => $fabricante['nome'],
                ':site' => $fabricante['site']
            ]);
            
        } else { // update do registro
            $sql = "UPDATE fabricante SET nome = :nome, 
                                          site = :site
                                          WHERE id = :id";
            $result = $conn->prepare($sql);
            $result->execute([
                ':id' => $fabricante['id'],
                ':nome' => $fabricante['nome'],
                ':site' => $fabricante['site']
            ]);
        }
    }

    public static function find($id)
    {
        $conn = self::getConnection();

        $result = $conn->prepare("SELECT * FROM fabricante WHERE id = :id");

        $result->execute([':id' => $id]);

        return $result->fetch();
    }

    public static function delete($id)
    {
        $conn = self::getConnection();

        $result = $conn->prepare("DELETE FROM fabricante WHERE id = :id");

        $result->execute([':id' => $id]);

        return $result;
    }

    public static function all()
    {
        $conn = self::getConnection();

        $result = $conn->query("SELECT * from fabricante");

        return $result->fetchAll();
    }
}
