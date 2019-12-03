<?php

// Para evitar as mensagens "Notice: Undefined variable:"
$grideArtigos =  null;
$grideUsers =  null;

//--------- Inicio do Form ----------------
$frm = new TForm('Atualizar Módulo',600,1100);
$frm->setFlat(true);
$frm->setMaximize(true);

$frm->addHtmlField('aviso','Selecione o Módulo que deseja atualizar. Os dados serão migrados do '.J25.' para '.J39);

$frm->addButton('Atualizar', null, 'Atualizar', null, null, true, false);
$frm->addButton('Limpar', null, 'Limpar', null, null, false, false);

$controllers = new Relatorios();
$dados = $controllers->getModulosJ25();
$gride = gerarGride( 'gdModulos', 'Lista de Módulo PUBLICADOS no '.J25 ,$dados );
$frm->addHtmlField('grideModulos',$gride);


$acao = isset($acao) ? $acao : null;
switch( $acao ) {
    //--------------------------------------------------------------------------------
    case 'Atualizar':
        $listIdModulos = PostHelper::getArray('idCheckColumn');
        d($listIdModulos);
        try{
            if(empty($listIdArtigos)){
                $frm->setMessage('Selecione os itens que deseja migrar');
            }else{
                $controllers = new Migrar();
                //$msg = $controllers->artigosAtualizar($listIdArtigos);
                $frm->setMessage( $msg );
            }
        }
        catch (DomainException $e) {
            $frm->setMessage( $e->getMessage() );
        }
        catch (Exception $e) {
            Mensagem::reportarLog($e);
            $frm->setMessage( $e->getMessage() );
        }
    break;
    //--------------------------------------------------------------------------------
    case 'Limpar':
        $frm->clearFields();
        break;
}

$frm->show();

function gerarGride( $gdId, $gdTitulo ,$dados ) {
    $gride = new TGrid( $gdId,$gdTitulo);
    $gride->setData( $dados ); // array de dados
    $gride->addRowNumColumn();
    $gride->addCheckColumn('idCheckColumn','id','ID','ID',true,true);
    $gride->addColumn('TITLE','Titulo');
    $gride->addColumn('MODULE','Módulo');
    $gride->enableDefaultButtons(false);
    return $gride;
}

?>