<?php

require_once 'class/produto.php';

class Lista_Unidade {

    public static function all(){
        $conn = Produto::getConnection();

        $result = $conn->query("SELECT * FROM unidade ORDER BY id");

        return $result->fetchAll();

    }
}