<?php
    class ProdutoPedido{
        private $id;
        private $cliente_id;
        private $pedido_id;
        private $produto_id;

        public function __set($attr,$value){
            $this->$attr = $value;
            return $this;
        }

        public function __get($attr){
            return $this->$attr;
        }

    }

?>