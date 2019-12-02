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
	            $link = '<a href="http://www.mpdft.mp.br/portal/administrator/index.php?option=com_content&view=article&layout=edit&id='.$dadosArtigos['J1_ID'][$key].'" target="_blank">'.$value.'</a>';
	            $dadosArtigos['J1_TITLE'][$key] = $link;
	        }
	    }
	    return $dadosArtigos;
	}
	
	private function formataArtigosNovos( $daoJ25, $datIncial ,$datFim ){
	    $dadosArtigos = $daoJ25->selectNovos($datIncial,$datFim);
	    $dadosArtigos = self::incluirDadosJ3($dadosArtigos, 'I');
	    $result = $this->trataArtigosLinkJoomlaAntigo($dadosArtigos);
	    return $result;
	}
	
	public function getNovosRegistros( $datIncial ,$datFim ){
	    if( empty($datIncial) ){
	        throw new DomainException('Informe uma data inicial');
	    }
	    $datIncial = DateTimeHelper::date2Mysql($datIncial);
		$datFim = DateTimeHelper::date2Mysql($datFim);
		
		$daoContentJ25 = new J25_contentDAO();

	    $result = null;
		$result['CONTENT']['SQL'] = $daoContentJ25->getSqlSelectNovos($datIncial,$datFim);
	    $result['CONTENT']['RESULT'] = $this->formataArtigosNovos($daoContentJ25,$datIncial,$datFim);
		
		$daoUsersJ25 = new J25_usersDAO ();
	    $result['USERS']['SQL'] = $daoUsersJ25->getSqlSelect($datIncial);
		$result['USERS']['RESULT'] = $daoUsersJ25->getUltimosUsuarios($datIncial);
	    
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
	                        $dadosArtigosJ1['STATUS'][$key] = '<span style="color:Magenta">ATUALIZAR</span>';
	                    }
	                }
	            }	            
	            
	        }
	    }
	    return $dadosArtigosJ1;
	}
	
	private function formataArtigosModificados( $daoJ25, $datIncial ,$datFim ){
	    $dadosArtigos = $daoJ25->selectAlterados($datIncial,$datFim);
	    $dadosArtigos = self::incluirDadosJ3($dadosArtigos, 'U');
	    $result = self::trataArtigosLinkJoomlaAntigo($dadosArtigos);
	    return $result;
	}
	
	public function getArtigosModificados( $datIncial ,$datFim ){
	    if( empty($datIncial) ){
	        throw new DomainException('Informe uma data inicial');
	    }
	    $datIncial = DateTimeHelper::date2Mysql($datIncial);
	    $datFim = DateTimeHelper::date2Mysql($datFim);
		$result = null;
		$daoJ25 = new J25_contentDAO();
	    $result['CONTENT']['SQL'] = $daoJ25->getSqlSelectAlterdos($datIncial,$datFim);	    
	    $result['CONTENT']['RESULT'] = $this->formataArtigosModificados($daoJ25, $datIncial, $datFim);
	    
	    return $result;
	}

	public function getSQLUltimoArtigoJ3(){
		$daoJ39 = new J39_contentDAO();
		$result = $daoJ39->getSQLUltimoArtigoJ3();
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
	
	public function getSQLUltimoArtigoModificadoJ3(){
		$controllers = new J39_contentDAO();
		$result = $controllers->getSQLUltimoArtigoModificadoJ3();
		return $result;
	}

	public function getUltimoArtigoModificadoJ3() {
		$controllers = new J39_contentDAO();
		$result = $controllers->getUltimoArtigoModificadoJ3();
	    $dados = array();
	    $dados['ID'][0]=$result['J3_ID'][0];
	    $dados['TITLE'][0]=self::trataArtigosLinkJ3( $result['J3_ID'][0], $result['J3_TITLE'][0] );
	    $dados['CREATED'][0]=$result['J3_CREATED'][0];
	    $dados['MODIFIED'][0]=$result['J3_MODIFIED'][0];
	    return $dados;
	}
}
?>