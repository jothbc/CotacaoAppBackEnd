<?php

    $buscas = explode(' ',$_GET['descricao']);
    $unica_query = '';
    foreach($buscas as $desc){
        $unica_query =  $unica_query.'%'.$desc.'%';
    }
    
    $produto = new Produto();
    $produto->__set('descricao',$unica_query);

    echo json_encode($produto->buscarProdutos());
?>