<?php
/**
 * System generated by SysGen (System Generator with Formdin Framework) 
 * Download SysGen: https://github.com/bjverde/sysgen
 * Download Formdin Framework: https://github.com/bjverde/formDin
 * 
 * SysGen  Version: 1.10.1-alpha
 * FormDin Version: 4.7.9-alpha
 * 
 * System migraj created in: 2019-11-22 19:23:22
 */
class J25_usersDAO 
{

    private static $sqlBasicSelect = 'select
                                      id
                                     ,name
                                     ,username
                                     ,email
                                     ,password
                                     ,usertype
                                     ,block
                                     ,sendemail
                                     ,registerdate
                                     ,lastvisitdate
                                     ,activation
                                     ,params
                                     ,lastresettime
                                     ,resetcount
                                     from joomlainternet.j16_users ';

    private $tpdo = null;

    public function __construct($tpdo=null)
    {
        FormDinHelper::validateObjTypeTPDOConnectionObj($tpdo,__METHOD__,__LINE__);
        if( empty($tpdo) ){
            $tpdo = New TPDOConnectionObj();
        }
        $this->setTPDOConnection($tpdo);
    }
    public function getTPDOConnection()
    {
        return $this->tpdo;
    }
    public function setTPDOConnection($tpdo)
    {
        FormDinHelper::validateObjTypeTPDOConnectionObj($tpdo,__METHOD__,__LINE__);
        $this->tpdo = $tpdo;
    }
    private function processWhereGridParameters( $whereGrid )
    {
        $result = $whereGrid;
        if ( is_array($whereGrid) ){
            $where = ' 1=1 ';
            $where = SqlHelper::getAtributeWhereGridParameters($where, $whereGrid, 'ID', SqlHelper::SQL_TYPE_NUMERIC);
            $where = SqlHelper::getAtributeWhereGridParameters($where, $whereGrid, 'NAME', SqlHelper::SQL_TYPE_TEXT_LIKE);
            $where = SqlHelper::getAtributeWhereGridParameters($where, $whereGrid, 'USERNAME', SqlHelper::SQL_TYPE_TEXT_LIKE);
            $where = SqlHelper::getAtributeWhereGridParameters($where, $whereGrid, 'EMAIL', SqlHelper::SQL_TYPE_TEXT_LIKE);
            $where = SqlHelper::getAtributeWhereGridParameters($where, $whereGrid, 'PASSWORD', SqlHelper::SQL_TYPE_TEXT_LIKE);
            $where = SqlHelper::getAtributeWhereGridParameters($where, $whereGrid, 'USERTYPE', SqlHelper::SQL_TYPE_TEXT_LIKE);
            $where = SqlHelper::getAtributeWhereGridParameters($where, $whereGrid, 'BLOCK', SqlHelper::SQL_TYPE_NUMERIC);
            $where = SqlHelper::getAtributeWhereGridParameters($where, $whereGrid, 'SENDEMAIL', SqlHelper::SQL_TYPE_NUMERIC);
            $where = SqlHelper::getAtributeWhereGridParameters($where, $whereGrid, 'REGISTERDATE', SqlHelper::SQL_TYPE_TEXT_LIKE);
            $where = SqlHelper::getAtributeWhereGridParameters($where, $whereGrid, 'LASTVISITDATE', SqlHelper::SQL_TYPE_TEXT_LIKE);
            $where = SqlHelper::getAtributeWhereGridParameters($where, $whereGrid, 'ACTIVATION', SqlHelper::SQL_TYPE_TEXT_LIKE);
            $where = SqlHelper::getAtributeWhereGridParameters($where, $whereGrid, 'PARAMS', SqlHelper::SQL_TYPE_TEXT_LIKE);
            $where = SqlHelper::getAtributeWhereGridParameters($where, $whereGrid, 'LASTRESETTIME', SqlHelper::SQL_TYPE_TEXT_LIKE);
            $where = SqlHelper::getAtributeWhereGridParameters($where, $whereGrid, 'RESETCOUNT', SqlHelper::SQL_TYPE_NUMERIC);
            $result = $where;
        }
        return $result;
    }
    //--------------------------------------------------------------------------------
    public function selectById( $id )
    {
        FormDinHelper::validateIdIsNumeric($id,__METHOD__,__LINE__);
        $values = array($id);
        $sql = self::$sqlBasicSelect.' where id = ?';
        $result = $this->tpdo->executeSql($sql, $values);
        return $result;
    }
    //--------------------------------------------------------------------------------
    public function selectCount( $where=null )
    {
        $where = $this->processWhereGridParameters($where);
        $sql = 'select count(id) as qtd from joomlainternet.j16_users';
        $sql = $sql.( ($where)? ' where '.$where:'');
        $result = $this->tpdo->executeSql($sql);
        return $result['QTD'][0];
    }
    //--------------------------------------------------------------------------------
    public function selectAllPagination( $orderBy=null, $where=null, $page=null,  $rowsPerPage= null )
    {
        $rowStart = SqlHelper::getRowStart($page,$rowsPerPage);
        $where = $this->processWhereGridParameters($where);

        $sql = self::$sqlBasicSelect
        .( ($where)? ' where '.$where:'')
        .( ($orderBy) ? ' order by '.$orderBy:'')
        .( ' LIMIT '.$rowStart.','.$rowsPerPage);

        $result = $this->tpdo->executeSql($sql);
        return $result;
    }
    //--------------------------------------------------------------------------------
    public function selectAll( $orderBy=null, $where=null )
    {
        $where = $this->processWhereGridParameters($where);
        $sql = self::$sqlBasicSelect
        .( ($where)? ' where '.$where:'')
        .( ($orderBy) ? ' order by '.$orderBy:'');

        $result = $this->tpdo->executeSql($sql);
        return $result;
    }
    //--------------------------------------------------------------------------------
    public function insert( J16_usersVO $objVo )
    {
        $values = array(  $objVo->getName() 
                        , $objVo->getUsername() 
                        , $objVo->getEmail() 
                        , $objVo->getPassword() 
                        , $objVo->getUsertype() 
                        , $objVo->getBlock() 
                        , $objVo->getSendemail() 
                        , $objVo->getRegisterdate() 
                        , $objVo->getLastvisitdate() 
                        , $objVo->getActivation() 
                        , $objVo->getParams() 
                        , $objVo->getLastresettime() 
                        , $objVo->getResetcount() 
                        );
        $sql = 'insert into joomlainternet.j16_users(
                                 name
                                ,username
                                ,email
                                ,password
                                ,usertype
                                ,block
                                ,sendemail
                                ,registerdate
                                ,lastvisitdate
                                ,activation
                                ,params
                                ,lastresettime
                                ,resetcount
                                ) values (?,?,?,?,?,?,?,?,?,?,?,?,?)';
        $result = $this->tpdo->executeSql($sql, $values);
        $result = $this->tpdo->getLastInsertId();
        return intval($result);
    }
    //--------------------------------------------------------------------------------
    public function update ( J16_usersVO $objVo )
    {
        $values = array( $objVo->getName()
                        ,$objVo->getUsername()
                        ,$objVo->getEmail()
                        ,$objVo->getPassword()
                        ,$objVo->getUsertype()
                        ,$objVo->getBlock()
                        ,$objVo->getSendemail()
                        ,$objVo->getRegisterdate()
                        ,$objVo->getLastvisitdate()
                        ,$objVo->getActivation()
                        ,$objVo->getParams()
                        ,$objVo->getLastresettime()
                        ,$objVo->getResetcount()
                        ,$objVo->getId() );
        $sql = 'update joomlainternet.j16_users set 
                                 name = ?
                                ,username = ?
                                ,email = ?
                                ,password = ?
                                ,usertype = ?
                                ,block = ?
                                ,sendemail = ?
                                ,registerdate = ?
                                ,lastvisitdate = ?
                                ,activation = ?
                                ,params = ?
                                ,lastresettime = ?
                                ,resetcount = ?
                                where id = ?';
        $result = $this->tpdo->executeSql($sql, $values);
        return intval($result);
    }
    //--------------------------------------------------------------------------------
    public function delete( $id )
    {
        FormDinHelper::validateIdIsNumeric($id,__METHOD__,__LINE__);
        $values = array($id);
        $sql = 'delete from joomlainternet.j16_users where id = ?';
        $result = $this->tpdo->executeSql($sql, $values);
        return $result;
    }
    //--------------------------------------------------------------------------------
    public function getVoById( $id )
    {
        FormDinHelper::validateIdIsNumeric($id,__METHOD__,__LINE__);
        $result = $this->selectById( $id );
        $result = \ArrayHelper::convertArrayFormDin2Pdo($result,false);
        $result = $result[0];
        $vo = new J16_usersVO();
        $vo = \FormDinHelper::setPropertyVo($result,$vo);
        return $vo;
    }
    //--------------------------------------------------------------------------------
    public function getSqlSelect( $dat ) {
		
		$sql = "SELECT ju.id
                      ,ju.name
                      ,ju.username
                      ,ju.email
                      ,ju.registerDate
                 FROM ".J25_DB.'.'.J25_DBID."users ju 
        		WHERE  ju.registerDate > '".$dat." 00:00:00'
        		order by ju.id";
		return $sql;
    }
    //--------------------------------------------------------------------------------
    public function getUltimosUsuarios($dat) {
        $sql = $this->getSqlSelect($dat);
        $result = $this->tpdo->executeSql($sql);
        return $result;
    }
}
?>