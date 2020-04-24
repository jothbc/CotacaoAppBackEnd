<?php

    session_start();
    $fornecedor_id = $_SESSION['id'];
    $cliente_id = $_POST['id'];

    $fornecedor = new Fornecedor();
    $fornecedor->__set('id',$fornecedor_id);

    if($fornecedor->removerCliente($cliente_id)){
        echo true;
    }else{
        echo false;
    }
?>