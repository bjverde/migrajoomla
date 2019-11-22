<?php
/**
 * System generated by SysGen (System Generator with Formdin Framework) 
 * Download SysGen: https://github.com/bjverde/sysgen
 * Download Formdin Framework: https://github.com/bjverde/formDin
 * 
 * SysGen  Version: 1.10.1-alpha
 * FormDin Version: 4.7.9-alpha
 * 
 * System migraj created in: 2019-11-22 19:23:21
 */
class J25_categoriesVO
{
    private $id = null;
    private $asset_id = null;
    private $parent_id = null;
    private $lft = null;
    private $rgt = null;
    private $level = null;
    private $path = null;
    private $extension = null;
    private $title = null;
    private $alias = null;
    private $note = null;
    private $description = null;
    private $published = null;
    private $checked_out = null;
    private $checked_out_time = null;
    private $access = null;
    private $params = null;
    private $metadesc = null;
    private $metakey = null;
    private $metadata = null;
    private $created_user_id = null;
    private $created_time = null;
    private $modified_user_id = null;
    private $modified_time = null;
    private $hits = null;
    private $language = null;
    public function __construct( $id=null, $asset_id=null, $parent_id=null, $lft=null, $rgt=null, $level=null, $path=null, $extension=null, $title=null, $alias=null, $note=null, $description=null, $published=null, $checked_out=null, $checked_out_time=null, $access=null, $params=null, $metadesc=null, $metakey=null, $metadata=null, $created_user_id=null, $created_time=null, $modified_user_id=null, $modified_time=null, $hits=null, $language=null ) {
        $this->setId( $id );
        $this->setAsset_id( $asset_id );
        $this->setParent_id( $parent_id );
        $this->setLft( $lft );
        $this->setRgt( $rgt );
        $this->setLevel( $level );
        $this->setPath( $path );
        $this->setExtension( $extension );
        $this->setTitle( $title );
        $this->setAlias( $alias );
        $this->setNote( $note );
        $this->setDescription( $description );
        $this->setPublished( $published );
        $this->setChecked_out( $checked_out );
        $this->setChecked_out_time( $checked_out_time );
        $this->setAccess( $access );
        $this->setParams( $params );
        $this->setMetadesc( $metadesc );
        $this->setMetakey( $metakey );
        $this->setMetadata( $metadata );
        $this->setCreated_user_id( $created_user_id );
        $this->setCreated_time( $created_time );
        $this->setModified_user_id( $modified_user_id );
        $this->setModified_time( $modified_time );
        $this->setHits( $hits );
        $this->setLanguage( $language );
    }
    //--------------------------------------------------------------------------------
    public function setId( $strNewValue = null )
    {
        $this->id = $strNewValue;
    }
    public function getId()
    {
        return $this->id;
    }
    //--------------------------------------------------------------------------------
    public function setAsset_id( $strNewValue = null )
    {
        $this->asset_id = $strNewValue;
    }
    public function getAsset_id()
    {
        return $this->asset_id;
    }
    //--------------------------------------------------------------------------------
    public function setParent_id( $strNewValue = null )
    {
        $this->parent_id = $strNewValue;
    }
    public function getParent_id()
    {
        return $this->parent_id;
    }
    //--------------------------------------------------------------------------------
    public function setLft( $strNewValue = null )
    {
        $this->lft = $strNewValue;
    }
    public function getLft()
    {
        return $this->lft;
    }
    //--------------------------------------------------------------------------------
    public function setRgt( $strNewValue = null )
    {
        $this->rgt = $strNewValue;
    }
    public function getRgt()
    {
        return $this->rgt;
    }
    //--------------------------------------------------------------------------------
    public function setLevel( $strNewValue = null )
    {
        $this->level = $strNewValue;
    }
    public function getLevel()
    {
        return $this->level;
    }
    //--------------------------------------------------------------------------------
    public function setPath( $strNewValue = null )
    {
        $this->path = $strNewValue;
    }
    public function getPath()
    {
        return $this->path;
    }
    //--------------------------------------------------------------------------------
    public function setExtension( $strNewValue = null )
    {
        $this->extension = $strNewValue;
    }
    public function getExtension()
    {
        return $this->extension;
    }
    //--------------------------------------------------------------------------------
    public function setTitle( $strNewValue = null )
    {
        $this->title = $strNewValue;
    }
    public function getTitle()
    {
        return $this->title;
    }
    //--------------------------------------------------------------------------------
    public function setAlias( $strNewValue = null )
    {
        $this->alias = $strNewValue;
    }
    public function getAlias()
    {
        return $this->alias;
    }
    //--------------------------------------------------------------------------------
    public function setNote( $strNewValue = null )
    {
        $this->note = $strNewValue;
    }
    public function getNote()
    {
        return $this->note;
    }
    //--------------------------------------------------------------------------------
    public function setDescription( $strNewValue = null )
    {
        $this->description = $strNewValue;
    }
    public function getDescription()
    {
        return $this->description;
    }
    //--------------------------------------------------------------------------------
    public function setPublished( $strNewValue = null )
    {
        $this->published = $strNewValue;
    }
    public function getPublished()
    {
        return $this->published;
    }
    //--------------------------------------------------------------------------------
    public function setChecked_out( $strNewValue = null )
    {
        $this->checked_out = $strNewValue;
    }
    public function getChecked_out()
    {
        return $this->checked_out;
    }
    //--------------------------------------------------------------------------------
    public function setChecked_out_time( $strNewValue = null )
    {
        $this->checked_out_time = $strNewValue;
    }
    public function getChecked_out_time()
    {
        return $this->checked_out_time;
    }
    //--------------------------------------------------------------------------------
    public function setAccess( $strNewValue = null )
    {
        $this->access = $strNewValue;
    }
    public function getAccess()
    {
        return $this->access;
    }
    //--------------------------------------------------------------------------------
    public function setParams( $strNewValue = null )
    {
        $this->params = $strNewValue;
    }
    public function getParams()
    {
        return $this->params;
    }
    //--------------------------------------------------------------------------------
    public function setMetadesc( $strNewValue = null )
    {
        $this->metadesc = $strNewValue;
    }
    public function getMetadesc()
    {
        return $this->metadesc;
    }
    //--------------------------------------------------------------------------------
    public function setMetakey( $strNewValue = null )
    {
        $this->metakey = $strNewValue;
    }
    public function getMetakey()
    {
        return $this->metakey;
    }
    //--------------------------------------------------------------------------------
    public function setMetadata( $strNewValue = null )
    {
        $this->metadata = $strNewValue;
    }
    public function getMetadata()
    {
        return $this->metadata;
    }
    //--------------------------------------------------------------------------------
    public function setCreated_user_id( $strNewValue = null )
    {
        $this->created_user_id = $strNewValue;
    }
    public function getCreated_user_id()
    {
        return $this->created_user_id;
    }
    //--------------------------------------------------------------------------------
    public function setCreated_time( $strNewValue = null )
    {
        $this->created_time = $strNewValue;
    }
    public function getCreated_time()
    {
        return $this->created_time;
    }
    //--------------------------------------------------------------------------------
    public function setModified_user_id( $strNewValue = null )
    {
        $this->modified_user_id = $strNewValue;
    }
    public function getModified_user_id()
    {
        return $this->modified_user_id;
    }
    //--------------------------------------------------------------------------------
    public function setModified_time( $strNewValue = null )
    {
        $this->modified_time = $strNewValue;
    }
    public function getModified_time()
    {
        return $this->modified_time;
    }
    //--------------------------------------------------------------------------------
    public function setHits( $strNewValue = null )
    {
        $this->hits = $strNewValue;
    }
    public function getHits()
    {
        return $this->hits;
    }
    //--------------------------------------------------------------------------------
    public function setLanguage( $strNewValue = null )
    {
        $this->language = $strNewValue;
    }
    public function getLanguage()
    {
        return $this->language;
    }
    //--------------------------------------------------------------------------------
}
?>