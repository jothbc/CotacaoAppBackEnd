<?php
   
    if(isset($_POST['id_item_cotacao'])){
        $id = $_POST['id_item_cotacao'];

        $pedido = new ProdutoPedido();
        $pedido->__set('id',$id);

        $service = new ProdutoPedidoService($pedido, new Conexao());
        echo $service->delete();
    }
?>