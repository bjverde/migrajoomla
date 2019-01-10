<?php
class ContentDAO extends TPDOConnection {
    
    private static function getCampoData( $campo, $datInicio, $datFim ) {
        $stringCampo = null;
        if( empty($datFim) ){
            $stringCampo = "jc.".$campo." > '".$datInicio." 00:00:00' ";
        }else{
            $stringCampo = "( jc.".$campo." BETWEEN '".$datInicio." 00:00:00' AND '".$datFim." 23:59:59' )";
        }        
        return $stringCampo;
    }
    //--------------------------------------------------------------------------------
    public static function getSqlSelectTodos( $datInicio, $datFim ) {
        parent::connect(null,true,null,null);
		$sql = "SELECT jc.id
            		,jc.title
            		,jc.created
            		,CASE WHEN ".self::getCampoData('created', $datInicio, $datFim)." THEN 'SIM' ELSE '' END as criterio_created
            		,jc.publish_up
            		,CASE WHEN ".self::getCampoData('publish_up', $datInicio, $datFim)." THEN 'SIM' ELSE '' END as criterio_publi
            		,jc.modified
            		,CASE WHEN ".self::getCampoData('modified', $datInicio, $datFim)." THEN 'SIM' ELSE '' END as criterio_mod
        		FROM deefete.emepe_content as jc
        		WHERE  ".self::getCampoData('created', $datInicio, $datFim)."
            	   or  ".self::getCampoData('publish_up', $datInicio, $datFim)."
            	   or  ".self::getCampoData('modified', $datInicio, $datFim)."
        		order by jc.created";
		return $sql;
	}
	public static function selectTodos( $datInicio, $datFim ) {
	    parent::connect(null,true,null,null);
	    $sql = self::getSqlSelectTodos($datInicio, $datFim);
		$result = self::executeSql($sql);
		return $result;
	}
	//--------------------------------------------------------------------------------
	public static function getSqlSelectNovos( $datInicio, $datFim ) {
	    parent::connect(null,true,null,null);
	    $sql = "SELECT jc.id as j1_id
            		,jc.title as j1_title
            		,jc.created as j1_created
            		,CASE WHEN ".self::getCampoData('created', $datInicio, $datFim)." THEN 'SIM' ELSE '' END as criterio_created
            		,jc.publish_up as j1_publish_up
            		,jc.modified
        		FROM deefete.emepe_content as jc
        		WHERE  ".self::getCampoData('created', $datInicio, $datFim)."
        		order by jc.created";
	    return $sql;
	}
	public static function selectNovos( $datInicio, $datFim ) {
	    parent::connect(null,true,null,null);
	    $sql = self::getSqlSelectNovos($datInicio, $datFim);
	    $result = self::executeSql($sql);
	    return $result;
	}
	//--------------------------------------------------------------------------------
	public static function getSqlSelectAlterdos( $datInicio, $datFim ) {
	    parent::connect(null,true,null,null);
	    
	    $sql = "SELECT jc.id as j1_id
            		,jc.title as j1_title
            		,jc.created as j1_created
            		,jc.modified as j1_modified
            		,CASE WHEN ".self::getCampoData('modified', $datInicio, $datFim)." THEN 'SIM' ELSE '' END as j1_criterio_mod
        		FROM deefete.emepe_content as jc
        		WHERE  ".self::getCampoData('modified', $datInicio, $datFim)."
        		and date(jc.created) <> date(jc.modified)
        		order by jc.modified";
	    return $sql;
	}
	public static function selectAlterados( $datInicio, $datFim ) {
	    parent::connect(null,true,null,null);
	    $sql = self::getSqlSelectAlterdos($datInicio, $datFim);
	    $result = self::executeSql($sql);
	    return $result;
	}
	//--------------------------------------------------------------------------------
	public static function selectArtigoById( $id ) {
	    parent::connect(null,true,null,null);
	    
	    if( empty($id) ){
	        throw new DomainException('Id não informado');
	    }	    
	    $sql = "SELECT jc.id
            		,jc.title
            		,jc.alias
            		,jc.title_alias
            		,jc.introtext 
            		,jc.fulltext
            		,jc.state
            		,jc.sectionid
            		,jc.mask
            		,jc.catid
            		,jc.created
            		,jc.created_by
            		,jc.modified
            		,jc.modified_by
                    ,jc.publish_up
                    ,jc.publish_down
                    ,jc.images
                    ,jc.urls
                    ,jc.version
        		FROM deefete.emepe_content as jc
        		WHERE  jc.id = ".$id."
        		order by jc.id";
	    $result = self::executeSql($sql);
	    return $result;
	}
	//--------------------------------------------------------------------------------
	public static function getSqlSelectStates( $idmin, $idmax ) {
	    $sql = "SELECT co.id
		             , co.state 
                FROM deefete.emepe_content as co
				WHERE  1=1 ";
		$sql = !empty($idmin)?$sql." and co.id >= ".$idmin:$sql.'';
		$sql = !empty($idmax)?$sql." and co.id <= ".$idmax:$sql.'';
		$sql = $sql." order by co.id";
	    return $sql;
	}
	public static function selectSelectStates( $idmin, $idmax ) {
	    parent::connect(null,true,null,null);
	    $sql = self::getSqlSelectStates( $idmin, $idmax );
	    $result = self::executeSql($sql);
	    return $result;
	}	
}
?>