<?php    

   // Easy Language
   //define('ELANG_FOLDER', 'idiomas'); // Opcional: Define a pasta com as traduções
   include_once( '../easy-language.php' );

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
      <h1>Easy-Language</h1>
      <hr>
      <p>
         <strong>Idioma:</strong>
         <a href="?lang=pt_BR">pt_BR</a> | <a href="?lang=en_US">en_US</a> | <a href="?lang=es_ES">es_ES</a>
      </p>      

      <p class="well">      
         <?php echo _('Este texto está em português e pronto para tradução!'); ?>
      </p>
      
   </div>
</body>
</html>