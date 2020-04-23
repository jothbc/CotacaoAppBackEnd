<?php
class ListaService
{
    private $lista;
    private $conexao;

    public function __construct(Lista $lista, Conexao $conexao)
    {
        $this->lista = $lista;
        $this->conexao = $conexao->conectar();
    }

    public function create()
    {
        try{
            $sql = 'INSERT INTO 
                        cotacao_fornecedor_lista (fornecedor_id,pedido_id,cliente_id,produto_id,valor)
                    VALUES
                        (:fornecedor_id,:pedido_id,:cliente_id,:produto_id,:valor)';
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(":fornecedor_id",$this->lista->__get('fornecedor_id'));
            $stmt->bindValue(":pedido_id",$this->lista->__get('pedido_id'));
            $stmt->bindValue(":cliente_id",$this->lista->__get('cliente_id'));
            $stmt->bindValue(":produto_id",$this->lista->__get('produto_id'));
            $stmt->bindValue(":valor",$this->lista->__get('valor'));
            $stmt->execute();
            return $this->conexao->lastInsertId();
        }catch(PDOException  $e){
            echo '<p>'.$e->getMessage().'</p>';
        }
    }
    
    public function alterar_status_item_aprovado(){
        try{
            $sql = 'UPDATE
                        cotacao_fornecedor_lista
                    SET
                        aprovado = !aprovado
                    WHERE
                        fornecedor_id = :fornecedor_id AND
                        cliente_id = :cliente_id AND
                        pedido_id = :pedido_id AND
                        produto_id =:produto_id';
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(":fornecedor_id",$this->lista->__get('fornecedor_id'));
            $stmt->bindValue(":cliente_id",$this->lista->__get('cliente_id'));
            $stmt->bindValue(":pedido_id",$this->lista->__get('pedido_id'));
            $stmt->bindValue(":produto_id",$this->lista->__get('produto_id'));
            return $stmt->execute();
        }catch(PDOException  $e){
            echo '<p>'.$e->getMessage().'</p>';
        }
    }

    public function delete()
    {
        try{
            $sql = 'DELETE FROM 
                    cotacao_fornecedor_lista 
                WHERE 
                    fornecedor_id = :fornecedor_id AND
                    pedido_id = :pedido_id AND
                    cliente_id = :cliente_id AND
                    produto_id = :produto_id';
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(":fornecedor_id",$this->lista->__get('fornecedor_id'));
            $stmt->bindValue(":pedido_id",$this->lista->__get('pedido_id'));
            $stmt->bindValue(":cliente_id",$this->lista->__get('cliente_id'));
            $stmt->bindValue(":produto_id",$this->lista->__get('produto_id'));
            return $stmt->execute();
        }catch(PDOException  $e){
            echo '<p>'.$e->getMessage().'</p>';
        }
    }

    public function deleteAll($fornecedor_id,$pedido_id,$cliente_id){
        try{
            $sql = 'DELETE FROM 
                    cotacao_fornecedor_lista 
                WHERE 
                    fornecedor_id =:fornecedor_id AND
                    pedido_id = :pedido_id AND
                    cliente_id = :cliente_id';
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(":fornecedor_id",$fornecedor_id);
            $stmt->bindValue(":pedido_id",$pedido_id);
            $stmt->bindValue(":cliente_id",$cliente_id);
            return $stmt->execute();
        }catch(PDOException  $e){
            echo '<p>'.$e->getMessage().'</p>';
        }
    }
    public function readAllList($cnpj, $pedido)
    {
        //busca o pedido pelo numero e cnpj enquanto a cotação existir e o pedido estiver aberto
        try {
            $sql = 'SELECT 
                        ped.*, coi.`status`
                    FROM
                        (SELECT 				
                            c.cliente_id,
                            c.company_name,
                            c.pedido_id,
                            c.produto_id,
                            p.descricao
                        FROM
                            (SELECT
                                co.*,cl.cnpj,cl.company_name
                            FROM
                                cotacao_cliente_lista AS co JOIN cliente AS cl
                            ON
                                (co.cliente_id = cl.id)
                            WHERE
                                cl.cnpj = :cnpj AND co.pedido_id = :pedido) AS c LEFT JOIN produto AS p
                        ON (c.produto_id = p.id)) AS ped LEFT JOIN cotacao_cliente_info AS coi
                    ON
                        (ped.pedido_id = coi.pedido)
                    ';
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(":cnpj", $cnpj);
            $stmt->bindValue(":pedido", $pedido);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo '<p>'.$e->getMessage().'</p>';
        }
    }

    public function readAllInformado($cnpj, $pedido,$fornecedor_id){
        try {
            $sql = 'SELECT 
                cf.* 
            FROM 
                cotacao_fornecedor_lista AS cf LEFT JOIN cliente 
            ON 
                (cf.cliente_id = cliente.id)
            where 
                cf.pedido_id = :pedido_id AND cliente.cnpj = :cnpj AND cf.fornecedor_id = :fornecedor_id';
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(":pedido_id", $pedido);
            $stmt->bindValue(":cnpj", $cnpj);
            $stmt->bindValue(":fornecedor_id", $fornecedor_id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo '<p>'.$e->getMessage().'</p>';
        }
    }
}

?>