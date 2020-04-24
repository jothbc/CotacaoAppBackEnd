<?php
    session_start();

    $fornecedor_id = $_SESSION['id'];
    $cliente_cnpj = $_POST['cnpj'];

    $cliente = new Cliente();
    $cliente->__set('cnpj',$cliente_cnpj);
    $response = $cliente->getClientePorCNPJ();

    if(isset($response['id'])){
        $fornecedor = new Fornecedor();
        $fornecedor->__set('id',$fornecedor_id);

        $fornecedor->addCliente($response['id']);
        echo json_encode($response);
    }else{
        echo 'noCliente';
    }
?>