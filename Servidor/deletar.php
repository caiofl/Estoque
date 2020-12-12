<?php 
 
require_once "../Entidades/Produto.php";

$deletar = new Produtos();

 if(isset($_POST['id']))
      {
        $id_produto = ($_POST['id']);
        $deletar->deletar($id_produto);    
      }

      
?>