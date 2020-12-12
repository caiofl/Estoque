<?php

require_once '../incluir/estilo.php';

?>

<div class="row">
  <div class="col s10 m6 push-m3">
      <h3 class="ligth"> Novo Produto </h3>
    

       <div class="input-field col s10">
          Produto:
          <input type="text" name="nome" id="nome" required>
          <label for="nome"></label>
       </div>


       <div class="input-field col s10">
          Quantidade Comprado:
          <input type="number" name="quantidadecompra" id="quantidadecompra" min="0"
          max="10" required>
          <label for="quantidadecompra"></label>
       </div>

       <div class="input-field col s10">
          Quantidade Utilizado:
          <input type="number" name="quantidadeuso" id="quantidadeuso" min="0" max="10" required>
          <label for="quantidadeuso"></label> <!-- label efeito ao clicar no campo -->
       </div>

       <div class="col s10">
        <p>Perecível</p>
          <select id="perecivel" name="perecivel" style="display: block; margin-bottom: 12px;border: 1px solid #adabab;height: 32px;">

            <option>Sim</option>
            <option>Não</option>
          </select>
       </div>

       <!-- Redirecionar para pag do form create.php-->
       <button style="margin-left: 12px;" type="button" name="btn-cadastrar" id="btn-cadastrar" class="btn"> Cadastrar </button> 
       <a href="../index.php" class="btn green"> Lista de Produtos </a>

       <div id="mensagens"> </div>
    </div>
  </div>


 <script>
  
  $(document).ready(function(){

    $( "#btn-cadastrar" ).click(function() {
      $.ajax({

        url: '../Servidor/adicionar-produtos.php', 
        type:'POST',
        data:{
          nome:$("#nome").val(), 
          quantidadecompra:$("#quantidadecompra").val(),
          quantidadeuso:$("#quantidadeuso").val(),
          perecivel:$("#perecivel").val()
        },

        beforeSend: function(){ 

          $("#mensagens").html("Carregando..");
        },
        success:function(data)
        {
          $("#mensagens").html(data);
          $(':input').val('');
        },
        error:function(data){
          $("mensagens").html("Não conseguimos encontrar a Pagina");
        
            
        }


    });
  });
});

</script>
