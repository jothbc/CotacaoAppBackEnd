<?php

class FornecedorService
{
    private $fornecedor;
    private $conexao;

    public function __construct($fornecedor, $conexao)
    {
        $this->fornecedor = $fornecedor;
        $this->conexao = $conexao->conectar();
    }

    public function create()
    {
        try {
            $sql = 'insert into fornecedor (email, pass, company_name,cnpj,tel,tel_2) value (:email, :pass, :comp, :cnpj, :tel, :tel2)';
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(':email', $this->fornecedor->__get('email'));
            $stmt->bindValue(':pass', $this->fornecedor->__get('pass'));
            $stmt->bindValue(':comp', $this->fornecedor->__get('company_name'));
            $stmt->bindValue(':cnpj', $this->fornecedor->__get('cnpj'));
            $stmt->bindValue(':tel', $this->fornecedor->__get('tel'));
            $stmt->bindValue(':tel2', $this->fornecedor->__get('tel2'), null != $this->fornecedor->__get('tel2') ? PDO::PARAM_STR : PDO::PARAM_NULL );
            $stmt->execute();
            return $this->conexao->lastInsertId();
        } catch (PDOException $e) {
            echo '<p class = "text-danger">' . $e->getMessage() . '</p>';
        }
    }
    public function read()
    {
        try{
            $sql = 'select * from fornecedor where id = ?';
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(1,$this->fornecedor->__get('id'));
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
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
            $sql = 'SELECT * FROM fornecedor WHERE email = ? AND pass = ?';
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(1,$this->fornecedor->__get('email'));
            $stmt->bindValue(2,$this->fornecedor->__get('pass'));
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo '<p class = "text-danger">' . $e->getMessage() . '</p>';
        }
    }
}

?>
