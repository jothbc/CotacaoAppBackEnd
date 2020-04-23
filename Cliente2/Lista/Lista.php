<?php
    class Lista{
        private $id;
        private $cliente_id;
        private $pedido_id;
        private $produto_id;

        private $fornecedor_id;
        private $aprovado;

        public function __set($attr,$value){
            $this->$attr = $value;
            return $this;
        }

        public function __get($attr){
            return $this->$attr;
        }
    }


?>