<?php
session_start();

if (!isset($_SESSION['tipo'])) {
    header("Location: ../index.php?cadastro=erro");
}

$tipo = $_SESSION['tipo'];
if ($tipo == 'cliente') {
    $cliente = new Cliente();
    $cliente->__set('email', trim($_POST['email']))
        ->__set('pass', $_POST['pass'])
        ->__set('company_name',trim($_POST['company_name']))
        ->__set('cnpj', trim($_POST['cnpj']))
        ->__set('tel', trim($_POST['tel']));
    if ($_POST['tel2']) {
        $cliente->__set('tel2', trim($_POST['tel2']));
    }
    $service = new ClienteService($cliente, new Conexao());
    if ($service->create()){
        header("Location: ../index.php?cadastro=success");
    }else{
        header("Location: ../index.php?cadastro=fail");
    }
} else if ($tipo == 'fornecedor') {
    $fornecedor = new Fornecedor();
    $fornecedor->__set('email', trim($_POST['email']))
        ->__set('pass', $_POST['pass'])
        ->__set('company_name', trim($_POST['company_name']))
        ->__set('cnpj', trim($_POST['cnpj']))
        ->__set('tel', trim($_POST['tel']));
    if ($_POST['tel2']) {
        $fornecedor->__set('tel2',trim($_POST['tel2']));
    }
    $service = new FornecedorService($fornecedor, new Conexao());
    if ($service->create()){
        header("Location: ../index.php?cadastro=success");
    }else{
        header("Location: ../index.php?cadastro=fail");
    }
}



?>