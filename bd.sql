<?php

class Banco
{
    private static $dbNome = '';
    private static $dbHost = '';
    private static $dbUsuario = '';
    private static $dbSenha = '';
    
    private static $cont = null;
    
    public function __construct() 
    {
        die('A função Init nao é permitido!');
    }
    
    public static function conectar()
    {
        if(null == self::$cont)
        {
            try
            {
                self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbNome, self::$dbUsuario, self::$dbSenha); 
            }
            catch(PDOException $exception)
            {
                die($exception->getMessage());
            }
        }
        return self::$cont;
    }
    
    public static function desconectar()
    {
        self::$cont = null;
    }
}

?>

--quiz
CREATE TABLE leads (

id INT AUTO_INCREMENT PRIMARY KEY,

nome VARCHAR(100),

email VARCHAR(150),

telefone VARCHAR(30),

resultado VARCHAR(100),

dataCadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP

);