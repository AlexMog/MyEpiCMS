<?php

/**
 * File SQLConnector.php
 * Encoded with: UTF-8
 * Created date: Jun 13, 2013 at 1:53:14 PM 
 * @author moghra_a
 */
class SQLConnector {
    private $pdo_object;
    
    public function __construct() {
        try {
            $this->pdo_object = new PDO('mysql:host='.MYSQL_SERVER.';dbname='.MYSQL_DB, MYSQL_USER, MYSQL_PASSWORD);
        } catch(Exception $e) {
            echo "MySQL error: ".$e->getMessage();
            die();
        }
    }
}

?>
