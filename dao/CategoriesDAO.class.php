<?php
class CategoriesDAO extends TPDOConnection {

	public static function getSqlSelect( $dat ) {	
		$sql = "SELECT jc.id
                	  ,jc.parent_id
                	  ,jc.title
                	  ,jc.created_time
                	  ,CASE WHEN jc.created_time > '".$dat." 00:00:00' THEN 'SIM' ELSE '' END as criterio_creat
                	  ,jc.modified_time
                	  ,CASE WHEN jc.modified_time > '".$dat." 00:00:00' THEN 'SIM' ELSE '' END as criterio_mod
		FROM joomlainternet.j16_categories as jc
    		where jc.created_time > '".$dat." 00:00:00'
    		or jc.modified_time > '".$dat." 00:00:00'
		order by jc.id";
		return $sql;
	}
	//--------------------------------------------------------------------------------
	public static function selectAll( $dat ) {
	    $sql = self::getSqlSelect($dat);
		$result = self::executeSql($sql);
		return $result;
	}
}
?>