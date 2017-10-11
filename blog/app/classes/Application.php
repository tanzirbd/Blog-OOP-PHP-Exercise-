<?php

namespace App\classes;
use App\classes\Database;

class Application {
    public function getAllPublishedBlog() {
        $sql ="SELECT * FROM blogs WHERE publication_status = 1 ";
        if(mysqli_query(Database::db_connect(), $sql)) {
            $queryResult = mysqli_query(Database::db_connect(), $sql);
            return $queryResult;
        } else {
            die('Query Problem'.mysqli_error(Database::db_connect()));
        }
    }
    
    
    
}
