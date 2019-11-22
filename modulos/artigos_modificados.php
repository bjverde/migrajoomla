<?php

// Para evitar as mensagens "Notice: Undefined variable:"
$grideArtigos =  null;
$grideUsers =  null;

//--------- Inicio do Form ----------------
$frm = new TForm('Artigos Modificados',600,1100);
$frm->setFlat(true);
$frm->setMaximize(true);

$frm->addDateField('DATINICIAL','Data Inicial',true);
$frm->addDateField('DATFINAL','Data final',false,false);

$frm->addHtmlField('grideArtigosJ3',gerarGrideArtigosJ3());
$frm->addMemoField('sqlArtigosJ3', 'SQL Artigos do '.J39,4000,false,120,5,null,true,null,J3ContentDAO::getSQLUltimoArtigoModificadoJ3());

$frm->addButton('Pesquisar', null, 'Pesquisar', null, null, true, false);
$frm->addButton('Migrar', null, 'Migrar', null, null, false, false);
$frm->addButton('Limpar', null, 'Limpar', null, null, false, false);

$frm->addGroupField('gpArtigos','Banco '.J25.' - origem dos dados ',null,null,null,null,true,null,false)->setcloseble(true);
$frm->addHtmlField('grideArtigos',$grideArtigos);
$frm->addMemoField('sqlArtigos', 'SQL Artigos do Joomla '.J25,4000,false,120,5,null,true);
$frm->closeGroup();


$acao = isset($acao) ? $acao : null;
switch( $acao ) {
    case 'Pesquisar':
        if ( $frm->validate() ) {
            $datIncial = $frm->getFieldValue('DATINICIAL');
            $datFim = $frm->getFieldValue('DATFINAL');
            $resultado = Relatorios::getArtigosModificados($datIncial,$datFim);
            
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
                $msg = Migrar::artigosAtualizar($listIdArtigos);
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

$frm->addHtmlField('gride');
$frm->show();

function gerarGrideArtigos( $gdId, $gdTitulo ,$dados ) {
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

function gerarGrideArtigosJ3() {
    $dados = Relatorios::getUltimoArtigoModificadoJ3();
    $gride = gerarGrideSimples( 'gdArtigoJ3', 'Último artigo modificado no Joomla 3.8.13' ,$dados );
    return $gride;
}

function gerarGrideSimples( $gdId, $gdTitulo ,$dados ) {
    $gride = new TGrid( $gdId,$gdTitulo);
    $gride->setData( $dados ); // array de dados
    $gride->enableDefaultButtons(false);
    return $gride;
}

?>