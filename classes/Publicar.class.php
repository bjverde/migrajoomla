<?php

class Publicar {
	public function __construct(){
	}
	
	public static function msgAcaoMateriaSucesso( $listIdsArtigos,$listArtigosAtualizar,$listArtigosIguais ){	    
	    $result = null;
	    if( count($listArtigosIguais) == 0 ){
	        $qtd = count($listIdsArtigos);
	        $result = 'Todos os artigos '.$qtd.' atualisados com sucesso !!';
	    }else{
	        $idFalhas = null;
	        foreach ($listArtigosAtualizar as $valeu) {
	            $idFalhas = $idFalhas.'
                          <li>'.$valeu.'</li>';
	        }
	        $qtd      = count($listIdsArtigos);
	        $qtdOK    = count($listArtigosAtualizar);
	        $qtdFalha = count($listArtigosIguais);
	        $result   = 'Qtd de artigos solicitados:'.$qtd
	                 .'; Qtd de artigos NÃO atualizados:'.$qtdFalha
	                 .'; Qtd de artigos atualizados:'.$qtdOK;
					 //.'. Lista dos id com atualizados: '.$idFalhas;
	        echo $result.';Lista dos id Atualizados <ul>: '.$idFalhas.'</ul>';
	    }
	    return $result;
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
	            $keyJ1 = array_search($value, $artigosStateJ1);
    	        $idIgual    = ( $artigosStateJ3['J3_ID'][$key] === $artigosStateJ1['ID'][$keyJ1] );
    	        $stateIgual = ( $artigosStateJ3['J3_STATE'][$key] === $artigosStateJ1['STATE'][$keyJ1] );
    	        if( $idIgual && $stateIgual){
    	            $listArtigosIguais[]=$value;
    	        }else{
    	            $listArtigosAtualizar[]=$value;
    	        }
	        }
	    }
	    d( $listArtigosNaoExisteJ1 );
	    $result = self::msgAcaoMateriaSucesso($listIdsArtigos,$listArtigosAtualizar,$listArtigosIguais);
	    return $result;
	}
}
?>