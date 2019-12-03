<?php

// Para evitar as mensagens "Notice: Undefined variable:"
$grideArtigos =  null;
$grideUsers =  null;

//--------- Inicio do Form ----------------
$frm = new TForm('Atualizar Módulo',600,1100);
$frm->setFlat(true);
$frm->setMaximize(true);

$frm->addHtmlField('aviso','Selecione o Módulo que deseja atualizar. Os dados serão migrados do '.J25.' para '.J39);

$frm->addButton('Atualizar', null, 'Migrar', null, null, true, false);
$frm->addButton('Limpar', null, 'Limpar', null, null, false, false);

$dados = array();
$gride = gerarGride( 'gdModulos', 'Lista de Módulo no '.J25 ,$dados );
$frm->addHtmlField('grideModulos',$gride);


$acao = isset($acao) ? $acao : null;
switch( $acao ) {
    case 'Pesquisar':
        if ( $frm->validate() ) {
            $datIncial = $frm->getFieldValue('DATINICIAL');
            $datFim = $frm->getFieldValue('DATFINAL');
            $controllers = new Relatorios();
            $resultado = $controllers->getArtigosModificados($datIncial,$datFim);
            
            $artigos  = $resultado['CONTENT'];
            
            $grupo = $frm->getField('gpArtigos');
            $grupo->setOpened(true);
            $grideArquivos = gerarGrideArtigos( 'gdArtigo', 'Artigos Modificados, ordenados por data modificação', $artigos['RESULT'] );
            $frm->setFieldValue('grideArtigos',$grideArquivos);
            $frm->setFieldValue('sqlArtigos',$artigos['SQL']);
            
        }
    break;
    //--------------------------------------------------------------------------------
    case 'Migrar':
        $listIdArtigos = PostHelper::getArray('idCheckColumn');
        try{
            if(empty($listIdArtigos)){
                $frm->setMessage('Selecione os itens que deseja migrar');
            }else{
                $controllers = new Migrar();
                $msg = $controllers->artigosAtualizar($listIdArtigos);
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
    $gride->addCheckColumn('idCheckColumn','J1 id','J1_ID','J1_ID',true,true);
    $gride->addColumn('STATUS','Status',null,'center');
    $gride->addColumn('J1_TITLE','J1 Titulo');
    $gride->addColumn('J1_CREATED','J1 Dat Criação',null,'center');
    $gride->addColumn('J1_MODIFIED','J1 Dat Modificação',null,'center');    
    $gride->addColumn('J3_ID','J3 Id',null,'center');
    $gride->addColumn('J3_TITLE','J3 Titulo');
    $gride->addColumn('J3_MODIFIED','J3 Dat Modificação');    
    $gride->enableDefaultButtons(false);
    return $gride;
}

?>