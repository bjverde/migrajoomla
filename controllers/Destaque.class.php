<?php

class Destaque {
	public function __construct(){
	}
	
	public static function msgAcaoMateriaSucesso( $artigosJ25Qtd ,$artigosJ39Qtd ){	    
	    $result = 'No '.J25.' quantidade de artigos '.$artigosJ25Qtd.' No '.J39.' quantidade de artigos atualizados '.$artigosJ39Qtd;
	    return $result;
	}
	//--------------------------------------------------------------------------------
	public static function artigosAtualizar(){		
		$daoJ25 = new J25_content_frontpageDAO();
		$artigosJ25    = $daoJ25->selectAll();
		$artigosJ25Qtd = $daoJ25->selectCount();

		$daoJ39 = new J39_content_frontpageDAO();
		$result = $daoJ39->deleteAll();        
		
		$artigosJ39Qtd = 0;
	    foreach ($artigosJ25['CONTENT_ID'] as $key => $idArtigo) {
			$objVoJ39 = new J39_content_frontpageVO();
			$objVoJ39->setContent_id($idArtigo);
			$objVoJ39->setOrdering($artigosJ25['ORDERING'][$key]);

			$result = $daoJ39->insert($objVoJ39);
	        if( $result == 1 ){
	            $artigosJ39Qtd = $artigosJ39Qtd + 1;
	        }
	    }
	    $result = self::msgAcaoMateriaSucesso( $artigosJ25Qtd ,$artigosJ39Qtd);
	    return $result;
	}
}
?>