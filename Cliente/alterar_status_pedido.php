<?php
    
    if(isset($_GET['cliente_id']) && isset($_GET['pedido'])){
        $cotacao = new CotacaoClienteInfo();
        $cotacao->__set('cliente_id',$_GET['cliente_id']);
        $cotacao->__set('pedido',$_GET['pedido']);

        $service = new CotacaoClienteInfoService($cotacao,new Conexao());
        $service->alterStatus();
    }

    header("Location: ./cotacao.php")
?>