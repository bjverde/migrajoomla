<?php
require_once("../classes/ServidorConfig.class.php");
require_once("../includes/constantes.php");
$msgSysNameVersion = SYSTEM_NAME.' - v'.SYSTEM_VERSION;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Changelog - <?php echo($msgSysNameVersion); ?></title>
</head>
<body>
    <h2><?php echo($msgSysNameVersion); ?></h2>
    <li>versão 1.3.1 - 05/11/2018</li>
        <ul>
            <li>Bug migração inclusão</li>
        </ul>     
    <li>versão 1.3.0 - 18/10/2018</li>
        <ul>
            <li>Migra registros novo para novo Joomla</li>
            <li>Coluna status informando o que deve ser feito</li>
        </ul>      
    <li>versão 1.2.0 - 17/10/2018</li>
        <ul>
            <li>Informações das conexões</li>
            <li>Lista ultimo artigo incluido no Joomla 3.8.13</li>
            <li>Lista ultimo artigo modificado no Joomla 3.8.13</li>
            <li>Migra registros alterados para novo Joomla</li>
        </ul>    
    <li>versão 1.1.0 - 16/10/2018</li>
        <ul>
            <li>Lista registros novos Joomla 1.5</li>
            <li>Lista registros alterados Joomla 1.5</li>
            <li>Lista novos usuarios no Joomla 1.5</li>
            <li>Tela para migrar um registros</li>
        </ul>
    <li>versão 0.0.0</li>
        <ul>
            <li>Primeira versão</li>
        </ul>
</body>
</html>