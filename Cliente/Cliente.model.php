<?php
class Cliente
{
    private $id;
    private $email;
    private $pass;
    private $company_name;
    private $cnpj;
    private $tel, $tel2;

    public function __set($attr, $value)
    {
        $this->$attr =  $value;
        return $this;
    }

    public function __get($attr){
        return $this->$attr;
    }
}
