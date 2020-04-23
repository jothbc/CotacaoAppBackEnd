<?php
    session_start();
    if (!isset($_SESSION['id']) || !isset($_SESSION['company_name'])) {
        session_destroy();
        header("Location: ../index.php?erro=login");
    }

    //instancia o cliente
    $cliente = new Cliente();
    $cliente->__set('id',$_SESSION['id']);
    //obem o ultimo pedido registrado no cliente
    $clienteService = new ClienteService($cliente,new Conexao());
    $cliente_assoc = $clienteService->read();

    //seta os valore de cliente vidos do banco de dados pelo cliente_assoc, é necessário para poder fazer o update
    $cliente->__set('email',$cliente_assoc['email']);
    $cliente->__set('pass',$cliente_assoc['pass']);
    $cliente->__set('company_name',$cliente_assoc['company_name']);
    $cliente->__set('cnpj',$cliente_assoc['cnpj']);
    $cliente->__set('tel',$cliente_assoc['tel']);
    $cliente->__set('tel2',$cliente_assoc['tel2']);
    $cliente->__set('ultimo_pedido',$cliente_assoc['ultimo_pedido'] + 1); //ja seta o ultimo pedido como sendo o próximo vazio

    //instancia a cotacao
    $cotacao = new CotacaoClienteInfo();
    $cotacao->__set('cliente_id',$_SESSION['id']);
    $cotacao->__set('pedido', $cliente->__get('ultimo_pedido'));
    
    //registra a cotacao no banco de dados
    $cotacaoService = new CotacaoClienteInfoService($cotacao,new Conexao());
    $cotacaoService->create();

    //atualiza a ultima cotacao do cliente
    $clienteService = new ClienteService($cliente,new Conexao());
    $clienteService->update();

    //chama a página cotacao enviando via GET o ultimo pedido
    header("Location: ./cotacao.php?pedido=".$cliente->__get('ultimo_pedido'));

?>
    
