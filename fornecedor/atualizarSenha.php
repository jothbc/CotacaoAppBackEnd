<?php
    // Array ( [pass_atual] => 12 [pass_novo] => 123 [pass_novo2] => 3123132 )
    session_start();
    if(!isset($_SESSION['id'])){
        header('Location: route.php?route=logoff');
    }
    
    if($_POST['pass_novo'] != $_POST['pass_novo2']){
        header('Location: Fornecedor/perfil.php?pass=diferent');
        die;
    }

    $fornecedor = new Fornecedor();
    $fornecedor->__set('id',$_SESSION['id']);
    $fornecedor->__set('pass',md5($_POST['pass_atual']));
    $valida = $fornecedor->autenticar2();
    if(isset($valida['company_name']) && $valida['company_name']!=''){
        $fornecedor->__set('pass',md5($_POST['pass_novo']));
        if($fornecedor->atualizarSenha()){
            header('Location: Fornecedor/index.php?editPerfil=success');
            die;
        }
    }
    header('Location: Fornecedor/index.php?editPerfil=fail')

?>