<?php

//--------- Inicio do Form ----------------
$frm = new TForm('Atualizar Desqueta dos Artigos');
$frm->setFlat(true);
$frm->setMaximize(true);
$controllersRelatorios = new Relatorios();
$ultimoArtigo = $controllersRelatorios->getUltimosArtigosJ3();
$MAXID = $ultimoArtigo['ID'][0];

$frm->addHtmlField('aviso','Os artigos em Destaque ficará igual ao '.J25.'. ATENÇÃO ESSA ETAPA é demorada !!');

$frm->addButton('Atualizar', null, 'Atualizar', null, null, true, false);
$frm->addButton('Limpar', null, 'Limpar', null, null, false, false);

$acao = isset($acao) ? $acao : null;
switch( $acao ) {
    //--------------------------------------------------------------------------------
    case 'Atualizar':
        try{            
            if ( $frm->validate() ) {
                $msg = Destaque::artigosAtualizar();
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