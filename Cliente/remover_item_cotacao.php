<?php
   
    if(isset($_GET['id_item_cotacao'])){
        $id = $_GET['id_item_cotacao'];

        $pedido = new ProdutoPedido();
        $pedido->__set('id',$id);

        $service = new ProdutoPedidoService($pedido, new Conexao());
        $service->delete();
    }
    header("Location: ./cotacao.php");
?>