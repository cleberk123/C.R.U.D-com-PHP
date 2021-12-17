<?php
    
    require_once 'class/fabricante.php';
    require_once 'class/lista_fabricante.php';
    require_once 'class/lista_unidade.php';
    require_once 'class/lista_tipo.php';
    require_once 'class/produto.php';

    class ProdutoForm {

        private $html;
        private $dados;
        private $mensagem;
    
        public function __construct()
        {
            $this->html = file_get_contents('html/form_produto.html');
            $this->dados = [
                'id'        => null,
                'descricao'      => null,
                'estoque'  => null,
                'preco_custo'    => null,
                'preco_venda'  => null,
                'id_fabricante'     => null,
                'id_unidade' => null,
                'id_tipo' => null
            ];
    
            $fabricantes = '';
            foreach(Lista_Fabricante::all() as $fabricante){
                $fabricantes .= "<option value='{$fabricante['id']}'> {$fabricante['nome']} </option>\n";
            }
    
            $this->html = str_replace('{fabricantes}', $fabricantes, $this->html);

            $unidades = '';
            foreach(Lista_Unidade::all() as $unidade){
                $unidades .= "<option value='{$unidade['id']}'> {$unidade['nome']} </option>\n";
            }
    
            $this->html = str_replace('{unidades}', $unidades, $this->html);

            $tipos = '';
            foreach(Lista_Tipo::all() as $tipo){
                $tipos .= "<option value='{$tipo['id']}'> {$tipo['nome']} </option>\n";
            }
    
            $this->html = str_replace('{tipos}', $tipos, $this->html);
            
            $this->mensagem = "";
        }
    
        public function edit($param){
            try{
                $id = (int) $param['id'];
                $produto = Produto::find($id);
                $this->dados = $produto;
    
            } catch (Exception $e){
                print $e->getMessage();
            }
        }
    
        public function save($param){
            try {
                Produto::save($param);
                $this->dados = $param;
                
                $texto = file_get_contents('HTML/mensagem_info.html');
                $texto = str_replace('{texto_mensagem}', "Produto salvo com sucesso", $texto);
                $this->mensagem = $texto;
    
            } catch (Exception $e){
                print $e->getMessage();
            }
        }
    
        public function show(){
            $this->html = str_replace('{id}',        $this->dados['id'],        $this->html);
            $this->html = str_replace('{descricao}',      $this->dados['descricao'],      $this->html);
            $this->html = str_replace('{estoque}',  $this->dados['estoque'],  $this->html);
            $this->html = str_replace('{preco_custo}',    $this->dados['preco_custo'],    $this->html);
            $this->html = str_replace('{preco_venda}',  $this->dados['preco_venda'],  $this->html);
            $this->html = str_replace('{id_fabricante}',     $this->dados['id_fabricante'],     $this->html);
            $this->html = str_replace('{id_unidade}', $this->dados['id_unidade'], $this->html);
            $this->html = str_replace('{id_tipo}', $this->dados['id_tipo'], $this->html);

            $this->html = str_replace('{mensagem}', $this->mensagem, $this->html);
    
            $this->html = str_replace("option value='{$this->dados['id_fabricante']}' ",
                                      "option selected=1 value='{$this->dados['id_fabricante']}'",
                                      $this->html);

            $this->html = str_replace("option value='{$this->dados['id_unidade']}' ",
                                      "option selected=1 value='{$this->dados['id_unidade']}'",
                                      $this->html);

            $this->html = str_replace("option value='{$this->dados['id_tipo']}' ",
                                      "option selected=1 value='{$this->dados['id_tipo']}'",
                                      $this->html);
    
            print $this->html;
        }
    }
