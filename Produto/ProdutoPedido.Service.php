<?php
    class ProdutoPedidoService{
        private $produtoPedido;
        private $conexao;


        public function __construct(ProdutoPedido $produtoPedido, Conexao $conexao)
        {
            $this->produtoPedido = $produtoPedido;
            $this->conexao = $conexao->conectar();
        }

        public function create(){
            try{
                $sql = 'INSERT INTO 
                        cotacao_cliente_lista(cliente_id, pedido_id, produto_id) 
                        VALUES 
                            (?,?,?)';
                $stmt = $this->conexao->prepare($sql);
                $stmt->bindValue(1,$this->produtoPedido->__get('cliente_id'));
                $stmt->bindValue(2,$this->produtoPedido->__get('pedido_id'));
                $stmt->bindValue(3,$this->produtoPedido->__get('produto_id'));
                return $stmt->execute();
            }catch(PDOException $e){
                echo '<p>'.$e->getMessage().'</p>';
            }
        }
        public function read(){
            
        }
        public function update(){
            
        }
        public function delete(){
            try{
                $sql = 'DELETE FROM  
                            cotacao_cliente_lista
                        WHERE  
                            id = ?';
                $stmt = $this->conexao->prepare($sql);
                $stmt->bindValue(1,$this->produtoPedido->__get('id'));
                return $stmt->execute();
            }catch(PDOException $e){
                echo '<p>'.$e->getMessage().'</p>';
            }
        }

        public function readAll(){
            try{
                $sql = 'SELECT 
                            c.id,c.cliente_id,c.pedido_id, c.produto_id, p.descricao 
                        FROM 
                            cotacao_cliente_lista AS c LEFT JOIN produto AS p 
                        ON
                            (c.produto_id = p.id)
                        WHERE 
                            c.cliente_id = ? AND c.pedido_id = ?';
                $stmt = $this->conexao->prepare($sql);
                $stmt->bindValue(1,$this->produtoPedido->__get('cliente_id'));
                $stmt->bindValue(2,$this->produtoPedido->__get('pedido_id'));
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }catch(PDOException $e){
                echo '<p>'.$e->getMessage().'</p>';
            }
        }

    }
