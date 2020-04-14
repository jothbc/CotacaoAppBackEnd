<?php
session_start();
require_once "../../../app_cotacao/Cliente/Cliente.model.php";
require_once "../../../app_cotacao/Cliente/ClienteService.php";
require_once "../../../app_cotacao/Fornecedor/Fornecedor.model.php";
require_once "../../../app_cotacao/Fornecedor/Fornecedor.Service.php";

if (!isset($_POST['email']) && !isset($_POST['senha'])) {
    session_destroy();
    header("Location: ../index.php?erro=login");
}

if (isset($_POST['cliente']) && $_POST['cliente'] == 1) {
    //cliente tentando logar
    $cliente = new Cliente();
    $cliente->__set('email', trim($_POST['email'])) ;
    $cliente->__set('pass', $_POST['senha']) ;

    $conexao = new Conexao();
    $service = new ClienteService($cliente,$conexao);
    $auth = $service->authencitation();
    if($auth){
        //autenticou
        $_SESSION['authenticate'] = 'yes';
        $_SESSION['id'] = $auth['id'];
        $_SESSION['company_name'] = $auth['company_name'];

        header("Location: ../Cliente/index.php");
    }else{
        session_destroy();
        header("Location: ../index.php?erro=usuario");
    }
} else if (isset($_POST['fornecedor']) && $_POST['fornecedor'] == 1) {
   //fornecedor tentando logar
   $fornecedor = new Fornecedor();
   $fornecedor->__set('email', trim($_POST['email'])) ;
   $fornecedor->__set('pass', $_POST['senha']) ;

   $conexao = new Conexao();
   $service = new FornecedorService($fornecedor,$conexao);
   $auth = $service->authencitation();
   if($auth){
       //autenticou
       $_SESSION['authenticate'] = 'yes';
       $_SESSION['id'] = $auth['id'];
       $_SESSION['company_name'] = $auth['company_name'];
        // print_r($_SESSION);
       header("Location: ../Fornecedor/index.php");
   }else{
       session_destroy();
       header("Location: ../index.php?erro=usuario");
   }
    
}
