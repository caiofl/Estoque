<?php 

 require_once '../incluir/estilo.php';

 require_once '../Entidades/Produto.php';

 $produto = new Produtos();
 $novo = $produto->mostrar($_GET['id']);

?>


<div class="row">
  <div class="col s10 m6 push-m3">
    <h3 class="ligth"> Alterar Quantidade </h3>
    <form action="" method="POST">
       <input type="hidden" name="id" id="id" value="<?php if(isset($novo['id'])) { echo $novo['id']; }?>">


       <div class="input-field col s10">
          Quantidade Compra:
          <input type="number" name="quantidadecompra" id="quantidadecompra" required value="<?php if(isset($novo['quantidadecompra'])) { echo $novo['quantidadecompra']; } ?>">
          <label for="quantidadecompra"></label>
       </div>

       <div class="input-field col s10">
          Quantidade Utilizada:
          <input type="number" name="quantidadeuso" id="quantidadeuso" required value="<?php if(isset($novo['quantidadeuso'])) { echo $novo['quantidadeuso']; } ?>">
          <label for="quantidadeuso"></label> <!-- label efeito ao clicar no campo -->
       </div>

       <a href="../index.php" class="btn green"> Lista de clientes </a>
       <button type="button" id="btn-editar" name="btn-editar" class="btn"> Atualizar </button> 


       <div id="mensagens"> </div>
    </form>

  </div> 
</div>


<script>
    
  $(document).ready(function(){   

  $("#btn-editar").click(function(){
   $.ajax({

      url: '../Servidor/editar.php',
      type: 'POST',
      data:{
        id:$("#id").val(),
        quantidadecompra:$("#quantidadecompra").val(),
        quantidadeuso:$("#quantidadeuso").val()
      },

      beforeSend: function(){

        $("#mensagens").html("");
      },
      success: function(data)
      {
        $("#mensagens").html(data);
      },
      error:function(data)
      {
        $("#mensagens").html("Não foi possivel Editar!");
        
      }


    });
  });
});
  

</script>
