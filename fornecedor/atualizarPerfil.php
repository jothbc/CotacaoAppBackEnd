<?php

    session_start();
    if(!isset($_SESSION['id'])){
        header('Location: route.php?route=logoff');
    }

    $fornecedor= new Fornecedor();
    $fornecedor->__set('id',$_SESSION['id']);
    $fornecedor->__set('company_name',$_POST['empresa']);
    $fornecedor->__set('cnpj',$_POST['cnpj']);
    $fornecedor->__set('tel',$_POST['tel']);
    $fornecedor->__set('tel2',$_POST['tel2']);
    $fornecedor->__set('email',$_POST['email']);

    if($fornecedor->atualizarCadastro()){
        $_SESSION['company_name'] = $fornecedor->__get('company_name');
        header('Location: Fornecedor/index.php?editPerfil=success');
    }else{
        header('Location: Fornecedor/index.php?editPerfil=fail');
    }
?>