<?php

class Migrar {
	public function __construct(){
	}
	
	public static function msgAcaoMateriaSucesso( $listIdsArtigos,$listArtigosOK,$listArtigosFalha ){	    
	    $result = null;
	    if( count($listArtigosFalha) == 0 ){
	        $qtd = count($listIdsArtigos);
	        $result = 'Todos os artigos '.$qtd.' atualisados com sucesso !!';
	    }else{
	        $idFalhas = null;
	        foreach ($listArtigosFalha as $valeu) {
	            $idFalhas = $idFalhas.','.$valeu;
	        }
	        $qtdOK = count($listArtigosOK);
	        $qtdFalha = count($listArtigosFalha);
	        $result = 'Teve alguma falha !! Artigos com sucesso:'.$qtdOK.'; Artigos com falha:'.$qtdFalha.'. Lista dos id com falhas: '.$idFalhas;
	    }
	    return $result;
	}
	//--------------------------------------------------------------------------------
	public static function getIdUserJ3ByIdJ1( $idUsersJ1 ){
	    $idUsersJ3 = 10;
	    if( $idUsersJ1 == 0){
	        $idUsersJ3 = 0;
	    }elseif ( !empty($idUsersJ1) ){
	       $userJ1 = UsersDAO::selectById( $idUsersJ1 );	    
	       $userJ3 = J3UsersDAO::selectByEmail($userJ1['EMAIL'][0]);
	       $idUsersJ3 = empty($userJ3['ID'][0])?10:$userJ3['ID'][0]; //ID 10 = Nudes 6
	    }
	    return $idUsersJ3;
	}
	//--------------------------------------------------------------------------------
	public function artigosAtualizar( $listIdsArtigos ){
	    if( !is_array($listIdsArtigos) ){
	        throw new DomainException('Selecione os itens que deseja migrar');
	    }
	    
	    $listArtigosFalha = array();
		$listArtigosOK = array();		
	    foreach ($listIdsArtigos as $idArtigo) {
			$daoJ39 = new J39_contentDAO();
			$temArigo = $daoJ39->temArtigoById($idArtigo);
	        if( $temArigo ){
				$objVoJ39 = $daoJ39->getVoById($idArtigo);
				$artigoJ5 = $this->getArtigoJ25($idArtigo);
				$objVoJ39 = $this->setVoJ39( $objVoJ39, $artigoJ5 );
				$daoJ39->update($objVoJ39);
	            $listArtigosOK[]=$idArtigo;
	        }else{
	            $listArtigosFalha[]=$idArtigo;
	        }
	    }    
	    $result = self::msgAcaoMateriaSucesso($listIdsArtigos,$listArtigosOK,$listArtigosFalha);
	    return $result;
	}
	//--------------------------------------------------------------------------------
	public function getArtigoJ25( $idArtigo ){
		$daoJ25 = new J25_contentDAO();
		$artigoJ5 = $daoJ25->selectById($idArtigo);
		return $artigoJ5;
	}
	//--------------------------------------------------------------------------------
	public function setVoJ39( J39_contentVO $objVoJ39, $artigoJ25 ){
		$objVoJ39->setAsset_id( $artigoJ25['ASSET_ID'][0] );
		$objVoJ39->setTitle(empty($artigoJ25['TITLE'][0])?' ':$artigoJ25['TITLE'][0]);
		$objVoJ39->setAlias(empty($artigoJ25['ALIAS'][0])?' ':$artigoJ25['ALIAS'][0]);
		$objVoJ39->setIntrotext(empty($artigoJ25['INTROTEXT'][0])?' ':$artigoJ25['INTROTEXT'][0]);
		$objVoJ39->setFulltext(empty($artigoJ25['FULLTEXT'][0])?' ':$artigoJ25['FULLTEXT'][0]);
		$objVoJ39->setState(empty($artigoJ25['STATE'][0])?0:$artigoJ25['STATE'][0]);
		$objVoJ39->setCatid($artigoJ25['CATID'][0]);
		$objVoJ39->setCreated($artigoJ25['CREATED'][0]);
		$objVoJ39->setCreated_by($artigoJ25['CREATED_BY'][0]);
		$objVoJ39->setCreated_by_alias(empty($artigoJ25['CREATED_BY_ALIAS'][0])?' ':$artigoJ25['CREATED_BY_ALIAS'][0]);
		$objVoJ39->setModified($artigoJ25['MODIFIED'][0]);
		$objVoJ39->setModified_by($artigoJ25['MODIFIED_BY'][0]);
		$objVoJ39->setChecked_out($artigoJ25['CHECKED_OUT'][0]);
		$objVoJ39->setChecked_out_time(empty($artigoJ25['CHECKED_OUT_TIME'][0])?'':$artigoJ25['CHECKED_OUT_TIME'][0]);
		$objVoJ39->setPublish_up($artigoJ25['PUBLISH_UP'][0]);
		$objVoJ39->setPublish_down($artigoJ25['PUBLISH_DOWN'][0]);
		$objVoJ39->setImages(empty($artigoJ25['IMAGES'][0])?' ':$artigoJ25['IMAGES'][0]);
		$objVoJ39->setUrls(empty($artigoJ25['URLS'][0])?' ':$artigoJ25['URLS'][0]);
		$objVoJ39->setAttribs($artigoJ25['ATTRIBS'][0]);
		$objVoJ39->setVersion($artigoJ25['VERSION'][0]);
		$objVoJ39->setOrdering($artigoJ25['ORDERING'][0]);
		$objVoJ39->setMetakey(empty($artigoJ25['METAKEY'][0])?' ':$artigoJ25['METAKEY'][0]);
		$objVoJ39->setMetadesc(empty($artigoJ25['METADESC'][0])?' ':$artigoJ25['METADESC'][0]);
		$objVoJ39->setAccess($artigoJ25['ACCESS'][0]);
		$objVoJ39->setHits($artigoJ25['HITS'][0]);
		$objVoJ39->setMetadata($artigoJ25['METADATA'][0]);
		$objVoJ39->setFeatured($artigoJ25['FEATURED'][0]);
		$objVoJ39->setLanguage($artigoJ25['LANGUAGE'][0]);
		$objVoJ39->setXreference(empty($artigoJ25['XREFERENCE'][0])?' ':$artigoJ25['XREFERENCE'][0]);
		return $objVoJ39;
	}
	//--------------------------------------------------------------------------------
	public function artigosIncluir( $listIdsArtigos ){
	    if( !is_array($listIdsArtigos) ){
	        throw new DomainException('Selecione os itens que deseja incluir');
	    }
	    
	    $listArtigosFalha = array();
	    $listArtigosOK = array();
	    foreach ($listIdsArtigos as $idJ1) {
			$artigoJ1 = $this->getArtigoJ25($idJ1);
			
			$objVoJ39 = new J39_contentVO();
			$objVoJ39->setId( $artigoJ1['ID'][0] );
			$objVoJ39->setNote(' ');
			$objVoJ39 = $this->setVoJ39( $objVoJ39, $artigoJ1 );
			$daoJ39 = new J39_contentDAO();
			$daoJ39->insertMigracao($objVoJ39);
	    }
	    $result = self::msgAcaoMateriaSucesso($listIdsArtigos,$listArtigosOK,$listArtigosFalha);
	    return $result;
	}
}
?>