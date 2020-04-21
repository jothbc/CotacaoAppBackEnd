<?php

    if(isset($_POST['email']) && $_POST['email']!='' && isset($_POST['senha']) && $_POST['senha']!='' && isset($_POST['opcao'])){
        $opcao = $_POST['opcao'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        if(strlen($email)<5 || strlen($senha)<3){
            echo 'campos';
            die;
        }

        if($opcao == 'cliente'){
            require_once '../app_cotacao/Model/Cliente.php';
            $cliente = new Cliente();
            $cliente->__set('email',$email);
            $cliente->__set('pass',md5($senha));

            $cliente->autenticar();

            if(!empty($cliente->__get('id')) && !empty($cliente->__get('company_name'))){
                session_start();
                $_SESSION['id'] = $cliente->__get('id');
                $_SESSION['company_name'] = $cliente->__get('company_name');
                echo 'success';
            }else{
                echo 'fail';
            }
        }else if($opcao == 'fornecedor'){
            require_once '../app_cotacao/Model/Fornecedor.php';
            $fornecedor = new Fornecedor();
            $fornecedor->__set('email',$email);
            $fornecedor->__set('pass',md5($senha));
            $fornecedor->autenticar();
            if(!empty($fornecedor->__get('id')) && !empty($fornecedor->__get('company_name'))){
                session_start();
                $_SESSION['id'] = $fornecedor->__get('id');
                $_SESSION['company_name'] = $fornecedor->__get('company_name');
                echo 'success';
            }else{
                echo 'fail';
            }
        }else{
            echo 'opcao';
        }
    }else{
        echo 'campos';
    }

?>