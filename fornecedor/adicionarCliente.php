<?php
    session_start();

    $fornecedor_id = $_SESSION['id'];
    $cliente_id = $_POST['cliente_id'];

    $cliente = new Cliente();
    $cliente->__set('id',$cliente_id);
    $response = $cliente->getMinhasInfos();
    unset($response['email']);
    unset($response['tel']);
    unset($response['tel_2']);

    if(isset($response['company_name'])){
        $fornecedor = new Fornecedor();
        $fornecedor->__set('id',$fornecedor_id);

        foreach ($fornecedor->getClientes() as $key => $value) {
            if($value['cliente_id'] == $cliente_id){
                echo json_encode('exist');
                return;
            }
        }

        $fornecedor->addCliente($cliente_id);
        echo json_encode($response);
    }else{
        echo json_encode('noCliente');
    }
?>