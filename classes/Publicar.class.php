<?php

class Publicar {
	public function __construct(){
	}
	
	public static function getListHtml( $lista ){
	    $listaHtml = null;
	    foreach ( $lista as $valeu ) {
	        $listaHtml = $listaHtml.'
                          <li>'.$valeu.'</li>';
	    }
	    return $listaHtml;
	}
	
	public static function msgAcaoMateriaSucesso( $listIdsArtigos,$listArtigosAtualizar,$listArtigosIguais ,$listArtigosNaoExisteJ1 ){	    
	    $result = null;
	    if( count($listArtigosIguais) == 0 ){
	        $qtd = count($listIdsArtigos);
	        $result = 'Todos os artigos '.$qtd.' atualisados com sucesso !!';
	    }else{
	        $idFalhas = self::getListHtml( $listArtigosAtualizar );
	        $idJ3     = self::getListHtml( $listArtigosNaoExisteJ1 );
	        $qtd      = count($listIdsArtigos);
	        $qtdOK    = count($listArtigosAtualizar);
	        $qtdFalha = count($listArtigosIguais);
	        $resultJs = 'Qtd de artigos solicitados:'.$qtd
	                 .'; Qtd de artigos NÃO atualizados:'.$qtdFalha
	                 .'; Qtd de artigos atualizados:'.$qtdOK;
					 //.'. Lista dos id com atualizados: '.$idFalhas;
	        $result = $resultJs.'<br><br>Lista dos id Atualizados <ul>: '.$idFalhas.'</ul>';
	        $result = $result.'<br><br>Lista dos id que existem apenas no Joomla 3<ul>: '.$idJ3.'</ul>';
	        
	        echo $result;
	    }
	    return $resultJs;
	}
	//--------------------------------------------------------------------------------
	public static function artigosAtualizarPublicacao( $idmin, $idmax ){
	    if( $idmin > $idmax ){
	        throw new DomainException('Valor Max deve ser maior que o Min');
        }
        
        $artigosStateJ1 = ContentDAO::selectSelectStates( $idmin, $idmax );
        $artigosStateJ3 = J3ContentDAO::selectSelectStates( $idmin, $idmax );
        
        $listIdsArtigos   = $artigosStateJ3['J3_ID'];
	    $listArtigosIguais= array();
	    $listArtigosAtualizar = array();
	    $listArtigosNaoExisteJ1 = array();
	    foreach ($artigosStateJ3['J3_ID'] as $key => $value) {
	        //$idJ1 = ArrayHelper::getArrayFormKey($artigosStateJ1, 'ID', $key);
	        if( !in_array($value, $artigosStateJ1['ID']) ){
	            $listArtigosNaoExisteJ1[] = $value;
	        }else{
	            $keyJ1 = array_search($value, $artigosStateJ1['ID']);
    	        $idIgual    = ( $artigosStateJ3['J3_ID'][$key] === $artigosStateJ1['ID'][$keyJ1] );
    	        $stateIgual = ( $artigosStateJ3['J3_STATE'][$key] === $artigosStateJ1['STATE'][$keyJ1] );
    	        if( $idIgual && $stateIgual){
    	            $listArtigosIguais[]=$value;
    	        }else{
    	            $listArtigosAtualizar[]=$value;
    	            $id = $value;
    	            $state = $artigosStateJ1['STATE'][$keyJ1];
    	            J3ContentDAO::updateState( $id ,$state );
    	        }
	        }
	    }
	    $result = self::msgAcaoMateriaSucesso($listIdsArtigos
	                                         ,$listArtigosAtualizar
	                                         ,$listArtigosIguais
	                                         ,$listArtigosNaoExisteJ1);
	    return $result;
	}
}
?>