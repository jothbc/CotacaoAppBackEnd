<?php
    session_start();

    // segurança da página
    if (!isset($_SESSION['authenticate']) && $_SESSION['authenticate'] != 'yes') {
        session_destroy();
        header("Location: ../index.php?erro=login");
    }


    $cliente_id = $_SESSION['id'];
    $pedido_id = $_GET['pedido'];
    $produto_id = $_GET['item_id'];

    $pedido = new ProdutoPedido();
    $pedido->__set('cliente_id',$cliente_id);
    $pedido->__set('pedido_id',$pedido_id);
    $pedido->__set('produto_id',$produto_id);

    $service = new ProdutoPedidoService($pedido,new Conexao);
    $service->create();

?>