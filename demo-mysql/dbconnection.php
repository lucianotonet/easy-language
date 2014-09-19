<?php    

   // Conexão com servidor MySQL
   if (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'))) {
      
      //Conexão local 
      define('HOST',    'localhost');
      define('DBUSER',  'root');
      define('DBPASS',  '');
      define('DBNAME',  'easylanguage');

   }else{

      //Server
      define('HOST',    '');
      define('DBUSER',  '');
      define('DBPASS',  '');
      define('DBNAME',  '');

   }


   //Conecta
   $link = mysqli_connect( HOST, DBUSER, DBPASS, DBNAME) or die("Erro: " . mysqli_error($link)); 
   
   if (!$link->set_charset("utf8")) { // UTF-8
      printf("Erro no charset: %s\n", $link->error);
   }