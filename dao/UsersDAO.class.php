<?php
class UsersDAO extends TPDOConnection {

	public static function getSqlSelect( $dat ) {
		
		$sql = "SELECT ju.id
                      ,ju.name
                      ,ju.username
                      ,ju.email
                      ,ju.registerDate
                 FROM deefete.emepe_users ju
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
	    parent::connect(null,true,null,null);
	    $values = array( $id );
	    $sql = "SELECT ju.id
                      ,ju.name
                      ,ju.username
                      ,ju.email
                      ,ju.registerDate
                 FROM deefete.emepe_users ju
        		WHERE  ju.id = ?
        		order by ju.id";
	    $result = self::executeSql($sql,$values);
	    return $result;
	}
}
?>