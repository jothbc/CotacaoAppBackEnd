<?php
    // Array ( [pass_atual] => 12 [pass_novo] => 123 [pass_novo2] => 3123132 )
    session_start();
    if(!isset($_SESSION['id'])){
        header('Location: route.php?route=logoff');
    }
    
    if($_POST['pass_novo'] != $_POST['pass_novo2']){
        header('Location: Cliente/perfil.php?pass=diferent');
        die;
    }

    $cliente = new Cliente();
    $cliente->__set('id',$_SESSION['id']);
    $cliente->__set('pass',md5($_POST['pass_atual']));
    $valida = $cliente->autenticar2();
    if(isset($valida['company_name']) && $valida['company_name']!=''){
        $cliente->__set('pass',md5($_POST['pass_novo']));
        if($cliente->atualizarSenha()){
            header('Location: Cliente/index.php?editPerfil=success');
            die;
        }
    }
    header('Location: Cliente/index.php?editPerfil=fail')

?>