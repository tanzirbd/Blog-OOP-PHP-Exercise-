<?php
namespace App\classes;
class Database
{
    public function db_connect(){
        $hostName = 'localhost';
        $userName = 'root';
        $password = '';
        $dbName = 'blog';
        $link = mysqli_connect($hostName, $userName, $password, $dbName);
        return $link;
    }
}