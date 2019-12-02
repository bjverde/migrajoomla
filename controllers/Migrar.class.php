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
	    foreach ($listIdsArtigos as $valeu) {	        
	        $temArtigo = J3ContentDAO::temArtigoById($valeu);
	        if($temArtigo){
	            $artigo = ContentDAO::selectArtigoById($valeu);
	            $artigo['CREATED_BY'][0]  = self::getIdUserJ3ByIdJ1($artigo['CREATED_BY'][0]);
	            $artigo['MODIFIED_BY'][0] = self::getIdUserJ3ByIdJ1($artigo['MODIFIED_BY'][0]);
	            J3ContentDAO::update($artigo);
	            $listArtigosOK[]=$valeu;
	        }else{
	            $listArtigosFalha[]=$valeu;
	        }
	    }    
	    $result = self::msgAcaoMateriaSucesso($listIdsArtigos,$listArtigosOK,$listArtigosFalha);
	    return $result;
	}
	//--------------------------------------------------------------------------------
	private static function artigosIncluirAssests( $artigoJ1 ){
	    if( !is_array($artigoJ1) ){
	        throw new DomainException('Dados do Artigo Joomla 1.5.14 em branco!');
	    }
	    $asset =  array();
	    $rgt = J3AssetsDAO::getMaxRgt();
	    $name = 'com_content.article.'.$artigoJ1['ID'][0];
	    
	    $idAssests = J3AssetsDAO::getIdAssetsByName($name);
	    if( empty($idAssests) ){
    	    $asset['PARENT_ID'] = 1;
    	    $asset['LFT'] = $rgt+1;
    	    $asset['RGT'] = $rgt+2;
    	    $asset['LEVEL'] = 4;
    	    $asset['NAME'] = $name;
    	    $asset['TITLE'] = $artigoJ1['TITLE'][0];
    	    $asset['RULES'] = '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}';
    	    $asset = J3AssetsDAO::insert($asset);
    	    $idAssests = J3AssetsDAO::getIdAssetsByName($name);
	    }	    
	    return $idAssests;
	}
	//--------------------------------------------------------------------------------
	public static function artigosIncluir( $listIdsArtigos ){
	    if( !is_array($listIdsArtigos) ){
	        throw new DomainException('Selecione os itens que deseja incluir');
	    }
	    
	    $listArtigosFalha = array();
	    $listArtigosOK = array();
	    foreach ($listIdsArtigos as $idJ1) {
			$daoContentJ25 = new J25_contentDAO();
			$artigoJ1 = $daoContentJ25->selectById($idJ1);
			
			$objVoJ39 = new J39_contentVO();
			$objVoJ39->setId( $artigoJ1['ID'][0] );
			$objVoJ39->setAsset_id( $artigoJ1['ASSET_ID'][0] );
			$objVoJ39->setTitle(empty($artigoJ1['TITLE'][0])?' ':$artigoJ1['TITLE'][0]);
			$objVoJ39->setAlias(empty($artigoJ1['ALIAS'][0])?' ':$artigoJ1['ALIAS'][0]);
			$objVoJ39->setIntrotext(empty($artigoJ1['INTROTEXT'][0])?' ':$artigoJ1['INTROTEXT'][0]);
			$objVoJ39->setFulltext(empty($artigoJ1['FULLTEXT'][0])?' ':$artigoJ1['FULLTEXT'][0]);
			$objVoJ39->setState(empty($artigoJ1['STATE'][0])?0:$artigoJ1['STATE'][0]);
			$objVoJ39->setCatid($artigoJ1['CATID'][0]);
			$objVoJ39->setCreated($artigoJ1['CREATED'][0]);
			$objVoJ39->setCreated_by($artigoJ1['CREATED_BY'][0]);
			$objVoJ39->setCreated_by_alias(empty($artigoJ1['CREATED_BY_ALIAS'][0])?' ':$artigoJ1['CREATED_BY_ALIAS'][0]);
			$objVoJ39->setModified($artigoJ1['MODIFIED'][0]);
			$objVoJ39->setModified_by($artigoJ1['MODIFIED_BY'][0]);
			$objVoJ39->setChecked_out($artigoJ1['CHECKED_OUT'][0]);
			$objVoJ39->setChecked_out_time(empty($artigoJ1['CHECKED_OUT_TIME'][0])?'':$artigoJ1['CHECKED_OUT_TIME'][0]);
			$objVoJ39->setPublish_up($artigoJ1['PUBLISH_UP'][0]);
			$objVoJ39->setPublish_down($artigoJ1['PUBLISH_DOWN'][0]);
			$objVoJ39->setImages(empty($artigoJ1['IMAGES'][0])?' ':$artigoJ1['IMAGES'][0]);
			$objVoJ39->setUrls(empty($artigoJ1['URLS'][0])?' ':$artigoJ1['URLS'][0]);
			$objVoJ39->setAttribs($artigoJ1['ATTRIBS'][0]);
			$objVoJ39->setVersion($artigoJ1['VERSION'][0]);
			$objVoJ39->setOrdering($artigoJ1['ORDERING'][0]);
			$objVoJ39->setMetakey(empty($artigoJ1['METAKEY'][0])?' ':$artigoJ1['METAKEY'][0]);
			$objVoJ39->setMetadesc(empty($artigoJ1['METADESC'][0])?' ':$artigoJ1['METADESC'][0]);
			$objVoJ39->setAccess($artigoJ1['ACCESS'][0]);
			$objVoJ39->setHits($artigoJ1['HITS'][0]);
			$objVoJ39->setMetadata($artigoJ1['METADATA'][0]);
			$objVoJ39->setFeatured($artigoJ1['FEATURED'][0]);
			$objVoJ39->setLanguage($artigoJ1['LANGUAGE'][0]);
			$objVoJ39->setXreference(empty($artigoJ1['XREFERENCE'][0])?' ':$artigoJ1['XREFERENCE'][0]);
			$objVoJ39->setNote(' ');

			$daoJ39 = new J39_contentDAO();
			$daoJ39->insertMigracao($objVoJ39);
	    }
	    $result = self::msgAcaoMateriaSucesso($listIdsArtigos,$listArtigosOK,$listArtigosFalha);
	    return $result;
	}
}
?>