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
                $sql = 'SELECT 
                            co.* ,p.descricao
                        FROM 
                            cotacao_cliente_lista AS co LEFT JOIN produto AS p
                        ON
                            (co.produto_id = p.id)
                        WHERE 
                            co.cliente_id = ? AND co.pedido_id = ?';
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
                $sql = 'SELECT 
                            co.*,fo.company_name 
                        FROM 
                            cotacao_fornecedor_lista AS co LEFT JOIN fornecedor AS fo
                        ON
                            (co.fornecedor_id = fo.id)
                        WHERE 
                            co.cliente_id = ? AND co.pedido_id = ?';
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