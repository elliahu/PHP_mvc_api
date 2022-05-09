<?php
class Database{
    // třída pro práci s MySQL databází (obecně)

    // připojení k databázi
    // PŘEPSAT !!!
    private static $username = "root";
    private static $servername = "localhost";
    private static $password = "";
    private static $dbname = "apidb";

    // provedení příkazu, který nevrací výsledek (např. INSERT)
    static function executeNonQuery($command){
        // vytvoření spojení
        $connection = new PDO("mysql:host=".self::$servername.";dbname=".self::$dbname, self::$username, self::$password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // provedení
        $connection->exec($command);
        $connection = null; // dealokace spojení
    }

    static function executeReader($command){
        // vytvoření spojení
        $connection = new PDO("mysql:host=".self::$servername.";dbname=".self::$dbname, self::$username, self::$password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $connection->prepare($command);
        $stmt->execute();

        // vrátí pole vásledků
        return $stmt->fetchAll();
    }
}
?>