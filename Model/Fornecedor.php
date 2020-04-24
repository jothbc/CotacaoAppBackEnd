<?php

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
                if(isset($response['id'])){
                    $this->__set('id', $response['id']);
                    $this->__set('company_name', $response['company_name']);
                }
                return $this;
           }catch(\PDOException $e){
                echo $e;
           }
        }

        public function getInfo(){
            try{
                $query = 'SELECT 
                            email,
                            company_name,
                            cnpj,
                            tel,
                            tel_2
                        FROM 
                            fornecedor
                        WHERE 
                            id = :id';
                $stmt = $this->con->prepare($query);
                $stmt->bindValue(':id',$this->__get('id'));
                $stmt->execute();
                return $stmt->fetch(\PDO::FETCH_ASSOC);
           }catch(\PDOException $e){
                echo $e;
           }
        }

        public function getClientes(){
            try{
                $query = 'SELECT 
                            fo.id,
                            fo.cliente_id,
                            cl.company_name,
                            cl.cnpj
                        FROM 
                            fornecedor_clientes as fo
                            LEFT JOIN cliente as cl
                        ON
                            (fo.cliente_id = cl.id)
                        WHERE 
                            fo.fornecedor_id = :id';
                $stmt = $this->con->prepare($query);
                $stmt->bindValue(':id',$this->__get('id'));
                $stmt->execute();
                return $stmt->fetchAll(\PDO::FETCH_ASSOC);
           }catch(\PDOException $e){
                echo $e;
           }
        }

        public function addCliente($cliente_id){
            try{
                $query = 'INSERT INTO 
                            fornecedor_clientes (fornecedor_id,cliente_id)
                        VALUES 
                            (:fornecedor_id,:cliente_id)';
                $stmt = $this->con->prepare($query);
                $stmt->bindValue(':fornecedor_id',$this->__get('id'));
                $stmt->bindValue(':cliente_id',$cliente_id);
                $stmt->execute();
                return $this->con->lastInsertId();
           }catch(\PDOException $e){
                echo $e;
           }
        }

        public function removerCliente($cliente_id){
            try{
                $query = 'DELETE FROM 
                            fornecedor_clientes
                        WHERE 
                            fornecedor_id = :fornecedor_id AND
                            cliente_id = :cliente_id';
                $stmt = $this->con->prepare($query);
                $stmt->bindValue(':fornecedor_id',$this->__get('id'));
                $stmt->bindValue(':cliente_id',$cliente_id);
                return $stmt->execute();
           }catch(\PDOException $e){
                echo $e;
           }
        }
    }

?>