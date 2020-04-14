<?php
    class ListaService {
        private $lista;
        private $conexao;

        public function __construct(Lista $lista,Conexao $conexao)
        {
            $this->lista = $lista;
            $this->conexao = $conexao->conectar();
        }

        public function getListCliente(){
            try{
                $sql = 'SELECT * FROM cotacao_cliente_lista WHERE cliente_id = ? AND pedido_id = ?';
                $stmt = $this->conexao->prepare($sql);
                $stmt->bindValue(1,$this->lista->__get('cliente_id'));
                $stmt->bindValue(2,$this->lista->__get('pedido_id'));
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }catch(PDOException $e){
                echo '<p>'.$e->getMessage().'</p>';
            }
        }

        public function getListFornecedores(){
            try{
                $sql = 'SELECT * FROM cotacao_fornecedor_lista WHERE cliente_id = ? AND pedido_id = ?';
                $stmt = $this->conexao->prepare($sql);
                $stmt->bindValue(1,$this->lista->__get('cliente_id'));
                $stmt->bindValue(2,$this->lista->__get('pedido_id'));
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }catch(PDOException $e){
                echo '<p>'.$e->getMessage().'</p>';
            }
        }

    }


?>