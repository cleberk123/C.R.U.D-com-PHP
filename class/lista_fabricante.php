<?php

require_once 'class/produto.php';

class Lista_Fabricante {

    public static function all(){
        $conn = Produto::getConnection();

        $result = $conn->query("SELECT * FROM fabricante ORDER BY id");

        return $result->fetchAll();

    }
}