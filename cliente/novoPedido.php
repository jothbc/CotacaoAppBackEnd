<?php
    session_start();

    $cliente = new Cliente();
    $cliente->__set('id',$_SESSION['id']);
    echo $cliente->novoPedido();
?>