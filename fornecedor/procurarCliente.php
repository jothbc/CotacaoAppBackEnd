<?php
    session_start();

    if(isset($_GET['desc'])){
        $cliente = new Cliente();
        $lista = $cliente->procurarCliente($_GET['desc']);
        echo json_encode($lista);
    }
?>