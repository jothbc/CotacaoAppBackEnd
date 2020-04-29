<?php

    session_start();
    if(!isset($_SESSION['id']) || !isset($_POST['produto_index']) || !isset($_POST['pedido'])){
        echo 'fail';
        die;
    }
    
    $produto_index = $_POST['produto_index'];
    $pedido = $_POST['pedido'];
    $pretencao = isset($_POST['pretencao'])? $_POST['pretencao']: '';

    $cliente = new Cliente();
    $cliente->__set('id',$_SESSION['id']);
    $cliente->__set('ultimo_pedido',$pedido);

    if($cliente->setPretencao($produto_index,$pretencao)){
        echo 'success';
    }else{
        echo 'fail2';
    }
?>