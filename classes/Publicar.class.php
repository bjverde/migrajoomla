<?php

class Publicar {
	public function __construct(){
	}
	
	public static function msgAcaoMateriaSucesso( $listIdsArtigos,$listArtigosOK,$listArtigosFalha ){	    
	    $result = null;
	    if( count($listArtigosFalha) == 0 ){
	        $qtd = count($listIdsArtigos);
	        $result = 'Todos os artigos '.$qtd.' atualisados com sucesso !!';
	    }else{
	        $idFalhas = null;
	        foreach ($listArtigosOK as $valeu) {
	            $idFalhas = $idFalhas.','.$valeu;
	        }
	        $qtd      = count($listIdsArtigos);
	        $qtdOK    = count($listArtigosOK);
	        $qtdFalha = count($listArtigosFalha);
	        $result   = 'Qtd de artigos solicitados:'.$qtd
	                 .'; Qtd de artigos NÃO atualizados:'.$qtdFalha
	                 .'; Qtd de artigos atualizados:'.$qtdOK;
	                 //.'. Lista dos id com atualizados: '.$idFalhas;
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
	    $listArtigosOK    = array();
	    foreach ($artigosStateJ3['J3_ID'] as $key => $value) {
	        $idIgual    = ( $artigosStateJ3['J3_ID'][$key] === $artigosStateJ1['ID'][$key] );
	        $stateIgual = ( $artigosStateJ3['J3_STATE'][$key] === $artigosStateJ1['STATE'][$key] );
	        if( $idIgual && $stateIgual){
	            $listArtigosIguais[]=$value;
	        }else{
	            $listArtigosOK[]=$value;
	        }
	    }
	    $result = self::msgAcaoMateriaSucesso($listIdsArtigos,$listArtigosOK,$listArtigosIguais);
	    return $result;
	}
}
?>