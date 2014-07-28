<?php
    
    // Configurações de idiomas
    require 'languages/languages.config.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Easy Language - https://github.com/tonetlds/easy-language/</title>
</head>
<body>
    
    <!-- Menu exemplo -->    
        <ul>
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
            <li>
                <a href="?lang=pt_BR">
                    <?php echo _('Mudar para pt_BR'); ?>
                </a>
            </li>
            <li>
                <a href="?lang=en_US">
                    <?php echo _('Mudar para en_US'); ?>
                </a>
            </li>
        </ul>
    <!-- Fim Menu exemplo -->

</body>
</html>