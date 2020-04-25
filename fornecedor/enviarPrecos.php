<?php
    session_start();
    
    $fornecedor = new Fornecedor();
    $fornecedor->__set('id',$_SESSION['id']);

    if(!isset($_POST['lista']) || !isset($_POST['cliente_id']) || !isset($_POST['pedido_id'])){
        echo 'empty';
        die;
    }
    $fornecedor->limparCotacaoCliente($_POST['pedido_id'],$_POST['cliente_id']);
    foreach($_POST['lista'] as $item){
        $fornecedor->setarItemCotacaoCliente($_POST['pedido_id'],$_POST['cliente_id'],$item['id_produto'],$item['valor']);
    }
    echo 'success';
?>