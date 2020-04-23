<?php

    class Produto{

        private $id;
        private $descricao;
        private $con;

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

        public function buscarProdutos(){
            try{
                $query = 'SELECT
                                id,descricao
                            FROM
                                produto
                            WHERE
                                descricao LIKE :busca';
                $stmt = $this->con->prepare($query);
                $stmt->bindValue(':busca',$this->__get('descricao'));
                $stmt->execute();
                return $stmt->fetchAll(\PDO::FETCH_ASSOC);
            }catch(\PDOException $e){

            }
        }

        public function adicionarAoPedido($pedido,$cliente_id){
            try{
                $query = 'INSERT INTO
                                cotacao_cliente_lista(cliente_id,pedido_id,produto_id)
                            VALUES
                                (:cliente_id,:pedido_id,:produto_id)';
                $stmt = $this->con->prepare($query);
                $stmt->bindValue(':cliente_id',$cliente_id);
                $stmt->bindValue(':pedido_id',$pedido);
                $stmt->bindValue(':produto_id',$this->__get('id'));
                $stmt->execute();
                return $this->con->lastInsertId();
            }catch(\PDOException $e){

            }
        }

    }

?>