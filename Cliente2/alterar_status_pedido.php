<?php
    session_start();
    if(isset($_SESSION['id']) && isset($_SESSION['pedido'])){
        $cotacao = new CotacaoClienteInfo();
        $cotacao->__set('cliente_id',$_SESSION['id']);
        $cotacao->__set('pedido',$_SESSION['pedido']);

        $service = new CotacaoClienteInfoService($cotacao,new Conexao());
        $service->alterStatus();

        echo $service->getStatus()['status'];
    }
?>