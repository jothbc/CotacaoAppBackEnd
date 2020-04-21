<?php

class Connection
{
    private $host = 'localhost';
    private $dbname = 'php_pedidos';
    private $user = 'root';
    private $pass = '';

    static public function getConnection()
    {
        try {
            $conexao = new PDO(
                "mysql:host=localhost;dbname=php_pedidos",
                "root",
                ""
            );
            return $conexao;
        } catch (PDOException $e) {
            
        }
    }
}

?>