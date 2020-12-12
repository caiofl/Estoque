<?php 

  require_once "../Entidades/Produto.php";
  require_once "../Entidades/Perecivel.php";
  require_once "../Entidades/Naoperecivel.php";

  $nome 			= $_POST['nome'];
  $quantidadecompra = $_POST['quantidadecompra'];
  $quantidadeuso 	= $_POST['quantidadeuso'];
  $perecivel    	= $_POST['perecivel'];

  $novo = new Produtonaoperecivel();

  if($perecivel == 'Sim') {
     	$novo = new Produtoperecivel();	
  } 

 
  $novo->create($nome, $quantidadecompra, $quantidadeuso, $perecivel);


?>