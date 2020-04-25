<?php
     if(!isset($_GET['fornecedor_id']) || !isset($_GET['cliente_id']) || !isset($_GET['pedido_id']) || !isset($_GET['produto_id'])){
        echo 'fail';
        die;
    }
    $cliente = new Cliente();
    $cliente->__set('id',$_GET['cliente_id']);
    $cliente->__set('ultimo_pedido',$_GET['pedido_id']);

    $obs = $cliente->getObs($_GET['fornecedor_id'],$_GET['produto_id']);
    if(isset($obs['obs'])){
        echo $obs['obs'];
    }else{
        echo 'NA';
    }
?>