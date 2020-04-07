<?php
    class CotacaoClienteInfo{
        private $id;
        private $cliente_id;
        private $pedido;
        private $status;

        public function __set($attr,$value){
            $this->$attr = $value;
            return $this;
        }
        public function __get($attr){
            return $this->$attr;
        }
    }
?>
