<?php

//--------- Inicio do Form ----------------
$frm = new TForm('Atualizar um artigo');
$frm->setFlat(true);
$frm->setMaximize(true);

$frm->addNumberField('ID', 'Id Artigo Joomla 1.5.14',8,true,0,null,null,null,null,false);

$frm->addButton('Migrar', null, 'Migrar', null, null, true, false);
$frm->addButton('Limpar', null, 'Limpar', null, null, false, false);

$acao = isset($acao) ? $acao : null;
switch( $acao ) {
    //--------------------------------------------------------------------------------
    case 'Migrar':
        try{            
            if ( $frm->validate() ) {
                $id = $frm->getFieldValue('ID');
                $listArtigos = array();
                $listArtigos[]=$id;
                $msg = Migrar::artigosAtualizar($listArtigos);
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

?>