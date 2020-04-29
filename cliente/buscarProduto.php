<?php

$produto = new Produto();
$buscas = explode(' ', $_GET['descricao']);

$total = [];
$busca_count=0;
foreach ($buscas as $desc) {
    $produto->__set('descricao', '%'.$desc.'%');
    $total = array_merge($total,$produto->buscarProdutos());
    $busca_count++;
}
$join = [];
for($x = 0; $x<count($total);$x++){
    $count = 1;
    for($i = $x+1 ; $i<count($total);$i++){
        if($total[$x]['id'] == $total[$i]['id']){
            $count++;
        }
    }
    if($count == $busca_count){
        array_push($join,$total[$x]);
    }
}
echo json_encode($join);
?>