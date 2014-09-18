<?php    
   
   // Configurações de idiomas
   include_once( 'easy-language.php' );

   // Conexão com o banco
   require 'dbconnection.php';

?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8">

   <!-- Latest compiled and minified CSS -->
   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
   <!-- PRISM CSS -->
   <link rel="stylesheet" href="css/prism.css">
   <!-- custom styles -->
   <link rel="stylesheet" href="css/style.css">

    <title>Easy Language - https://github.com/tonetlds/easy-language/</title>
</head>
<body>

<div class="container">
   <div class="row">



      <div class="panel panel-default">
         <div class="panel-heading">
            <h1 class="panel-title">Idiomas <code><?php echo LANG ?></code></h1>
         </div>
         <div class="panel-body">     


            <ul class="nav nav-pills">
               <?php                

               //Antes de tudo, Confere a tabela de idiomas (languages)
                  //Monta a consulta
                  $query = "SELECT * FROM languages" or die("Erro na consulta... " . mysqli_error($link));                   
                  //Executa a query
                  $results = $link->query($query);


                  while($lang = mysqli_fetch_array($results)) { 

                     //Idioma atual = ACTIVE
                     $active = ($lang["cod"] == LANG)? 'active' : '';

                     echo '<li class="'. $active .'">';
                     echo '   <a href="?lang='.$lang["cod"].'">';
                     echo '      <img src="img/flag-'.$lang["cod"].'.png" alt="" title="'.$lang["nome"].'">';
                     echo '   </a>'; 
                     echo '</li>';
                     
                     // Bandeiras: http://freepsdfiles.net/graphics/free-psd-flags-icon-set

                     //Insere na global
                     $languages[] = $lang;
                  }
                  //print_r($languages);

               ?>   
            </ul>
            <!-- Fim menu idiomas -->
            
            <br>
            <label for="">$_SESSION</label>
            <pre>$_SESSION['lang'] = <code><?php print_r($_SESSION['lang']); ?></code></pre>
         </div>   
      </div>

   

      <div class="panel panel-default">
         <div class="panel-heading">
            <h1 class="panel-title">Strings Fixas</h1>
         </div>
         <div class="panel-body"> 
             <p>Menu exemplo</p>    
                  <ul class="nav nav-pills">
                     <li>
                         <a href="#home">
                             <?php echo _('Home'); ?>
                         </a>
                     </li>
                     <li>
                         <a href="#empresa">
                             <?php echo _('Empresa'); ?>
                         </a>
                     </li>
                     <li>
                         <a href="#servicos">
                             <?php echo _('Serviços'); ?>
                         </a>
                     </li>
                     <li>
                         <a href="#produtos">
                             <?php echo _('Produtos'); ?>
                         </a>
                     </li>
                     <li>
                         <a href="#contato">
                             <?php echo _('Contato'); ?>
                         </a>
                     </li>
                  </ul>
               <!-- Fim Menu exemplo -->
               
               <br>

               <label for="">Arquivo <code>messages.po</code></label>
               <div class="highlight">
                  <pre><code class="html">languages/<?php echo LANG ?>/messages.po</code></pre>
               </div>

         </div>
      </div>
   

<?php include 'itens.php'; ?>



      </div>
   </div>
   
   <!-- jQuery -->
   <script src="https://code.jquery.com/jquery-git1.min.js"></script>

   <!-- Latest compiled and minified JavaScript -->
   <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

   <!-- Google Analytics -->
   <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
         (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
         m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-33871454-2', 'auto');
      ga('send', 'pageview');
   </script>

   </body>
</html>