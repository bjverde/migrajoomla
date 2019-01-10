<?php
class J3UsersDAO extends TPDOConnection {

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
    
	public static function getSqlSelect( $dat ) {
		
		$sql = "SELECT ju.id
                      ,ju.name
                      ,ju.username
                      ,ju.email
                      ,ju.registerDate
                 FROM intranet.j38m_users ju
        		WHERE  ju.registerDate > '".$dat." 00:00:00'
        		order by ju.id";
		return $sql;
	}
	//--------------------------------------------------------------------------------
	public static function selectAll( $dat ) {
	    parent::connect(null,true,null,null);
	    $sql = self::getSqlSelect($dat);
		$result = self::executeSql($sql);
		return $result;
	}
	
	public static function selectById( $id ) {
	    if( empty($id) ){
	        throw new DomainException('Id não informado');
	    }
	    
	    $configFile    = null;
	    $boolRequired  = true;
	    $boolUtfDecode = null;
	    $configArray   = self::getInfoConnect();
	    parent::connect($configFile,$boolRequired,$boolUtfDecode,$configArray);
	    
	    $values = array( $id );
	    $sql = "SELECT ju.id
                      ,ju.name
                      ,ju.username
                      ,ju.email
                      ,ju.registerDate
                 FROM intranet.j38m_users ju
        		WHERE  ju.id = ?
        		order by ju.id";
	    $result = self::executeSql($sql,$values);
	    return $result;
	}
	
	public static function selectByEmail( $email ) {
	    if( empty($email) ){
	        throw new DomainException('E-mail não informado');
	    }
	    
	    $configFile    = null;
	    $boolRequired  = true;
	    $boolUtfDecode = null;
	    $configArray   = self::getInfoConnect();
	    parent::connect($configFile,$boolRequired,$boolUtfDecode,$configArray);
	    
	    $values = array( $email );
	    $sql = "SELECT ju.id
                      ,ju.name
                      ,ju.username
                      ,ju.email
                      ,ju.registerDate
                 FROM intranet.j38m_users ju
        		WHERE  ju.email = ?
        		order by ju.id";
	    $result = self::executeSql($sql,$values);
	    return $result;
	}
}
?>