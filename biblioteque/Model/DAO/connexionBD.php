<?php

// inclure la configuration
include_once ("Config/configBD.interface.php");
class connexionBD
{
    public static $instance =  null;

    public function __construct(){}

    public static function getInstance()
    {
//
        if (self::$instance == null){
//            paramètres de configuration PDO
            $config ="mysql:host=".ConfigurationBD::BD_HOST."dbname=".ConfigurationBD::BD_NAME;
            $userName = ConfigurationBD::BD_USER;
            $userPassWord = ConfigurationBD::BD_PASS_WORD;

            self::$instance = new PDO($config,$userName,$userPassWord);

            //  S’assurer que les transactions se font avec les caractères UTF8
            self::$instance->exec("SET character_set_results = 'utf8'");
            self::$instance->exec("SET character_set_client = 'utf8'");
            self::$instance->exec("SET character_set_connection = 'utf8'");
        }
        return self::$instance;
    }

    public static function fermerConnexion(){
        self::$instance=null;
    }


}