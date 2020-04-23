<?php

    session_start();
    
    $id_produto = $_POST['id_produto'];
    $pedido = $_POST['pedido'];

    $produto = new Produto();
    $produto->__set('id',$id_produto);

    echo $produto->adicionarAoPedido($pedido,$_SESSION['id']);
?>