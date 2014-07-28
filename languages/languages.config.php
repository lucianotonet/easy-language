<?php
/**
 * EASY LANGUAGE
 * 
 * Simples gerenciador de idiomas em PHP.
 * 
 * Gerencia string fixas via gettext();  
 * Memoriza idioma selecionado em uma SESSION
 * 
 * 
 * em breve...
 * gestão de idiomas em banco de dados MYSQL
 *
 *
 * @author tonetlds
 * @link http://www.lucianotonet.com/
 * @link https://github.com/tonetlds/easy-language/
 * @license http://opensource.org/licenses/MIT MIT License
 */


        // Usa SESSIONs
        // Se o sistema já iniciou uma session em outro ponto, comente esta linha.
        session_start();

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
            $language = "pt_BR"; // Idioma padrão
            // to do:
                // Grande diferencial!
                // Aqui pode ser inserido uma função pra pegar o idioma do navegador
                // Ou seja, o site detecta o idioma "automaticamente".
        }
         
        // Salva o idioma selecionado na SESSION para continuar durante a navegação
            // A variável "Language" destrói-se juntamente com a SESSION ao fechar o NAVEGADOR
            // mas não ao fechar a GUIA ou ABA
        $_SESSION["Language"]  = $language;

        // Pasta com os idiomas 
        $folder     = "languages";
        // Nome dos arquivos .mo e .po
        $domain     = "messages";
        // Codificação
        $encoding   = 'UTF-8';
         
        // Agora é por conta do PHP...
        putenv("LANG=" . $language);
        setlocale(LC_ALL, $language); 
        bindtextdomain($domain, $folder); 
        bind_textdomain_codeset($domain, $encoding);         
        textdomain($domain);