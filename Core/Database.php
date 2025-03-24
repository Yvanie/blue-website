<?php

namespace BleuWebsite\Core;

use PDO;
use PDOException;
use Dotenv\Dotenv;
/**
 * Classe de la connexion à la base des données
 */
class Database extends PDO
{
    private static $_instance;
    protected $servername;
    protected $username;
    protected $password;
    protected $database;
    public function __construct()
    {
       $dotenv =Dotenv::createImmutable(dirname(__DIR__));
       $dotenv->load();
       $this->servername=$_ENV['DB_HOST'];
       $this->database=$_ENV['DB_DATABASE'];
       $this->username=$_ENV['DB_USER'];
       $this->password=$_ENV['DB_PASSWORD'];
 
        $_dsn = 'mysql:dbname=' . $this->database . ';host=' . $this->servername;
        try {
            parent::__construct($_dsn, $this->username, $this->password);
            $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $error) {
            die($error->getMessage());
        }
    }

	/**
	 * Fonction d'instanciation de la connexion à la BDD
	 *
	 * @return void
	 */
    public static function getInstance()
    {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
}
