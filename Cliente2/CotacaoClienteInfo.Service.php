<?php
class CotacaoClienteInfoService
{
    private $cotacao;
    private $conexao;

    public function __construct(CotacaoClienteInfo $cotacao, Conexao $conexao)
    {
        $this->cotacao = $cotacao;
        $this->conexao = $conexao->conectar();
    }

    public function create()
    {
        try {
            $sql = 'insert into cotacao_cliente_info(cliente_id,pedido) values (?,?)';
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(1, $this->cotacao->__get('cliente_id'));
            $stmt->bindValue(2, $this->cotacao->__get('pedido'));
            return $stmt->execute();
        } catch (PDOException $e) {
            echo '<p>' . $e->getMessage() . '</p>';
        }
    }
    public function read()
    {
        try {
            $sql = 'SELECT 
                        c.id, c.cliente_id, c.pedido, c.status, s.descricao 
                    FROM 
                        cotacao_cliente_info as c left join status_pedido as s 
                    on 
                        (c.status = s.id) 
                    where 
                        c.cliente_id = :cliente_id and c.pedido = :pedido';
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(":cliente_id", $this->cotacao->__get('cliente_id'));
            $stmt->bindValue(":pedido", $this->cotacao->__get('pedido'));
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo '<p>' . $e->getMessage() . '</p>';
        }
    }

    public function readAll()
    {
        try {
            $sql = 'SELECT 
                        c.id, c.cliente_id, c.pedido, c.status, s.descricao 
                    FROM 
                        cotacao_cliente_info as c left join status_pedido as s 
                    on 
                        (c.status = s.id) 
                    where 
                        c.cliente_id = :cliente_id';
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(":cliente_id", $this->cotacao->__get('cliente_id'));
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo '<p>' . $e->getMessage() . '</p>';
        }
    }

    public function update()
    {
        try{
            $sql = 'UPDATE 
                        cotacao_cliente_info 
                    SET
                        cliente_id = ?,
                        pedido = ?,
                        `status` = ?
                    WHERE 
                        id = ?';
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(1,$this->cotacao->__get('cliente_id'));
            $stmt->bindValue(2,$this->cotacao->__get('pedido'));
            $stmt->bindValue(3,$this->cotacao->__get('status'));
            $stmt->bindValue(4,$this->cotacao->__get('id'));
            return $stmt->execute();
        }catch(PDOException $e){
            echo '<p>' . $e->getMessage() . '</p>';
        }
    }

    public function alterStatus(){
        try{
            $sql = 'UPDATE 
                        cotacao_cliente_info 
                    SET
                        `status` = !`status`
                    WHERE 
                        cliente_id= ? AND pedido = ?';
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(1,$this->cotacao->__get('cliente_id'));
            $stmt->bindValue(2,$this->cotacao->__get('pedido'));
            return $stmt->execute();
        }catch(PDOException $e){
            echo '<p>' . $e->getMessage() . '</p>';
        }
    }
    public function delete()
    {
        try{
            $sql = 'DELETE FROM cotacao_cliente_info WHERE cliente_id = ? AND pedido = ?';
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(1,$this->cotacao->__get('cliente_id'));
            $stmt->bindValue(2,$this->cotacao->__get('pedido'));
            return $stmt->execute();
        }catch(PDOException $e){
            echo '<p>' . $e->getMessage() . '</p>';
        }
    }
    public function getStatus(){
        try{
            $sql = 'SELECT `status` FROM cotacao_cliente_info WHERE cliente_id = ? AND pedido = ?';
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(1,$this->cotacao->__get('cliente_id'));
            $stmt->bindValue(2,$this->cotacao->__get('pedido'));
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo '<p>' . $e->getMessage() . '</p>';
        }
    }
}