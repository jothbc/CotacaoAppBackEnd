<?php

if (!isset($_POST['email']) || !isset($_POST['senha']) || !isset($_POST['senha2']) || !isset($_POST['tel']) || !isset($_POST['cnpj']) || !isset($_POST['company_name']) || !isset($_POST['opcao'])) {
    echo 'campos';
    die;
}
$die = false;
if (strlen($_POST['email']) < 10) {
    echo 'emailErro';
    $die=true;
}
if (strlen($_POST['senha'] < 3)) {
    echo 'senhaMin';
    $die=true;
}
if($_POST['senha']!= $_POST['senha2']){
    echo 'senhaDif';
    $die=true;
}
if(strlen($_POST['tel'])<9){
    echo 'telMin';
    $die=true;
}
if(strlen($_POST['cnpj'])<11){
    echo 'cnpjMin';
    $die=true;
}
if(strlen($_POST['company_name'])<3){
    echo 'compMin';
    $die=true;
}
if($die){
    die;
}

if($_POST['opcao']== 'cliente'){
    require_once '../app_cotacao/Model/Cliente.php';
    $cliente = new Cliente();
    $cliente->__set('email',$_POST['email']);
    $cliente->__set('pass',md5($_POST['senha']));
    $cliente->__set('tel',$_POST['tel']);
    if($_POST['tel2']!=''){
        $cliente->__set('tel2',$_POST['tel2']);
    }
    $cliente->__set('cnpj',$_POST['cnpj']);
    $cliente->__set('company_name',$_POST['company_name']);

    $existe = $cliente->getClientePorEmail();

    if(!isset($existe['id'])){
        $cliente->cadastrar();
        echo 'success';
    }else{
        echo 'emailDup';
    }
}

?>