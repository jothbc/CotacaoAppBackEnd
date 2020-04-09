<?php
class ProdutoService
{
    private $conexao;
    private $produto;


    public function __construct(Produto $produto, Conexao $conexao)
    {
        $this->produto = $produto;
        $this->conexao = $conexao->conectar();
    }

    public function create()
    {
        try {
            $sql = 'insert into produto (descricao) values(?)';
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(1, $this->produto->__get('descricao'));
            $stmt->execute();
            return $this->conexao->lastInsertId();
        } catch (PDOException $e) {
            echo '<p>' . $e->getMessage() . '</p>';
        }
    }
    public function read($attr)
    {
        if ($attr == 'id') {
            try {
                $sql = "select * from produto where id = ?";
                $stmt = $this->conexao->prepare($sql);
                $stmt->bindValue(1, $this->produto->__get('id'));
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo '<p>' . $e->getMessage() . '</p>';
            }
        }else if($attr == 'descricao'){
            try {
                $sql = "SELECT * FROM produto where descricao like '%".$this->produto->__get('descricao')."%'";
                $stmt = $this->conexao->prepare($sql);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo '<p>' . $e->getMessage() . '</p>';
            }
        }
    }
    public function update()
    {
    }
    public function delete()
    {
    }
}

?>