<?php
require_once 'class/produto.php';
require_once 'class/fabricante.php';
require_once 'class/lista_fabricante.php';
require_once 'class/lista_tipo.php';
require_once 'class/lista_unidade.php';
require_once 'ProdutoList.php';

class PesquisaProduto{

    private static $conn;
    private $html;

    public function __construct()
    {
        $this->html = file_get_contents('HTML/list_produto.html');
    }

    public static function pesquisa(){
        
        self::$conn = Produto::getConnection();

        $busca = $_POST['pesquisar'];

        $result = self::$conn->query("SELECT p.id, p.descricao, p.estoque, p.preco_custo, p.preco_venda, t.nome as nome_tipo, u.nome  as nome_unidade, f.nome as nome_fabricante, t.id as id_tipo, u.id as id_unidade, f.id as id_fabricante
        FROM produto p

        INNER JOIN tipo t ON p.id_tipo = t.id
        INNER JOIN unidade u ON p.id_unidade = u.id
        INNER JOIN fabricante f ON p.id_fabricante = f.id
        WHERE p.descricao LIKE '%$busca%'
        ORDER BY p.id");

        return $result->fetchAll();

    }

    public function load(){
        try {
            $produtos = $this->pesquisa();
            $itens = '';

            foreach($produtos as $produto){
                $item = file_get_contents('HTML/item_produto.html');
                $item = str_replace('{id}',          $produto['id'],          $item);
                $item = str_replace('{descricao}',        $produto['descricao'],        $item);
                $item = str_replace('{estoque}',    $produto['estoque'],    $item);
                $item = str_replace('{preco_custo}',      $produto['preco_custo'],      $item);
                $item = str_replace('{preco_venda}',    $produto['preco_venda'],    $item);
                $item = str_replace('{nome_fabricante}',       $produto['nome_fabricante'],       $item);
                $item = str_replace('{nome_unidade}', $produto['nome_unidade'], $item);
                $item = str_replace('{nome_tipo}', $produto['nome_tipo'], $item);

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