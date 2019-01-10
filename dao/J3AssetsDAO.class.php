<?php
class J3AssetsDAO extends TPDOConnection {

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
    public static function getMaxRgt() {
        $configFile    = null;
        $boolRequired  = true;
        $boolUtfDecode = null;
        $configArray   = self::getInfoConnect();
        parent::connect($configFile,$boolRequired,$boolUtfDecode,$configArray);

        $sql = 'SELECT max(rgt) as rgt FROM intranet.j38m_assets as ja;';
        $result = self::executeSql($sql);
            
        return $result['RGT'][0];
    }
    //--------------------------------------------------------------------------------
    public static function getIdAssetsByName($name) {
        $configFile    = null;
        $boolRequired  = true;
        $boolUtfDecode = null;
        $configArray   = self::getInfoConnect();
        parent::connect($configFile,$boolRequired,$boolUtfDecode,$configArray);
        
        if( empty($name) ){
            throw new DomainException('Nome do Assest está em branco!');
        }
        
        $sql = 'SELECT id, parent_id, lft, rgt, level, name, title FROM intranet.j38m_assets as ja where ja.name = ?';
        
        $values = array( $name );
        $result = self::executeSql($sql,$values);
        
        return $result['ID'][0];
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
            
            $values = array( $artigo['PARENT_ID']
                           , $artigo['LFT']
                           , $artigo['RGT']
                           , $artigo['LEVEL']
                           , $artigo['NAME']
                           , $artigo['TITLE']
                           , $artigo['RULES']
                           );
            $sql = 'INSERT INTO intranet.j38m_assets
                    (`parent_id`
                    ,`lft`
                    ,`rgt`
                    ,`level`
                    ,`name`
                    ,`title`
                    ,`rules`)
                    VALUES
                    (?
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
}
?>