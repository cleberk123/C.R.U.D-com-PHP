<?php
    
    require_once 'class/fabricante.php';
    require_once 'class/lista_fabricante.php';
    require_once 'class/lista_unidade.php';
    require_once 'class/lista_tipo.php';
    require_once 'class/produto.php';

    class FabricanteForm{

        private $html;
        private $dados;
        private $mensagem;

        public function __construct()
        {
            $this->html = file_get_contents('HTML/form_fabricante.html');
            $this->dados = [
                'id'       => null,
                'nome'     => null,
                'site'     => null
            ];

            $this->mensagem = "";
        }

        public function edit($param)
        {
            try 
            {
                $id = (int) $param['id'];

                $fabricante = Fabricante::find($id);
                $this->dados = $fabricante;         
            } 
            catch (Exception $e) 
            {
                print $e->getMessage();
            }
        }

        public function save($param)
        {
            try {
                
                Fabricante::save($param);
                $this->dados = $param;

                $texto = file_get_contents('HTML/mensagem_info.html');
                $texto = str_replace('{texto_mensagem}', "Fabricante salvo com sucesso", $texto);
                $this->mensagem = $texto;

            } catch (Exception $e) {
                print $e->getMessage();
            }
        }

        public function show()
        {
            $this->html = str_replace('{id}', $this->dados['id'], $this->html);
            $this->html = str_replace('{nome}', $this->dados['nome'], $this->html);
            $this->html = str_replace('{site}', $this->dados['site'], $this->html);

            $this->html = str_replace('{mensagem}', $this->mensagem, $this->html);

            print $this->html;
        }
    }
?>