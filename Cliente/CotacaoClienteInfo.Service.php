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
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo '<p>' . $e->getMessage() . '</p>';
        }
    }
    public function read()
    {
        try {
            $sql = 'select * from cotacao_cliente_info where cliente_id = :cliente_id and pedido = :pedido';
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(":cliente_id", $this->cotacao->__get('cliente_id'));
            $stmt->bindValue(":pedido", $this->cotacao->__get('pedido'));
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo '<p>' . $e->getMessage() . '</p>';
        }
    }
    public function update()
    {
    }
    public function delete()
    {
    }
}
