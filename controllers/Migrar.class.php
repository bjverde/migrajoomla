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
	        $artigoJ3 = array();
	        $artigoJ1 = ContentDAO::selectArtigoById($idJ1);
	        $idAssests = self::artigosIncluirAssests($artigoJ1);
			
			$artigoJ3['id']         = $artigoJ1['ID'][0];
			$artigoJ3['asset_id']   = $idAssests;
			$artigoJ3['title']      = empty($artigoJ1['TITLE'][0])?' ':$artigoJ1['TITLE'][0];
			$artigoJ3['alias']      = empty($artigoJ1['ALIAS'][0])?' ':$artigoJ1['ALIAS'][0];
			$artigoJ3['introtext']  = empty($artigoJ1['INTROTEXT'][0])?' ':$artigoJ1['INTROTEXT'][0];
			$artigoJ3['fulltext']   = empty($artigoJ1['FULLTEXT'][0])?' ':$artigoJ1['FULLTEXT'][0];
			$artigoJ3['state']      = empty($artigoJ1['STATE'][0])?' ':$artigoJ1['STATE'][0];
			$artigoJ3['catid']      = 1019; //categoria migração
			$artigoJ3['created']    = $artigoJ1['CREATED'][0];
			$artigoJ3['created_by'] = self::getIdUserJ3ByIdJ1($artigoJ1['CREATED_BY'][0]);
			$artigoJ3['created_by_alias'] = ' ';
			$artigoJ3['modified']    = $artigoJ1['MODIFIED'][0];
			$artigoJ3['modified_by'] = self::getIdUserJ3ByIdJ1($artigoJ1['MODIFIED_BY'][0]);
			$artigoJ3['checked_out'] = 0;   //Valor padrão depois do redmigrator
			$artigoJ3['checked_out_time'] = '0000-00-00 00:00:00'; //Valor padrão depois do redmigrator
			$artigoJ3['publish_up']  = $artigoJ1['PUBLISH_UP'][0];
			$artigoJ3['publish_down']= $artigoJ1['PUBLISH_DOWN'][0];
			$artigoJ3['images']      = empty($artigoJ1['IMAGES'][0])?' ':$artigoJ1['IMAGES'][0];
			$artigoJ3['urls']        = empty($artigoJ1['URLS'][0])?' ':$artigoJ1['URLS'][0];
			$artigoJ3['attribs']     = '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_author":"","show_create_date":"","show_modify_date":"","show_print_icon":"","show_email_icon":"","show_parent_category":"","link_parent_category":"","link_author":"","show_publish_date":"","show_item_navigation":"","show_print_icons":"","show_icons":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":"","list_show_hits":"","list_show_author":"","show_readmore":""}';
			$artigoJ3['version']     = empty($artigoJ1['VERSION'][0])?' ':$artigoJ1['VERSION'][0];
			$artigoJ3['ordering']    = 0;
			$artigoJ3['metakey']     = ' ';
			$artigoJ3['metadesc']    = ' ';
			$artigoJ3['access']      = 1;
			$artigoJ3['hits']        = 0;
			$artigoJ3['metadata']    = '{"robots":"","author":"","tags":""}';
			$artigoJ3['featured']    = 0;
			$artigoJ3['language']    = '*';
			$artigoJ3['xreference']  = ' ';

			J3ContentDAO::insert($artigoJ3);

	        /*
	        if($temArtigo){
	            $artigo = ContentDAO::selectArtigoById($idJ1);
	            J3ContentDAO::update($artigo);
	            $listArtigosOK[]=$idJ1;
	        }else{
	            $listArtigosFalha[]=$idJ1;
	        }
	        */
	    }
	    $result = self::msgAcaoMateriaSucesso($listIdsArtigos,$listArtigosOK,$listArtigosFalha);
	    return $result;
	}
}
?>