<?php
/**
 * System generated by SysGen (System Generator with Formdin Framework) 
 * Download SysGen: https://github.com/bjverde/sysgen
 * Download Formdin Framework: https://github.com/bjverde/formDin
 * 
 * SysGen  Version: 1.10.1-alpha
 * FormDin Version: 4.7.9-alpha
 * 
 * System migraj created in: 2019-11-22 18:12:06
 */
class J39_contentDAO 
{

    private static $sqlBasicSelect = 'select
                                      id
                                     ,asset_id
                                     ,title
                                     ,alias
                                     ,introtext
                                     ,`fulltext`
                                     ,state
                                     ,catid
                                     ,created
                                     ,created_by
                                     ,created_by_alias
                                     ,modified
                                     ,modified_by
                                     ,checked_out
                                     ,checked_out_time
                                     ,publish_up
                                     ,publish_down
                                     ,images
                                     ,urls
                                     ,attribs
                                     ,version
                                     ,ordering
                                     ,metakey
                                     ,metadesc
                                     ,access
                                     ,hits
                                     ,metadata
                                     ,featured
                                     ,language
                                     ,xreference
                                     ,note
                                     from portal.j36_content ';

    private $tpdo = null;

    public function __construct($tpdo=null)
    {
        FormDinHelper::validateObjTypeTPDOConnectionObj($tpdo,__METHOD__,__LINE__);
        if( empty($tpdo) ){
            $perfilBancoJ39  = ServidorConfig::getInstancia()->getPerfilJ39();
            $tpdo = New TPDOConnectionObj();
            $tpdo->setDBMS(DBMS_MYSQL);
            $tpdo->setHost($perfilBancoJ39['HOST']);
            $tpdo->setPort($perfilBancoJ39['PORT']);
            $tpdo->setDataBaseName($perfilBancoJ39['DATABASE']);
            $tpdo->setUsername($perfilBancoJ39['USERNAME']);
            $tpdo->setPassword($perfilBancoJ39['PASSWORD']);
            $tpdo->connect(null,true,null,null);
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
            $where = SqlHelper::getAtributeWhereGridParameters($where, $whereGrid, 'ASSET_ID', SqlHelper::SQL_TYPE_NUMERIC);
            $where = SqlHelper::getAtributeWhereGridParameters($where, $whereGrid, 'TITLE', SqlHelper::SQL_TYPE_TEXT_LIKE);
            $where = SqlHelper::getAtributeWhereGridParameters($where, $whereGrid, 'ALIAS', SqlHelper::SQL_TYPE_TEXT_LIKE);
            $where = SqlHelper::getAtributeWhereGridParameters($where, $whereGrid, 'INTROTEXT', SqlHelper::SQL_TYPE_TEXT_LIKE);
            $where = SqlHelper::getAtributeWhereGridParameters($where, $whereGrid, 'FULLTEXT', SqlHelper::SQL_TYPE_TEXT_LIKE);
            $where = SqlHelper::getAtributeWhereGridParameters($where, $whereGrid, 'STATE', SqlHelper::SQL_TYPE_NUMERIC);
            $where = SqlHelper::getAtributeWhereGridParameters($where, $whereGrid, 'CATID', SqlHelper::SQL_TYPE_NUMERIC);
            $where = SqlHelper::getAtributeWhereGridParameters($where, $whereGrid, 'CREATED', SqlHelper::SQL_TYPE_TEXT_LIKE);
            $where = SqlHelper::getAtributeWhereGridParameters($where, $whereGrid, 'CREATED_BY', SqlHelper::SQL_TYPE_NUMERIC);
            $where = SqlHelper::getAtributeWhereGridParameters($where, $whereGrid, 'CREATED_BY_ALIAS', SqlHelper::SQL_TYPE_TEXT_LIKE);
            $where = SqlHelper::getAtributeWhereGridParameters($where, $whereGrid, 'MODIFIED', SqlHelper::SQL_TYPE_TEXT_LIKE);
            $where = SqlHelper::getAtributeWhereGridParameters($where, $whereGrid, 'MODIFIED_BY', SqlHelper::SQL_TYPE_NUMERIC);
            $where = SqlHelper::getAtributeWhereGridParameters($where, $whereGrid, 'CHECKED_OUT', SqlHelper::SQL_TYPE_NUMERIC);
            $where = SqlHelper::getAtributeWhereGridParameters($where, $whereGrid, 'CHECKED_OUT_TIME', SqlHelper::SQL_TYPE_TEXT_LIKE);
            $where = SqlHelper::getAtributeWhereGridParameters($where, $whereGrid, 'PUBLISH_UP', SqlHelper::SQL_TYPE_TEXT_LIKE);
            $where = SqlHelper::getAtributeWhereGridParameters($where, $whereGrid, 'PUBLISH_DOWN', SqlHelper::SQL_TYPE_TEXT_LIKE);
            $where = SqlHelper::getAtributeWhereGridParameters($where, $whereGrid, 'IMAGES', SqlHelper::SQL_TYPE_TEXT_LIKE);
            $where = SqlHelper::getAtributeWhereGridParameters($where, $whereGrid, 'URLS', SqlHelper::SQL_TYPE_TEXT_LIKE);
            $where = SqlHelper::getAtributeWhereGridParameters($where, $whereGrid, 'ATTRIBS', SqlHelper::SQL_TYPE_TEXT_LIKE);
            $where = SqlHelper::getAtributeWhereGridParameters($where, $whereGrid, 'VERSION', SqlHelper::SQL_TYPE_NUMERIC);
            $where = SqlHelper::getAtributeWhereGridParameters($where, $whereGrid, 'ORDERING', SqlHelper::SQL_TYPE_NUMERIC);
            $where = SqlHelper::getAtributeWhereGridParameters($where, $whereGrid, 'METAKEY', SqlHelper::SQL_TYPE_TEXT_LIKE);
            $where = SqlHelper::getAtributeWhereGridParameters($where, $whereGrid, 'METADESC', SqlHelper::SQL_TYPE_TEXT_LIKE);
            $where = SqlHelper::getAtributeWhereGridParameters($where, $whereGrid, 'ACCESS', SqlHelper::SQL_TYPE_NUMERIC);
            $where = SqlHelper::getAtributeWhereGridParameters($where, $whereGrid, 'HITS', SqlHelper::SQL_TYPE_NUMERIC);
            $where = SqlHelper::getAtributeWhereGridParameters($where, $whereGrid, 'METADATA', SqlHelper::SQL_TYPE_TEXT_LIKE);
            $where = SqlHelper::getAtributeWhereGridParameters($where, $whereGrid, 'FEATURED', SqlHelper::SQL_TYPE_NUMERIC);
            $where = SqlHelper::getAtributeWhereGridParameters($where, $whereGrid, 'LANGUAGE', SqlHelper::SQL_TYPE_TEXT_LIKE);
            $where = SqlHelper::getAtributeWhereGridParameters($where, $whereGrid, 'XREFERENCE', SqlHelper::SQL_TYPE_TEXT_LIKE);
            $where = SqlHelper::getAtributeWhereGridParameters($where, $whereGrid, 'NOTE', SqlHelper::SQL_TYPE_TEXT_LIKE);
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
        $sql = 'select count(id) as qtd from portal.j36_content';
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
    public function insert( J39_contentVO $objVo )
    {
        $values = array(  $objVo->getAsset_id() 
                        , $objVo->getTitle() 
                        , $objVo->getAlias() 
                        , $objVo->getIntrotext() 
                        , $objVo->getFulltext() 
                        , $objVo->getState() 
                        , $objVo->getCatid() 
                        , $objVo->getCreated() 
                        , $objVo->getCreated_by() 
                        , $objVo->getCreated_by_alias() 
                        , $objVo->getModified() 
                        , $objVo->getModified_by() 
                        , $objVo->getChecked_out() 
                        , $objVo->getChecked_out_time() 
                        , $objVo->getPublish_up() 
                        , $objVo->getPublish_down() 
                        , $objVo->getImages() 
                        , $objVo->getUrls() 
                        , $objVo->getAttribs() 
                        , $objVo->getVersion() 
                        , $objVo->getOrdering() 
                        , $objVo->getMetakey() 
                        , $objVo->getMetadesc() 
                        , $objVo->getAccess() 
                        , $objVo->getHits() 
                        , $objVo->getMetadata() 
                        , $objVo->getFeatured() 
                        , $objVo->getLanguage() 
                        , $objVo->getXreference() 
                        , $objVo->getNote() 
                        );
        $sql = 'insert into portal.j36_content(
                                 asset_id
                                ,title
                                ,alias
                                ,introtext
                                ,`fulltext`
                                ,state
                                ,catid
                                ,created
                                ,created_by
                                ,created_by_alias
                                ,modified
                                ,modified_by
                                ,checked_out
                                ,checked_out_time
                                ,publish_up
                                ,publish_down
                                ,images
                                ,urls
                                ,attribs
                                ,version
                                ,ordering
                                ,metakey
                                ,metadesc
                                ,access
                                ,hits
                                ,metadata
                                ,featured
                                ,language
                                ,xreference
                                ,note
                                ) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
        $result = $this->tpdo->executeSql($sql, $values);
        $result = $this->tpdo->getLastInsertId();
        return intval($result);
    }
    //--------------------------------------------------------------------------------
    public function insertMigracao( J39_contentVO $objVo )
    {
        $values = array(  $objVo->setId()
                        , $objVo->getAsset_id() 
                        , $objVo->getTitle() 
                        , $objVo->getAlias() 
                        , $objVo->getIntrotext() 
                        , $objVo->getFulltext() 
                        , $objVo->getState() 
                        , $objVo->getCatid() 
                        , $objVo->getCreated() 
                        , $objVo->getCreated_by() 
                        , $objVo->getCreated_by_alias() 
                        , $objVo->getModified() 
                        , $objVo->getModified_by() 
                        , $objVo->getChecked_out() 
                        , $objVo->getChecked_out_time() 
                        , $objVo->getPublish_up() 
                        , $objVo->getPublish_down() 
                        , $objVo->getImages() 
                        , $objVo->getUrls() 
                        , $objVo->getAttribs() 
                        , $objVo->getVersion() 
                        , $objVo->getOrdering() 
                        , $objVo->getMetakey() 
                        , $objVo->getMetadesc() 
                        , $objVo->getAccess() 
                        , $objVo->getHits() 
                        , $objVo->getMetadata() 
                        , $objVo->getFeatured() 
                        , $objVo->getLanguage() 
                        , $objVo->getXreference() 
                        , $objVo->getNote() 
                        );
        $sql = 'insert into portal.j36_content(
                                 id
                                ,asset_id
                                ,title
                                ,alias
                                ,introtext
                                ,`fulltext`
                                ,state
                                ,catid
                                ,created
                                ,created_by
                                ,created_by_alias
                                ,modified
                                ,modified_by
                                ,checked_out
                                ,checked_out_time
                                ,publish_up
                                ,publish_down
                                ,images
                                ,urls
                                ,attribs
                                ,version
                                ,ordering
                                ,metakey
                                ,metadesc
                                ,access
                                ,hits
                                ,metadata
                                ,featured
                                ,language
                                ,xreference
                                ,note
                                ) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
        $result = $this->tpdo->executeSql($sql, $values);
        return $result;
    }    
    //--------------------------------------------------------------------------------
    public function update ( J39_contentVO $objVo )
    {
        $values = array( $objVo->getAsset_id()
                        ,$objVo->getTitle()
                        ,$objVo->getAlias()
                        ,$objVo->getIntrotext()
                        ,$objVo->getFulltext()
                        ,$objVo->getState()
                        ,$objVo->getCatid()
                        ,$objVo->getCreated()
                        ,$objVo->getCreated_by()
                        ,$objVo->getCreated_by_alias()
                        ,$objVo->getModified()
                        ,$objVo->getModified_by()
                        ,$objVo->getChecked_out()
                        ,$objVo->getChecked_out_time()
                        ,$objVo->getPublish_up()
                        ,$objVo->getPublish_down()
                        ,$objVo->getImages()
                        ,$objVo->getUrls()
                        ,$objVo->getAttribs()
                        ,$objVo->getVersion()
                        ,$objVo->getOrdering()
                        ,$objVo->getMetakey()
                        ,$objVo->getMetadesc()
                        ,$objVo->getAccess()
                        ,$objVo->getHits()
                        ,$objVo->getMetadata()
                        ,$objVo->getFeatured()
                        ,$objVo->getLanguage()
                        ,$objVo->getXreference()
                        ,$objVo->getNote()
                        ,$objVo->getId() );
        $sql = 'update portal.j36_content set 
                                 asset_id = ?
                                ,title = ?
                                ,alias = ?
                                ,introtext = ?
                                ,fulltext = ?
                                ,state = ?
                                ,catid = ?
                                ,created = ?
                                ,created_by = ?
                                ,created_by_alias = ?
                                ,modified = ?
                                ,modified_by = ?
                                ,checked_out = ?
                                ,checked_out_time = ?
                                ,publish_up = ?
                                ,publish_down = ?
                                ,images = ?
                                ,urls = ?
                                ,attribs = ?
                                ,version = ?
                                ,ordering = ?
                                ,metakey = ?
                                ,metadesc = ?
                                ,access = ?
                                ,hits = ?
                                ,metadata = ?
                                ,featured = ?
                                ,language = ?
                                ,xreference = ?
                                ,note = ?
                                where id = ?';
        $result = $this->tpdo->executeSql($sql, $values);
        return intval($result);
    }
    //--------------------------------------------------------------------------------
    public function delete( $id )
    {
        FormDinHelper::validateIdIsNumeric($id,__METHOD__,__LINE__);
        $values = array($id);
        $sql = 'delete from portal.j36_content where id = ?';
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
        $vo = new J39_contentVO();
        $vo = \FormDinHelper::setPropertyVo($result,$vo);
        return $vo;
    }
    //--------------------------------------------------------------------------------
    public function selectByIdMigrator( $id ) {
        FormDinHelper::validateIdIsNumeric($id,__METHOD__,__LINE__);
        $values = array( $id );
        $sql = "SELECT jc.id as j3_id
            		,jc.title as j3_title
            		,jc.alias as j3_alias
            		,jc.introtext as j3_introtext
            		,jc.fulltext as j3_fulltext
            		,jc.created as j3_created
            		,jc.modified as j3_modified
        		FROM portal.j36_content as jc
        		WHERE  jc.id = ?
        		order by jc.id";
        $result = $this->tpdo->executeSql($sql,$values);
        return $result;
    }    
    //--------------------------------------------------------------------------------
    public function getSQLUltimoArtigoJ3() {
        $sql = "SELECT max(jc.id) as id FROM portal.j36_content as jc;";
        return $sql;
    }
    //--------------------------------------------------------------------------------
    public function getUltimoArtigo() {
        $sql = $this->getSQLUltimoArtigoJ3();
        $result = $this->tpdo->executeSql($sql);
        $result = $this->selectByIdMigrator( $result['ID'][0] );
        return $result;
    }
}
?>