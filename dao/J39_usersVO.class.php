<?php
/**
 * System generated by SysGen (System Generator with Formdin Framework) 
 * Download SysGen: https://github.com/bjverde/sysgen
 * Download Formdin Framework: https://github.com/bjverde/formDin
 * 
 * SysGen  Version: 1.10.1-alpha
 * FormDin Version: 4.7.9-alpha
 * 
 * System migraj created in: 2019-11-22 18:12:07
 */
class J39_usersVO
{
    private $id = null;
    private $name = null;
    private $username = null;
    private $email = null;
    private $password = null;
    private $block = null;
    private $sendemail = null;
    private $registerdate = null;
    private $lastvisitdate = null;
    private $activation = null;
    private $params = null;
    private $lastresettime = null;
    private $resetcount = null;
    private $otpkey = null;
    private $otep = null;
    private $requirereset = null;
    public function __construct( $id=null, $name=null, $username=null, $email=null, $password=null, $block=null, $sendemail=null, $registerdate=null, $lastvisitdate=null, $activation=null, $params=null, $lastresettime=null, $resetcount=null, $otpkey=null, $otep=null, $requirereset=null ) {
        $this->setId( $id );
        $this->setName( $name );
        $this->setUsername( $username );
        $this->setEmail( $email );
        $this->setPassword( $password );
        $this->setBlock( $block );
        $this->setSendemail( $sendemail );
        $this->setRegisterdate( $registerdate );
        $this->setLastvisitdate( $lastvisitdate );
        $this->setActivation( $activation );
        $this->setParams( $params );
        $this->setLastresettime( $lastresettime );
        $this->setResetcount( $resetcount );
        $this->setOtpkey( $otpkey );
        $this->setOtep( $otep );
        $this->setRequirereset( $requirereset );
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
    public function setName( $strNewValue = null )
    {
        $this->name = $strNewValue;
    }
    public function getName()
    {
        return $this->name;
    }
    //--------------------------------------------------------------------------------
    public function setUsername( $strNewValue = null )
    {
        $this->username = $strNewValue;
    }
    public function getUsername()
    {
        return $this->username;
    }
    //--------------------------------------------------------------------------------
    public function setEmail( $strNewValue = null )
    {
        $this->email = $strNewValue;
    }
    public function getEmail()
    {
        return $this->email;
    }
    //--------------------------------------------------------------------------------
    public function setPassword( $strNewValue = null )
    {
        $this->password = $strNewValue;
    }
    public function getPassword()
    {
        return $this->password;
    }
    //--------------------------------------------------------------------------------
    public function setBlock( $strNewValue = null )
    {
        $this->block = $strNewValue;
    }
    public function getBlock()
    {
        return $this->block;
    }
    //--------------------------------------------------------------------------------
    public function setSendemail( $strNewValue = null )
    {
        $this->sendemail = $strNewValue;
    }
    public function getSendemail()
    {
        return $this->sendemail;
    }
    //--------------------------------------------------------------------------------
    public function setRegisterdate( $strNewValue = null )
    {
        $this->registerdate = $strNewValue;
    }
    public function getRegisterdate()
    {
        return $this->registerdate;
    }
    //--------------------------------------------------------------------------------
    public function setLastvisitdate( $strNewValue = null )
    {
        $this->lastvisitdate = $strNewValue;
    }
    public function getLastvisitdate()
    {
        return $this->lastvisitdate;
    }
    //--------------------------------------------------------------------------------
    public function setActivation( $strNewValue = null )
    {
        $this->activation = $strNewValue;
    }
    public function getActivation()
    {
        return $this->activation;
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
    public function setLastresettime( $strNewValue = null )
    {
        $this->lastresettime = $strNewValue;
    }
    public function getLastresettime()
    {
        return $this->lastresettime;
    }
    //--------------------------------------------------------------------------------
    public function setResetcount( $strNewValue = null )
    {
        $this->resetcount = $strNewValue;
    }
    public function getResetcount()
    {
        return $this->resetcount;
    }
    //--------------------------------------------------------------------------------
    public function setOtpkey( $strNewValue = null )
    {
        $this->otpkey = $strNewValue;
    }
    public function getOtpkey()
    {
        return $this->otpkey;
    }
    //--------------------------------------------------------------------------------
    public function setOtep( $strNewValue = null )
    {
        $this->otep = $strNewValue;
    }
    public function getOtep()
    {
        return $this->otep;
    }
    //--------------------------------------------------------------------------------
    public function setRequirereset( $strNewValue = null )
    {
        $this->requirereset = $strNewValue;
    }
    public function getRequirereset()
    {
        return $this->requirereset;
    }
    //--------------------------------------------------------------------------------
}
?>