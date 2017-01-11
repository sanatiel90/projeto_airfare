<?php 
session_start();

include_once '../model/class/Manager.class.php';

if(!isset($_SESSION[md5('func')])){
   
    header("location: http://localhost/projeto_airfare/index.php");

  }else{

    $func = $_SESSION[md5('func')];

    $manager = new Manager();

    
    $field = "";
    $search = "";
    $order = "";

    if(!isset($_POST['field'])){

        $field = "nome";

    }else{
      
        $field = $_POST['field'];

    }
    

    if(!isset($_POST['order'])){

        $order = "id";

    }else{
      
        $order = $_POST['order'];

    }


    if(!isset($_POST['search'])){

        $field = "nome";
        $search = "";
        $order = "id";

    }else{
      
        $search = $_POST['search'];

    }


    $search_result = $manager->busca_funcionario($field,$search,$order);


}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Página Inicial - Airfare</title>
        <link rel="stylesheet" type="text/css" href="../view/assets/bootstrap/css/bootstrap.css">
        
        <script src="../view/assets/bootstrap/js/jquery.js"></script>
        <script src="../view/assets/bootstrap/js/bootstrap.js"></script>

    </head>
    <body>
        <div class="container">
            <header class="row navbar navbar-default cabecalho"><!-- cabecalho -->
                <div class="col-lg-8 ">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="inicio.php"><strong>AirFare - Área Adminstrativa</strong></a>
                    </div>

                    <ul class="nav navbar-nav navbar-default">
                         <li class="dropdown" style="background-color:#98FB98">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Buscar <span class="caret"></span></a>
                           <ul class="dropdown-menu">
                              <li><a href="busca_funcionarios.php">Funcionários</a></li>
                              <li><a href="#">Clientes</a></li>
                              <li><a href="listagem_voos.php">Vôos</a></li>
                              <li><a href="#">Pedidos</a></li>
                              
                            </ul>
                          </li>
                        
                         <li class="dropdown" style="background-color:#98FB98">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Listar <span class="caret"></span></a>
                           <ul class="dropdown-menu">
                              <li><a href="#">Funcionários</a></li>
                              <li><a href="#">Clientes</a></li>
                              <li><a href="listagem_voos.php">Vôos</a></li>
                              <li><a href="#">Pedidos</a></li>
                              
                            </ul>
                          </li>

                           <li class="dropdown" style="background-color:#98FB98">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Opções <span class="caret"></span></a>
                           <ul class="dropdown-menu">
                              <li><a href="../controller/logout_func.php">Sair do Sistema</a></li>
                              
                            </ul>
                          </li>


                        </ul>

                </div>
                <div class="col-lg-4">
                    <div class="navbar-header navbar-right">
                        <p class="navbar-text"> Bem vindo(a), <strong><?php foreach($func as $key){echo $key["nome"];} ?></strong> </p>
                    </div>
                </div>
            </header>   <!-- fim cabecalho -->
            <section class="row">
              <div class="col-lg-1"></div> 
                
              
                <div class="col-lg-10" >

                                
                   <div class="panel panel-success" >
                        <div class="panel-heading" style="background-color:lightgreen;">
                            <h3 class="panel-title text-center">
                                <span class="glyphicon glyphicon-th">
                                    <strong style="font-family:arial;">Busca de Funcionários</strong>
                                </span>
                            </h3>
                        </div>
                    </div>
                    <div class="panel-body">

                    <?php if(isset($_GET['func_edited'])){ ?>

                    <div class="alert alert-success text-center" >
                         <strong>Dados do funcionário atualizados com sucesso</strong>
                    </div>

                    <?php } ?>

                    <?php if(isset($_GET['edit_error'])){ ?>

                    <div class="alert alert-danger text-center" >
                         <strong>Erro ao atualizar dados. Alterações não feitas.</strong>
                    </div>

                    <?php } ?>

                    <?php if(isset($_GET['func_deleted'])){ ?>

                    <div class="alert alert-success text-center" >
                         <strong>Funcionário deletado do sistema</strong>
                    </div>

                    <?php } ?>

                    <?php if(isset($_GET['delete_error'])){ ?>

                    <div class="alert alert-danger text-center" >
                         <strong>Erro ao deletar. Funcionário não removido.</strong>
                    </div>

                    <?php } ?>

                       <div class="col-lg-12" style="font-size:15px">    
                         <div class="col-lg-4 text-center">
                           
                         </div>

                         <div class="col-lg-4 text-center">
                          <form action="" method="POST">
                           <label>Pesquisar por:</label> <br> 
                           <input type="radio" name="field" value="nome"> Nome &nbsp;&nbsp;&nbsp;
                           <input type="radio" name="field" value="email"> Email
                           <br><br>
                           <label>Ordernar resultado da pesquisa por:</label><br>
                           <select style="border-radius:5px" name="order">
                             <option value="null">Selecione --</option>
                             <option value="id">Id</option>
                             <option value="nome">Nome</option>
                             <option value="salario DESC">Maior Salário</option>
                             <option value="salario">Menor Salário</option>
                             
                           </select>
                           <br><br>
                           <div class="form-group">
                           <input type="text" name="search" class="form-control" placeholder="Digite sua pesquisa">
                           </div>
                           <button class="btn btn-primary">Pesquisar</button>
                           <br><br>
                          </form> 
                         </div>
                         
                         <div class="col-lg-4 text-center">
                            
                           <!--  <a class="btn btn-warning" href="" target="_blank">Gerar Relatório</a> -->
                            
                         </div>


                                                 

                       </div>
                       <br><br><br>
                       <label>Total registros encontrados: </label> <?php echo count($search_result); ?>
                      <table class="table table-bordered table-hover text-center">
                         <tr class="info">
                             <th class="text-center">Id</th>
                             <th class="text-center">Nome</th>
                             <th class="text-center">E-mail</th>
                             <th class="text-center">Telefone</th>
                             <th class="text-center">Salário</th>
                             <th class="text-center">Ações</th>
                         </tr> 

                        <?php if($search_result != null){ 
                         foreach ($search_result as $key) { ?>

                         <tr>
                             <td><?php echo $key["id"]; ?></td>
                             <td><?php echo $key["nome"]; ?></td>
                             <td><?php echo $key["email"]; ?></td>
                             <td><?php echo $key["telefone"]; ?></td>
                             <td><?php echo 'R$ '.$key["salario"]; ?></td>
                             <td>
                             <a href="edita_funcionario.php?id=<?php echo $key["id"]; ?>" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
                             <button type="button" value="<?php echo $key["id"]; ?>" class="btexclui btn btn-danger btn-xs" data-toggle="modal" data-target="#exclui"><span class="glyphicon glyphicon-remove" ></span></button>
                            
                             </td>
                         </tr>

                         <?php } }else{ ?>
                          <br>
                          <div style="color:red" class="text-center" >
                                <strong>Não foram encontrados resultados para a pesquisa realizada</strong>
                          </div>
                          <br>
                         <?php  } ?>

                      </table>


                    </div>
                </div>
              <div class="col-lg-1"></div> 
            </section>
        </div>
    </body>
</html>

<script>

 $(".btexclui").on('click',function(){
      
      var $id = $(this).val();
      $("#confdelete").val($id);
   });
  
</script>


<!-- DIV PARA MODAL EXCLUSAO-->
<div class="modal fade text-center" id="exclui">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <div class="modal-header">
        <h3 class="modal-title" > Atenção! Este processo irá apagar permanentemente os dados do funcionário </h4>
        <hr>
        <h4 class="modal-title" > Confirma a exclusão do funcionário? </h4>
      </div>  

      <div class="modal-body text-center">
        
           <form action="../controller/delete_funcionario.php" method="POST">
          
          <button type="button" class="btn btn-default" data-dismiss="modal"> Cancelar </button>
        
                
          <input type="hidden" value="" id="confdelete" name="id"/>

          <button  class="btn btn-danger"> Confirmar</button>
          </form> 
        
      </div>

    
    </div> <!-- content -->
  </div> <!-- dialog -->
</div> <!-- modal fade-->
