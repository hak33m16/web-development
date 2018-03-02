<?php

include 'PDODBConnector.php';

class DatabaseHelper {
	private static $pdo = null;

    public static function setConnectionInfo() {
          self::$pdo = PDODBConnector::getInstance()->getConnection();
    }

    public static function runQuery($sql, $parameters=array()){
        self::$pdo ?: self::setConnectionInfo();        
        // Ensure parameters are in an array
        if (!is_array($parameters)) {
            $parameters = array($parameters);
        }

        $statement = null;
        if (count($parameters) > 0) {
            // Use a prepared statement if parameters 
            $statement = self::$pdo->prepare($sql);
            $executedOk = $statement->execute($parameters);
            if (! $executedOk) {
                throw new PDOException;
            }
        } else {
            // Execute a normal query     
            $statement = self::$pdo->query($sql); 
            if (!$statement) {
                throw new PDOException;
            }
        }
        return $statement;
    }    
    
}
?>
