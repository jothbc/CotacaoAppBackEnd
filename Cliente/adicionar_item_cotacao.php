<?php
    session_start();

    // segurança da página
    if (!isset($_SESSION['authenticate']) && $_SESSION['authenticate'] != 'yes') {
        session_destroy();
        header("Location: ../index.php?erro=login");
    }

    $cliente_id = $_SESSION['id'];
    $pedido_id = $_SESSION['pedido'];
    $produto_id;

    if(isset($_POST['novo'])){
        $produto_novo = new Produto();
        $produto_novo->__set('descricao',$_POST['novo']);

        $service_novo = new ProdutoService($produto_novo,new Conexao());
        $produto_id = $service_novo->create();
    }
    
    if(isset($_POST['item_id'])){
        $produto_id = $_POST['item_id'];
    }

    $pedido = new ProdutoPedido();
    $pedido->__set('cliente_id', $cliente_id);
    $pedido->__set('pedido_id', $pedido_id);
    $pedido->__set('produto_id', $produto_id);

    $service = new ProdutoPedidoService($pedido, new Conexao);
    $pedido->__set('id', $service->create());
    echo json_encode($service->read())
?>
