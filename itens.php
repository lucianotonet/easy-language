<?php 

  // Dados enviados pelo form
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {    

      //    #Tratar os dados antes de inserir
      $nome   = $_POST['nome'];
      $texto  = $_POST['texto'];


      // Inicialmente, resource ID é 1
      $resource_ID = '1';



      // Gambia auto icrement
      if( isset($_GET['res_id']) and $_GET['res_id'] != "" ){
         $resource_ID = $_GET['res_id'];
      }else{   
         $query = "SELECT res_id FROM itens ORDER BY res_id DESC LIMIT 1";
         //Executa a query
         $lastId = $link->query($query);         
         while($id = mysqli_fetch_array($lastId, MYSQL_ASSOC)) {
            //Incrementa o último ID adicionado
            $resource_ID = $id['res_id'] + 1;
         } 
      }



      // UPDATE
      if( !empty($_GET['res_id']) ){
            
            $query = "";
            foreach ($languages as $lang) { 
               $idioma = $lang['cod'];        
               // UPDATE  
               $query .= "UPDATE  itens SET nome = '" . $nome[ $idioma ] . "', texto = '" . $texto[ $idioma ] . "' WHERE  res_id = '".$_GET['res_id']."' AND lang = '".$idioma."'; ";
            }              
            $update = $link->multi_query($query);

            if( $update ){
               $_SESSION['messages'] = array('success' => 'O item foi atualizado com sucesso!');
               
            }else{
               $_SESSION['messages'] = array('danger' => 'Não foi possível atualizar o item!');
            }
            
            // GAMBIARRA para usar ->query após o ->multi_query
            while ($link->next_result()) 
            {
               if (!$link->more_results()) break;
            }

      }else{

      // INSERT
            $query  = "INSERT INTO itens (res_id, nome, texto, lang) VALUES";
            foreach ($languages as $lang) { 
               $idioma = $lang['cod'];               
               $values[] = "('" . $resource_ID . "', '" . $nome[ $idioma ] . "', '" . $texto[ $idioma ] . "', '" . $idioma . "')";          
            }
            $query .= implode(', ', $values) or die("Erro na insersão... " . mysqli_error($link));      

            //Executa a query
            $insert = $link->query($query); 


            if( $insert ){
               //Inseriu...
               $_SESSION['messages'] = array('success' => 'O item foi adicionado com sucesso!');               
            }else{
               $_SESSION['messages'] = array('danger' => 'Não foi possível adicionar o item!');
            }            
      }
      // Free result set
      
      $link->next_result();
  }

?>

         
<div class="panel panel-default">
   <div class="panel-heading">
      <h1 class="panel-title">Banco de dados <code><?php echo LANG ?></code></h1>
   </div>
   <div class="panel-body">    
      <h2>Banco de dados</h2>

      <?php
         //Mensgens
         if(isset($_SESSION['messages'])){
            foreach ($_SESSION['messages'] as $type => $msg) {
      ?>         
               <div class="alert alert-<?php echo $type ?> fade in" role="alert">
                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                  <?php echo $msg ?>
               </div>
      <?php
            }
            unset($_SESSION['messages']);
         }
      ?>





   
<?php 
   if( isset($_GET['res_id']) ){ 
      //Consulta
      $query = "SELECT * FROM itens WHERE res_id = ".$_GET['res_id'] or die("Erro na consulta.." . mysqli_error($link)); 
      //Executa a query
      $itens = $link->query($query);
      
      if( $itens ){         
         
         //Coloca todos os dados numa array associativa para popular o form
         while($i = mysqli_fetch_array($itens, MYSQL_ASSOC)){ 
            $itemLang          = $i['lang'];
            $item[ $itemLang ] = $i;
         } 
?>         

         <div class="panel panel-info">
            <div class="panel-heading">
               <h2 class="panel-title">Editar item</h2> 
            </div>
            <div class="panel-body">
               
               <form class="form-horizontal" role="form" action="" method="POST">         
                  <table class="table">
                     <thead>
                        <tr>
                           <td>&nbsp;</td>
                              <?php 
                                 foreach ($languages as $lang) { 
                                    echo '<td>' . ucfirst($lang["nome"]) . '</td>';
                                 } 
                              ?>
                        </tr>
                     </thead>              
                     <tbody>
                        <tr>
                           <td>Nome:</td>
                              <?php
                                 foreach ($languages as $lang) { 
                                    $lc = $lang["cod"];
                                    echo '<td>
                                             <input class="form-control" type="text" name="nome['.$lc.']" value="'.$item[ $lc ]["nome"].'" >
                                          </td>';
                                 } 
                              ?>  
                        </tr>
                        <tr>
                           <td>Texto:</td>
                              <?php
                                 foreach ($languages as $lang) {
                                    $lc = $lang["cod"];
                                    echo '<td>
                                             <textarea class="form-control" name="texto['.$lc.']">'.$item[ $lc ]["texto"].'</textarea>
                                          </td>';
                                 } 
                              ?>
                        </tr>
                        <tr>
                           <td><input class="btn btn-primary" type="submit" value="Salvar"></td>
                           <td></td>
                           <td></td>
                           <td></td>                           
                        </tr>
                     </tbody>
                  </table>         

               </form>               
            </div>
         </div>

<?php 
         mysqli_free_result($itens);        
      } //end while
   } // end if
?>




         
      <p>Itens no idioma <code><?php echo LANG ?></code></p>
      <?php
    
          //Consulta
          $query = "SELECT * FROM itens WHERE lang = '".LANG."'" or die("Erro na consulta.." . mysqli_error($link)); 
          //Executa a query
          $itens = $link->query($query); 
          
      ?>
         <table class="table table-condensed table-hover">
            <thead>
               <tr>
                  <th>#</th>
                  <th>Nome</th>
                  <th>Texto</th>
                  <th></th>
               </tr>
            </thead>
            <tbody>
               <?php               
                   //Mostra a informação
                   while($item = mysqli_fetch_array($itens)) { 
                     echo '<tr>';
                        echo '<td>' . $item["res_id"] . '</td>';
                        echo '<td>' . $item["nome"] . '</td>';
                        echo '<td>' . $item["texto"] . '</td>';
                        echo '<td>';
                        echo '   <div class="btn-group pull-right">';
                        echo '      <a href="?res_id=' . $item["res_id"] . '" title="Editar item" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-edit"></span></a>';
                        echo '      <a href="delete.php?res_id=' . $item["res_id"] . '" title="Excluir item" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove"></span></a>';
                        echo '   </div>';
                        echo '</td>';
                     echo '</tr>';
                   } 
               ?>                       
            </tbody>
      </table>   



      <div class="panel panel-info">
         <div class="panel-heading">
            <h2 class="panel-title">Adicionar item</h2> 
         </div>
         <div class="panel-body"> 
     
            <form class="form-horizontal" role="form" action="" method="POST">         
               <table class="table">
                  
                  <thead>
                     <tr>
                        <td>&nbsp;</td>
                        <?php                            
                           foreach ($languages as $lang) { 
                              echo '<td>' . ucfirst($lang["nome"]) . '</td>';
                           } 
                        ?>
                     </tr>
                  </thead>              

                  <tr>
                     <td>Nome:</td>
                     <?php foreach ($languages as $lang) { ?>                        
                        <td><input class="form-control" type="text" name="nome[<?php echo $lang["cod"] ?>]" ></td>
                     <?php } ?>
                  </tr>

                  <tr>
                     <td>Texto:</td>                     
                     <?php foreach ($languages as $lang) { ?>
                        <td><textarea class="form-control" name="texto[<?php echo $lang["cod"] ?>]"></textarea></td>
                     <?php } ?>
                  </tr>

                  <tr>               
                     <td><input class="btn btn-primary" type="submit" value="Salvar"></td>                   
                     <?php foreach ($languages as $lang) { ?>                     
                        <td>&nbsp;</td>
                     <?php } ?>
                  </tr>

              </table>         
               
             </form>
         </div>
      </div>
   </div>
</div>



<div class="panel panel-default">
   <div class="panel-heading">
      <h3 class="panel-title">DEBUG</h3>
   </div>
   <div class="panel-body">

      <?php
         //Mensgens
         if($link->error){
            foreach ($link->error_list as $error) {
      ?>         
               <div class="alert alert-danger fade in" role="alert">
                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                  <?php echo $error['error'] ?>
               </div>
      <?php
            }
         }
      ?>

      <div class="col col-md-6">
         <label for="">Object(mysqli)</label>
         <div class="highlight">
            <pre><code class="html"><?php print_r($link); ?></code></pre>
         </div>
      </div>

      <div class="col col-md-6">
         <label for="">$_POST</label>
         <div class="highlight">
            <pre><code class="html"><?php print_r($_POST); ?></code></pre>
         </div>
      </div>      

      <div class="col col-md-6">
         <label for="">$_GET</label>
         <div class="highlight">
            <pre><code class="html"><?php print_r($_GET); ?></code></pre>
         </div>
      </div>
      <div class="col col-md-6">
         <label for="">$_SESSION</label>
         <div class="highlight">
            <pre><code class="html"><?php print_r($_SESSION); ?></code></pre>
         </div>
      </div>


   </div>
</div>