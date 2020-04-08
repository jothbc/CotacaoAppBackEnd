<?php
    class ProdutoPedidoService{
        private $produtoPedido;
        private $conexao;


        public function __construct(ProdutoPedido $produtoPedido, Conexao $conexao)
        {
            $this->produtoPedido = $produtoPedido;
            $this->conexao = $conexao->conectar();
        }

        public function create(){
            
        }
        public function read(){
            
        }
        public function update(){
            
        }
        public function delete(){
            
        }

    }


?>