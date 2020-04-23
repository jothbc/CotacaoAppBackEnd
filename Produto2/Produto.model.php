<?php
    class Produto{
        private $id;
        private $descricao;

        public function __set($attr,$value){
            $this->$attr =$value;
            return $this;
        }

        public function __get($attr){
            return $this->$attr;
        }
    }
?>