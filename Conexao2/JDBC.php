<?php
class Conexao
{
    private $host = 'localhost';
    private $dbname = 'php_pedidos';
    private $user = 'root';
    private $pass = '';

    public function conectar()
    {
        try {
            $conexao = new PDO(
                "mysql:host=$this->host;dbname=$this->dbname",
                "$this->user",
                "$this->pass"
            );
            return $conexao;
        } catch (PDOException $e) {
            echo '<p>' . $e->getMessage() . '</p>';
        }
    }
}
class ConexaoFirebird
{
    private $host = 'firebird:dbname=192.168.0.158:C:/IBS/Sisfatura/SISFATURA.FDB; charset = utf-8;';
    private $password = 'masterkey';
    private $username = 'SYSDBA';

    public function conectar()
    {
        try {
            $firebird = new PDO(
                $this->host,
                $this->username,
                $this->password,
                [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]
            );
            return $firebird;
        } catch (PDOException $e) {
            echo '<p>' . $e->getMessage() . '</p>';
        }
    }
}

?>
