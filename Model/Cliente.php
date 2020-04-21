<?php
require_once '../app_cotacao/Model/Model.php';

class Cliente extends Model
{
    private $ultimo_pedido;

    public function autenticar(){
        try {
            $query = 'SELECT 
                            id,company_name
                        FROM 
                            cliente
                        WHERE 
                            email = ? AND
                            pass = ?';
            $stmt = $this->con->prepare($query);
            $stmt->bindValue(1, $this->__get('email'));
            $stmt->bindValue(2, $this->__get('pass'));
            $stmt->execute();
            $response =  $stmt->fetch(\PDO::FETCH_ASSOC);
            if(isset($response['id'])){
                $this->__set('id', $response['id']);
                $this->__set('company_name', $response['company_name']);
            }
            return $this;
        } catch (\PDOException $e) {
            echo $e;
        }
    }

    public function getClientePorEmail(){
        try {
            $query = 'SELECT 
                            id
                        FROM 
                            cliente
                        WHERE 
                            email = ?';
            $stmt = $this->con->prepare($query);
            $stmt->bindValue(1, $this->__get('email'));
            $stmt->execute();
            $response = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $response;
        } catch (\PDOException $e) {
            echo $e;
        }
    }

    public function cadastrar(){
        try {
            $query = 'INSERT INTO 
                            cliente (email,pass,company_name,cnpj,tel,tel_2)
                        VALUES 
                            (:email,:pass,:company_name,:cnpj,:tel,:tel2)';
            $stmt = $this->con->prepare($query);
            $stmt->bindValue(':email', $this->__get('email'));
            $stmt->bindValue(':pass', $this->__get('pass'));
            $stmt->bindValue(':tel', $this->__get('tel'));
            $stmt->bindValue(':tel2', $this->__get('tel2'), null != $this->__get('tel2') ? PDO::PARAM_STR : PDO::PARAM_NULL );
            $stmt->bindValue(':cnpj', $this->__get('cnpj'));
            $stmt->bindValue(':company_name', $this->__get('company_name'));
            $stmt->execute();
            
            $this->__set('id',$this->con->lastInsertId());
            return $this;
        } catch (\PDOException $e) {
            echo $e;
        }
    }
}

?>