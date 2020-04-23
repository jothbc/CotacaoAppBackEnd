<?php
    abstract class Model{
        protected $con;
        protected $id;
        protected $email;
        protected $pass;
        protected $company_name;
        protected $cnpj;
        protected $tel;
        protected $tel2;

        public function __construct()
        {
            $this->con = Connection::getConnection();
        }

        public function __get($attr){
            return $this->$attr;
        }

        public function __set($attr,$value){
            $this->$attr = $value;
            return $this;
        }

    }

?>