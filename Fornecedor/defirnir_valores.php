<?php
session_start();

$fornecedor_id = $_SESSION['id'];
$pedido_id = $_SESSION['pedido'];
$cliente_id = $_SESSION['cliente_id'];

$conexao = new Conexao();
//limpa lista
(new ListaService(new Lista(), $conexao))->deleteAll($fornecedor_id,$pedido_id,$cliente_id);

if (isset($_POST['dado'])) {
    
    foreach ($_POST['dado'] as $key => $item) {
        $dado = new Lista();
        $dado->__set('fornecedor_id', $fornecedor_id)
            ->__set('pedido_id', $pedido_id)
            ->__set('cliente_id', $cliente_id)
            ->__set('produto_id', $item['id_prod'])
            ->__set('valor', $item['valor']);
        print_r($dado);
        $service = new ListaService($dado, $conexao);
        
        $service->create();
    }
}

?>