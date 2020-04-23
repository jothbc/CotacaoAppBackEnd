<?php
    session_start();
    $index_id_item = $_POST['id'];

    $cliente = new Cliente();
    $cliente->__set('id',$_SESSION['id']);
    if($cliente->removerItemPedido($index_id_item)){
        echo 'true';
    }else{
        echo 'false';
    }

?>