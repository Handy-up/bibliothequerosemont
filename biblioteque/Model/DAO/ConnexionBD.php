<?php

// inclure la configuration
include_once("Config/ConfigBD.interface.php");
class connexionBD
{
    public static $instance =  null;

    //public function __construct(){}

    public static function getInstanceT()
    {
//
        if (self::$instance == null){
//            paramètres de configuration PDO
            $config ="mysql:host=".ConfigurationBD::BD_HOST.";dbname=".ConfigurationBD::BD_NAME;
            $userName = ConfigurationBD::BD_USER;
            $userPassWord = ConfigurationBD::BD_PASS_WORD;

            try {
                self::$instance = new PDO($config,$userName,$userPassWord);
            }catch (PDOException $err){
                echo $err;
            }

            //  S’assurer que les transactions se font avec les caractères UTF8

        }
        return self::$instance;
    }

    public static function fermerConnexion()
    {
        self::$instance=null;
    }


}