<?php
require_once 'class/produto.php';
require_once 'class/fabricante.php';
require_once 'class/lista_fabricante.php';
require_once 'class/lista_tipo.php';
require_once 'class/lista_unidade.php';

class ProdutoList{

    private $html;

    public function __construct()
    {
        $this->html = file_get_contents('HTML/list_produto.html');
    }

    public function delete($param){
        try {
            $id = (int) $param['id'];
            Produto::delete($id);

        } catch (Exception $e){
            print $e->getMessage();
        }
    }
    
    public function load(){
        try {
            $produtos = Produto::all();
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