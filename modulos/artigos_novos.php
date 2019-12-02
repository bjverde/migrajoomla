<?php

// Para evitar as mensagens "Notice: Undefined variable:"
    $grideArtigos =  null;
    $grideUsers =  null;

//--------- Inicio do Form ----------------
$frm = new TForm('Artigos e Usuários Criados',600,1100);
$frm->setFlat(true);
$frm->setMaximize(true);

$frm->addDateField('DATINICIAL','Data Inicial',true);
$frm->addDateField('DATFINAL','Data final',false,false);

$controllersRelatorios = new Relatorios();
$frm->addHtmlField('grideArtigosJ3',gerarGrideArtigosJ3($controllersRelatorios));
$frm->addMemoField('sqlArtigosJ3', 'SQL Artigos do '.J39,4000,false,120,5,null,true,null,$controllersRelatorios->getSQLUltimoArtigoJ3());

$frm->addButton('Pesquisar', null, 'Pesquisar', null, null, true, false);
$frm->addButton('Incluir', null, 'Incluir', null, null, false, false);
$frm->addButton('Limpar', null, 'Limpar', null, null, false, false);


$frm->addGroupField('gpArtigos','Banco '.J25.' - origem dos dados',null,null,null,null,true,null,false)->setcloseble(true);
    $frm->addHtmlField('grideArtigos',$grideArtigos);
    $frm->addMemoField('sqlArtigos', 'SQL Artigos',4000,false,120,5);
$frm->closeGroup();

$frm->addGroupField('gpUsers','Usuários',null,null,null,null,true,null,false)->setcloseble(true);
    $frm->addHtmlField('grideUsers',$grideUsers);
    $frm->addMemoField('sqlUsers', 'SQL Usuários',4000,false,120,5);
$frm->closeGroup();


$acao = isset($acao) ? $acao : null;
switch( $acao ) {
    case 'Pesquisar':
        if ( $frm->validate() ) {
            $datIncial = $frm->getFieldValue('DATINICIAL');
            $datFim = $frm->getFieldValue('DATFINAL');
            $controllers = new Relatorios();
            $resultado = $controllers->getNovosRegistros($datIncial,$datFim);
            
            $artigos  = $resultado['CONTENT'];
            $usuarios = $resultado['USERS'];
            
            $grupo = $frm->getField('gpArtigos');
            $grupo->setOpened(true);
            $grideArquivos = gerarGrideArtigos( 'gdArtigo', 'Artigos Novos, ordenados por data inclusão', $artigos['RESULT'] );
            $frm->setFieldValue('grideArtigos',$grideArquivos);
            $frm->setFieldValue('sqlArtigos',$artigos['SQL']);
            
            $grupo = $frm->getField('gpUsers');
            $grupo->setOpened(true);
            $grideUsers = gerarGrideSimples( 'gdUsers', 'Usuários', $usuarios['RESULT'] );
            $frm->setFieldValue('grideUsers',$grideUsers);
            $frm->setFieldValue('sqlUsers',$usuarios['SQL']);            
        }
    break;
    //--------------------------------------------------------------------------------
    case 'Incluir':
        $listIdArtigos = PostHelper::getArray('idCheckColumn');
        try{
            if(empty($listIdArtigos)){
                $frm->setMessage('Selecione os itens que deseja incluir');
            }else{
                $msg = Migrar::artigosIncluir($listIdArtigos);
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

function gerarGrideArtigosJ3($controllersRelatorios) {
    $dados = $controllersRelatorios->getUltimosArtigosJ3();
    $gride = gerarGrideSimples( 'gdArtigoJ3', 'Último artigo incluído no '.J39 ,$dados );
    return $gride;
}

function gerarGrideArtigos( $gdId, $gdTitulo ,$dados ) {
    $gride = new TGrid( $gdId,$gdTitulo);
    $gride->setData( $dados ); // array de dados
    $gride->addRowNumColumn();
    $gride->addCheckColumn('idCheckColumn','J1 id','J1_ID','J1_ID',true,true);
    $gride->addColumn('STATUS','Status',null,'center');
    $gride->addColumn('J1_TITLE','J1 Titulo');
    $gride->addColumn('J1_CREATED','J1 Dat Criação',null,'center');
    $gride->addColumn('J3_ID','J3 Id',null,'center');
    $gride->addColumn('J3_TITLE','J3 Titulo');
    $gride->addColumn('J3_CREATED','J1 Dat Criação',null,'center');
    $gride->addColumn('J3_MODIFIED','J3 Dat Modificação');
    $gride->enableDefaultButtons(false);
    return $gride;
}

function gerarGrideSimples( $gdId, $gdTitulo ,$dados ) {
    $gride = new TGrid( $gdId,$gdTitulo);
    $gride->setData( $dados ); // array de dados
    $gride->enableDefaultButtons(false);
    return $gride;
}

?>