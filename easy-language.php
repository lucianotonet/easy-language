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
      define('ELANG_DEFAULT', 'pt_BR');      // Idioma padrão
      define('ELANG_DOMAIN', 'messages');    // Domínio dos idiomas
      define('ELANG_FOLDER', 'languages');   // Pasta com os arquivos de tradução
      define('ELANG_ENCODE', 'UTF-8');       // Codificação


         //Variável que conterá todos os idiomas ativos no sistma
         global $languages;

         // Inicia uma session, se ainda não foi iniciada
         if (session_status() == PHP_SESSION_NONE) {
             session_start();
         }

        // verifica se o idioma está setado por GET via parametro "lang" ( Ex: site.com.br?lang=en_EU )        
        if (isset($_GET["lang"])) {
            // to do:
                // Se o idioma não existir vai voltar ao padrão
                // Aqui pode ser colocado uma condição para corrigir isso                
            $language = $_GET["lang"]; // Define qual idioma será usado
        }  // SENÃO verifica se está setado na SESSION
        else if (isset($_SESSION["lang"])) {
            $language  = $_SESSION["lang"]; // Define qual idioma será usado
        }  // SE não for setado nem por get nem na session, aplica o idioma padrão
        else {
            $language = ELANG_DEFAULT; // Idioma padrão
            // to do:
                // Grande diferencial!
                // Aqui pode ser inserido uma função pra pegar o idioma do navegador
                // Ou seja, o site detecta o idioma "automaticamente".
        }
         
        // Salva o idioma selecionado na SESSION para continuar durante a navegação
            // A variável "Language" destrói-se juntamente com a SESSION ao fechar o NAVEGADOR
            // mas não ao fechar a GUIA ou ABA
        $_SESSION["lang"]  = $language;
        // Define uma constante
        define( 'LANG' , $_SESSION['lang']);

        // Pasta com os idiomas 
        $folder     = ELANG_FOLDER;
        // Nome dos arquivos .mo e .po
        $domain     = ELANG_DOMAIN;
        // Codificação
        $encoding   = 'UTF-8';
         
        // Agora é por conta do PHP...
        putenv("LANG=" . $language);
        setlocale(LC_ALL, $language); 
        bindtextdomain($domain, $folder); 
        bind_textdomain_codeset($domain, $encoding);         
        textdomain($domain);