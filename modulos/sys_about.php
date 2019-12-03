<?php
defined('APLICATIVO') or die();

require_once 'includes/config_conexao.php';

$login = (array_key_exists('USER', $_SESSION[APLICATIVO]) ? $_SESSION[APLICATIVO]['USER']['LOGIN']:null);
$grupo = null;
if (array_key_exists('USER', $_SESSION[APLICATIVO])) {
    $grupo = (array_key_exists('GRUPO_NOME', $_SESSION[APLICATIVO]['USER']) ? $_SESSION[APLICATIVO]['USER']['GRUPO_NOME']:null);
}

$frm = new TForm('Sobre', 400, 500);
$frm->setFlat(true);
$frm->setMaximize(true);

$frm->addGroupField('gpx1', 'Sistema');
    $frm->addTextField('systemName', 'Sistema:', 50, false, 50, SYSTEM_NAME)->setReadOnly(true);
    $frm->addTextField('systemAcronym', 'Sigla:', 20, false, 50, SYSTEM_ACRONYM)->setReadOnly(true);
    $frm->addTextField('versionSystem', 'Versão do Sistema:', 20, false, 20, SYSTEM_VERSION)->setReadOnly(true);
    $pathChangeLog = 'ajuda/changelog.php';
    $changelog = $frm->addTextField('changelog', 'Arquivo ChangeLog:', 20, false, 20, $pathChangeLog);
    $changelog->setReadOnly(true);
    $changelog->setHelpOnLine('ChangeLog', 500, 800, $pathChangeLog);
    $frm->addTextField('versionFormDin', 'Versão do FormDin:', 20, false, 20, FORMDIN_VERSION)->setReadOnly(true);
$frm->closeGroup();

$frm->addGroupField('gpx3', 'Banco '.J25.' - origem dos dados');    
    $frm->addTextField('servidorBD', 'Servidor de Banco:', 20, false, 20, HOST)->setReadOnly(true);
    $frm->addTextField('banco', 'Banco:', 20, false, 20, DATABASE)->setReadOnly(true);
$frm->closeGroup();

$frm->addGroupField('gpx2', 'Banco '.J39.' - Destino dos dados');
    $perfilBancoAcesso  = ServidorConfig::getInstancia()->getPerfilJ39();
    $frm->addTextField('servidorBDJ3', 'Servidor:', 50, false, 50, $perfilBancoAcesso['HOST'])->setReadOnly(true);
    $frm->addTextField('bancoJ3', 'banco:', 50, false, 50, $perfilBancoAcesso['DATABASE'])->setReadOnly(true);
    $frm->addTextField('usuarioJ3', 'Usuário:', 50, false, 50, $perfilBancoAcesso['USERNAME'])->setReadOnly(true);
    //$frm->addTextField('senhaJ3', 'Senha:', 50, false, 50, $perfilBancoAcesso['PASSWORD'])->setReadOnly(true);
$frm->closeGroup();


$frm->show();
