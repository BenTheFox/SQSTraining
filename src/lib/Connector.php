<?php
/**
 * Created by PhpStorm.
 * User: connor
 * Date: 10/8/18
 * Time: 11:35 PM
 */

//require_once(__DIR__.'/../config/config.ini');
require_once(__DIR__.'/../config/config.php');

/**
 * Class Connector
 *
 *
 */

class Connector extends PDO{

    private static $conn;

    /**
     * Connector constructor.
     */
    public function __construct(){

        //$config = parse_ini_file("../config/config.ini");

        //$db = $config['db'];
        //$dbhost = $config['dbhost'];
        //$dbport = $config['dbport'];
        //$dbname = $config['dbname'];
        //$dbuser = $config['dbuser'];
        //$dbpass = $config['dbpass'];

        //$db_dsn = "$db:dbname=$dbname;host=$dbhost;port=$dbport";
        //$db_dsn = "$db:dbname=$dbname;host=$dbhost";

        try{
            //$this->conn = new PDO($db_dsn, $dbuser, $dbpass);
            parent::__construct(DB_DSN, DB_USER, DB_PASSWORD);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->setAttribute(PDO::ATTR_EMULATE_PREPARES,TRUE);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }

    /**
     * @return Connector
     */
    public function getDatabase(){
        // Create the connection if not already created
        if (self::$conn == null) {
            self::$conn = new self();
        }
        // And return a reference to that connection
        return self::$conn;
    }

}