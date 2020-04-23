<?php

    print_r($_POST);
    $conexao = new Conexao();
    $lista = new Lista();
    $lista->__set('fornecedor_id',$_POST['fornecedor_id'])
        ->__set('cliente_id',$_POST['cliente_id'])
        ->__set('pedido_id',$_POST['pedido_id'])
        ->__set('produto_id',$_POST['produto_id']);

    $service = new ListaService($lista,$conexao);
    echo json_encode($service->alterar_status_item_aprovado());
?>