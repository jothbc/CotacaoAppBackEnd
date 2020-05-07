<?php

    session_start();
    if(!isset($_SESSION['id'])){
        header('Location: route.php?route=logoff');
    }

    $cliente = new Cliente();
    $cliente->__set('id',$_SESSION['id']);
    $cliente->__set('company_name',$_POST['empresa']);
    $cliente->__set('cnpj',$_POST['cnpj']);
    $cliente->__set('tel',$_POST['tel']);
    $cliente->__set('tel2',$_POST['tel2']);
    $cliente->__set('email',$_POST['email']);

    if($cliente->atualizarCadastro()){
        $_SESSION['company_name'] = $cliente->__get('company_name');
        header('Location: Cliente/index.php?editPerfil=success');
    }else{
        header('Location: Cliente/index.php?editPerfil=fail');
    }
?>