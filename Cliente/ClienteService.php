<?php

class ClienteService
{
    private $cliente;
    private $conexao;

    public function __construct(Cliente $cliente, Conexao $conexao)
    {
        $this->cliente = $cliente;
        $this->conexao = $conexao->conectar();
    }

    public function create()
    {
        try {
            $sql = 'insert into cliente (email, pass, company_name,cnpj,tel,tel_2) value (:email, :pass, :comp, :cnpj, :tel, :tel2)';
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(':email', $this->cliente->__get('email'));
            $stmt->bindValue(':pass', $this->cliente->__get('pass'));
            $stmt->bindValue(':comp', $this->cliente->__get('company_name'));
            $stmt->bindValue(':cnpj', $this->cliente->__get('cnpj'));
            $stmt->bindValue(':tel', $this->cliente->__get('tel'));
            $stmt->bindValue(':tel2', $this->cliente->__get('tel2'), null != $this->cliente->__get('tel2') ? PDO::PARAM_STR : PDO::PARAM_NULL );
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo '<p class = "text-danger">' . $e->getMessage() . '</p>';
        }
    }

    public function read()
    {
        try{
            $sql = 'select * from cliente where id = ?';
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(1,$this->cliente->__get('id'));
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        }catch(PDOException $e){
            echo '<p class = "text-danger">' . $e->getMessage() . '</p>';
        }
    }

    public function update()
    {
    }

    public function delete()
    {
    }

    public function authencitation(){
        try{
            $sql = 'select * from cliente where email = ? and pass = ?';
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(1,$this->cliente->__get('email'));
            $stmt->bindValue(2,$this->cliente->__get('pass'));
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo '<p class = "text-danger">' . $e->getMessage() . '</p>';
        }
    }
}
