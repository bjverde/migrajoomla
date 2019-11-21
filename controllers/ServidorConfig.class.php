<?php

if ( !defined('DS') ){ define('DS'   , DIRECTORY_SEPARATOR); }
class ServidorConfig 
{
    const NOME_ARQUIVO_CONFIG = 'migrajoomla.ini';
    const DATABASE = 'database';

    /**
     * Contém uma instância de ServidorConfig para implementação do padrão GoF Singleton.
     */
    private static $instancia = null;
    
    private $perfilJ25 = array();
    private $perfilJ39 = array();
    
    private $config = array();
    
    
    /**
     * Construtor Singleton.
     */
    private function __construct() {
        $root     = $_SERVER['DOCUMENT_ROOT'];
        $ini_path = $root .DS.'config'.DS.self::NOME_ARQUIVO_CONFIG;
        $ini_conf = null;
        if(file_exists($ini_path)){
            $ini_conf = parse_ini_file($ini_path, true);
        }else{ 
            throw new InvalidArgumentException('Arquivo '.self::NOME_ARQUIVO_CONFIG.' não encontrado');
        }
        
        foreach ( $ini_conf as &$conf ){
            if ( !empty($conf[self::DATABASE]) ){
                $conf[self::DATABASE] = strtoupper($conf[self::DATABASE]);
            }
        }
        
        $this->perfilJ25         = $ini_conf['ds-j25'];
        $this->perfilJ39         = $ini_conf['ds-j39'];
        $this->config 			 = $ini_conf['config'];
    }
    
    /**
     * Trata a clonagem da classe como impossível de ser clonada. Ao se utilizar o operador clone sobre uma instância da classe o sistema é encerrado.
     */
    public function __clone() {
        die('O objeto do tipo ServidorConfig não pode ser clonado.');
    }
    
    /**
     * Retorna a única instância da classe que o sistema deverá acessar. Implementação do padrão GoF Singleton.
     * @return ServidorConfig
     */
    public static function getInstancia() {
        if(is_null(self::$instancia)) {
            self::$instancia = new self;
        }
        return self::$instancia;
    }
    
    public function getPerfilJ25() {
        return $this->perfilJ25;
    }

    public function getPerfilJ39() {
        return $this->perfilJ39;
    }
    
    public function getConfig(){
        return $this->config;
    }
    
    public function getConfigParam($param){
        return $this->config[$param];
    }
    
}