<?php
    require_once '../app_cotacao/Model/Model.php';

    class Fornecedor extends Model{

        public function autenticar(){
           try{
                $query = 'SELECT 
                            id,company_name
                        FROM 
                            fornecedor
                        WHERE 
                            email = ? AND
                            pass = ?';
                $stmt = $this->con->prepare($query);
                $stmt->bindValue(1,$this->__get('email'));
                $stmt->bindValue(2,$this->__get('pass'));
                $stmt->execute();
                $response =  $stmt->fetch(\PDO::FETCH_ASSOC);
                $this->__set('id',$response['id']);
                $this->__set('company_name',$response['company_name']);
                return $this;
           }catch(\PDOException $e){
                echo $e;
           }
        }
    }

?>