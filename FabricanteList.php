<?php
require_once 'class/produto.php';
require_once 'class/fabricante.php';
require_once 'class/lista_fabricante.php';
require_once 'class/lista_tipo.php';
require_once 'class/lista_unidade.php';

class FabricanteList{

    private $html;

    public function __construct()
    {
        $this->html = file_get_contents('HTML/list_fabricante.html');
    }

    public function delete($param){
        try {
            $id = (int) $param['id'];
            Fabricante::delete($id);

        } catch (Exception $e){
            print $e->getMessage();
        }
    }

    public function load(){
        try {
            $fabricantes = Fabricante::all();
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