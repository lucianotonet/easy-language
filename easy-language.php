<?php
/**
 * EASY LANGUAGE
 * 
 * Simples gerenciador de idiomas em PHP.
 *    -> Gerencia string fixas via gettext();
 * 
 * - Utilize echo _( 'String fixa' ) para cada string a ser traduzível
 * - Utilize POEDIT para catalogar e traduzir as strings fixas 
 * - Utilize a SESSION["lang"] como referência para suas requisições em banco de dados
 * 
 * 
 *
 * @author tonetlds
 * @version 1.0
 * @link http://www.lucianotonet.com/
 * @link https://github.com/tonetlds/easy-language/
 * @license http://opensource.org/licenses/MIT MIT License
 */
         
   /**
    *    CONFIGURAÇÕES 
    **/
   define('ELANG_DEFAULT','pt_BR');      // Idioma padrão
   define('ELANG_DOMAIN', 'messages');    // Domínio dos idiomas
   define('ELANG_ENCODE', 'UTF-8');       // Codificação

   //Test

   if( !defined('ELANG_FOLDER') ){         
      define('ELANG_FOLDER', 'easy-language/languages'); // Pasta com os arquivos de tradução padrão
   }

   $cookieName         = "language";
   $cookieDefaultValue = ELANG_DEFAULT;
   $languageFolder     = ELANG_FOLDER;      
   $language           = null;

   // verificar se o cookie existe assim como o set de lingua
   // o periodo de permanencia do cookie é de 24H
   if (!isset($_COOKIE[$cookieName]) && !isset($_GET["lang"])) {
      // caso não exista este é criado com os valores padrão
      setcookie ($cookieName, $cookieDefaultValue, time() + (3600 * 24));
      $language = $cookieDefaultValue;
   } else if (isset($_COOKIE[$cookieName]) && isset($_GET["lang"])) {
      //fazer set do novo valor do cookie
      setcookie($cookieName, $_GET["lang"], time() + (3600 * 24));
      $language = $_GET["lang"];
   } else {
      $language = $_COOKIE[$cookieName];
   }
    
   define( 'LANG' , $language);

   // Codificação
   $encoding   = ELANG_ENCODE;
    
   // Não toque!
   putenv("LC_ALL=$language");
   setlocale(LC_ALL, $language);
   bindtextdomain($language, ELANG_FOLDER);
   textdomain($language); //gettext files will be created like messages.po, messages.mo etc).