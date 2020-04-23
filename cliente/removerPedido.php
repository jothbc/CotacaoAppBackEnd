<?php
    session_start();
    $pedido = $_POST['pedido'];

    $cliente = new Cliente();
    $cliente->__set('id',$_SESSION['id']);
    $cliente->__set('ultimo_pedido',$pedido);
    if($cliente->removerPedido()){
        echo 'true';
    }else{
        echo 'false';
    }

?>