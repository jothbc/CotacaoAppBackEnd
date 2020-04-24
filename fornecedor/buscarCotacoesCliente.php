<?php
    $cliente = new Cliente();
    $cliente->__set('id',$_GET['cliente_id']);

    echo json_encode($cliente->getPedidos());
?>