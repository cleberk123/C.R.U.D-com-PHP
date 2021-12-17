<?php

require_once 'class/produto.php';

class Lista_Tipo {

    public static function all(){
        $conn = Produto::getConnection();

        $result = $conn->query("SELECT * FROM tipo ORDER BY id");

        return $result->fetchAll();

    }
}