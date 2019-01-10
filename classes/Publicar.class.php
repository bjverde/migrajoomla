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
	        $result   = 'Qtd de artigos solicitados:'.$qtd.'; Qtd de artigos NÃO atualizados:'.$qtdFalha.'. Lista dos id com atualizados: '.$idFalhas;
	    }
	    return $result;
	}
	//--------------------------------------------------------------------------------
	public static function artigosAtualizarPublicacao( $idmin, $idmax ){
	    if( !is_numeric($idmin) ){
	        throw new DomainException('Valor Min não é inteiro');
        }
        if( !is_numeric($idmax) ){
	        throw new DomainException('Valor Max não é inteiro');
        }
	    if( $idmin > $idmax ){
	        throw new DomainException('Valor Max deve ser maior que o Min');
        }
        
        $artigosStateJ1 = ContentDAO::selectSelectStates( $idmin, $idmax );
        $artigosStateJ3 = J3ContentDAO::selectSelectStates( $idmin, $idmax );
        
        $listIdsArtigos   = $artigosStateJ3;
	    $listArtigosFalha = array();
	    $listArtigosOK    = array();
	    foreach ($artigosStateJ3['J3_ID'] as $key => $value) {
	        if( $value ==  $artigosStateJ1['ID'][$key] ){
	            $listArtigosFalha[]=$value;
	        }else{
	            $listArtigosOK[]=$value;
	        }
	    }
	    $result = self::msgAcaoMateriaSucesso($listIdsArtigos,$listArtigosOK,$listArtigosFalha);
	    return $result;
	}
}
?>