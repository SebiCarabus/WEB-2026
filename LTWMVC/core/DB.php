<?php
declare(strict_types=1);
class DB{
    private static ?PDO $pdo=NULL;

    public static function getConnection():PDO{
        if(self::$pdo==NULL){
            $host='localhost';
            $dbname = 'issuesdb';
            $password = '';
            $username ='root';
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ];
            self::$pdo = new PDO("mysql:host=$host;dbname=$dbname;",$username,$password,$options);
        }
        return  self::$pdo;
    }
}