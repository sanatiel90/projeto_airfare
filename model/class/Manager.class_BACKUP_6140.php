<?php
include_once('Connection.class.php');

class Manager extends Connection{
    public function busca_voo ($origem, $destino, $data) {
        $pdo = parent::getCon();

        try {
            $stmt = $pdo->prepare(
                "SELECT * FROM v_dados_voo WHERE " .
                "cidade_origem LIKE :origem AND " .
                "cidade_destino LIKE :destino AND " .
                "data_voo = :data_voo"
            );
<<<<<<< HEAD
			$stmt->bindValue(":origem", "%$origem%");
			$stmt->bindValue(":destino", "%$destino%");
			$stmt->bindValue(":data_voo", "$data");

			$stmt->execute();

			$result = array();

			if ($stmt->rowCount()) {
				while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
					$result[] = $row;
				}
				return $result;

			} else {
				return false;
			}

		}catch(Exception $e){
			echo $e->getMessage();
		}
	}



	public function busca_funcionario($field,$search,$order){

		$pdo = parent::getCon();

		try {
			$stmt = $pdo->prepare("SELECT * FROM funcionarios WHERE $field LIKE :search ORDER BY $order");
			
			$stmt->bindValue(":search", "%$search%");
			
			$stmt->execute();

			$result = array();

			if ($stmt->rowCount()) {
				while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
					$result[] = $row;
				}
				return $result;

			} else {
				return false;
			}

		}catch(Exception $e){
			echo $e->getMessage();
		}

	}




	public function voo_solicitado($id){
		$pdo = parent::getCon();

		try{

			$stmt = $pdo->prepare("SELECT * FROM v_dados_voo WHERE id = :id LIMIT 1");

			$stmt->bindValue(":id",$id);

			$stmt->execute();

			$result = array();

			if($stmt->rowCount()){
				while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
					$result[] = $row;
					
				}
				return $result;
			}else{
				return false;
			}


		}catch(Exception $e){
			echo $e->getMessage();
		}

	}




	public function login_cliente($email,$password){

		$pdo = parent::getCon();

		try{

			$stmt = $pdo->prepare("SELECT * FROM v_dados_cliente WHERE email = :email AND senha = :password  LIMIT 1");

			
			$stmt->bindValue(":email",$email);
			$stmt->bindValue(":password",$password);

			$stmt->execute();

			$result = array();

			if($stmt->rowCount()){
				while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
					$result[] = $row;
					
				}
				return $result;
			}else{
				return false;
			}

		}catch(Exception $e){

			echo $e->getMessage();
		}

	}



	public function login_func($email,$password){

		$pdo = parent::getCon();

		try{

			$stmt = $pdo->prepare("SELECT * FROM funcionarios WHERE email = :email AND senha = :password  LIMIT 1");

			
			$stmt->bindValue(":email",$email);
			$stmt->bindValue(":password",$password);

			$stmt->execute();

			$result = array();

			if($stmt->rowCount()){
				while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
					$result[] = $row;
=======
            $stmt->bindValue(":origem", "%$origem%");
            $stmt->bindValue(":destino", "%$destino%");
            $stmt->bindValue(":data_voo", "$data");
            $stmt->execute();
            $result = array();

            if ($stmt->rowCount()) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $result[] = $row;
                }
                return $result;
            } else {
                return false;
            }
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function voo_solicitado($id){
        $pdo = parent::getCon();

        try{
            $stmt = $pdo->prepare("SELECT * FROM v_dados_voo WHERE id = :id LIMIT 1");
            $stmt->bindValue(":id",$id);
            $stmt->execute();
            $result = array();

            if($stmt->rowCount()){
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $result[] = $row;
                }
                return $result;
            }else{
                return false;
            }
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
    public function login_cliente($email,$password){
        $pdo = parent::getCon();

        try{

            $stmt = $pdo->prepare("SELECT * FROM v_dados_cliente WHERE email = :email AND senha = :password  LIMIT 1");
            $stmt->bindValue(":email",$email);
            $stmt->bindValue(":password",$password);

            $stmt->execute();

            $result = array();

            if ($stmt->rowCount()) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $result[] = $row;
>>>>>>> 21d839f764f31c4d7e74a46bd5a2aa3509e9e657
					
                }
                return $result;
            }else{
                return false;
            }

        } catch(Exception $e) {
            echo $e->getMessage();
        }

    }

    public function login_func($email,$password) {
        $pdo = parent::getCon();

        try{

            $stmt = $pdo->prepare("SELECT * FROM funcionarios WHERE email = :email AND senha = :password  LIMIT 1");
            $stmt->bindValue(":email",$email);
            $stmt->bindValue(":password",$password);
            $stmt->execute();
            $result = array();

            if ($stmt->rowCount()) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $result[] = $row;
                }
                return $result;
            } else {
                return false;
            }
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function insert_cliente($nome, $cpf, $email, $telefone, $rg, $senha, $cartaocredito) {
        $pdo = parent::getCon();

        try{
            //chamando stored procedure de inserção de clientes que foi criada no banco dados
            $stmt = $pdo->prepare("CALL sp_insere_cliente(:nome,:cpf,:email,:telefone,:rg,:senha,:cartaocredito)");

            $stmt->bindValue(":nome",$nome);
            $stmt->bindValue(":cpf",$cpf);
            $stmt->bindValue(":email",$email);
            $stmt->bindValue(":telefone",$telefone);
            $stmt->bindValue(":rg",$rg);
            $stmt->bindValue(":senha",$senha);
            $stmt->bindValue(":cartaocredito",$cartaocredito);
			
            $stmt->execute();
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function insert_pedido($quantidade,$preco,$cod_voo,$cod_cli){
        $pdo = parent::getCon();

        try{
            $stmt = $pdo->prepare("INSERT INTO pedidos(quantidade_pessoas,preco_total,cod_voo,cod_cliente) VALUES(:quant,:preco,:voo,:cli)");
            $stmt->bindValue(":quant",$quantidade);
            $stmt->bindValue(":preco",$preco);
            $stmt->bindValue(":voo",$cod_voo);
            $stmt->bindValue(":cli",$cod_cli);

            if ($stmt->execute()) {
                return $pdo->lastInsertId();
            } else {
                return false;
            }
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function lista_compras_cliente($id){
        $pdo = parent::getCon();

        try{

            $stmt = $pdo->prepare("SELECT * FROM v_dados_pedido WHERE id_cli = :id ORDER BY data_pedido DESC");
            $stmt->bindValue(":id",$id);
            $stmt->execute();
            $result = array();

            if ($stmt->rowCount()) {
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $result[] = $row;
                }
                return $result;
            } else {
                return false;
            }
        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }

    public function dados_comprovante($id) {
        $pdo = parent::getCon();

        try{

            $stmt = $pdo->prepare("SELECT * FROM v_dados_pedido WHERE id_pedido = :id  LIMIT 1");
            $stmt->bindValue(":id",$id);
            $stmt->execute();
            $result = array();

            if ($stmt->rowCount()) {
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $result[] = $row;
                }
                return $result;
            }else{
                return false;
            }

        }catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function update_cliente($id,$telefone)
    {
        $pdo = parent::getCon();

        try {

            $stmt = $pdo->prepare("UPDATE clientes SET telefone = :telefone WHERE id = :id");
            $stmt->bindValue(":id", $id);
            $stmt->bindValue(":telefone", $telefone);

            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function lista_voos($filter,$order){
        $pdo = parent::getCon();

        try{
            $stmt = $pdo->prepare("SELECT * FROM v_dados_voo $filter ORDER BY $order");
            $stmt->execute();
            $result = array();

            if ($stmt->rowCount()) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $result[] = $row;
                }
                return $result;
            } else {
                return false;
            }

        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }

    public function count_records($table){
        $pdo = parent::getCon();

        try{
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM $table");
            $stmt->execute();

            if ($stmt->rowCount()) {
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $result = $row;
                }
                return $result;
            } else {
                return false;
            }
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
} //fim class