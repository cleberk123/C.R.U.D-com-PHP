<?php
require_once 'class/produto.php';
require_once 'class/fabricante.php';
require_once 'class/lista_fabricante.php';
require_once 'class/lista_tipo.php';
require_once 'FabricanteList.php';

class PesquisaFabricante{

    private static $conn;
    private $html;

    public function __construct()
    {
        $this->html = file_get_contents('HTML/list_fabricante.html');
    }

    public static function pesquisa(){
        
        self::$conn = Produto::getConnection();

        $busca = $_POST['pesquisar'];

        $result = self::$conn->query("SELECT * FROM fabricante f
        WHERE nome LIKE '%$busca%'
        ORDER BY f.id");

        return $result->fetchAll();

    }

    public function load(){
        try {
            $fabricantes = self::pesquisa();
            $itens = '';

            foreach($fabricantes as $fabricante){
                $item = file_get_contents('HTML/item_fabricante.html');
                $item = str_replace('{id}',          $fabricante['id'],          $item);
                $item = str_replace('{nome}',        $fabricante['nome'],        $item);
                $item = str_replace('{site}',    $fabricante['site'],    $item);

                $itens .= $item;
            }

            $this->html = str_replace('{itens}', $itens, $this->html);

        } catch(Exception $e){
            print $e->getMessage();
        }
    }

    public function show(){
        
        $this->load();
        print $this->html;
    }
}
?>