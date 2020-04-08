<?php
    session_start();
    // echo '<pre>';
    // print_r($_SESSION);
    // echo '</pre>';

    // echo '<pre>';
    // print_r($_GET);
    // echo '</pre>';

    $cotacao = new CotacaoClienteInfo();
    $cotacao->__set('cliente_id',$_SESSION['id']);
    $cotacao->__set('pedido',$_GET['pedido']);

    $service = new CotacaoClienteInfoService($cotacao,new Conexao());
    if ($service->delete()){
        header("Location: ./index.php?delete=success");
    }else{
        header("Location: ./index.php?delete=fail");
    }
?>