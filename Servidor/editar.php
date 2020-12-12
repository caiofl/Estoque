<?php

require_once "../Entidades/Produto.php";

$editar = new Produtos();

$quantidadecompra 	= $_POST['quantidadecompra'];
$quantidadeuso 		= $_POST['quantidadeuso'];
$id 				= $_POST['id'];

$editar->editar($quantidadecompra, $quantidadeuso, $id);

?>
