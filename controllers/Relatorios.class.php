<?php

class Relatorios {

	public function __construct(){
	}
	//--------------------------------------------------------------------------------
	
	/**
	 * Gera o link para apresentação
	 * @param string $dat
	 * @return NULL|array
	 */
	private function trataArtigosLinkJoomlaAntigo( $dadosArtigos ){
	    if( isset($dadosArtigos) ){
	        foreach ($dadosArtigos['J1_TITLE'] as $key => $value) {
	            $link = '<a href="https://intranet.mpdft.mp.br/portal/administrator/index.php?option=com_content&sectionid=-1&task=edit&cid[]='.$dadosArtigos['J1_ID'][$key].'" target="_blank">'.$value.'</a>';
	            $dadosArtigos['J1_TITLE'][$key] = $link;
	        }
	    }
	    return $dadosArtigos;
	}
	
	private function formataArtigosNovos( $daoJ25, $datIncial ,$datFim ){
	    $dadosArtigos = $daoJ25->selectNovos($datIncial,$datFim);
	    $dadosArtigos = self::incluirDadosJ3($dadosArtigos, 'I');
	    //$result = $this->trataArtigosLinkJoomlaAntigo($dadosArtigos);
	    return $dadosArtigos;
	}
	
	public function getNovosRegistros( $datIncial ,$datFim ){
	    if( empty($datIncial) ){
	        throw new DomainException('Informe uma data inicial');
	    }
	    $datIncial = DateTimeHelper::date2Mysql($datIncial);
		$datFim = DateTimeHelper::date2Mysql($datFim);
		
		$daoJ25 = new J25_contentDAO();

	    $result = null;
		$result['CONTENT']['SQL'] = $daoJ25->getSqlSelectNovos($datIncial,$datFim);
	    $result['CONTENT']['RESULT'] = $this->formataArtigosNovos($daoJ25,$datIncial,$datFim);
		
		/*
	    $result['USERS']['SQL'] = UsersDAO::getSqlSelect($datIncial);
		$result['USERS']['RESULT'] = UsersDAO::selectAll($datIncial);
		*/
	    
		return $result;
	}	
	
	private static function trataArtigosLinkJ3( $j3_id, $j3_title ){
	    if( isset($j3_id) ){
	        $j3_title = '<a href="https://vh2-web-006/portal/administrator/index.php?option=com_content&task=article.edit&id='.$j3_id.'" target="_blank">'.$j3_title.'</a>';
	    }
	    return $j3_title;
	}
	
	private static function incluirDadosJ3( $dadosArtigosJ1 , $operacao){
	    if( isset($dadosArtigosJ1) ){
			$daoJ39 = new J39_contentDAO();

	        foreach ($dadosArtigosJ1['J1_ID'] as $key => $value) {
	            $artigo_j3 = $daoJ39->selectByIdMigrator($value);
	            $dadosArtigosJ1['J3_ID'][$key] = $artigo_j3['J3_ID'][0];
	            $dadosArtigosJ1['J3_TITLE'][$key] = self::trataArtigosLinkJ3( $artigo_j3['J3_ID'][0] , $artigo_j3['J3_TITLE'][0] );
	            $dadosArtigosJ1['J3_CREATED'][$key] = $artigo_j3['J3_CREATED'][0];
	            $dadosArtigosJ1['J3_MODIFIED'][$key] = $artigo_j3['J3_MODIFIED'][0];
	            
	            if( $operacao == 'I'){
	                if( $dadosArtigosJ1['J1_CREATED'][$key] == $dadosArtigosJ1['J3_CREATED'][$key] ){
	                    $dadosArtigosJ1['STATUS'][$key] = '<span style="color:green">ok</span>';
	                }else{
	                    $dadosArtigosJ1['STATUS'][$key] = '<span style="color:red">INCLUIR</span>';
	                }
	            } else {
	                if( $dadosArtigosJ1['J1_MODIFIED'][$key] == $dadosArtigosJ1['J3_MODIFIED'][$key] ){
	                    $dadosArtigosJ1['STATUS'][$key] = '<span style="color:green">ok</span>';
	                }else{
	                    if( empty($dadosArtigosJ1['J3_ID'][$key]) ){
	                        $dadosArtigosJ1['STATUS'][$key] = '<span style="color:red">INCLUIR</span>';
	                    } else {
	                        $dadosArtigosJ1['STATUS'][$key] = '<span style="color:RED">ATUALIZAR</span>';
	                    }
	                }
	            }	            
	            
	        }
	    }
	    return $dadosArtigosJ1;
	}
	
	private static function formataArtigosModificados( $datIncial ,$datFim ){
	    $dadosArtigos = ContentDAO::selectAlterados($datIncial,$datFim);
	    $dadosArtigos = self::incluirDadosJ3($dadosArtigos, 'U');
	    $result = self::trataArtigosLinkJoomlaAntigo($dadosArtigos);
	    return $result;
	}
	
	public static function getArtigosModificados( $datIncial ,$datFim ){
	    if( empty($datIncial) ){
	        throw new DomainException('Informe uma data inicial');
	    }
	    $datIncial = DateTimeHelper::date2Mysql($datIncial);
	    $datFim = DateTimeHelper::date2Mysql($datFim);
	    $result = null;
	    $result['CONTENT']['SQL'] = ContentDAO::getSqlSelectAlterdos($datIncial,$datFim);	    
	    $result['CONTENT']['RESULT'] = self::formataArtigosModificados($datIncial, $datFim);
	    
	    return $result;
	}
	
	public function getUltimosArtigosJ3() {
		$daoJ39 = new J39_contentDAO();
		$result = $daoJ39->getUltimoArtigo();

	    $dados = array();
	    $dados['ID'][0]=$result['J3_ID'][0];
	    $dados['TITLE'][0]=self::trataArtigosLinkJ3( $result['J3_ID'][0], $result['J3_TITLE'][0] );
	    $dados['CREATED'][0]=$result['J3_CREATED'][0];
	    $dados['MODIFIED'][0]=$result['J3_MODIFIED'][0];
	    return $dados;
	}
	
	public function getUltimoArtigoModificadoJ3() {
		//$controllers = new J39_content();
		//$result = $controllers->getUltimoArtigo();		
	    $result = J3ContentDAO::getUltimoArtigoModificadoJ3();
	    $dados = array();
	    $dados['ID'][0]=$result['J3_ID'][0];
	    $dados['TITLE'][0]=self::trataArtigosLinkJ3( $result['J3_ID'][0], $result['J3_TITLE'][0] );
	    $dados['CREATED'][0]=$result['J3_CREATED'][0];
	    $dados['MODIFIED'][0]=$result['J3_MODIFIED'][0];
	    return $dados;
	}
}
?>