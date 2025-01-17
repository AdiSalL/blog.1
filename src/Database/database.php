<?php


namespace Pc\Blogapp\Database;

class Database {
    private static ?\PDO $pdo = null;
    
    public static function getConnection(): \PDO {
    if(self::$pdo == null) {
        require_once __DIR__ . "/../Config/config.php";
        $config = getDatabaseConfig();  
        self::$pdo = new \PDO(
            $config["database"]["host"],
            $config["database"]["user"],
            $config["database"]["password"],
            
        );
    }

    return self::$pdo;
}


public static function beginTransaction() {
    self::$pdo->beginTransaction();
}

public static function commitTransaction() {
    self::$pdo->commit();
}

public static function rollbackTransaction() {
    self::$pdo->rollback();
}
}
