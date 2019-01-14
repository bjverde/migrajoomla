<?php
class J3ContentDAO extends TPDOConnection {

    public static function getInfoConnect() {
        $perfilBancoAcesso  = ServidorConfig::getInstancia()->getPerfilAcesso();
        $configArray= array(
             'DBMS' => $perfilBancoAcesso['DBMS']
            ,'PORT' => $perfilBancoAcesso['PORT']
            ,'HOST' => $perfilBancoAcesso['HOST']
            ,'DATABASE' => $perfilBancoAcesso['DATABASE']
            ,'USERNAME' => $perfilBancoAcesso['USERNAME']
            ,'PASSWORD' => $perfilBancoAcesso['PASSWORD']
        );
        return $configArray;
    }
    //--------------------------------------------------------------------------------
    public static function selectArtigoById( $id ) {
        if( empty($id) ){
            throw new DomainException('Id não informado');
        }
        
        $configFile    = null;
        $boolRequired  = true;
        $boolUtfDecode = null;
        $configArray   = self::getInfoConnect();
        parent::connect($configFile,$boolRequired,$boolUtfDecode,$configArray);
        
        $values = array( $id );
        $sql = "SELECT jc.id as j3_id
            		,jc.title as j3_title
            		,jc.alias as j3_alias
            		,jc.introtext as j3_introtext
            		,jc.fulltext as j3_fulltext
            		,jc.created as j3_created
            		,jc.modified as j3_modified
        		FROM intranet.j38m_content as jc
        		WHERE  jc.id = ?
        		order by jc.id";
        $result = self::executeSql($sql,$values);
        return $result;
    }
    //--------------------------------------------------------------------------------
    public static function getSQLUltimoArtigoJ3() {
        $sql = "SELECT max(jc.id) as id FROM intranet.j38m_content as jc;";
        return $sql;
    }
    //--------------------------------------------------------------------------------
    public static function getUltimoArtigo() {
        $configFile    = null;
        $boolRequired  = true;
        $boolUtfDecode = null;
        $configArray   = self::getInfoConnect();
        parent::connect($configFile,$boolRequired,$boolUtfDecode,$configArray);
        
        $sql = self::getSQLUltimoArtigoJ3();
        $result = self::executeSql($sql);        
        $result = self::selectArtigoById( $result['ID'][0] );        
        return $result;
    }
    //--------------------------------------------------------------------------------
    public static function getSQLUltimoArtigoModificadoJ3() {
        $sql = "SELECT jc.id FROM intranet.j38m_content as jc
                where jc.modified = (SELECT max(jc1.modified) as id
                                    FROM intranet.j38m_content as jc1
                                    WHERE jc1.created <> jc1.modified
                                    );";
        return $sql;
    }
    //--------------------------------------------------------------------------------
    public static function getUltimoArtigoModificadoJ3() {
        $configFile    = null;
        $boolRequired  = true;
        $boolUtfDecode = null;
        $configArray   = self::getInfoConnect();
        parent::connect($configFile,$boolRequired,$boolUtfDecode,$configArray);
        
        $sql = self::getSQLUltimoArtigoModificadoJ3();
        $result = self::executeSql($sql);
        $result = self::selectArtigoById( $result['ID'][0] );
        return $result;
    }
    //--------------------------------------------------------------------------------
    public static function temArtigoById( $id ) {
        $result = false;
        $dados = self::selectArtigoById($id);
        if( is_array($dados) ){
            if ( $dados['J3_ID'][0] == $id ){
                $result = true;
            }
        }
        return $result;
    }
    //--------------------------------------------------------------------------------    
    public static function update ( $artigo ) {
        $configFile    = null;
        $boolRequired  = true;
        $boolUtfDecode = null;
        $configArray   = self::getInfoConnect();
        parent::connect($configFile,$boolRequired,$boolUtfDecode,$configArray);

        $result = null;
        if( !is_array($artigo) ){
            throw new DomainException('Array Artigo em branco');
        }else{
            
            $values = array( $artigo['TITLE'][0]
                           , $artigo['ALIAS'][0]
                           , $artigo['INTROTEXT'][0]
                           , $artigo['FULLTEXT'][0]
                           , $artigo['CREATED'][0]
                           , $artigo['CREATED_BY'][0]
                           , $artigo['MODIFIED'][0]
                           , $artigo['MODIFIED_BY'][0]
                           , $artigo['ID'][0] );
            $sql = 'update intranet.j38m_content set
    					    title = ?
                           ,alias = ?
                           ,introtext = ?
                           ,`fulltext` = ?
                           ,created = ?
                           ,created_by = ?
                           ,modified = ?
                           ,modified_by = ?
    				where id = ?';
            $result = self::executeSql($sql,$values);
        }
        return $result;
    }
    //--------------------------------------------------------------------------------
    public static function insert ( $artigo ) {
        $configFile    = null;
        $boolRequired  = true;
        $boolUtfDecode = null;
        $configArray   = self::getInfoConnect();
        parent::connect($configFile,$boolRequired,$boolUtfDecode,$configArray);
        
        $result = null;
        if( !is_array($artigo) ){
            throw new DomainException('Array Artigo em branco');
        }else{
            
            $values = array( 
                  $artigo['id']
                , $artigo['asset_id']
                , $artigo['title']
                , $artigo['alias']
                , $artigo['introtext']
                , $artigo['fulltext'] 
                , $artigo['state']
                , $artigo['catid'] 
                , $artigo['created']
                , $artigo['created_by']
                , $artigo['created_by_alias']
                , $artigo['modified']
                , $artigo['modified_by']
                , $artigo['checked_out']
                , $artigo['checked_out_time']
                , $artigo['publish_up']
                , $artigo['publish_down']
                , $artigo['images']
                , $artigo['urls']
                , $artigo['attribs']
                , $artigo['version']
                , $artigo['ordering']
                , $artigo['metakey']
                , $artigo['metadesc']
                , $artigo['access']
                , $artigo['hits']
                , $artigo['metadata']
                , $artigo['featured']
                , $artigo['language']
                , $artigo['xreference']
            );
            $sql = 'INSERT INTO intranet.j38m_content
                            (`id`,
                            `asset_id`,
                            `title`,
                            `alias`,
                            `introtext`,
                            `fulltext`,
                            `state`,
                            `catid`,
                            `created`,
                            `created_by`,
                            `created_by_alias`,
                            `modified`,
                            `modified_by`,
                            `checked_out`,
                            `checked_out_time`,
                            `publish_up`,
                            `publish_down`,
                            `images`,
                            `urls`,
                            `attribs`,
                            `version`,
                            `ordering`,
                            `metakey`,
                            `metadesc`,
                            `access`,
                            `hits`,
                            `metadata`,
                            `featured`,
                            `language`,
                            `xreference`)
                            VALUES
                            (?
                            ,?
                            ,?
                            ,?
                            ,?
                            ,?
                            ,?
                            ,?
                            ,?
                            ,?
                            ,?
                            ,?
                            ,?
                            ,?
                            ,?
                            ,?
                            ,?
                            ,?
                            ,?
                            ,?
                            ,?
                            ,?
                            ,?
                            ,?
                            ,?
                            ,?
                            ,?
                            ,?
                            ,?
                            ,?
                            );';
            $result = self::executeSql($sql,$values);
        }
        return $result;
    }
	//--------------------------------------------------------------------------------
	public static function getSqlSelectStates( $idmin, $idmax ) {
	    $sql = "SELECT co.id as j3_id
		             , co.state as j3_state
                FROM intranet.j38m_content as co
				WHERE  1=1 ";
		$sql = !empty($idmin)?$sql." and co.id >= ".$idmin:$sql.'';
		$sql = !empty($idmax)?$sql." and co.id <= ".$idmax:$sql.'';
		$sql = $sql." order by co.id";
	    return $sql;
	}
	public static function selectSelectStates( $idmin, $idmax ) {
	    $configFile    = null;
	    $boolRequired  = true;
	    $boolUtfDecode = null;
	    $configArray   = self::getInfoConnect();
	    parent::connect($configFile,$boolRequired,$boolUtfDecode,$configArray);
	    
	    $sql = self::getSqlSelectStates( $idmin, $idmax );
	    $result = self::executeSql($sql);
	    return $result;
	}
	//--------------------------------------------------------------------------------
	public static function updateState ( $id, $state ) {
	    if( !is_numeric($id) ){
	        throw new DomainException('Id não numero informado');
	    }
	    
	    if( !is_numeric($state) ){
	        throw new DomainException('Id: '.$id.'. State não informado');
	    }
	    
	    $configFile    = null;
	    $boolRequired  = true;
	    $boolUtfDecode = null;
	    $configArray   = self::getInfoConnect();
	    parent::connect($configFile,$boolRequired,$boolUtfDecode,$configArray);
	    
	    $values = array( $state, $id );
	    $sql = 'update intranet.j38m_content set
    				   state = ?
    			 where id = ?';
	    $result = self::executeSql($sql,$values);
	    return $result;
	}
}
?>