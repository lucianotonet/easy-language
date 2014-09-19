<?php    
   
   // Configurações de idiomas
   include_once( '../easy-language.php' );

   // Conexão com o banco
   require 'dbconnection.php';

?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8">

   <!-- Latest compiled and minified CSS -->
   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

   <title>Easy Language - https://github.com/tonetlds/easy-language/</title>
</head>
<body>

<div class="container">
   <h1>Easy-Language </h1>
   <a href="https://github.com/tonetlds">@tonetlds</a> | <a href="https://github.com/tonetlds/easy-language">GitHub</a>
   <h3>Demonstração com MYSQL</h3>

   <p>O Easy-Language lê a tabela de idiomas no seu banco de dados (se você tiver uma) e monta os links para alternar entre os idiomas.</p>
   <p>Além disso, você pode utilizar a variável $_SESSION['lang'] controlada pelo Easy-Language como referência para todas as suas requisições ao banco de dados</p>
   <p>As demonstrações abaixo utilizam um simples CRUD em PHP e MYSQL. Veja o código deste exemplo para entender como trabalhar com o Easy-Language e banco de dados</p>


      <div class="panel panel-default">
         <div class="panel-heading">
            <h1 class="panel-title">Selecione o idioma</h1>
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