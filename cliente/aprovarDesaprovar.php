<?php

    print_r($_POST);
    if(!isset($_POST['fornecedor_id']) || !isset($_POST['cliente_id']) || !isset($_POST['pedido_id']) || !isset($_POST['produto_id'])){
        echo 'fail';
        die;
    }
    $cliente = new Cliente();
    $cliente->__set('id',$_POST['cliente_id']);
    $cliente->__set('ultimo_pedido',$_POST['pedido_id']);

    echo $cliente->aprovarDesaprovar($_POST['fornecedor_id'],$_POST['produto_id']);
?>