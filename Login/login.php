<?php
session_start();
require_once "../../../app_cotacao/Cliente/Cliente.model.php";
require_once "../../../app_cotacao/Cliente/ClienteService.php";

if (!isset($_POST['email']) && !isset($_POST['senha'])) {
    session_destroy();
    header("Location: ../index.php?erro=login");
}
if (isset($_POST['cliente']) && $_POST['cliente'] == 1) {
    //cliente tentando logar
    $cliente = new Cliente();
    $cliente->__set('email', $_POST['email']) ;
    $cliente->__set('pass', $_POST['senha']) ;

    $conexao = new Conexao();
    $service = new ClienteService($cliente,$conexao);
    $novo = $service->authencitation();
    if($novo){
        //autenticou
        $_SESSION['authenticate'] = 'yes';
        $_SESSION['id'] = $novo['id'];
        $_SESSION['company_name'] = $novo['company_name'];

        header("Location: ../Cliente/index.php");
    }else{
        session_destroy();
        header("Location: ../index.php?erro=usuario");
    }
} else if (isset($_POST['fornecedor']) && $_POST['fornecedor'] == 1) {
    //fornecedor tentando logar
    
}
