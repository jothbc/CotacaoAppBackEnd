<?php

    if(!isset($_POST['cliente_id']) || !isset($_POST['pedido_id'])){
        echo 'fail';
    }
    $cliente = new Cliente();
    $cliente->__set('id',$_POST['cliente_id']);
    $cliente->__set('ultimo_pedido',$_POST['pedido_id']);

    echo $cliente->alterarStatusPedido();
?>