<?php

	$cookieName = "cookie";
	$cookieDefaultValue = "pt_BR";
	
	$languageFolder = "easy-language/languages";
	
	$language = null;
	
	// verificar se o cookie existe assim como o set de lingua
	// o periodo de permanencia do cookie é de 24H
	if (!isset($_COOKIE[$cookieName]) && !isset($_GET["lg"])) {
		// caso não exista este é criado com os valores padrão
		setcookie ($cookieName, $cookieDefaultValue, time() + (3600 * 24));
	} else if (isset($_COOKIE[$cookieName]) && isset($_GET["lg"])) {
		//fazer set do novo valor do cookie
		setcookie ($cookieName, $_GET["lg"], time() + (3600 * 24));
	} else {/* nada acontece para já */}
	
	// agora para saber qual o idioma que está em vigor basta verificares o valor da variavel $languages
