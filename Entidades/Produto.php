<?php 

require_once '/var/www/html/Estoque/Database/conexao.php';

class Produtos {

private $id, $nome, $quantidadecompra, $quantidadeuso, $perecivel;

	public function getID(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getNome(){
		return $this->nome;
	}

	public function setNome($nome){
		$this->nome = $nome;
	}

	public function getQuantidadecompra(){
		return $this->quantidadecompra;
	}

	public function setQuantidadecompra($quantidadecompra){
		$this->quantidadecompra = $quantidadecompra;
	}

	public function getQuantidadeuso(){
		return $this->quantidadeuso;
	}

	public function setQuantidadeuso($quantidadeuso){
		$this->quantidadeuso = $quantidadeuso;
	}

  public function getPerecivel(){
    return $this->perecivel;
  }

  public function setPerecivel($perecivel){
    $this->perecivel = $perecivel;
  }

	public function create ($nome, $quantidadecompra, $quantidadeuso, $perecivel) {


	try{

		if(!empty($nome) && !empty($quantidadecompra) && !empty($quantidadeuso) ) {
      		echo "";
    	}else {
      		throw new PDOException("Preencher os campos");
    	}

    if($quantidadecompra >= $quantidadeuso){
      echo "";
      } else {
        throw new PDOException("Quantidade de compra invalida");
      }

		$sql = ("INSERT INTO produtos (nome, quantidadecompra, quantidadeuso, perecivel) VALUES (?, ?, ?, ?)");

		$cadastrar = Conexao::getConnect()->prepare($sql);

		$cadastrar->bindParam(1, $nome);
		$cadastrar->bindParam(2, $quantidadecompra);
		$cadastrar->bindParam(3, $quantidadeuso);
    $cadastrar->bindParam(4, $perecivel);
		
    	if ($cadastrar->execute()) {
      	if ($cadastrar->rowCount() > 0) {
        	 echo " Produto cadastrados com Sucesso!";
      	}else {echo "Erro ao tentar cadastrar"; }
    	}else {
        		  throw new PDOException("Error não foi possivel executar sql");
      		  }
    	}catch (PDOException $erro) {
        		echo "Erro: " . $erro->getMessage();
      		}
    	}	 


    	public function listar($busca = '') {

      	$pdo = Conexao::getConnect();

       	$produto = $pdo->query("SELECT id, nome, quantidadecompra, perecivel, quantidadeuso, (quantidadecompra - quantidadeuso) as restante FROM produtos WHERE nome LIKE '%{$busca}%'")->fetchAll();
    
   	   	if(!empty($produto)){
          return $produto;
      	}
          return [];
    	}

    	public function editar($quantidadecompra, $quantidadeuso, $id) {

        if($quantidadecompra >= $quantidadeuso){
            echo "Editado com Sucesso";
          } else {
             throw new PDOException("");
          }

      	$sql = "UPDATE produtos SET quantidadecompra = '$quantidadecompra', quantidadeuso = '$quantidadeuso' WHERE id = '$id'";
      	$editar = Conexao::getConnect()->prepare($sql);  

      	$editar->bindValue(1, $quantidadecompra);
      	$editar->bindValue(2, $quantidadeuso);
      	$editar->bindValue(3, $id);

      	$editar->execute();

    	}	


    	public function mostrar($id) {

      	$pdo = Conexao::getConnect();

      	$dados = $pdo->query("SELECT * FROM produtos WHERE id = $id")->fetch();
    
   		if(!empty($dados)){
        	return $dados;
    	}
    	    return [];
		}

    	public function deletar($id){

	     	$sql = "DELETE FROM produtos WHERE id = ?"; 

		    $deletar = Conexao::getConnect()->prepare($sql);
		    $deletar->bindValue(1, $id);
		    $deletar->execute();

	    }
      
}	


?>
