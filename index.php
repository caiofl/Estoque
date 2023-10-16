<?php 

include_once "incluir/modelo.php";

include_once "Entidades/Produto.php";


?>


<meta charset="UTF-8">
<div class="container">
<title>Estoque daae Produtos </title>

<center><h2>Estoque de Produtos</h2></center>


<h5>Digite o produto a pesquisar</h5>
  <div id="consulta" class="input-prepend">
    <input type="text"  name="pesquisa" id="pesquisa" tabindex="1" placeholder="Pesquisar Produto.."/>
  </div><br/>

<table border="1" id="id_tabela" class="table table-striped table table-condensed">
  <thead>
    <tr bgcolor="black" style="color:White;">
          <th> Produto </th> 
          <th> Quantidade de Compra</th>
          <th> Quantidade Utilizada </th>
          <th> Restante </th>
          <th> Perecível </th>
          <th> Opçoẽs </th>
      </tr>
  </thead>

  <tbody>
  <?php
    
    $exibir = new Produtos();
    foreach ($exibir->listar() as $novo): ?>

    <tr>
      <td><?php echo $novo['nome']; ?></td>
      <td><?php echo $novo['quantidadecompra']; ?></td>
      <td><?php echo $novo['quantidadeuso']; ?></td>
      <td><?php echo $novo['restante']; ?></td>
      <td><?php echo $novo['perecivel']; ?></td>
      <td><a href="Produtos/editar.php?id=<?php echo $novo['id']; ?>" class="btn btn-warning" role="button"> ✐Alterar</a>
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-danger delete" value="<?php echo $novo['id']; ?>" data-toggle="modal" data-target="#exampleModal"> X Excluir </button></td>
    </tr>

  <?php
    
    endforeach; 
    
  ?> 
 
  </tbody>
</table>


  <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Excluir Produto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
          </div>
            <div class="modal-body">Deseja Realmente excluir ? </div>
              <div class="modal-footer">
              <button type="button" class="btn btn-secondary cancelar" data-dismiss="modal">Cancelar</button>
              <button value="" type="button" name="deletar" class="btn btn-danger deletar"> SIM QUERO DELETAR </button>
          </div>
        </div>
      </div>
    </div>         

  <br>
  <a href="Produtos/adicionar-produtos.php" class="btn btn-info" role="button">Adicionar Produto</a>
      
<script>
    
 $(document).ready(function(){   

  $(".delete").click(function(){
    $('.deletar').val($(this).val());
  });
    
    $(".deletar").click(function(){
       $.ajax({
          type: "POST",
          url: "Servidor/deletar.php",
          dataType  : 'json',
          data: { id: $(this).val() },
 
          success: function (data) {      
              
          $.ajax({
            type: "POST",
            url: "Servidor/listagem.php",
            data: { busca: $(this).val()}       

          })
        },   

          error: function(data){
             $("#mensagens").html("Não foi possivel");
             location.reload();

          }
       });
    });
    

   $("#pesquisa").keyup(function(){

     var busca = $(this);

    $.ajax({
      type: "POST",
      url: "Servidor/listagem.php",
      data: { busca: $(this).val()},

      success: function(data){

          $("#id_tabela tbody").empty().html(data);

         }     
      });
   });


});

</script>




    