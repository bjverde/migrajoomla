<?php

//--------- Inicio do Form ----------------
$frm = new TForm('Atualizar status Publicação dos Artigos');
$frm->setFlat(true);
$frm->setMaximize(true);

$ultimoArtigo = J3ContentDAO::getUltimoArtigo();
$MAXID = $ultimoArtigo['J3_ID'][0];

$frm->addHtmlField('aviso','Informa os Ids do intervalo dos artigos. O campo embranco irá rodar sobre todos os artigos, o ultimo artigo no Joomla 3 é '.$MAXID.'. Para atulizar um artigo informe os dois campois com o mesmo valor');
$frm->addGroupField('gpf01','Lista de Artigos no Joomla 3');
    $frm->addNumberField('IDMIN', 'Id menor Artigo',8,false,0,null,null,null,null,false);
    $frm->addNumberField('IDMAX', 'Id maior Artigo',8,false,0,false,null,null,$MAXID,false);
$frm->closeGroup();

$frm->addButton('Atualizar', null, 'Atualizar', null, null, true, false);
$frm->addButton('Limpar', null, 'Limpar', null, null, false, false);

$acao = isset($acao) ? $acao : null;
switch( $acao ) {
    //--------------------------------------------------------------------------------
    case 'Atualizar':
        try{            
            if ( $frm->validate() ) {
                $idmin = $frm->getFieldValue('IDMIN');
                $idmax = $frm->getFieldValue('IDMAX');
                $msg = Publicar::artigosAtualizarPublicacao( $idmin, $idmax );
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