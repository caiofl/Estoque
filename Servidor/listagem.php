<?php

require_once "../Entidades/Produto.php";

$html = ''; 

	$exibir = new Produtos;
	foreach ($exibir->listar($_POST['busca']) as $novo):
        $restante = $novo['quantidadecompra'] - $novo['quantidadeuso'];
	$html .= 
		"<tr>
    		<td> {$novo['nome']} </td>
    		<td> {$novo['quantidadecompra']} </td>
    		<td> {$novo['quantidadeuso']} </td>
    		<td> {$restante} </td>
        <td> {$novo['perecivel']} </td>
			  <td> <a href='Produtos/editar.php?id={$novo['id']}' class='btn btn-warning' role='button'> ✐Alterar</a>
    		<button type='button' class='btn btn-danger delete' value='{$novo['id']}' data-toggle='modal' data-target='#exampleModal'> X Excluir</button>
    		</td>
		</tr>

     <div class='modal fade' id='exampleModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
      <div class='modal-dialog' role='document'>
        <div class='modal-content'>
          <div class='modal-header'>
            <h5 class='modal-title' id='exampleModalLabel'>Excluir Usuario</h5>
            <button type='button' class='close' data-dismiss='modal' aria-label='Close'></button>
          </div>
            <div class='modal-body'>Deseja Realmente excluir ? </div>
              <div class='modal-footer'>
              <button type='button' class='btn btn-secondary cancelar' data-dismiss='modal'>Cancelar</button>
              <button value=' type='button' name='deletar' class='btn btn-danger deletar'> SIM QUERO DELETAR </button>
          </div>
        </div>
      </div>
    </div>";



    endforeach;

echo $html;


?>


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
});


</script>