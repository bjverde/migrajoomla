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
class J36_contentVO
{
    private $id = null;
    private $asset_id = null;
    private $title = null;
    private $alias = null;
    private $introtext = null;
    private $fulltext = null;
    private $state = null;
    private $catid = null;
    private $created = null;
    private $created_by = null;
    private $created_by_alias = null;
    private $modified = null;
    private $modified_by = null;
    private $checked_out = null;
    private $checked_out_time = null;
    private $publish_up = null;
    private $publish_down = null;
    private $images = null;
    private $urls = null;
    private $attribs = null;
    private $version = null;
    private $ordering = null;
    private $metakey = null;
    private $metadesc = null;
    private $access = null;
    private $hits = null;
    private $metadata = null;
    private $featured = null;
    private $language = null;
    private $xreference = null;
    private $note = null;
    public function __construct( $id=null, $asset_id=null, $title=null, $alias=null, $introtext=null, $fulltext=null, $state=null, $catid=null, $created=null, $created_by=null, $created_by_alias=null, $modified=null, $modified_by=null, $checked_out=null, $checked_out_time=null, $publish_up=null, $publish_down=null, $images=null, $urls=null, $attribs=null, $version=null, $ordering=null, $metakey=null, $metadesc=null, $access=null, $hits=null, $metadata=null, $featured=null, $language=null, $xreference=null, $note=null ) {
        $this->setId( $id );
        $this->setAsset_id( $asset_id );
        $this->setTitle( $title );
        $this->setAlias( $alias );
        $this->setIntrotext( $introtext );
        $this->setFulltext( $fulltext );
        $this->setState( $state );
        $this->setCatid( $catid );
        $this->setCreated( $created );
        $this->setCreated_by( $created_by );
        $this->setCreated_by_alias( $created_by_alias );
        $this->setModified( $modified );
        $this->setModified_by( $modified_by );
        $this->setChecked_out( $checked_out );
        $this->setChecked_out_time( $checked_out_time );
        $this->setPublish_up( $publish_up );
        $this->setPublish_down( $publish_down );
        $this->setImages( $images );
        $this->setUrls( $urls );
        $this->setAttribs( $attribs );
        $this->setVersion( $version );
        $this->setOrdering( $ordering );
        $this->setMetakey( $metakey );
        $this->setMetadesc( $metadesc );
        $this->setAccess( $access );
        $this->setHits( $hits );
        $this->setMetadata( $metadata );
        $this->setFeatured( $featured );
        $this->setLanguage( $language );
        $this->setXreference( $xreference );
        $this->setNote( $note );
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
    public function setIntrotext( $strNewValue = null )
    {
        $this->introtext = $strNewValue;
    }
    public function getIntrotext()
    {
        return $this->introtext;
    }
    //--------------------------------------------------------------------------------
    public function setFulltext( $strNewValue = null )
    {
        $this->fulltext = $strNewValue;
    }
    public function getFulltext()
    {
        return $this->fulltext;
    }
    //--------------------------------------------------------------------------------
    public function setState( $strNewValue = null )
    {
        $this->state = $strNewValue;
    }
    public function getState()
    {
        return $this->state;
    }
    //--------------------------------------------------------------------------------
    public function setCatid( $strNewValue = null )
    {
        $this->catid = $strNewValue;
    }
    public function getCatid()
    {
        return $this->catid;
    }
    //--------------------------------------------------------------------------------
    public function setCreated( $strNewValue = null )
    {
        $this->created = $strNewValue;
    }
    public function getCreated()
    {
        return $this->created;
    }
    //--------------------------------------------------------------------------------
    public function setCreated_by( $strNewValue = null )
    {
        $this->created_by = $strNewValue;
    }
    public function getCreated_by()
    {
        return $this->created_by;
    }
    //--------------------------------------------------------------------------------
    public function setCreated_by_alias( $strNewValue = null )
    {
        $this->created_by_alias = $strNewValue;
    }
    public function getCreated_by_alias()
    {
        return $this->created_by_alias;
    }
    //--------------------------------------------------------------------------------
    public function setModified( $strNewValue = null )
    {
        $this->modified = $strNewValue;
    }
    public function getModified()
    {
        return $this->modified;
    }
    //--------------------------------------------------------------------------------
    public function setModified_by( $strNewValue = null )
    {
        $this->modified_by = $strNewValue;
    }
    public function getModified_by()
    {
        return $this->modified_by;
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
    public function setPublish_up( $strNewValue = null )
    {
        $this->publish_up = $strNewValue;
    }
    public function getPublish_up()
    {
        return $this->publish_up;
    }
    //--------------------------------------------------------------------------------
    public function setPublish_down( $strNewValue = null )
    {
        $this->publish_down = $strNewValue;
    }
    public function getPublish_down()
    {
        return $this->publish_down;
    }
    //--------------------------------------------------------------------------------
    public function setImages( $strNewValue = null )
    {
        $this->images = $strNewValue;
    }
    public function getImages()
    {
        return $this->images;
    }
    //--------------------------------------------------------------------------------
    public function setUrls( $strNewValue = null )
    {
        $this->urls = $strNewValue;
    }
    public function getUrls()
    {
        return $this->urls;
    }
    //--------------------------------------------------------------------------------
    public function setAttribs( $strNewValue = null )
    {
        $this->attribs = $strNewValue;
    }
    public function getAttribs()
    {
        return $this->attribs;
    }
    //--------------------------------------------------------------------------------
    public function setVersion( $strNewValue = null )
    {
        $this->version = $strNewValue;
    }
    public function getVersion()
    {
        return $this->version;
    }
    //--------------------------------------------------------------------------------
    public function setOrdering( $strNewValue = null )
    {
        $this->ordering = $strNewValue;
    }
    public function getOrdering()
    {
        return $this->ordering;
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
    public function setMetadesc( $strNewValue = null )
    {
        $this->metadesc = $strNewValue;
    }
    public function getMetadesc()
    {
        return $this->metadesc;
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
    public function setHits( $strNewValue = null )
    {
        $this->hits = $strNewValue;
    }
    public function getHits()
    {
        return $this->hits;
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
    public function setFeatured( $strNewValue = null )
    {
        $this->featured = $strNewValue;
    }
    public function getFeatured()
    {
        return $this->featured;
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
    public function setXreference( $strNewValue = null )
    {
        $this->xreference = $strNewValue;
    }
    public function getXreference()
    {
        return $this->xreference;
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
}
?>