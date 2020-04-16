<?php
    session_start();

    $lista = new Lista();
    $lista->__set('pedido_id',$_SESSION['pedido'])
        ->__set('cliente_id',$_SESSION['id']);
    
    $service = new ListaService($lista,new Conexao());
    
    echo json_encode($service->getListCliente());
?>